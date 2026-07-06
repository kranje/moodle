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
 * Strings for component 'lti', language 'en_us', version '5.1'.
 *
 * @package     lti
 * @category    string
 * @copyright   1999 Martin Dougiamas and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['cancelled'] = 'Canceled';
$string['external_tool_type_help'] = '* **Automatic, based on tool URL** - The best tool configuration is selected automatically. If the tool URL is not recognized, the tool configuration details may need to be entered manually.
* **A specific preconfigured tool** - The tool configuration for the specified tool will be used when communicating with the external tool provider. If the tool URL does not appear to belong to the tool provider, a warning will be shown. It is not always necessary to enter a tool URL.
* **Custom configuration** - A consumer key and shared secret may need to be entered manually. The consumer key and shared secret may be obtained from the tool provider. However, not all tools require a consumer key and shared secret, in which case the fields may be left blank.

### Preconfigured tool editing

Three icons are available after the preconfigured tool drop-down menu:

* **Add** - Create a course level tool configuration. All External tool instances in this course may use the tool configuration.
* **Edit** - Select a course level tool from the drop-down menu, then click this icon. The details of the tool configuration may be edited.
* **Delete** - Remove the selected course level tool.';
$string['no_tp_cancelled'] = 'There are no canceled external tool registrations.';
$string['redirectionuris_help'] = 'A list of URIs (one per line) which the tool uses when making authorization requests.  At least one must be registered before a message can be successfully sent to the tool.';
$string['share_roster_admin_help'] = 'Specify whether the tool can access the list of users enrolled in courses from which this tool is launched.';
