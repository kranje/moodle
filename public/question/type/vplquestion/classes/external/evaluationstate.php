<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * External functions for checking asynchronous evaluation state.
 * @package    qtype_vplquestion
 * @copyright  2026 Astor Bizard
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace qtype_vplquestion\external;

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->libdir . '/externallib.php');

use external_api;
use external_description;
use external_function_parameters;
use external_single_structure;
use external_value;
use mod_quiz\quiz_attempt;
use qtype_vplquestion\locallib;

/**
 * External functions for checking asynchronous evaluation state.
 * @copyright  2026 Astor Bizard
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class evaluationstate extends external_api {
    /**
     * Defines the parameters of the check_evaluation_state function.
     * @return external_function_parameters
     */
    public static function check_evaluation_state_parameters() {
        return new external_function_parameters([
                'usageid' => new external_value(PARAM_INT, 'Question usage id'),
                'slot' => new external_value(PARAM_INT, 'Question slot'),
                'url' => new external_value(PARAM_RAW, 'Current URL, used for display options'),
        ]);
    }

    /**
     * Checks the state of an evaluation task and returns rendering and question feedback info if it has been evaluated.
     * @param int $usageid Question usage id.
     * @param int $slot Question slot.
     * @param string $url Current URL, used for display options.
     * @return object defined by check_evaluation_state_returns()
     */
    public static function check_evaluation_state($usageid, $slot, $url) {
        [ $usageid, $slot, $url ] = array_values(self::validate_parameters(self::check_evaluation_state_parameters(), [
                'usageid' => $usageid,
                'slot' => $slot,
                'url' => $url,
        ]));

        [ $queued, $message ] = locallib::get_async_evaluation_status($usageid, $slot, true);
        if ($queued) {
            // Evaluation is still queued, question has not been evaluated yet.
            return [
                    'finished' => false,
                    'progressmessage' => $message,
            ];
        } else {
            // Evaluation is not queued anymore, question has been evaluated.
            global $PAGE;
            // Get context, renderers and display options.
            $quizattempt = quiz_attempt::create_from_usage_id($usageid);
            self::validate_context(\context_module::instance($quizattempt->get_cmid()));
            $reviewing = (new \moodle_url($url))->get_path(false) == '/mod/quiz/review.php';
            $questionattempt = $quizattempt->get_question_attempt($slot);
            $displayoptions = $quizattempt->get_display_options_with_edit_link($reviewing, $slot, $url);
            $qoutput = $PAGE->get_renderer('core', 'question');
            $qtoutput = $questionattempt->get_question()->get_renderer($PAGE);
            $behaviouroutput = $questionattempt->get_behaviour()->get_renderer($qoutput->get_page());

            // Retrieve feedback.
            $PAGE->start_collecting_javascript_requirements();
            $qfeedback = $qtoutput->feedback($questionattempt, $displayoptions);
            $bfeedback = $behaviouroutput->feedback($questionattempt, $displayoptions);
            $javascript = $PAGE->requires->get_end_code();
            $PAGE->end_collecting_javascript_requirements();

            // Build response object.
            $qfeedback = \html_writer::nonempty_tag('div', $qfeedback, [ 'class' => 'feedback' ]);
            $bfeedback = \html_writer::nonempty_tag('div', $bfeedback, [ 'class' => 'im-feedback' ]);
            $state = $questionattempt->get_state_string($displayoptions->correctness);
            $grade = $behaviouroutput->mark_summary($questionattempt, $qoutput, $displayoptions);
            if ($displayoptions->marks >= \question_display_options::MARK_AND_MAX) {
                $marks = $questionattempt->format_fraction_as_mark(
                    $questionattempt->get_fraction(),
                    $displayoptions->markdp
                );
            } else {
                $marks = '';
            }
            $navbutton = [
                    'id' => 'quiznavbutton' . $slot,
                    'title' => $questionattempt->get_state_string($displayoptions->correctness),
                    'oldclass' => \question_state::$needsgrading->get_state_class($displayoptions->correctness),
                    'newclass' => $questionattempt->get_state_class($displayoptions->correctness),
            ];
            $sequencecheck = [
                    'name' => $questionattempt->get_control_field_name('sequencecheck'),
                    'value' => $questionattempt->get_sequence_check_count(),
            ];

            return [
                    'finished' => true,
                    'evaluationresults' => [
                            'qfeedback' => $qfeedback,
                            'bfeedback' => $bfeedback,
                            'javascript' => $javascript,
                            'state' => $state,
                            'grade' => $grade,
                            'marks' => $marks,
                            'navbutton' => $navbutton,
                            'sequencecheck' => $sequencecheck,
                    ],
            ];
        }
    }

    /**
     * Defines the return type of the check_evaluation_state function.
     * @return external_description
     */
    public static function check_evaluation_state_returns() {
        return new external_single_structure([
                'finished' => new external_value(PARAM_BOOL, 'Whether finished'),
                'progressmessage' => new external_value(PARAM_RAW, 'Progress message, if not finished', VALUE_OPTIONAL),
                'evaluationresults' => new external_single_structure([
                        'qfeedback' => new external_value(PARAM_RAW, 'Question feedback'),
                        'bfeedback' => new external_value(PARAM_RAW, 'Behaviour feedback'),
                        'javascript' => new external_value(PARAM_RAW, 'Any javascript that came with the feedback'),
                        'state' => new external_value(PARAM_RAW, 'Question state string'),
                        'grade' => new external_value(PARAM_RAW, 'Question grade string'),
                        'marks' => new external_value(PARAM_RAW, 'Question marks string'),
                        'navbutton' => new external_single_structure([
                                'id' => new external_value(PARAM_RAW, 'Question navigation button ID'),
                                'title' => new external_value(PARAM_RAW, 'Button title'),
                                'oldclass' => new external_value(PARAM_RAW, 'The previous class'),
                                'newclass' => new external_value(PARAM_RAW, 'The new class'),
                        ]),
                        'sequencecheck' => new external_single_structure([
                                'name' => new external_value(PARAM_RAW, 'Sequence check field name'),
                                'value' => new external_value(PARAM_INT, 'Sequence check value'),
                        ]),
                ], 'All useful information to display and alter the page with, if finished', VALUE_OPTIONAL),
        ]);
    }
}
