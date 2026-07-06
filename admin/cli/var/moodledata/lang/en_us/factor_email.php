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
 * Strings for component 'factor_email', language 'en_us', version '5.1'.
 *
 * @package     factor_email
 * @category    string
 * @copyright   1999 Martin Dougiamas and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['event:unauthemail'] = 'Unauthorized email received';
$string['settings:suspend'] = 'Suspend unauthorized accounts';
$string['settings:suspend_help'] = 'Check this to suspend user accounts if an unauthorized email verification is received.';
$string['unauthemail'] = 'Unauthorized email';
$string['unauthloginattempt'] = 'The user with ID {$a->userid} made an unauthorized login attempt using email verification from
IP {$a->ip} with browser agent {$a->useragent}.';
