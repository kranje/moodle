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
 * Question type class for the vplquestion question type.
 * @package    qtype_vplquestion
 * @copyright  2024 Astor Bizard
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/question/type/questiontypebase.php');

/**
 * The vplquestion type class.
 * @copyright  2024 Astor Bizard
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_vplquestion extends question_type {
    /**
     * {@inheritDoc}
     * @see question_type::extra_question_fields()
     */
    public function extra_question_fields() {
        return [
                "question_vplquestion",
                "templatevpl",
                "templatelang",
                "templatecontext",
                "answertemplate",
                "teachercorrection",
                "validateonsave",
                "execfiles",
                "precheckpreference",
                "precheckexecfiles",
                "gradingmethod",
                "deletesubmissions",
                "useasynceval",
        ];
    }

    /**
     * {@inheritDoc}
     * @param stdClass $fromform data from the form.
     * @see question_type::save_defaults_for_new_questions()
     */
    public function save_defaults_for_new_questions(stdClass $fromform): void {
        parent::save_defaults_for_new_questions($fromform);
        $this->set_default_value('precheckpreference', $fromform->precheckpreference);
        $this->set_default_value('gradingmethod', $fromform->gradingmethod);
        $this->set_default_value('deletesubmissions', $fromform->deletesubmissions);
        $this->set_default_value('useasynceval', $fromform->useasynceval);
    }

    /**
     * Imports question from the Moodle XML format.
     *
     * This function uses the default behavior and checks that template VPL is valid.
     *
     * @param mixed $data
     * @param mixed $question
     * @param qformat_xml $format
     * @param mixed|null $extra
     *
     * @see question_type::import_from_xml()
     */
    public function import_from_xml($data, $question, qformat_xml $format, $extra = null) {
        global $COURSE;
        $importdata = parent::import_from_xml($data, $question, $format, $extra);
        $oldcm = get_coursemodule_from_id('vpl', $importdata->templatevpl);
        if ($oldcm) {
            $templatevplname = $format->getpath($data, [ '#', 'templatevplname', 0, '#' ], false, true);
            if ($oldcm->course != $COURSE->id && $templatevplname) {
                $vplsincourse = array_column(get_coursemodules_in_course('vpl', $COURSE->id), 'name', 'id');
                $cmid = array_search(format_string($templatevplname), array_map('format_string', $vplsincourse), true);
                if ($cmid) {
                    $importdata->templatevpl = (int) $cmid;
                    core\notification::info(get_string('templatevplautosetnotice', 'qtype_vplquestion', $importdata->name));
                } else {
                    core\notification::warning(
                        get_string('cannotimportquestionvplunreachable', 'qtype_vplquestion', $importdata->name)
                    );
                }
            }
        } else {
            core\notification::warning(get_string('cannotimportquestionvplnotfound', 'qtype_vplquestion', $importdata->name));
        }
        return $importdata;
    }

    /**
     * Export question to the Moodle XML format
     *
     * Adds templatevplname (readable name of the template VPL) for reference in the export.
     * @param object $question question to be exported into XML format
     * @param qformat_xml $format format class exporting the question
     * @param object $extra extra information (not required for exporting this question in this format)
     * @return string containing the question data in XML format
     * @see question_type::export_to_xml()
     */
    public function export_to_xml($question, qformat_xml $format, $extra = null) {
        $output = parent::export_to_xml($question, $format, $extra);
        if ($output === false) {
            return false;
        }
        $templatevplname = get_coursemodule_from_id('vpl', $question->options->templatevpl)->name ?? '';
        if ($templatevplname) {
            $tag = "    <templatevplname>" . $format->xml_escape($templatevplname) . "</templatevplname>\n";
            // Insert right after </templatevpl> so the new field stays with question options.
            $output = str_replace("</templatevpl>\n", "</templatevpl>\n" . $tag, $output);
        }
        return $output;
    }
}
