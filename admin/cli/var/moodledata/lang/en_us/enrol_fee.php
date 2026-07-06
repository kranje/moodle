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
 * Strings for component 'enrol_fee', language 'en_us', version '5.1'.
 *
 * @package     enrol_fee
 * @category    string
 * @copyright   1999 Martin Dougiamas and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['cost'] = 'Enrollment fee';
$string['costerror'] = 'The enrollment fee must be a number.';
$string['enrolenddaterror'] = 'The enrollment end date cannot be earlier than the start date.';
$string['enrolperiod'] = 'Enrollment duration';
$string['enrolperiod_desc'] = 'Default length of time that the enrollment is valid. If set to zero, the enrollment duration will be unlimited by default.';
$string['enrolperiod_help'] = 'Length of time that the enrollment is valid, starting with the moment the user is enrolled. If disabled, the enrollment duration will be unlimited.';
$string['expiredaction'] = 'Enrollment expiry action';
$string['expiredaction_help'] = 'Select the action to be performed when a user\'s enrollment expires. Please note that some user data and settings are deleted when a user is unenrolled.';
$string['fee:config'] = 'Configure enrolment on payment enrol instances';
$string['fee:unenrol'] = 'Unenroll users from course';
$string['fee:unenrolself'] = 'Unenroll self from course';
$string['instancedescription_help'] = 'The description is only shown on the \'Enrollment methods\' page and is not shown to users enrolling in the course.';
$string['nocost'] = 'There is no cost to enroll in this course.';
$string['paymentaccount_help'] = 'Enrollment fees will be paid to this account.';
$string['pluginname'] = 'Enrollment on payment';
$string['pluginname_desc'] = 'The enrollment on payment enrollment method allows you to set up courses requiring a payment. If the fee for any course is set to zero, then students are not asked to pay for entry. There is a site-wide fee that you set here as a default for the whole site and then a course setting that you can set for each course individually. The course fee overrides the site fee.';
$string['privacy:metadata'] = 'The enrollment on payment enrollment plugin does not store any personal data.';
$string['purchasedescription'] = 'Enrollment in course {$a}';
$string['status'] = 'Allow enrollment on payment enrollments';
$string['status_desc'] = 'Allow users to make a payment to enroll into a course by default.';
