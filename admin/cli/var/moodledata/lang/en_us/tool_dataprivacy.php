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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Strings for component 'tool_dataprivacy', language 'en_us', version '5.1'.
 *
 * @package     tool_dataprivacy
 * @category    string
 * @copyright   1999 Martin Dougiamas and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['gdpr_art_9_2_b_description'] = 'Processing is necessary for the purposes of carrying out the obligations and exercising specific rights of the controller or of the data subject in the field of employment and social security and social protection law in so far as it is authorized by Union or Member State law or a collective agreement pursuant to Member State law providing for appropriate safeguards for the fundamental rights and the interests of the data subject.';
$string['requireallenddatesforuserdeletion_desc'] = 'When calculating user expiry, several factors are considered:

* the user\'s last login time is compared against the retention period for users; and
* whether the user is actively enrolled in any courses.

When checking the active enrollment in a course, if the course has no end date then this setting is used to determine whether that course is considered active or not.

If the course has no end date, and this setting is enabled, then the user cannot be deleted.';
$string['resubmittedrequest'] = 'The existing {$a->type} request for {$a->username} was canceled and resubmitted.';
$string['statuscancelled'] = 'Canceled';
