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
 * Strings for component 'enrol_meta', language 'en_us', version '5.1'.
 *
 * @package     enrol_meta
 * @category    string
 * @copyright   1999 Martin Dougiamas and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['enrolmetasynctask'] = 'Meta enrollment sync task';
$string['meta:config'] = 'Configure meta enroll instances';
$string['meta:unenrol'] = 'Unenroll suspended users';
$string['nosyncroleids'] = 'Roles that are not synchronized';
$string['nosyncroleids_desc'] = 'Select any roles that should not be synchronized between the source course to the target course.';
$string['pluginname_desc'] = 'The course meta link synchronizes enrollments and roles from the source course to the target course.';
$string['privacy:metadata:core_group'] = 'The course meta link enrollment plugin can create a new group or use an existing group to add participants from the source course.';
$string['syncall'] = 'Synchronize all enrolled users';
$string['syncall_desc'] = 'If enabled, all enrolled users are synchronized from the source course even if they have no role in it. Otherwise, only users that have at least one role are enrolled in the target course.';
$string['wsinvalidmetacourse'] = 'Meta course ID = {$a} doesn\'t exist or you don\'t have permission to add an enrollment instance.';
