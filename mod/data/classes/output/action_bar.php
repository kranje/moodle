<?php
// This file is part of Moodle - http://moodle.org/
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

namespace mod_data\output;

<<<<<<< HEAD
use mod_data\manager;
use mod_data\preset;
use moodle_url;
use url_select;
=======
use moodle_url;
>>>>>>> forked/LAE_400_PACKAGE

/**
 * Class responsible for generating the action bar elements in the database module pages.
 *
 * @package    mod_data
 * @copyright  2021 Mihail Geshoski <mihail@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class action_bar {

    /** @var int $id The database module id. */
    private $id;

<<<<<<< HEAD
    /** @var int $cmid The database course module id. */
    private $cmid;

=======
>>>>>>> forked/LAE_400_PACKAGE
    /** @var moodle_url $currenturl The URL of the current page. */
    private $currenturl;

    /**
     * The class constructor.
     *
     * @param int $id The database module id.
     * @param moodle_url $pageurl The URL of the current page.
     */
    public function __construct(int $id, moodle_url $pageurl) {
        $this->id = $id;
<<<<<<< HEAD
        [$course, $cm] = get_course_and_cm_from_instance($this->id, 'data');
        $this->cmid = $cm->id;
=======
>>>>>>> forked/LAE_400_PACKAGE
        $this->currenturl = $pageurl;
    }

    /**
     * Generate the output for the action bar in the field page.
     *
     * @param bool $hasfieldselect Whether the field selector element should be rendered.
<<<<<<< HEAD
     * @param null $unused1 This parameter has been deprecated since 4.1 and should not be used anymore.
     * @param null $unused2 This parameter has been deprecated since 4.1 and should not be used anymore.
     * @return string The HTML code for the action bar.
     */
    public function get_fields_action_bar(
        bool $hasfieldselect = false,
        ?bool $unused1 = null,
        ?bool $unused2 = null
    ): string {
        global $PAGE;

        if ($unused1 !== null || $unused2 !== null) {
            debugging('Deprecated argument passed to get_fields_action_bar method', DEBUG_DEVELOPER);
        }

        $fieldselect = null;
        if ($hasfieldselect) {
            $fieldselect = $this->get_create_fields();
        }

        $renderer = $PAGE->get_renderer('mod_data');
        $fieldsactionbar = new fields_action_bar($this->id, null, null, null, null, $fieldselect);
=======
     * @param bool $hassaveaspreset Whether the save as preset button element should be rendered.
     * @param bool $hasexportpreset Whether the export as preset button element should be rendered.
     * @return string The HTML code for the action bar.
     */
    public function get_fields_action_bar(bool $hasfieldselect = false, bool $hassaveaspreset = false,
            bool $hasexportpreset = false): string {
        global $PAGE, $DB;

        $createfieldlink = new moodle_url('/mod/data/field.php', ['d' => $this->id]);
        $importlink = new moodle_url('/mod/data/field.php', ['d' => $this->id, 'mode' => 'import']);
        $presetslink = new moodle_url('/mod/data/field.php', ['d' => $this->id, 'mode' => 'usepreset']);

        $menu = [
            $createfieldlink->out(false) => get_string('managefields', 'mod_data'),
            $importlink->out(false) => get_string('importpreset', 'mod_data'),
            $presetslink->out(false) => get_string('usestandard', 'mod_data'),
        ];

        $selected = $createfieldlink->out(false);
        $mode = $this->currenturl->get_param('mode');

        if ($mode == 'import') {
            $selected = $importlink->out(false);
        } else if ($mode === 'usepreset') {
            $selected = $presetslink->out(false);
        }

        $urlselect = new \url_select($menu, $selected, null, 'fieldactionselect');
        $urlselect->set_label(get_string('fieldsnavigation', 'mod_data'), ['class' => 'sr-only']);

        $fieldselect = null;
        if ($hasfieldselect) {
            // Get the list of possible fields (plugins).
            $plugins = \core_component::get_plugin_list('datafield');
            $menufield = [];

            foreach ($plugins as $plugin => $fulldir) {
                $menufield[$plugin] = get_string('pluginname', "datafield_{$plugin}");
            }
            asort($menufield);

            $fieldselecturl = new moodle_url('/mod/data/field.php', ['d' => $this->id, 'mode' => 'new']);
            $fieldselect = new \single_select($fieldselecturl, 'newtype', $menufield, null, get_string('newfield', 'data'),
                'fieldform');
            $fieldselect->set_label(get_string('newfield', 'mod_data'), ['class' => 'sr-only']);
        }

        $saveaspresetbutton = null;
        $exportpresetbutton = null;
        $hasfields = $DB->record_exists('data_fields', ['dataid' => $this->id]);

        if ($hasfields) {
            if ($hassaveaspreset) {
                $saveaspresetlink = new moodle_url('/mod/data/preset.php',
                    ['d' => $this->id, 'action' => 'export']);
                $saveaspresetbutton = new \single_button($saveaspresetlink,
                    get_string('saveaspreset', 'mod_data'), 'post', false);
            }

            if ($hasexportpreset) {
                $exportpresetlink = new moodle_url('/mod/data/preset.php',
                    ['d' => $this->id, 'action' => 'export']);
                $exportpresetbutton = new \single_button($exportpresetlink,
                    get_string('exportpreset', 'mod_data'), 'get', false);
            }
        }
        $renderer = $PAGE->get_renderer('mod_data');
        $fieldsactionbar = new fields_action_bar($this->id, $urlselect, $fieldselect, $saveaspresetbutton,
            $exportpresetbutton);
>>>>>>> forked/LAE_400_PACKAGE

        return $renderer->render_fields_action_bar($fieldsactionbar);
    }

    /**
<<<<<<< HEAD
     * Generate the output for the action bar in the field mappings page.
     *
     * @return string The HTML code for the action bar.
     */
    public function get_fields_mapping_action_bar(): string {
        global $PAGE;

        $renderer = $PAGE->get_renderer('mod_data');
        $fieldsactionbar = new fields_mappings_action_bar($this->id);

        $data = $fieldsactionbar->export_for_template($renderer);
        return $renderer->render_from_template('mod_data/fields_action_bar', $data);
    }

    /**
     * Generate the output for the create a new field action menu.
     *
     * @return \action_menu Action menu to create a new field
     */
    public function get_create_fields(): \action_menu {
        // Get the list of possible fields (plugins).
        $plugins = \core_component::get_plugin_list('datafield');
        $menufield = [];
        foreach ($plugins as $plugin => $fulldir) {
            $menufield[$plugin] = get_string('pluginname', "datafield_{$plugin}");
        }
        asort($menufield);

        $fieldselect = new \action_menu();
        $fieldselect->set_menu_trigger(get_string('newfield', 'mod_data'), 'btn btn-secondary');
        $fieldselectparams = ['d' => $this->id, 'mode' => 'new'];
        foreach ($menufield as $fieldtype => $fieldname) {
            $fieldselectparams['newtype'] = $fieldtype;
            $fieldselect->add(new \action_menu_link(
                new moodle_url('/mod/data/field.php', $fieldselectparams),
                new \pix_icon('field/' . $fieldtype, $fieldname, 'data'),
                $fieldname,
                false
            ));
        }
        $fieldselect->set_additional_classes('singlebutton');

        return $fieldselect;
    }

    /**
     * Generate the output for the action selector in the view page.
     *
     * @param bool $hasentries Whether entries exist.
     * @param string $mode The current view mode (list, view...).
     * @return string The HTML code for the action selector.
     */
    public function get_view_action_bar(bool $hasentries, string $mode): string {
=======
     * Generate the output for the action selector in the view page.
     *
     * @param bool $hasentries Whether entries exist.
     * @return string The HTML code for the action selector.
     */
    public function get_view_action_bar(bool $hasentries): string {
>>>>>>> forked/LAE_400_PACKAGE
        global $PAGE;

        $viewlistlink = new moodle_url('/mod/data/view.php', ['d' => $this->id]);
        $viewsinglelink = new moodle_url('/mod/data/view.php', ['d' => $this->id, 'mode' => 'single']);

        $menu = [
            $viewlistlink->out(false) => get_string('listview', 'mod_data'),
            $viewsinglelink->out(false) => get_string('singleview', 'mod_data'),
        ];

        $activeurl = $this->currenturl;

        if ($this->currenturl->get_param('rid') || $this->currenturl->get_param('mode') == 'single') {
            $activeurl = $viewsinglelink;
        }

<<<<<<< HEAD
        $urlselect = new url_select($menu, $activeurl->out(false), null, 'viewactionselect');
        $urlselect->set_label(get_string('viewnavigation', 'mod_data'), ['class' => 'sr-only']);
        $renderer = $PAGE->get_renderer('mod_data');
        $viewactionbar = new view_action_bar($this->id, $urlselect, $hasentries, $mode);
=======
        $urlselect = new \url_select($menu, $activeurl->out(false), null, 'viewactionselect');
        $urlselect->set_label(get_string('viewnavigation', 'mod_data'), ['class' => 'sr-only']);
        $renderer = $PAGE->get_renderer('mod_data');
        $viewactionbar = new view_action_bar($this->id, $urlselect, $hasentries);
>>>>>>> forked/LAE_400_PACKAGE

        return $renderer->render_view_action_bar($viewactionbar);
    }

    /**
     * Generate the output for the action selector in the templates page.
     *
     * @return string The HTML code for the action selector.
     */
    public function get_templates_action_bar(): string {
<<<<<<< HEAD
        global $PAGE;
=======
        global $PAGE, $DB;
>>>>>>> forked/LAE_400_PACKAGE

        $listtemplatelink = new moodle_url('/mod/data/templates.php', ['d' => $this->id,
            'mode' => 'listtemplate']);
        $singletemplatelink = new moodle_url('/mod/data/templates.php', ['d' => $this->id,
            'mode' => 'singletemplate']);
        $advancedsearchtemplatelink = new moodle_url('/mod/data/templates.php', ['d' => $this->id,
            'mode' => 'asearchtemplate']);
        $addtemplatelink = new moodle_url('/mod/data/templates.php', ['d' => $this->id, 'mode' => 'addtemplate']);
        $rsstemplatelink = new moodle_url('/mod/data/templates.php', ['d' => $this->id, 'mode' => 'rsstemplate']);
        $csstemplatelink = new moodle_url('/mod/data/templates.php', ['d' => $this->id, 'mode' => 'csstemplate']);
        $jstemplatelink = new moodle_url('/mod/data/templates.php', ['d' => $this->id, 'mode' => 'jstemplate']);

        $menu = [
<<<<<<< HEAD
            $addtemplatelink->out(false) => get_string('addtemplate', 'mod_data'),
            $singletemplatelink->out(false) => get_string('singletemplate', 'mod_data'),
            $listtemplatelink->out(false) => get_string('listtemplate', 'mod_data'),
            $advancedsearchtemplatelink->out(false) => get_string('asearchtemplate', 'mod_data'),
            $csstemplatelink->out(false) => get_string('csstemplate', 'mod_data'),
            $jstemplatelink->out(false) => get_string('jstemplate', 'mod_data'),
            $rsstemplatelink->out(false) => get_string('rsstemplate', 'mod_data'),
        ];

        $selectmenu = new \core\output\select_menu('presetsactions', $menu, $this->currenturl->out(false));
        $selectmenu->set_label(get_string('templatesnavigation', 'mod_data'), ['class' => 'sr-only']);

        $renderer = $PAGE->get_renderer('mod_data');

        $presetsactions = $this->get_presets_actions_select(false);

        // Reset all templates action.
        $resetallurl = new moodle_url($this->currenturl);
        $resetallurl->params([
            'action' => 'resetalltemplates',
            'sesskey' => sesskey(),
        ]);
        $presetsactions->add(new \action_menu_link(
            $resetallurl,
            null,
            get_string('resetalltemplates', 'mod_data'),
            false,
            ['data-action' => 'resetalltemplates', 'data-dataid' => $this->id]
        ));

        $templatesactionbar = new templates_action_bar($this->id, $selectmenu, null, null, $presetsactions);
=======
            $listtemplatelink->out(false) => get_string('listtemplate', 'mod_data'),
            $singletemplatelink->out(false) => get_string('singletemplate', 'mod_data'),
            $advancedsearchtemplatelink->out(false) => get_string('asearchtemplate', 'mod_data'),
            $addtemplatelink->out(false) => get_string('addtemplate', 'mod_data'),
            $rsstemplatelink->out(false) => get_string('rsstemplate', 'mod_data'),
            $csstemplatelink->out(false) => get_string('csstemplate', 'mod_data'),
            $jstemplatelink->out(false) => get_string('jstemplate', 'mod_data'),
        ];

        $urlselect = new \url_select($menu, $this->currenturl->out(false), null, 'templatesactionselect');
        $urlselect->set_label(get_string('templatesnavigation', 'mod_data'), ['class' => 'sr-only']);

        $hasfields = $DB->record_exists('data_fields', ['dataid' => $this->id]);

        $saveaspresetbutton = null;
        $exportpresetbutton = null;

        if ($hasfields) {
            $saveaspresetlink = new moodle_url('/mod/data/preset.php',
                ['d' => $this->id, 'action' => 'export']);
            $saveaspresetbutton = new \single_button($saveaspresetlink,
                get_string('saveaspreset', 'mod_data'), 'post', false);

            $exportpresetlink = new moodle_url('/mod/data/preset.php',
                ['d' => $this->id, 'action' => 'export', 'sesskey' => sesskey()]);
            $exportpresetbutton = new \single_button($exportpresetlink,
                get_string('exportpreset', 'mod_data'), 'get', false);
        }

        $renderer = $PAGE->get_renderer('mod_data');
        $templatesactionbar = new templates_action_bar($this->id, $urlselect, $saveaspresetbutton,
            $exportpresetbutton);
>>>>>>> forked/LAE_400_PACKAGE

        return $renderer->render_templates_action_bar($templatesactionbar);
    }

    /**
     * Generate the output for the action selector in the presets page.
     *
     * @return string The HTML code for the action selector.
     */
    public function get_presets_action_bar(): string {
        global $PAGE;

        $renderer = $PAGE->get_renderer('mod_data');
<<<<<<< HEAD
        $presetsactionbar = new presets_action_bar($this->cmid, $this->get_presets_actions_select(true));

        return $renderer->render_presets_action_bar($presetsactionbar);
    }

    /**
     * Generate the output for the action selector in the presets preview page.
     *
     * @param manager $manager the manager instance
     * @param string $fullname the preset fullname
     * @param string $current the current template name
     * @return string The HTML code for the action selector
     */
    public function get_presets_preview_action_bar(manager $manager, string $fullname, string $current): string {
        global $PAGE;

        $renderer = $PAGE->get_renderer(manager::PLUGINNAME);

        $cm = $manager->get_coursemodule();

        $menu = [];
        $selected = null;
        foreach (['listtemplate', 'singletemplate'] as $templatename) {
            $link = new moodle_url('/mod/data/preset.php', [
                'd' => $this->id,
                'template' => $templatename,
                'fullname' => $fullname,
                'action' => 'preview',
            ]);
            $menu[$link->out(false)] = get_string($templatename, manager::PLUGINNAME);
            if (!$selected || $templatename == $current) {
                $selected = $link->out(false);
            }
        }
        $urlselect = new url_select($menu, $selected, null);
        $urlselect->set_label(get_string('templatesnavigation', manager::PLUGINNAME), ['class' => 'sr-only']);

        $data = [
            'title' => get_string('preview', manager::PLUGINNAME, preset::get_name_from_plugin($fullname)),
            'hasback' => true,
            'backtitle' => get_string('back'),
            'backurl' => new moodle_url('/mod/data/preset.php', ['id' => $cm->id]),
            'extraurlselect' => $urlselect->export_for_template($renderer),
        ];
        return $renderer->render_from_template('mod_data/action_bar', $data);
    }

    /**
     * Helper method to get the selector for the presets action.
     *
     * @param bool $hasimport Whether the Import buttons must be included or not.
     * @return \action_menu|null The selector object used to display the presets actions. Null when the import button is not
     * displayed and the database hasn't any fields.
     */
    protected function get_presets_actions_select(bool $hasimport = false): ?\action_menu {
        global $DB;

        $hasfields = $DB->record_exists('data_fields', ['dataid' => $this->id]);

        // Early return if the database has no fields and the import action won't be displayed.
        if (!$hasfields && !$hasimport) {
            return null;
        }

        $actionsselect = new \action_menu();
        $actionsselect->set_menu_trigger(get_string('actions'), 'btn btn-secondary');

        if ($hasimport) {
            // Import.
            $actionsselectparams = ['id' => $this->cmid];
            $actionsselect->add(new \action_menu_link(
                new moodle_url('/mod/data/preset.php', $actionsselectparams),
                null,
                get_string('importpreset', 'mod_data'),
                false,
                ['data-action' => 'importpresets', 'data-dataid' => $this->cmid]
            ));
        }

        // If the database has no fields, export and save as preset options shouldn't be displayed.
        if ($hasfields) {
            // Export.
            $actionsselectparams = ['id' => $this->cmid, 'action' => 'export'];
            $actionsselect->add(new \action_menu_link(
                new moodle_url('/mod/data/preset.php', $actionsselectparams),
                null,
                get_string('exportpreset', 'mod_data'),
                false
            ));
            // Save as preset.
            $actionsselect->add(new \action_menu_link(
                new moodle_url('/mod/data/preset.php', $actionsselectparams),
                null,
                get_string('saveaspreset', 'mod_data'),
                false,
                ['data-action' => 'saveaspreset', 'data-dataid' => $this->id]
            ));
        }

        return $actionsselect;
    }
=======
        $presetsactionbar = new presets_action_bar($this->id);

        return $renderer->render_presets_action_bar($presetsactionbar);
    }
>>>>>>> forked/LAE_400_PACKAGE
}
