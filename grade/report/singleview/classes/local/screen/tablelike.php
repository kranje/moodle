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
 * The gradebook simple view - base class for the table
 *
 * @package   gradereport_singleview
 * @copyright 2014 Moodle Pty Ltd (http://moodle.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace gradereport_singleview\local\screen;

<<<<<<< HEAD
use gradereport_singleview\local\ui\be_readonly;
use html_table;
use html_writer;
use stdClass;
=======
use html_table;
use html_writer;
use stdClass;
use grade_item;
>>>>>>> forked/LAE_400_PACKAGE
use grade_grade;
use gradereport_singleview\local\ui\bulk_insert;

defined('MOODLE_INTERNAL') || die;

/**
 * The gradebook simple view - base class for the table
 *
 * @package   gradereport_singleview
 * @copyright 2014 Moodle Pty Ltd (http://moodle.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
<<<<<<< HEAD
abstract class tablelike extends screen implements be_readonly {

    /**
     * A list of table headers
     * @var array $headers
     */
    protected $headers = [];

    /**
     * A list of errors that mean we should not show the table
     * @var array $initerrors
     */
    protected $initerrors = [];

    /**
     * Describes the columns in the table
     * @var array $definition
     */
    protected $definition = [];
=======
abstract class tablelike extends screen {

    /** @var array $headers A list of table headers */
    protected $headers = array();

    /** @var array $initerrors A list of errors that mean we should not show the table */
    protected $initerrors = array();

    /** @var array $definition Describes the columns in the table */
    protected $definition = array();
>>>>>>> forked/LAE_400_PACKAGE

    /**
     * Format a row of the table
     *
<<<<<<< HEAD
     * @var mixed $item
     * @return array
     */
    abstract public function format_line($item): array;
=======
     * @param mixed $item
     * @return string
     */
    public abstract function format_line($item);
>>>>>>> forked/LAE_400_PACKAGE

    /**
     * Get the summary for this table.
     *
     * @return string
     */
<<<<<<< HEAD
    abstract public function summary(): string;
=======
    public abstract function summary();
>>>>>>> forked/LAE_400_PACKAGE

    /**
     * Get the table headers
     *
     * @return array
     */
<<<<<<< HEAD
    public function headers(): array {
=======
    public function headers() {
>>>>>>> forked/LAE_400_PACKAGE
        return $this->headers;
    }

    /**
     * Set the table headers
     *
     * @param array $overwrite New headers
     * @return tablelike This
     */
<<<<<<< HEAD
    public function set_headers(array $overwrite): tablelike {
=======
    public function set_headers($overwrite) {
>>>>>>> forked/LAE_400_PACKAGE
        $this->headers = $overwrite;
        return $this;
    }

    /**
     * Get the list of errors
     *
     * @return array
     */
<<<<<<< HEAD
    public function init_errors(): array {
=======
    public function init_errors() {
>>>>>>> forked/LAE_400_PACKAGE
        return $this->initerrors;
    }

    /**
     * Set an error detected while building the page.
     *
     * @param string $mesg
     */
<<<<<<< HEAD
    public function set_init_error(string $mesg) {
=======
    public function set_init_error($mesg) {
>>>>>>> forked/LAE_400_PACKAGE
        $this->initerrors[] = $mesg;
    }

    /**
     * Get the table definition
     *
     * @return array The definition.
     */
<<<<<<< HEAD
    public function definition(): array {
=======
    public function definition() {
>>>>>>> forked/LAE_400_PACKAGE
        return $this->definition;
    }

    /**
     * Set the table definition
     *
     * @param array $overwrite New definition
     * @return tablelike This
     */
<<<<<<< HEAD
    public function set_definition(array $overwrite): tablelike {
=======
    public function set_definition($overwrite) {
>>>>>>> forked/LAE_400_PACKAGE
        $this->definition = $overwrite;
        return $this;
    }

    /**
     * Get a element to generate the HTML for this table row
<<<<<<< HEAD
     * @param grade_grade $grade The grade.
     * @return array
     */
    public function format_definition(grade_grade $grade): array {
        $line = [];
=======
     * @param array $line This is a list of lines in the table (modified)
     * @param grade_grade $grade The grade.
     * @return string
     */
    public function format_definition($line, $grade) {
>>>>>>> forked/LAE_400_PACKAGE
        foreach ($this->definition() as $i => $field) {
            // Table tab index.
            $tab = ($i * $this->total) + $this->index;
            $classname = '\\gradereport_singleview\\local\\ui\\' . $field;
            $html = new $classname($grade, $tab);

            if ($field == 'finalgrade' and !empty($this->structure)) {
<<<<<<< HEAD
                $html .= $this->structure->get_grade_action_menu($grade);
=======
                $html .= $this->structure->get_grade_analysis_icon($grade);
>>>>>>> forked/LAE_400_PACKAGE
            }

            // Singleview users without proper permissions should be presented
            // disabled checkboxes for the Exclude grade attribute.
<<<<<<< HEAD
            if ($field == 'exclude' && !has_capability('moodle/grade:manage', $this->context)) {
                $html->disabled = true;
            }

            $line[$field] = $html;
=======
            if ($field == 'exclude' && !has_capability('moodle/grade:manage', $this->context)){
                $html->disabled = true;
            }

            $line[] = $html;
>>>>>>> forked/LAE_400_PACKAGE
        }
        return $line;
    }

    /**
     * Get the HTML for the whole table
     * @return string
     */
<<<<<<< HEAD
    public function html(): string {
=======
    public function html() {
>>>>>>> forked/LAE_400_PACKAGE
        global $OUTPUT;

        if (!empty($this->initerrors)) {
            $warnings = '';
            foreach ($this->initerrors as $mesg) {
                $warnings .= $OUTPUT->notification($mesg);
            }
            return $warnings;
        }
        $table = new html_table();

        $table->head = $this->headers();

        $summary = $this->summary();
        if (!empty($summary)) {
            $table->caption = $summary;
            $table->captionhide = true;
        }

        // To be used for extra formatting.
        $this->index = 0;
        $this->total = count($this->items);

        foreach ($this->items as $item) {
            if ($this->index >= ($this->perpage * $this->page) &&
                $this->index < ($this->perpage * ($this->page + 1))) {
                $table->data[] = $this->format_line($item);
            }
            $this->index++;
        }

<<<<<<< HEAD
=======
        $underlying = get_class($this);

>>>>>>> forked/LAE_400_PACKAGE
        $data = new stdClass();
        $data->table = $table;
        $data->instance = $this;

<<<<<<< HEAD
        $buttonattr = ['class' => 'singleview_buttons submit'];
        $buttonhtml = implode(' ', $this->buttons($this->is_readonly()));
        $buttons = html_writer::tag('div', $buttonhtml, $buttonattr);

        $sessionvalidation = html_writer::empty_tag('input',
            ['type' => 'hidden', 'name' => 'sesskey', 'value' => sesskey()]);

        $html = html_writer::tag('form',
            html_writer::table($table)  . $this->bulk_insert() . $buttons . $sessionvalidation,
            ['method' => 'POST']
        );

        return html_writer::div($html, 'reporttable');
=======
        $buttonattr = array('class' => 'singleview_buttons submit');
        $buttonhtml = implode(' ', $this->buttons());

        $buttons = html_writer::tag('div', $buttonhtml, $buttonattr);
        $selectview = new select($this->courseid, $this->itemid, $this->groupid);

        $sessionvalidation = html_writer::empty_tag('input',
            array('type' => 'hidden', 'name' => 'sesskey', 'value' => sesskey()));

        $html = $selectview->html();
        $html .= html_writer::tag('form',
            $buttons . html_writer::table($table) . $this->bulk_insert() . $buttons . $sessionvalidation,
            array('method' => 'POST')
        );
        $html .= $selectview->html();
        return $html;
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Get the HTML for the bulk insert form
     *
     * @return string
     */
    public function bulk_insert() {
        return html_writer::tag(
            'div',
            (new bulk_insert($this->item))->html(),
<<<<<<< HEAD
            ['class' => 'singleview_bulk', 'hidden' => true]
=======
            array('class' => 'singleview_bulk')
>>>>>>> forked/LAE_400_PACKAGE
        );
    }

    /**
<<<<<<< HEAD
     * Return true if this is read-only.
     *
     * @return bool
     */
    public function is_readonly(): bool {
        global $USER;
        return empty($USER->editing);
    }

    /**
     * Get the buttons for saving changes.
     * @param bool $disabled If button is disabled
     *
     * @return array
     */
    public function buttons(bool $disabled = false): array {
        global $OUTPUT;
        $params = ['type' => 'submit', 'value' => get_string('save', 'gradereport_singleview')];
        if ($disabled) {
            $params['disabled'] = 'disabled';
        }
        return [$OUTPUT->render_from_template('gradereport_singleview/button', $params)];
=======
     * Get the buttons for saving changes.
     *
     * @return array
     */
    public function buttons() {
        global $OUTPUT;

        $save = $OUTPUT->render_from_template('gradereport_singleview/button', [
            'type' => 'submit',
            'value' => get_string('save', 'gradereport_singleview'),
        ]);

        return array($save);
>>>>>>> forked/LAE_400_PACKAGE
    }
}
