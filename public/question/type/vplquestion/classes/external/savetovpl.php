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
 * External functions for
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
use mod_vpl;
use mod_vpl_edit;
use moodle_exception;
use qtype_vplquestion\locallib;

/**
 * External functions for
 * @copyright  2026 Astor Bizard
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class savetovpl extends external_api {
    /**
     * Defines the parameters of the save_files function.
     * @return external_function_parameters
     */
    public static function save_files_parameters() {
        return new external_function_parameters([
                'questionid' => new external_value(PARAM_INT, 'Question ID'),
                'answer' => new external_value(PARAM_RAW, 'User current answer that will be inserted in place of {{ANSWER}} tag'),
                'filestype' => new external_value(PARAM_RAW, 'Either "run" or "precheck" to know which execution filse to include'),
        ]);
    }

    /**
     * Save an answer to a VPL Question along with execution files as a submission on the VPL activity.
     * @param int $questionid Question ID.
     * @param string $answer User current answer that will be inserted in place of {{ANSWER}} tag.
     * @param string $filestype Either "run" or "precheck" to know which execution filse to include.
     * @return object defined by save_files_returns()
     */
    public static function save_files($questionid, $answer, $filestype) {
        [ $questionid, $answer, $filestype ] = array_values(self::validate_parameters(self::save_files_parameters(), [
                'questionid' => $questionid,
                'answer' => $answer,
                'filestype' => $filestype,
        ]));

        global $CFG, $DB, $USER;

        $question = $DB->get_record('question_vplquestion', [ 'questionid' => $questionid ], '*', MUST_EXIST);

        require_once($CFG->dirroot . '/mod/vpl/vpl.class.php');
        require_once($CFG->dirroot . '/mod/vpl/forms/edit.class.php');
        $vpl = new mod_vpl($question->templatevpl);
        require_login($vpl->get_course(), false);

        if (!$vpl->is_submit_able()) {
            throw new moodle_exception('notavailable');
        }

        $reqfile = locallib::get_reqfile_for_submission($question, $answer);

        if ($filestype == 'run') {
            $filestokeep = $vpl->get_execution_fgm()->getfilekeeplist();
            $execfiles = locallib::format_execution_files(json_decode($question->execfiles), $filestokeep);
        } else if ($filestype == 'precheck') {
            $execfilesdata = $question->precheckpreference == 'diff' ? $question->precheckexecfiles : $question->execfiles;
            $execfiles = locallib::format_execution_files(json_decode($execfilesdata));
        } else {
            throw new moodle_exception('invalidparameter', 'debug');
        }

        $files = $reqfile + $execfiles;
        mod_vpl_edit::save($vpl, $USER->id, $files);

        return true;
    }

    /**
     * Defines the return type of the save_files function.
     * @return external_description
     */
    public static function save_files_returns() {
        return new external_value(PARAM_BOOL, 'True on success');
    }
}
