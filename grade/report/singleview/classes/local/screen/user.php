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

/**
 * The user screen.
 *
 * @package   gradereport_singleview
 * @copyright 2014 Moodle Pty Ltd (http://moodle.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace gradereport_singleview\local\screen;

use grade_seq;
use gradereport_singleview;
use moodle_url;
use pix_icon;
use html_writer;
use gradereport_singleview\local\ui\range;
use gradereport_singleview\local\ui\bulk_insert;
use grade_item;
use grade_grade;
use stdClass;

defined('MOODLE_INTERNAL') || die;

/**
 * The user screen.
 *
 * @package   gradereport_singleview
 * @copyright 2014 Moodle Pty Ltd (http://moodle.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class user extends tablelike implements selectable_items {

    /** @var array $categories A cache for grade_item categories */
<<<<<<< HEAD
    private $categories = [];
=======
    private $categories = array();
>>>>>>> forked/LAE_400_PACKAGE

    /** @var int $requirespaging Do we have more items than the paging limit? */
    private $requirespaging = true;

    /**
     * Get the label for the select box that chooses items for this page.
     * @return string
     */
<<<<<<< HEAD
    public function select_label(): string {
=======
    public function select_label() {
>>>>>>> forked/LAE_400_PACKAGE
        return get_string('selectgrade', 'gradereport_singleview');
    }

    /**
     * Get the description for the screen.
     *
     * @return string
     */
<<<<<<< HEAD
    public function description(): string {
=======
    public function description() {
>>>>>>> forked/LAE_400_PACKAGE
        return get_string('gradeitems', 'grades');
    }

    /**
     * Convert the list of items to a list of options.
     *
     * @return array
     */
<<<<<<< HEAD
    public function options(): array {
        $result = [];
=======
    public function options() {
        $result = array();
>>>>>>> forked/LAE_400_PACKAGE
        foreach ($this->items as $itemid => $item) {
            $result[$itemid] = $item->get_name();
        }
        return $result;
    }

    /**
     * Get the type of items on this screen.
     *
     * @return string
     */
<<<<<<< HEAD
    public function item_type(): string {
=======
    public function item_type() {
>>>>>>> forked/LAE_400_PACKAGE
        return 'grade';
    }

    /**
     * Init the screen
     *
     * @param bool $selfitemisempty Have we selected an item yet?
     */
    public function init($selfitemisempty = false) {
<<<<<<< HEAD
=======
        global $DB;
>>>>>>> forked/LAE_400_PACKAGE

        if (!$selfitemisempty) {
            $validusers = $this->load_users();
            if (!isset($validusers[$this->itemid])) {
                // If the passed user id is not valid, show the first user from the list instead.
                $this->item = reset($validusers);
                $this->itemid = $this->item->id;
            } else {
                $this->item = $validusers[$this->itemid];
            }
        }

<<<<<<< HEAD
        $seq = new grade_seq($this->courseid, true);

        $this->items = [];
=======
        $params = array('courseid' => $this->courseid);

        $seq = new grade_seq($this->courseid, true);

        $this->items = array();
>>>>>>> forked/LAE_400_PACKAGE
        foreach ($seq->items as $itemid => $item) {
            if (grade::filter($item)) {
                $this->items[$itemid] = $item;
            }
        }

        $this->requirespaging = count($this->items) > $this->perpage;

        $this->setup_structure();

<<<<<<< HEAD
        $this->definition = [
            'finalgrade', 'feedback', 'override', 'exclude'
        ];
=======
        $this->definition = array(
            'finalgrade', 'feedback', 'override', 'exclude'
        );
>>>>>>> forked/LAE_400_PACKAGE
        $this->set_headers($this->original_headers());
    }

    /**
     * Get the list of headers for the table.
     *
     * @return array List of headers
     */
<<<<<<< HEAD
    public function original_headers(): array {
        return [
            get_string('assessmentname', 'gradereport_singleview'),
            '', // For filter icon.
            get_string('gradecategory', 'grades'),
            get_string('grade', 'grades'),
            get_string('range', 'grades'),
            get_string('feedback', 'grades'),
            get_string('override', 'gradereport_singleview'),
            get_string('exclude', 'gradereport_singleview'),
        ];
=======
    public function original_headers() {
        return array(
            '', // For filter icon.
            get_string('assessmentname', 'gradereport_singleview'),
            get_string('gradecategory', 'grades'),
            get_string('range', 'grades'),
            get_string('grade', 'grades'),
            get_string('feedback', 'grades'),
            $this->make_toggle_links('override'),
            $this->make_toggle_links('exclude')
        );
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Format each row of the table.
     *
     * @param grade_item $item
<<<<<<< HEAD
     * @return array
     */
    public function format_line($item): array {
=======
     * @return string
     */
    public function format_line($item) {
>>>>>>> forked/LAE_400_PACKAGE
        global $OUTPUT;

        $grade = $this->fetch_grade_or_default($item, $this->item->id);
        $lockicon = '';

        $lockeditem = $lockeditemgrade = 0;
        if (!empty($grade->locked)) {
            $lockeditem = 1;
        }
        if (!empty($grade->grade_item->locked)) {
            $lockeditemgrade = 1;
        }
        // Check both grade and grade item.
        if ($lockeditem || $lockeditemgrade) {
<<<<<<< HEAD
             $lockicon = $OUTPUT->pix_icon('t/locked', 'grade is locked', 'moodle', ['class' => 'ml-3']);
        }

        // Create a fake gradetreeitem so we can call get_element_header().
        // The type logic below is from grade_category->_get_children_recursion().
        $gradetreeitem = [];

        $type = in_array($item->itemtype, ['course', 'category']) ? "{$item->itemtype}item" : 'item';
        $gradetreeitem['type'] = $type;
        $gradetreeitem['object'] = $item;
        $gradetreeitem['userid'] = $this->item->id;

        $itemname = $this->structure->get_element_header($gradetreeitem, true, false, false, false, true);
        $grade->label = $item->get_name();

        $formatteddefinition = $this->format_definition($grade);

        $itemicon = html_writer::div($this->format_icon($item), 'mr-1');
        $itemtype = \html_writer::span($this->structure->get_element_type_string($gradetreeitem),
            'd-block text-uppercase small dimmed_text');
        // If a behat test site is running avoid outputting the information about the type of the grade item.
        // This additional information currently causes issues in behat particularly with the existing xpath used to
        // interact with table elements.
        if (!defined('BEHAT_SITE_RUNNING')) {
            $itemcontent = html_writer::div($itemtype . $itemname);
        } else {
            $itemcontent = html_writer::div($itemname);
        }

        $line = [
            html_writer::div($itemicon . $itemcontent .  $lockicon, "{$type} d-flex align-items-center"),
            $this->get_item_action_menu($item),
            $this->category($item),
            $formatteddefinition['finalgrade'],
            new range($item),
            $formatteddefinition['feedback'],
            $formatteddefinition['override'],
            $formatteddefinition['exclude'],
        ];
        $lineclasses = [
            'gradeitem',
            'action',
            'category',
            'grade',
            'range',
        ];

        $outputline = [];
        $i = 0;
        foreach ($line as $key => $value) {
            $cell = new \html_table_cell($value);
            if ($isheader = $i == 0) {
=======
             $lockicon = $OUTPUT->pix_icon('t/locked', 'grade is locked');
        }

        $iconstring = get_string('filtergrades', 'gradereport_singleview', $item->get_name());

        // Create a fake gradetreeitem so we can call get_element_header().
        // The type logic below is from grade_category->_get_children_recursion().
        $gradetreeitem = array();
        if (in_array($item->itemtype, array('course', 'category'))) {
            $gradetreeitem['type'] = $item->itemtype.'item';
        } else {
            $gradetreeitem['type'] = 'item';
        }
        $gradetreeitem['object'] = $item;
        $gradetreeitem['userid'] = $this->item->id;

        $itemlabel = $this->structure->get_element_header($gradetreeitem, true, false, false, false, true);
        $grade->label = $item->get_name();

        $line = array(
            $OUTPUT->action_icon($this->format_link('grade', $item->id), new pix_icon('t/editstring', ''), null,
                    ['title' => $iconstring, 'aria-label' => $iconstring]),
            $this->format_icon($item) . $lockicon . $itemlabel,
            $this->category($item),
            new range($item)
        );
        $lineclasses = array(
            "action",
            "gradeitem",
            "category",
            "range"
        );

        $outputline = array();
        $i = 0;
        foreach ($line as $key => $value) {
            $cell = new \html_table_cell($value);
            if ($isheader = $i == 1) {
>>>>>>> forked/LAE_400_PACKAGE
                $cell->header = $isheader;
                $cell->scope = "row";
            }
            if (array_key_exists($key, $lineclasses)) {
                $cell->attributes['class'] = $lineclasses[$key];
            }
            $outputline[] = $cell;
            $i++;
        }

<<<<<<< HEAD
        return $outputline;
=======
        return $this->format_definition($outputline, $grade);
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Helper to get the icon for an item.
     *
     * @param grade_item $item
     * @return string
     */
<<<<<<< HEAD
    private function format_icon($item): string {
        $element = ['type' => 'item', 'object' => $item];
=======
    private function format_icon($item) {
        $element = array('type' => 'item', 'object' => $item);
>>>>>>> forked/LAE_400_PACKAGE
        return $this->structure->get_element_icon($element);
    }

    /**
<<<<<<< HEAD
     * Return the action menu HTML for the grade item.
     *
     * @param grade_item $item
     * @return mixed
     */
    private function get_item_action_menu(grade_item $item) {
        global $OUTPUT;

        $menuitems = [];
        $url = new moodle_url($this->format_link('grade', $item->id));
        $title = get_string('showallgrades', 'core_grades');
        $menuitems[] = new \action_menu_link_secondary($url, null, $title);
        $menu = new \action_menu($menuitems);
        $icon = $OUTPUT->pix_icon('i/moremenu', get_string('actions'));
        $menu->set_menu_trigger($icon);
        $menu->set_menu_left();

        return $OUTPUT->render($menu);
    }

    /**
     * Helper to get the category for an item.
     *
     * @param grade_item $item
     * @return string
     */
    private function category(grade_item $item): string {
=======
     * Helper to get the category for an item.
     *
     * @param grade_item $item
     * @return grade_category
     */
    private function category($item) {
>>>>>>> forked/LAE_400_PACKAGE
        global $DB;

        if (empty($item->categoryid)) {

            if ($item->itemtype == 'course') {
                return $this->course->fullname;
            }

<<<<<<< HEAD
            $params = ['id' => $item->iteminstance];
=======
            $params = array('id' => $item->iteminstance);
>>>>>>> forked/LAE_400_PACKAGE
            $elem = $DB->get_record('grade_categories', $params);

            return $elem->fullname;
        }

        if (!isset($this->categories[$item->categoryid])) {
            $category = $item->get_parent_category();

            $this->categories[$category->id] = $category;
        }

        return $this->categories[$item->categoryid]->get_name();
    }

    /**
     * Get the heading for the page.
     *
     * @return string
     */
<<<<<<< HEAD
    public function heading(): string {
=======
    public function heading() {
>>>>>>> forked/LAE_400_PACKAGE
        return get_string('gradeuser', 'gradereport_singleview', fullname($this->item));
    }

    /**
     * Get the summary for this table.
     *
     * @return string
     */
<<<<<<< HEAD
    public function summary(): string {
=======
    public function summary() {
>>>>>>> forked/LAE_400_PACKAGE
        return get_string('summaryuser', 'gradereport_singleview');
    }

    /**
     * Default pager
     *
     * @return string
     */
<<<<<<< HEAD
    public function pager(): string {
=======
    public function pager() {
>>>>>>> forked/LAE_400_PACKAGE
        global $OUTPUT;

        if (!$this->supports_paging()) {
            return '';
        }

        return $OUTPUT->paging_bar(
            count($this->items), $this->page, $this->perpage,
<<<<<<< HEAD
            new moodle_url('/grade/report/singleview/index.php', [
=======
            new moodle_url('/grade/report/singleview/index.php', array(
>>>>>>> forked/LAE_400_PACKAGE
                'perpage' => $this->perpage,
                'id' => $this->courseid,
                'group' => $this->groupid,
                'itemid' => $this->itemid,
                'item' => 'user'
<<<<<<< HEAD
            ])
=======
            ))
>>>>>>> forked/LAE_400_PACKAGE
        );
    }

    /**
     * Does this page require paging?
     *
     * @return bool
     */
<<<<<<< HEAD
    public function supports_paging(): bool {
=======
    public function supports_paging() {
>>>>>>> forked/LAE_400_PACKAGE
        return $this->requirespaging;
    }


    /**
     * Process the data from the form.
     *
     * @param array $data
<<<<<<< HEAD
     * @return stdClass of warnings
     */
    public function process($data): stdClass {
=======
     * @return array of warnings
     */
    public function process($data) {
>>>>>>> forked/LAE_400_PACKAGE
        $bulk = new bulk_insert($this->item);
        // Bulk insert messages the data to be passed in
        // ie: for all grades of empty grades apply the specified value.
        if ($bulk->is_applied($data)) {
            $filter = $bulk->get_type($data);
            $insertvalue = $bulk->get_insert_value($data);

            $userid = $this->item->id;
            foreach ($this->items as $gradeitemid => $gradeitem) {
                $null = $gradeitem->gradetype == GRADE_TYPE_SCALE ? -1 : '';
                $field = "finalgrade_{$gradeitem->id}_{$this->itemid}";
                if (isset($data->$field)) {
                    continue;
                }

                $oldfinalgradefield = "oldfinalgrade_{$gradeitem->id}_{$this->itemid}";
                // Bulk grade changes for all grades need to be processed and shouldn't be skipped if they had a previous grade.
                if ($gradeitem->is_course_item() || ($filter != 'all' && !empty($data->$oldfinalgradefield))) {
                    if ($gradeitem->is_course_item()) {
                        // The course total should not be overridden.
                        unset($data->$field);
                        unset($data->oldfinalgradefield);
                        $oldoverride = "oldoverride_{$gradeitem->id}_{$this->itemid}";
                        unset($data->$oldoverride);
                        $oldfeedback = "oldfeedback_{$gradeitem->id}_{$this->itemid}";
                        unset($data->$oldfeedback);
                    }
                    continue;
                }
<<<<<<< HEAD
                $grade = grade_grade::fetch([
                    'itemid' => $gradeitemid,
                    'userid' => $userid
                ]);
=======
                $grade = grade_grade::fetch(array(
                    'itemid' => $gradeitemid,
                    'userid' => $userid
                ));
>>>>>>> forked/LAE_400_PACKAGE

                $data->$field = empty($grade) ? $null : $grade->finalgrade;
                $data->{"old$field"} = $data->$field;
            }

            foreach ($data as $varname => $value) {
                if (preg_match('/^oldoverride_(\d+)_(\d+)/', $varname, $matches)) {
                    // If we've selected overriding all grades.
                    if ($filter == 'all') {
                        $override = "override_{$matches[1]}_{$matches[2]}";
                        $data->$override = '1';
                    }
                }
                if (!preg_match('/^finalgrade_(\d+)_(\d+)/', $varname, $matches)) {
                    continue;
                }

<<<<<<< HEAD
                $gradeitem = grade_item::fetch([
                    'courseid' => $this->courseid,
                    'id' => $matches[1],
                ]);

                $isscale = ($gradeitem->gradetype == GRADE_TYPE_SCALE);

                $empties = (trim($value ?? '') === '' || ($isscale && $value == -1));

                if ($filter == 'all' || $empties) {
                    $data->$varname = ($isscale && empty($insertvalue)) ? -1 : $insertvalue;
=======
                $gradeitem = grade_item::fetch(array(
                    'courseid' => $this->courseid,
                    'id' => $matches[1]
                ));

                $isscale = ($gradeitem->gradetype == GRADE_TYPE_SCALE);

                $empties = (trim($value) === '' or ($isscale and $value == -1));

                if ($filter == 'all' or $empties) {
                    $data->$varname = ($isscale and empty($insertvalue)) ?
                        -1 : $insertvalue;
>>>>>>> forked/LAE_400_PACKAGE
                }
            }
        }
        return parent::process($data);
    }
}
