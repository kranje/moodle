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
 * Strings for component 'tool_catalogue', language 'en_us', version '5.1'.
 *
 * @package     tool_catalogue
 * @category    string
 * @copyright   1999 Martin Dougiamas and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['cachedef_filters'] = 'Learning catalog search results and filters';
$string['catalogue'] = 'Catalog';
$string['catalogue:config'] = 'Configure learning catalog';
$string['catalogueisdisabled'] = 'Learning catalog is disabled';
$string['cataloguesettings'] = 'My programs and courses catalog settings';
$string['coursesperpage_main'] = 'Number of courses per page, main catalog page';
$string['coursesperpage_main_desc'] = 'Number of courses to display on the main catalog page before a category is selected or search query is given and before any filters applied.';
$string['displayfields_list'] = 'Fields to display in the \'list\' (detailed) view of the learning catalog';
$string['displayfields_tiles'] = 'Fields to display in the \'tiles\' (compact) view of the learning catalog';
$string['enablelearningcatalogue'] = 'Enable learning catalog';
$string['enablelearningcatalogue_desc'] = 'Enable this setting to give all users access to the \'Catalog\' in the main navigation. This allows them to easily discover, filter, and enroll in courses. Moodle Workplace catalog will replace the standard courses page for all users.
<br><br>For more details, refer to the <a href="{$a}">documentation page</a>.';
$string['featuredcustomfield_desc'] = 'If the selected custom field is marked as \'checked\' in a course, that course will be featured on the catalog main page.';
$string['featuredlearningsectionsummary_desc'] = 'This text will be displayed alongside featured courses in the \'Featured\' section on the main page of the catalog.';
$string['featuredlearningsectiontitle_desc'] = 'Override the title of the \'Featured\' section in the catalog. If left blank, the default title \'Featured\' will be displayed.';
$string['fieldonlyvisibleincatalogue'] = 'This field has restricted visibility on the course information and enrollment pages, however it can still be made available in the learning catalog. If enabled here, the field will be visible to everybody.';
$string['filterfields'] = 'Fields to display in the learning catalog filter';
$string['learningcataloguesettings'] = 'Learning catalog settings';
$string['pluginname'] = 'Learning catalog';
$string['reg_wpcatalogueashome'] = 'Catalog is enabled and added to the site home page ({$a})';
$string['reg_wpcatalogueenabled'] = 'Catalog is enabled ({$a})';
$string['reg_wpcataloguefeatured'] = 'If the featured courses section in the catalog is enabled ({$a})';
$string['reg_wpcataloguepublic'] = 'Catalog is enabled and available to guests ({$a})';
$string['reindextaskname'] = 'Regular reindex of courses for the catalog';
$string['safehtmltags_desc'] = 'List of the HTML tags that should be kept when displaying course summaries or course custom fields in the learning catalog. All other tags will be removed to ensure that course summaries do not break the layout of the catalog.<br>Note that for course summaries HTML tags may not work well together with the \'Truncate\' setting.';
$string['showfeaturedsection'] = 'Show featured section in catalog';
$string['showfeaturedsection_desc'] = 'If enabled, featured courses will be displayed in a standalone section at the top of the catalog main page.';
