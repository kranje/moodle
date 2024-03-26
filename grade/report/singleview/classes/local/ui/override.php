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
 * An override grade checkbox element
 *
 * @package   gradereport_singleview
 * @copyright 2014 Moodle Pty Ltd (http://moodle.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace gradereport_singleview\local\ui;

defined('MOODLE_INTERNAL') || die;

/**
 * An override grade checkbox element
 *
 * @package   gradereport_singleview
 * @copyright 2014 Moodle Pty Ltd (http://moodle.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
<<<<<<< HEAD
class override extends grade_attribute_format implements be_checked, be_disabled, be_readonly {

    /**
     * The name for this input
     * @var string $name
     */
=======
class override extends grade_attribute_format implements be_checked, be_disabled {

    /** @var string $name The name for this input */
>>>>>>> forked/LAE_400_PACKAGE
    public $name = 'override';

    /**
     * Is this input checked
     *
     * @return bool
     */
<<<<<<< HEAD
    public function is_checked(): bool {
=======
    public function is_checked() {
>>>>>>> forked/LAE_400_PACKAGE
        return $this->grade->is_overridden();
    }

    /**
     * Is this input disabled
     *
     * @return bool
     */
<<<<<<< HEAD
    public function is_disabled(): bool {
=======
    public function is_disabled() {
>>>>>>> forked/LAE_400_PACKAGE
        $lockedgrade = $lockedgradeitem = 0;
        if (!empty($this->grade->locked)) {
            $lockedgrade = 1;
        }
        if (!empty($this->grade->grade_item->locked)) {
            $lockedgradeitem = 1;
        }
        return ($lockedgrade || $lockedgradeitem);
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
=======
>>>>>>> forked/LAE_400_PACKAGE
     * Get the label for this form element.
     *
     * @return string
     */
<<<<<<< HEAD
    public function get_label(): string {
=======
    public function get_label() {
>>>>>>> forked/LAE_400_PACKAGE
        if (!isset($this->grade->label)) {
            $this->grade->label = '';
        }
        return $this->grade->label;
    }

    /**
     * Generate the element for this form input.
     *
     * @return element
     */
<<<<<<< HEAD
    public function determine_format(): element {
=======
    public function determine_format() {
>>>>>>> forked/LAE_400_PACKAGE
        if (!$this->grade->grade_item->is_overridable_item()) {
            return new empty_element();
        }
        return new checkbox_attribute(
            $this->get_name(),
            $this->get_label(),
            $this->is_checked(),
<<<<<<< HEAD
            $this->is_disabled(),
            $this->is_readonly()
=======
            $this->is_disabled()
>>>>>>> forked/LAE_400_PACKAGE
        );
    }

    /**
     * Save the modified value of this form element.
     *
     * @param string $value The new value to set
     * @return mixed string|false Any error message
     */
    public function set($value) {
        if (empty($this->grade->id)) {
            return false;
        }

<<<<<<< HEAD
        $state = !($value == 0);
=======
        $state = $value == 0 ? false : true;
>>>>>>> forked/LAE_400_PACKAGE

        $this->grade->set_overridden($state);
        $this->grade->grade_item->force_regrading();
        return false;
    }
}
