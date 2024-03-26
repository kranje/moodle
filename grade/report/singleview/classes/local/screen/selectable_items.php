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
 * Interface for a list of selectable things.
 *
 * @package   gradereport_singleview
 * @copyright 2014 Moodle Pty Ltd (http://moodle.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace gradereport_singleview\local\screen;

defined('MOODLE_INTERNAL') || die;

/**
 * Interface for a list of selectable things.
 *
 * @package   gradereport_singleview
 * @copyright 2014 Moodle Pty Ltd (http://moodle.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface selectable_items {
    /**
     * Get the description of this list
     * @return string
     */
<<<<<<< HEAD
    public function description(): string;
=======
    public function description();
>>>>>>> forked/LAE_400_PACKAGE

    /**
     * Get the label for the select box that chooses items for this page.
     * @return string
     */
<<<<<<< HEAD
    public function select_label(): string;
=======
    public function select_label();
>>>>>>> forked/LAE_400_PACKAGE

    /**
     * Get the list of options to show.
     * @return array
     */
<<<<<<< HEAD
    public function options(): array;
=======
    public function options();
>>>>>>> forked/LAE_400_PACKAGE

    /**
     * Get type of things in the list (gradeitem or user)
     * @return string
     */
<<<<<<< HEAD
    public function item_type(): string;
=======
    public function item_type();
>>>>>>> forked/LAE_400_PACKAGE
}
