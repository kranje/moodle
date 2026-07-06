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
 * Provides utility method to communicate with a VPL (this is an API wrapper to use VPLUtil and VPLUI)
 * @copyright  Astor Bizard, 2019
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(['core/url', 'mod_vpl/vplutil', 'mod_vpl/vplui', 'qtype_vplquestion/repository'], function(url, VPLUtil, VPLUI, Repository) {

    // Since VPL version 4.4.0, VPLUtil and VPLUI are not exported as modules but as objects so we need this fix.
    if (typeof VPLUtil.VPLUtil !== 'undefined') {
        VPLUtil = VPLUtil.VPLUtil;
    }
    if (typeof VPLUI.VPLUI !== 'undefined') {
        VPLUI = VPLUI.VPLUI;
    }

    /**
     * Build ajax url to call with VPLUI.
     * @param {String|Number} vplId VPL ID.
     * @param {String|Number} userId User ID.
     * @param {String} file (optional) Ajax file to use. Defaults to edit.
     * @return {String} The ajax url built.
     */
    function getAjaxUrl(vplId, userId, file) {
        if (typeof file === 'undefined') {
            file = 'edit';
        }
        return url.relativeUrl('/mod/vpl/forms') + '/' + file + '.json.php?id=' + vplId + '&userId=' + userId + '&action=';
    }

    var VPLService = {};

    // Cache for info.
    var cache = {
        reqfile: [],
        execfiles: []
    };

    // Retrieve specified files from the VPL (either 'reqfile' or 'execfile').
    // Note : these files are stored in cache. To clear it, the user has to reload the page.
    VPLService.info = async function(filesType, vplId) {
        if (typeof cache[filesType][vplId] === 'undefined') {
            if (filesType === 'reqfile') {
                cache.reqfile[vplId] = (await VPLUI.requestAction('resetfiles', '', {}, getAjaxUrl(vplId, ''))).files[0];
            } else if (filesType === 'execfiles') {
                cache.execfiles[vplId] = (await VPLUI.requestAction('load', '', {}, getAjaxUrl(vplId, '', 'executionfiles'))).files;
            } else {
                return null; // Not supposed to happen anyway.
            }
        }
        return cache[filesType][vplId];
    };

    // Save student answer to VPL, by replacing {{ANSWER}} in the template by the student answer.
    VPLService.save = async function(questionId, answer, filestype) {
        return await Repository.saveFilesToVPL(questionId, answer, filestype);
    };

    // Execute the specified action (should be 'run' or 'evaluate').
    // Note that this function does not call save, it has to be called beforehand if needed.
    // Note also that callback may be called several times
    // (especially one time with (false) execution error and one time right after with execution result).
    VPLService.exec = async function(action, vplId, userId, terminal, callback) {
        // Build the options object for VPLUI.
        var options = {
            ajaxurl: getAjaxUrl(vplId, userId),
            resultSet: false,
            errorCause: 'unknown',
            setResult: function(result) {
                this.resultSet = true;
                callback(result);
            },
            close: function() {
                // If connection is closed without a result set, display an error.
                // /!\ It can happen that result will be set about 0.3s after closing.
                // -> Set a timeout to avoid half-second display of error.
                // Note : if delay between close and result is greater than timeout, it is fine
                // (there will just be a 0.1s error display before displaying the result).
                setTimeout(function() {
                    if (!this.resultSet) {
                        callback({execerror: M.util.get_string('closerecievednoretrieve', 'qtype_vplquestion', this.errorCause)});
                    }
                }.bind(this), this.errorCause != 'unknown' ? 0 : 600); // If an error cause is known, no need to delay.
            },

            // The following will only be used for the 'run' action.
            getConsole: function() {
                return terminal;
            },
            run: function(type, conInfo, ws) {
                var _this = this;
                terminal.connect(conInfo.executionURL, function() {
                    ws.close();
                    if (!_this.resultSet) {
                        // This may happen for the run action.
                        callback({});
                    }
                });
            }
        };

        // Recode progress bar so we can display the cause when execution is unexpectedly closed.
        VPLUI.progressBar = function() {
            var closed = false;
            this.setLabel = function(message) {
                var knownCauses = ['timeout', 'outofmemory'];
                knownCauses.forEach(function(cause) {
                    var pattern = '{' + cause + '}';
                    if (message.indexOf(pattern) !== -1) {
                        options.errorCause = cause + message.substring(message.indexOf(pattern) + pattern.length);
                    }
                });
            };
            this.close = function() {
                closed = true;
            };
            this.isClosed = function() {
                return closed;
            };
        };

        var response = await VPLUI.requestAction(action, '', {}, options.ajaxurl);
        VPLUI.webSocketMonitor(response, '', '', options);
        return response;
    };

    return {
        call: async function(service, ...args) {
            // Deactivate VPLUI progress bar, as we have our own progress indicator.
            VPLUI.progressBar = function() {
                this.setLabel = function() {
                    return;
                };
                this.close = function() {
                    return;
                };
                this.isClosed = function() {
                    return true;
                };
            };
            // Call service.
            return VPLService[service](...args);
        },

        langOfFile: function(fileName) {
            var lang = VPLUtil.langType(fileName.split('.').pop());
            if (lang === 'plain_text') { // Might be caused by changes on VPLUtil API since VPL version 4.3.0.
                lang = VPLUtil.langType(fileName); // Retry with full file name.
            }
            return lang;
        },

        isBinary: function(fileName) {
            return VPLUtil.isBinary(fileName);
        }
    };
});
