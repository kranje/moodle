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
 * Code to update a user preference in response to an ajax call.
 *
 * You should not send requests to this script directly. Instead use the set_user_preference
 * function in javascript_static.js.
 *
 * @package    core
 * @category   preference
 * @copyright  2008 Tim Hunt
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');

// Check access.
if (!confirm_sesskey()) {
<<<<<<< HEAD
    throw new \moodle_exception('invalidsesskey');
=======
    print_error('invalidsesskey');
>>>>>>> forked/LAE_400_PACKAGE
}

// Get the name of the preference to update, and check it is allowed.
$name = required_param('pref', PARAM_RAW);
if (!isset($USER->ajax_updatable_user_prefs[$name])) {
<<<<<<< HEAD
    throw new \moodle_exception('notallowedtoupdateprefremotely');
=======
    print_error('notallowedtoupdateprefremotely');
>>>>>>> forked/LAE_400_PACKAGE
}

// Get and the value.
$value = required_param('value', $USER->ajax_updatable_user_prefs[$name]);

// Update
if (!set_user_preference($name, $value)) {
<<<<<<< HEAD
    throw new \moodle_exception('errorsettinguserpref');
=======
    print_error('errorsettinguserpref');
>>>>>>> forked/LAE_400_PACKAGE
}

echo 'OK';
