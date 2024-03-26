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
 * Drop down list (select list) element
 *
 * @package   gradereport_singleview
 * @copyright 2014 Moodle Pty Ltd (http://moodle.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace gradereport_singleview\local\ui;

<<<<<<< HEAD
=======
use html_writer;

>>>>>>> forked/LAE_400_PACKAGE
defined('MOODLE_INTERNAL') || die;

/**
 * Drop down list (select list) element
 *
 * @package   gradereport_singleview
 * @copyright 2014 Moodle Pty Ltd (http://moodle.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class dropdown_attribute extends element {

<<<<<<< HEAD
    /**
     * Who is selected?
     * @var string $selected
     */
    private $selected;

    /**
     * List of options
     * @var array $options
     */
    private $options;

    /**
     * Is this input disabled.
     * @var bool $isdisabled
     */
    private $isdisabled;

    /** @var bool If this is a read-only input. */
    private bool $isreadonly;

=======
    /** @var string $selected Who is selected ? */
    private $selected;

    /** @var array $options List of options ? */
    private $options;

    /** @var bool $isdisabled Is this input disabled. */
    private $isdisabled;

>>>>>>> forked/LAE_400_PACKAGE
    /**
     * Constructor
     *
     * @param string $name The first bit of the name of this input.
     * @param array $options The options list for this select.
     * @param string $label The form label for this input.
     * @param string $selected The name of the selected item in this input.
     * @param bool $isdisabled Are we disabled?
<<<<<<< HEAD
     * @param bool $isreadonly If this is a read-only input.
     */
    public function __construct(
        string $name,
        array $options,
        string $label,
        string $selected = '',
        bool $isdisabled = false,
        bool $isreadonly = false
    ) {
        $this->selected = $selected;
        $this->options = $options;
        $this->isdisabled = $isdisabled;
        $this->isreadonly = $isreadonly;
=======
     */
    public function __construct($name, $options, $label, $selected = '', $isdisabled = false) {
        $this->selected = $selected;
        $this->options = $options;
        $this->isdisabled = $isdisabled;
>>>>>>> forked/LAE_400_PACKAGE
        parent::__construct($name, $selected, $label);
    }

    /**
     * Nasty function spreading dropdown logic around.
     *
     * @return bool
     */
<<<<<<< HEAD
    public function is_dropdown(): bool {
=======
    public function is_dropdown() {
>>>>>>> forked/LAE_400_PACKAGE
        return true;
    }

    /**
     * Render this element as html.
     *
     * @return string
     */
<<<<<<< HEAD
    public function html(): string {
=======
    public function html() {
>>>>>>> forked/LAE_400_PACKAGE
        global $OUTPUT;

        $options = $this->options;
        $selected = $this->selected;

<<<<<<< HEAD
        $context = [
            'name' => $this->name,
            'value' => $this->selected,
            'text' => $options[$selected],
            'tabindex' => 1,
            'disabled' => !empty($this->isdisabled),
            'readonly' => $this->isreadonly,
=======
        $context = array(
            'name' => $this->name,
            'value' => $this->selected,
            'tabindex' => 1,
            'disabled' => !empty($this->isdisabled),
>>>>>>> forked/LAE_400_PACKAGE
            'options' => array_map(function($option) use ($options, $selected) {
                return [
                    'name' => $options[$option],
                    'value' => $option,
                    'selected' => $selected == $option
                ];
            }, array_keys($options)),
            'label' => get_string('gradefor', 'gradereport_singleview', $this->label),
<<<<<<< HEAD
        ];
=======
        );
>>>>>>> forked/LAE_400_PACKAGE

        return $OUTPUT->render_from_template('gradereport_singleview/dropdown_attribute', $context);
    }
}
