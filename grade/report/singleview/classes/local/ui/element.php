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
 * UI Element for an excluded grade_grade.
 *
 * @package   gradereport_singleview
 * @copyright 2014 Moodle Pty Ltd (http://moodle.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace gradereport_singleview\local\ui;

defined('MOODLE_INTERNAL') || die;

/**
 * UI Element for an excluded grade_grade.
 *
 * @package   gradereport_singleview
 * @copyright 2014 Moodle Pty Ltd (http://moodle.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class element {

<<<<<<< HEAD
    /**
     * The first bit of the name for this input.
     * @var string $name
     */
    public $name;

    /**
     * The value for this input.
     * @var string $value
     */
    public $value;

    /**
     * The form label for this input.
     * @var string $label
     */
=======
    /** @var string $name The first bit of the name for this input. */
    public $name;

    /** @var string $value The value for this input. */
    public $value;

    /** @var string $label The form label for this input. */
>>>>>>> forked/LAE_400_PACKAGE
    public $label;

    /**
     * Constructor
     *
     * @param string $name The first bit of the name for this input
     * @param string $value The value for this input
     * @param string $label The label for this form field
     */
<<<<<<< HEAD
    public function __construct(string $name, string $value, string $label) {
=======
    public function __construct($name, $value, $label) {
>>>>>>> forked/LAE_400_PACKAGE
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
    }

    /**
     * Nasty function used for spreading checkbox logic all around
     * @return bool
     */
<<<<<<< HEAD
    public function is_checkbox(): bool {
=======
    public function is_checkbox() {
>>>>>>> forked/LAE_400_PACKAGE
        return false;
    }

    /**
     * Nasty function used for spreading textbox logic all around
     * @return bool
     */
<<<<<<< HEAD
    public function is_textbox(): bool {
=======
    public function is_textbox() {
>>>>>>> forked/LAE_400_PACKAGE
        return false;
    }

    /**
     * Nasty function used for spreading dropdown logic all around
     * @return bool
     */
<<<<<<< HEAD
    public function is_dropdown(): bool {
=======
    public function is_dropdown() {
>>>>>>> forked/LAE_400_PACKAGE
        return false;
    }

    /**
     * Return the HTML
     * @return string
     */
<<<<<<< HEAD
    abstract public function html(): string;
=======
    abstract public function html();
>>>>>>> forked/LAE_400_PACKAGE
}
