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
 * Defines the editing form for the vplquestion question type.
 * @package    qtype_vplquestion
 * @copyright  2024 Astor Bizard
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use qtype_vplquestion\locallib;

/**
 * Vplquestion editing form definition.
 * @copyright  2024 Astor Bizard
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_vplquestion_edit_form extends question_edit_form {
    /**
     * Question type name.
     * @see question_edit_form::qtype()
     */
    public function qtype() {
        return 'vplquestion';
    }

    /**
     * Add our fields to the form.
     * @param MoodleQuickForm $mform The form being built.
     * @see question_edit_form::definition_inner()
     */
    protected function definition_inner($mform) {
        // Create form fields.
        $this->add_vpl_template_field($mform);
        $this->add_answer_template_field($mform);
        $this->add_teacher_correction_field($mform);
        $this->add_execfiles_field($mform);
        $this->add_additional_options($mform);

        // Setup Ace editors and form behavior.
        global $PAGE, $OUTPUT;
        $PAGE->requires->jquery_plugin('ui'); // Load jQueryUI because mod_vpl scripts need it.
        $templatechangehelp = $OUTPUT->help_icon('templatevplchange', 'qtype_vplquestion', get_string('help'));
        $PAGE->requires->strings_for_js([
                'merge',
                'overwrite',
                'templatevplchange',
                'templatevplchangeprompt',
                'switchbacktodefaultfile',
                'switchbacktodefaultfileprompt',
        ], 'qtype_vplquestion');
        $PAGE->requires->strings_for_js([ 'confirm', 'cancel' ], 'moodle');
        $PAGE->requires->string_for_js('binaryfile', 'mod_vpl');
        $PAGE->requires->js_call_amd('qtype_vplquestion/editform', 'setup', [ $templatechangehelp ]);
    }

    /**
     * Add a field for selecting the template VPL and editing the template.
     * @param MoodleQuickForm $mform the form being built.
     */
    protected function add_vpl_template_field($mform) {
        global $COURSE, $OUTPUT;
        $this->create_header($mform, 'qvplbase');

        $basevpls = array_map('format_string', array_column(get_coursemodules_in_course('vpl', $COURSE->id), 'name', 'id'));
        $basevpls = [ '' => get_string('choose', 'qtype_vplquestion') ] + $basevpls;
        $group = [];
        $group[] =& $mform->createElement('select', 'templatevpl', null, $basevpls);
        // Add warnings for the case where template VPL has no pre_vpl_run.sh file or no required file.
        foreach ([ 'noprevplrun', 'noreqfile' ] as $reason) {
            $icon = '<i class="fa fa-warning text-warning mx-1"></i>';
            $message = get_string($reason, 'qtype_vplquestion') . $OUTPUT->help_icon($reason, 'qtype_vplquestion', true);
            $html = '<div data-role="' . $reason . '-warning" style="display:none">' . $icon . $message . '</div>';
            $group[] =& $mform->createElement('html', $html);
        }
        $mform->addGroup($group, 'templatevplgroup', get_string('templatevpl', 'qtype_vplquestion'), null, false);
        $mform->addRule('templatevplgroup', null, 'required', null, 'client');
        $mform->addHelpButton('templatevplgroup', 'templatevpl', 'qtype_vplquestion');

        $mform->addElement('hidden', 'templatelang');
        $mform->setType('templatelang', PARAM_RAW);

        $this->add_codeeditor($mform, 'templatecontext');
    }

    /**
     * Add a field for the answer template.
     * @param MoodleQuickForm $mform the form being built.
     */
    protected function add_answer_template_field($mform) {
        $this->create_header($mform, 'answertemplate');
        $this->add_codeeditor($mform, 'answertemplate');
    }

    /**
     * Add a field for a correction from the teacher (optional).
     * @param MoodleQuickForm $mform the form being built.
     * @copyright Inspired from Coderunner question type.
     */
    protected function add_teacher_correction_field($mform) {
        $this->create_header($mform, 'teachercorrection');
        $this->add_codeeditor($mform, 'teachercorrection');

        $mform->addElement('advcheckbox', 'validateonsave', null, get_string('validateonsave', 'qtype_vplquestion'));
        $mform->setDefault('validateonsave', true);
        $mform->addHelpButton('validateonsave', 'validateonsave', 'qtype_vplquestion');
    }

    /**
     * Add a field for the execution files and grading options.
     * @param MoodleQuickForm $mform the form being built.
     */
    protected function add_execfiles_field($mform) {
        $this->create_header($mform, 'execfilesevalsettings');

        $this->add_fileset_editor($mform, 'execfiles', 'execfileslist', 'execfile');

        $mform->addElement('select', 'precheckpreference', get_string('precheckpreference', 'qtype_vplquestion'), [
                'none' => get_string('noprecheck', 'qtype_vplquestion'),
                'dbg' => get_string('precheckisdebug', 'qtype_vplquestion'),
                'same' => get_string('precheckhassamefiles', 'qtype_vplquestion'),
                'diff' => get_string('precheckhasownfiles', 'qtype_vplquestion'),
        ]);
        $mform->setDefault('precheckpreference', $this->get_default_value('precheckpreference', 'same'));
        $mform->addHelpButton('precheckpreference', 'precheckpreference', 'qtype_vplquestion');

        $this->add_fileset_editor($mform, 'precheckexecfiles', 'precheckexecfileslist', 'precheckexecfile');

        $mform->addElement('select', 'gradingmethod', get_string('gradingmethod', 'qtype_vplquestion'), [
                get_string('allornothing', 'qtype_vplquestion'),
                get_string('scaling', 'qtype_vplquestion'),
        ]);
        $mform->setDefault('gradingmethod', $this->get_default_value('gradingmethod', 0));
        $mform->addHelpButton('gradingmethod', 'gradingmethod', 'qtype_vplquestion');
    }

    /**
     * Add fields for additional options.
     * @param MoodleQuickForm $mform the form being built.
     */
    protected function add_additional_options($mform) {
        $this->create_header($mform, 'additionaloptions');

        $mform->addElement('selectyesno', 'deletesubmissions', get_string('deletesubmissions', 'qtype_vplquestion'));
        // If legacy config is still present, use it to keep consistency, else default 0.
        $default = get_config('qtype_vplquestion')->deletevplsubmissions ?? 0;
        $mform->setDefault('deletesubmissions', $this->get_default_value('deletesubmissions', $default));
        $mform->addHelpButton('deletesubmissions', 'deletesubmissions', 'qtype_vplquestion');

        if (get_config('qtype_vplquestion', 'allowasynceval')) {
            $mform->addElement('selectyesno', 'useasynceval', get_string('useasyncevaluation', 'qtype_vplquestion'));
            $mform->setDefault('useasynceval', $this->get_default_value('useasynceval', 0));
            $mform->addHelpButton('useasynceval', 'useasyncevaluation', 'qtype_vplquestion');
        } else {
            $mform->addElement('hidden', 'useasynceval', 0);
            $mform->setType('useasynceval', PARAM_BOOL);
        }
    }

    /**
     * Add an editor managing several files (with tabs).
     * @param MoodleQuickForm $mform the form being built.
     * @param string $name the name of the (hidden) field in which the files will be written.
     * @param string $listname the id of the file tabs element in DOM.
     * @param string $editorname the name of the editor.
     */
    private function add_fileset_editor($mform, $name, $listname, $editorname) {
        global $OUTPUT;
        $mform->addElement('hidden', $name);
        $mform->setType($name, PARAM_RAW);
        $mform->addElement(
            'static',
            $listname,
            get_string($name, 'qtype_vplquestion'),
            $OUTPUT->render_from_template('qtype_vplquestion/fileseteditor', [ 'listname' => $listname ])
        );
        $mform->addHelpButton($listname, $name, 'qtype_vplquestion');
        $mform->addElement('textarea', $editorname, '', [
                'rows' => 1,
                'class' => 'code-editor withfiletabs',
                'data-role' => 'code-editor',
                'data-manylangs' => true,
        ]);
    }

    /**
     * Add a code editor with an help button.
     * @param MoodleQuickForm $mform the form being built.
     * @param string $field the name of the editor.
     * @param array $attributes (optional) the attributes to add to the editor.
     */
    private function add_codeeditor($mform, $field, $attributes = null) {
        $mform->addElement('textarea', $field, get_string($field, 'qtype_vplquestion'), [
                'rows' => 1,
                'data-role' => 'code-editor',
        ]);
        if ($attributes != null) {
            $mform->updateElementAttr($field, $attributes);
        }
        $mform->addHelpButton($field, $field, 'qtype_vplquestion');
    }

    /**
     * Start a new form section with given name.
     * @param MoodleQuickForm $mform the form being built.
     * @param string $identifier the name of the section.
     */
    private function create_header($mform, $identifier) {
        $mform->addElement('header', $identifier . 'header', get_string($identifier, 'qtype_vplquestion'));
        $mform->setExpanded($identifier . 'header', true);
    }

    /**
     * Validate teacher correction against test cases.
     * @param array $submitteddata The data from the form.
     * @param array $files
     * @see question_edit_form::validation()
     */
    public function validation($submitteddata, $files) {
        require_sesskey();
        $errors = parent::validation($submitteddata, $files);

        if (stripos($submitteddata['templatecontext'], '{{ANSWER}}') === false) {
            $errors['templatecontext'] = get_string('noanswertag', 'qtype_vplquestion');
        }

        if ($submitteddata['validateonsave']) {
            $question = new stdClass();
            foreach ($submitteddata as $key => $value) {
                $question->$key = $value;
            }

            try {
                $result = locallib::evaluate($submitteddata['teachercorrection'], $question, false);
                $vplres = $result->vplresult;
                $grade = locallib::extract_fraction($vplres, $question->templatevpl);
                if (!empty($vplres->compilation)) {
                    $errors['teachercorrection'] = '<pre style="color:inherit">' . s($vplres->compilation) . '</pre>';
                } else if ($grade !== null) {
                    if ($grade < 1.0) {
                        $errors['teachercorrection'] = '<pre style="color:inherit">' . s($vplres->evaluation) . '</pre>';
                    }
                } else {
                    // No grade obtained. Something went wrong, display a message as explicit as possible.
                    $errors['teachercorrection'] = nl2br(locallib::make_evaluation_error_message($result, 'teacher'));
                }
            } catch (Exception $e) {
                $message = '[' . get_class($e) . ' - ' . $e->getCode() . ']' . $e->getMessage();
                $errors['teachercorrection'] = nl2br(get_string('unexpectederror', 'qtype_vplquestion', $message));
            }
        }

        return $errors;
    }
}
