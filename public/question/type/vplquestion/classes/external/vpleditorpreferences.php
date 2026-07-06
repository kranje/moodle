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
 * External functions for
 * @package    qtype_vplquestion
 * @copyright  2026 Astor Bizard
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace qtype_vplquestion\external;

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->libdir . '/externallib.php');

use external_api;
use external_description;
use external_function_parameters;
use external_single_structure;
use external_value;

/**
 * External functions for
 * @copyright  2026 Astor Bizard
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class vpleditorpreferences extends external_api {
    /**
     * Defines the parameters of the get_editor_preferences function.
     * @return external_function_parameters
     */
    public static function get_editor_preferences_parameters() {
        return new external_function_parameters([]);
    }

    /**
     * Fetch and return current user's preferences for Ace editor theme and font size.
     * @return object defined by get_editor_preferences_returns()
     */
    public static function get_editor_preferences() {
        return [
                'acetheme' => get_user_preferences('vpl_acetheme', get_config('mod_vpl', 'editor_theme') ?: 'chrome'),
                'fontsize' => get_user_preferences('vpl_editor_fontsize', 12),
        ];
    }

    /**
     * Defines the return type of the get_editor_preferences function.
     * @return external_description
     */
    public static function get_editor_preferences_returns() {
        return new external_single_structure([
                'acetheme' => new external_value(PARAM_RAW, 'Ace editor theme'),
                'fontsize' => new external_value(PARAM_INT, 'Ace editor font size'),
        ]);
    }

    /**
     * Defines the parameters of the set_editor_preferences function.
     * @return external_function_parameters
     */
    public static function set_editor_preferences_parameters() {
        return new external_function_parameters([
                'acetheme' => new external_value(PARAM_RAW, 'Requested Ace editor theme', VALUE_DEFAULT, null),
                'fontsize' => new external_value(PARAM_INT, 'Requested Ace editor font size', VALUE_DEFAULT, null),
        ]);
    }

    /**
     * Set current user's preferences for Ace editor theme and font size.
     * @param string $acetheme
     * @param int $fontsize
     * @return object defined by set_editor_preferences_returns()
     */
    public static function set_editor_preferences($acetheme, $fontsize) {
        [ $acetheme, $fontsize ] = array_values(self::validate_parameters(self::set_editor_preferences_parameters(), [
                'acetheme' => $acetheme,
                'fontsize' => $fontsize,
        ]));
        if ($acetheme !== null) {
            set_user_preference('vpl_acetheme', $acetheme);
        }
        if ($fontsize !== null) {
            set_user_preference('vpl_editor_fontsize', $fontsize);
        }
        return true;
    }

    /**
     * Defines the return type of the set_editor_preferences function.
     * @return external_description
     */
    public static function set_editor_preferences_returns() {
        return new external_value(PARAM_BOOL, 'True on success');
    }
}
