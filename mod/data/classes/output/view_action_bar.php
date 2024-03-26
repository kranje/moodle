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
use data_portfolio_caller;
use mod_data\manager;
use moodle_url;
use portfolio_add_button;
=======
use moodle_url;
>>>>>>> forked/LAE_400_PACKAGE
use templatable;
use renderable;

/**
 * Renderable class for the action bar elements in the view pages in the database activity.
 *
 * @package    mod_data
 * @copyright  2021 Mihail Geshoski <mihail@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class view_action_bar implements templatable, renderable {

    /** @var int $id The database module id. */
    private $id;

    /** @var \url_select $urlselect The URL selector object. */
    private $urlselect;

    /** @var bool $hasentries Whether entries exist. */
    private $hasentries;

<<<<<<< HEAD
    /** @var bool $mode The current view mode (list, view...). */
    private $mode;

=======
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * The class constructor.
     *
     * @param int $id The database module id.
     * @param \url_select $urlselect The URL selector object.
     * @param bool $hasentries Whether entries exist.
<<<<<<< HEAD
     * @param string $mode The current view mode (list, view...).
     */
    public function __construct(int $id, \url_select $urlselect, bool $hasentries, string $mode) {
        $this->id = $id;
        $this->urlselect = $urlselect;
        $this->hasentries = $hasentries;
        $this->mode = $mode;
=======
     */
    public function __construct(int $id, \url_select $urlselect, bool $hasentries) {
        $this->id = $id;
        $this->urlselect = $urlselect;
        $this->hasentries = $hasentries;
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Export the data for the mustache template.
     *
     * @param \renderer_base $output The renderer to be used to render the action bar elements.
     * @return array
     */
    public function export_for_template(\renderer_base $output): array {
<<<<<<< HEAD
        global $PAGE, $DB, $CFG;
=======
        global $PAGE, $DB;
>>>>>>> forked/LAE_400_PACKAGE

        $data = [
            'urlselect' => $this->urlselect->export_for_template($output),
        ];

<<<<<<< HEAD
        $activity = $DB->get_record('data', ['id' => $this->id], '*', MUST_EXIST);
        $manager = manager::create_from_instance($activity);

        $actionsselect = null;
        // Import entries.
        if (has_capability('mod/data:manageentries', $manager->get_context())) {
            $actionsselect = new \action_menu();
            $actionsselect->set_menu_trigger(get_string('actions'), 'btn btn-secondary');

            $importentrieslink = new moodle_url('/mod/data/import.php', ['d' => $this->id, 'backto' => $PAGE->url->out(false)]);
            $actionsselect->add(new \action_menu_link(
                $importentrieslink,
                null,
                get_string('importentries', 'mod_data'),
                false
            ));
        }

        // Export entries.
        if (has_capability(DATA_CAP_EXPORT, $manager->get_context()) && $this->hasentries) {
            if (!$actionsselect) {
                $actionsselect = new \action_menu();
                $actionsselect->set_menu_trigger(get_string('actions'), 'btn btn-secondary');
            }
            $exportentrieslink = new moodle_url('/mod/data/export.php', ['d' => $this->id, 'backto' => $PAGE->url->out(false)]);
            $actionsselect->add(new \action_menu_link(
                $exportentrieslink,
                null,
                get_string('exportentries', 'mod_data'),
                false
            ));
        }

        // Export to portfolio. This is for exporting all records, not just the ones in the search.
        if ($this->mode == '' && !empty($CFG->enableportfolios) && $this->hasentries) {
            if ($manager->can_export_entries()) {
                // Add the portfolio export button.
                require_once($CFG->libdir . '/portfoliolib.php');

                $cm = $manager->get_coursemodule();

                $button = new portfolio_add_button();
                $button->set_callback_options(
                    'data_portfolio_caller',
                    ['id' => $cm->id],
                    'mod_data'
                );
                if (data_portfolio_caller::has_files($activity)) {
                    // No plain HTML.
                    $button->set_formats([PORTFOLIO_FORMAT_RICHHTML, PORTFOLIO_FORMAT_LEAP2A]);
                }
                $exporturl = $button->to_html(PORTFOLIO_ADD_MOODLE_URL);
                if (!is_null($exporturl)) {
                    if (!$actionsselect) {
                        $actionsselect = new \action_menu();
                        $actionsselect->set_menu_trigger(get_string('actions'), 'btn btn-secondary');
                    }
                    $actionsselect->add(new \action_menu_link(
                        $exporturl,
                        null,
                        get_string('addtoportfolio', 'portfolio'),
                        false
                    ));
                }
            }
        }

        if ($actionsselect) {
            $data['actionsselect'] = $actionsselect->export_for_template($output);
=======
        $database = $DB->get_record('data', ['id' => $this->id]);
        $cm = get_coursemodule_from_instance('data', $this->id);
        $currentgroup = groups_get_activity_group($cm);
        $groupmode = groups_get_activity_groupmode($cm);

        if (data_user_can_add_entry($database, $currentgroup, $groupmode, $PAGE->context)) {
            $addentrylink = new moodle_url('/mod/data/edit.php', ['d' => $this->id, 'backto' => $PAGE->url->out(false)]);
            $addentrybutton = new \single_button($addentrylink, get_string('add', 'mod_data'), 'get', true);
            $data['addentrybutton'] = $addentrybutton->export_for_template($output);
        }

        if (has_capability('mod/data:manageentries', $PAGE->context)) {
            $importentrieslink = new moodle_url('/mod/data/import.php',
                ['d' => $this->id, 'backto' => $PAGE->url->out(false)]);
            $importentriesbutton = new \single_button($importentrieslink,
                get_string('importentries', 'mod_data'), 'get', false);
            $data['importentriesbutton'] = $importentriesbutton->export_for_template($output);
        }

        if (has_capability(DATA_CAP_EXPORT, $PAGE->context) && $this->hasentries) {
            $exportentrieslink = new moodle_url('/mod/data/export.php',
                ['d' => $this->id, 'backto' => $PAGE->url->out(false)]);
            $exportentriesbutton = new \single_button($exportentrieslink, get_string('exportentries', 'mod_data'),
                'get', false);
            $data['exportentriesbutton'] = $exportentriesbutton->export_for_template($output);
>>>>>>> forked/LAE_400_PACKAGE
        }

        return $data;
    }
}
