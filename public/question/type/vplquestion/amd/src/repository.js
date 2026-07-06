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
 * AJAX calls for this component.
 * @copyright  2026 Astor Bizard
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['core/ajax'], function(Ajax) {
    return {
        saveFilesToVPL: async function(questionid, answer, filestype) {
            return Ajax.call([{
                methodname: 'qtype_vplquestion_save_files',
                args: {
                    questionid,
                    answer,
                    filestype,
                },
            }])[0];
        },
        getEditorPreferences: async function() {
            try {
                var response = await Ajax.call([{
                    methodname: 'qtype_vplquestion_get_editor_preferences',
                    args: {},
                }])[0];
                return {
                    acetheme: response.acetheme,
                    fontsize: Number(response.fontsize),
                };
            } catch {
                return {
                    acetheme: 'chrome',
                    fontsize: 12,
                };
            }
        },
        saveEditorPreferences: async function(acetheme, fontsize) {
            return Ajax.call([{
                methodname: 'qtype_vplquestion_set_editor_preferences',
                args: {
                    acetheme,
                    fontsize,
                },
            }])[0];
        },
        checkEvaluationState: async function(usageid, slot, url) {
            return Ajax.call([{
                methodname: 'qtype_vplquestion_check_evaluation_state',
                args: {
                    usageid,
                    slot,
                    url,
                },
            }])[0];
        }
    };
});
