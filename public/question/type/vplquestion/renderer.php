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
 * Vplquestion renderer class.
 * @package    qtype_vplquestion
 * @copyright  2024 Astor Bizard
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use qtype_vplquestion\locallib;

/**
 * Generates HTML output for vplquestion.
 * @copyright  2024 Astor Bizard
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_vplquestion_renderer extends qtype_renderer {
    /**
     * {@inheritDoc}
     * @param question_attempt $qa the question attempt to display.
     * @param question_display_options $options controls what should and should not be displayed.
     * @see qtype_renderer::formulation_and_controls()
     */
    public function formulation_and_controls(question_attempt $qa, question_display_options $options) {
        global $USER;

        $question = $qa->get_question();

        $userid = $USER->id;
        $qid = $question->id;
        $vplid = $question->templatevpl;

        $inputname = $qa->get_qt_field_name('answer');
        $lastanswer = $qa->get_last_qt_var('answer');
        if ($lastanswer == null) {
            $lastanswer = $question->answertemplate;
        }

        $html = parent::formulation_and_controls($qa, $options);
        $html .= html_writer::start_div('mt-1 mb-3');

        global $CFG;
        require_once($CFG->dirroot . '/mod/vpl/vpl.class.php');
        try {
            $vpl = new mod_vpl($vplid);
            [ $course, $cm ] = get_course_and_cm_from_cmid($vplid, 'vpl');
            if ($course->id != $this->page->course->id) {
                $html .= $this->output->notification(get_string('vplnotincoursewarning', 'qtype_vplquestion'), 'warning');
            } else if (!$cm->visible && !(method_exists('mod_vpl', 'is_vpl_question_mode') && $vpl->is_vpl_question_mode())) {
                $html .= $this->output->notification(get_string('vplnotavailablewarning', 'qtype_vplquestion'), 'warning');
            }
        } catch (moodle_exception $e) {
            // Something went wrong instantiating the VPL, the question is badly configured.
            $html .= $this->output->notification(get_string('vplnotfounderror', 'qtype_vplquestion', $e->getMessage()), 'error');
            return $html . html_writer::end_div();
        }

        $this->output->page->requires->strings_for_js([
                'closerecievednoretrieve',
                'compilation',
                'execution',
                'evaluation',
                'evaluationerror',
                'execerror',
                'editoroptions',
        ], 'qtype_vplquestion');
        $this->output->page->requires->strings_for_js([ 'savechanges', 'cancel' ], 'moodle');
        $this->output->page->requires->js_call_amd(
            'mod_vpl/vplutil',
            'init',
            [ (object)[ 'scriptPath' => $CFG->wwwroot . '/mod/vpl/editor' ] ]
        );
        $this->output->page->requires->js_call_amd(
            'qtype_vplquestion/studentanswer',
            'setup',
            [ $qid, $vplid, $userid, $inputname ]
        );

        // Store installed ace themes in hidden element for editor preferences form.
        $html .= locallib::get_installed_themes_html_fragment_for_js();

        // Find the line where the {{ANSWER}} tag is located, to offset line numbers on Ace editor.
        // This offset is useful for compilation errors, so that error line will match editor line.
        $lineoffset = 1;
        foreach (explode("\n", $question->templatecontext) as $index => $line) {
            if (strpos($line, "{{ANSWER}}") !== false) {
                $lineoffset = $index + 1;
            }
        }

        $templatecontext = new stdClass();
        $templatecontext->qid = $qid;
        $templatecontext->readonly = $options->readonly;
        $templatecontext->inputname = $inputname;
        $templatecontext->lineoffset = $lineoffset;
        $templatecontext->templatelang = $question->templatelang;
        $templatecontext->lastanswer = $lastanswer;
        $templatecontext->run = $vpl->get_instance()->run;
        $templatecontext->precheck = $question->precheckpreference != 'none';
        $templatecontext->precheckaction = $question->precheckpreference == 'dbg' ? 'debug' : 'evaluate';
        $templatecontext->answertemplate = $question->answertemplate;
        $templatecontext->correction = has_capability('moodle/question:editall', $this->page->context);
        $templatecontext->teachercorrection = $question->teachercorrection;
        $html .= $this->output->render_from_template('qtype_vplquestion/question', $templatecontext);

        $html .= html_writer::end_div();

        return $html;
    }

    /**
     * Decide what to show in question state badge.
     * @param question_state $state Current question state.
     */
    protected function get_badge_label(question_state $state) {
        if ($state == question_state::$needsgrading) {
            return get_string('awaitingasyncevaluation', 'qtype_vplquestion');
        } else {
            return $state->default_string(true);
        }
    }

    /**
     * {@inheritDoc}
     * @param question_attempt $qa the question attempt to display.
     * @see qtype_renderer::specific_feedback()
     */
    public function specific_feedback(question_attempt $qa) {
        $feedback = '';
        if ($qa->get_state()->is_finished()) {
            $feedback = '<div class="correctness ' . $qa->get_state_class(true) . ' badge text-white">' .
                            $this->get_badge_label($qa->get_state()) .
                        '</div>';
        }
        if ($qa->get_state()->is_graded()) {
            $evaldata = $qa->get_last_qt_var('_evaldata', null);
            if ($evaldata === null) {
                // In older versions (<= 2021070700), evaluation data was stored as response summary.
                // Keep this piece of code to handle old question attempts.
                $evaldata = $qa->get_response_summary();
            }
            $displayid = 'vpl_eval_details_qa' . $qa->get_database_id();
            $feedback .= '<div class="mt-1">
                            <h5>' . get_string('evaluationdetails', 'qtype_vplquestion') . '</h5>
                            <div id="' . $displayid . '" class="bg-white p-2 border text-body" data-result="' . s($evaldata) . '">
                            </div>
                         </div>';
            $this->output->page->requires->js_call_amd('qtype_vplquestion/studentanswer', 'displayResult', [ $displayid, null ]);
        }
        if ($qa->get_state() == question_state::$needsgrading) {
            $feedback .= $this->async_evaluation_info($qa);
        }
        return $feedback;
    }

    /**
     * {@inheritDoc}
     * @param question_attempt $qa the question attempt to display.
     * @see qtype_renderer::correct_response()
     */
    public function correct_response(question_attempt $qa) {
        if (!$qa->get_question()->teachercorrection) {
            return '';
        }
        return '<h5>' . get_string('possiblesolution', 'qtype_vplquestion') . '</h5>' .
               '<pre class="line-height-3">' . s($qa->get_question()->teachercorrection) . '</pre>';
    }

    /**
     * Generate information about current status of asynchronous evaluation for the question.
     * @param question_attempt $qa
     * @return string HTML fragment
     */
    public function async_evaluation_info(question_attempt $qa) {
        if ($qa->get_state() != question_state::$needsgrading) {
            return '';
        }
        $usageid = $qa->get_usage_id();
        $slot = $qa->get_slot();
        [ $queued, $message ] = locallib::get_async_evaluation_status($usageid, $slot, true);
        if (!$queued) {
            // Evaluation is not queued, there is no information about async task to display.
            return '';
        }
        // Call js to check when this task is finished.
        $this->page->requires->strings_for_js([ 'state', 'marks' ], 'question');
        $this->page->requires->string_for_js('gradehaschangedreload', 'qtype_vplquestion');
        $this->page->requires->js_call_amd('qtype_vplquestion/evaluationobserver', 'init', [
                $qa->get_outer_question_div_unique_id(),
                $usageid,
                $slot,
                $this->page->url->out(false),
        ]);
        $message = html_writer::span($message, '', [ 'data-qtype_vplquestion-role' => 'async-eval-info' ]);
        $loadingicon = html_writer::span($this->output->render_from_template('core/loading', []), 'mx-1');
        return html_writer::div($loadingicon . $message, 'mt-1');
    }

    /**
     * {@inheritDoc}
     * @param question_attempt $qa The question attempt that will be displayed on the page.
     * @see qtype_renderer::head_code()
     */
    public function head_code(question_attempt $qa) {
        $this->output->page->requires->jquery_plugin('ui'); // Load jQueryUI because mod_vpl scripts need it.
        return parent::head_code($qa);
    }
}
