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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * External functions declaration.
 * @package    qtype_vplquestion
 * @copyright  2026 Astor Bizard
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$functions = [
        'qtype_vplquestion_save_files' => [
                'classname'   => 'qtype_vplquestion\external\savetovpl',
                'methodname'  => 'save_files',
                'description' => 'Save files as a submission in the VPL activity',
                'type'        => 'write',
                'ajax'        => true,
        ],
        'qtype_vplquestion_get_editor_preferences' => [
                'classname'   => 'qtype_vplquestion\external\vpleditorpreferences',
                'methodname'  => 'get_editor_preferences',
                'description' => 'Get user preferences for Ace editor font size and theme',
                'type'        => 'read',
                'ajax'        => true,
        ],
        'qtype_vplquestion_set_editor_preferences' => [
                'classname'   => 'qtype_vplquestion\external\vpleditorpreferences',
                'methodname'  => 'set_editor_preferences',
                'description' => 'Set user preferences for Ace editor font size and theme',
                'type'        => 'write',
                'ajax'        => true,
        ],
        'qtype_vplquestion_check_evaluation_state' => [
                'classname'   => 'qtype_vplquestion\external\evaluationstate',
                'methodname'  => 'check_evaluation_state',
                'description' => 'Check the status of the asynchronous evaluation of a question',
                'type'        => 'read',
                'ajax'        => true,
        ],
];
