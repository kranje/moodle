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
 * Defines the behavior of the student's answer form for a vplquestion.
 * @copyright  Astor Bizard, 2019
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define([
    'core/config',
    'qtype_vplquestion/codeeditors',
    'mod_vpl/vplterminal',
    'qtype_vplquestion/vplservice',
    ], function(cfg, CodeEditors, VPLTerminal, VPLService) {

    // Since VPL version 4.4.0, VPLTerminal is not exported as a module but as an object so we need this fix.
    if (typeof VPLTerminal.VPLTerminal !== 'undefined') {
        VPLTerminal = VPLTerminal.VPLTerminal;
    }

    /**
     * For VPLTerminal constructor - determines what to display on titlebar.
     * In our case, we just want to display if process is running or exited.
     * @param {String} key Key to map.
     * @return {String} Mapped string.
     */
    function str(key) {
        switch (key) {
            case 'console': return '[Process';
            case 'connected':
            case 'connecting':
            case 'running': return 'running]';
            case 'connection_closed': return 'exited]';
            default: return key;
        }
    }

    /**
     * Clean input HTML to only keep safe tags.
     * @param {String} text HTML text to clean.
     * @return {String} Cleaned text.
     */
    function sanitizeHTML(text) {
        // Img tags load src even when not displaying it. Remove external img tags pre-emptively to avoid any loading of image src.
        text = text.replace(/<img[^>]*>/ig, function(imgTag) {
            var imgSrcMatch = imgTag.match(/src=(?:(?:"([^"]*)")|(?:'([^']*)'))/i);
            if (!imgSrcMatch) {
                return '';
            }
            var imgSrc = imgSrcMatch[1] || imgSrcMatch[2];
            if (imgSrc.startsWith(cfg.wwwroot) || imgSrc.toLowerCase().startsWith('data:image')) {
                // This is an internal or inline image, allow it.
                return imgTag;
            } else {
                // External image, discard.
                return '';
            }
        });

        var div = document.createElement('div');
        div.innerHTML = text;
        // Allowed tags with allowed attributes.
        var allowedTags = {
            a: ['href'],
            b: [],
            br: [],
            details: ['open'],
            div: [],
            em: [],
            h1: [],
            h2: [],
            h3: [],
            h4: [],
            h5: [],
            h6: [],
            hr: [],
            i: [],
            img: ['alt', 'src', 'height', 'width'],
            li: [],
            ol: [],
            p: [],
            pre: [],
            span: ['lang'],
            summary: [],
            svg: ['height', 'width'],
            table: [],
            tbody: [],
            td: [],
            th: [],
            thead: [],
            tr: [],
            ul: [],
        };
        // Universally allowed attributes.
        var allowedAttrs = [
            'aria-label',
            'class',
            'dir',
            'role',
            'style',
            'title',
        ];

        // Allowed tags within SVG with allowed attributes.
        var allowedSVGTags = {
            circle: ['cx', 'cy', 'r'],
            ellipse: ['cx', 'cy', 'rx', 'ry'],
            g: [],
            line: ['x1', 'x2', 'y1', 'y2'],
            path: ['d'],
            polygon: ['points'],
            polyline: ['points'],
            rect: ['height', 'rx', 'ry', 'width', 'x', 'y'],
            text: ['dx', 'dy', 'lengthadjust', 'rotate', 'textlength', 'x', 'y'],
            tspan: ['dx', 'dy', 'rotate', 'textlength', 'x', 'y'],
        };
        // Universally allowed attributes in SVG elements.
        var allowedSVGAttrs = [
            'fill',
            'fill-opacity',
            'fill-rule',
            'fill-stroke',
            'font-family',
            'font-size',
            'opacity',
            'stroke',
            'stroke-width',
            'stroke-opacity',
            'stroke-linecap',
            'stroke-dasharray',
            'stroke-linejoin',
            'style',
            'text-anchor',
        ];

        var filterNodes = function(element) { // From https://stackoverflow.com/a/2393182.
            if (element.nodeType === Node.ELEMENT_NODE) {
                // First, clean children elements.
                element.childNodes.forEach(filterNodes);
                var tag = element.tagName.toLowerCase();
                var allowedAttributesForElement = null;
                if (tag in allowedTags) {
                    allowedAttributesForElement = allowedTags[tag].concat(allowedAttrs);
                } else if ((tag in allowedSVGTags) && element.closest('svg')) {
                    allowedAttributesForElement = allowedSVGTags[tag].concat(allowedSVGAttrs);
                } else {
                    // Replace unwanted elements with their contents.
                    element.outerHTML = element.innerHTML;
                    return;
                }
                // Remove unwanted attributes.
                Array.from(element.attributes).forEach(function(attr) {
                    if (!allowedAttributesForElement.includes(attr.name.toLowerCase())) {
                       element.removeAttributeNode(attr);
                    } else if (tag === 'a' && attr.name.toLowerCase() === 'href') {
                        // Extra sanitization for href - only internal links allowed.
                        if (!attr.value.startsWith(cfg.wwwroot) && !attr.value.startsWith('#')) {
                            element.outerHTML = element.innerHTML;
                        }
                    }
                });
            } else if (element.nodeType !== Node.TEXT_NODE) {
                // Only elements and text nodes allowed, no funny stuff.
                element.remove();
            }
        };
        filterNodes(div);
        return div.innerHTML;
    }

    /**
     * Build an html string to display the specified field of the result,
     * formatting titles (field name) and subtitles (lines starting with '-').
     * @param {Object} result Evaluation/execution result object.
     * @param {String} field Field of result to display.
     * @param {String} level CSS class fragment for error level.
     * @param {Boolean} wrapInPre Whether the result should be wrapped in a preformatted or interpreted.
     * @return {String} Formatted result as HTML fragment.
     */
    function makeResultHtml(result, field, level, wrapInPre) {
        if (result[field]) {
            var formattedText = '';
            if (wrapInPre) {
                var pre = document.createElement('pre');
                pre.classList.add('pb-3', 'mb-0'); // Make room for horizontal scrollbar if needed.
                if (typeof result[field] === 'string') {
                    pre.textContent = result[field].replace(/\r\n|\r/g, '\n').trim();
                } else if (typeof result[field].message !== 'undefined') { // Likely execerror object.
                    pre.textContent = result[field].message.replace(/\r\n|\r/g, '\n').trim();
                }
                formattedText = pre.outerHTML;
            } else {
                var lines = sanitizeHTML(result[field]).split(/\r\n|\r|\n|<br\s*\/?>/);
                // Trim empty lines from beginning and end of array.
                while (lines[0].trim() == '') {
                    lines.shift();
                }
                while (lines[lines.length - 1].trim() == '') {
                    lines.pop();
                }
                lines.forEach(function(line) {
                    line = line.trim();
                    if (line.charAt(0) == '-') {
                        // Title.
                        formattedText += '<b class="vpl-test-title rounded px-1">' + line.substring(1) + '</b><br>';
                    } else if (line.substring(0, 4) == '&gt;') {
                        // Preformatted.
                        formattedText += '<pre class="m-0">' + line.substring(4) + '</pre>';
                    } else {
                        // Add an effective carriage return that works for both inline and block elements, and for empty lines.
                        formattedText += line + (line > '' ? '<div class="clearfix" aria-hidden="true"></div>' : '<br>');
                    }
                });
                formattedText = formattedText.replaceAll('</pre><pre class="m-0">', '\n'); // Fuse consecutive <pre> elements.
            }
            return '<h6 class="vpl-result-title vpl-title-' + level + ' border border-dark px-1">' +
                        M.util.get_string(field, 'qtype_vplquestion') +
                    '</h6>' +
                    formattedText;
        }
        return '';
    }

    /**
     * Display result on screen in specified display.
     * If result is null, this method will try to get it from data-result attribute.
     * @param {String} displayId ID of DOM element in which result should be displayed.
     * @param {?Object} result Evaluation/execution result object, or null.
     */
    function displayResult(displayId, result) {
        var display = document.getElementById(displayId);
        if (result === null) {
            result = JSON.parse(display.dataset.result);
        }
        var html = makeResultHtml(result, 'compilation', 'error', true)
            + makeResultHtml(result, 'evaluation', 'info', false)
            + makeResultHtml(result, 'execerror', 'error', true)
            + makeResultHtml(result, 'evaluationerror', 'error', true);
        if (!html) {
            html = makeResultHtml(result, 'execution', 'error', true);
        }
        display.hidden = !html;
        display.innerHTML = html;
    }

    /**
     * Set up student answer box (ace editor, terminal and reset/correction, run and pre-check buttons).
     * @param {String|Number} questionId Question ID, used for DOM identifiers and executions.
     * @param {String|Number} vplId VPL ID, used for ajax calls.
     * @param {String|Number} userId User ID, used for ajax calls.
     * @param {String} textareaName HTML name attribute of textarea used for student answer.
     */
    async function setup(questionId, vplId, userId, textareaName) {
        // This is the textarea that will recieve student's answer.
        var textarea = document.getElementsByName(textareaName)[0];

        var questionOuterDiv = textarea.closest('.que.vplquestion');

        if (textareaName === document.querySelectorAll('.que.vplquestion textarea')[0].getAttribute('name')) {
            // Setup editor preferences form once for all the page if we are the first editor.
            // We do this by textarea name presence because for questions with errors, editor is not shown.
            CodeEditors.setupEditorPreferencesForm('[data-role="qvpl_open_editor_preferences"]');
        }

        // Setup ace editor THEN buttons (so Run and Check correctly take current ace text).
        await CodeEditors.setupQuestionEditor(textarea, questionOuterDiv.querySelectorAll('[data-role="qvpl_set_text"]'));

        if (textarea.hasAttribute('readonly')) {
            // We are in review (readonly) mode - do nothing more.
            return;
        }

        // Initialize the terminal on the wrapper.
        var wrapperId = 'terminal_q' + questionId;
        var terminal = new VPLTerminal(wrapperId, wrapperId, str);

        // Deactivate message function (it normally displays a ticking timer, which is annoying).
        terminal.setMessage = function() {
            return;
        };

        // Move the terminal to a nice place within the question box.
        var qvplButtons = questionOuterDiv.querySelector('[data-role="qvpl-buttons"]');
        var globalTerminalWrapper = document.getElementById(wrapperId).parentElement;
        globalTerminalWrapper.style.zIndex = 1000; // It sets itself to 2000 which is too much for Moodle navigation.
        qvplButtons.after(globalTerminalWrapper);

        // Show resize handle for terminal.
        globalTerminalWrapper.querySelector('.ui-resizable-s').classList.add('resize-handle');

        // Replace titlebar class for two reasons: styling and removing jQueryUI managing drag-and-drop of terminal to move it.
        var titleBar = globalTerminalWrapper.querySelector('.ui-dialog-titlebar');
        titleBar.classList.remove('ui-dialog-titlebar');
        titleBar.classList.add('terminal-titlebar');

        // Remove console buttons (clipboard, etc.) as we do not manage it.
        globalTerminalWrapper.querySelector('.console-title-buttons').remove();

        // Override show function, that indirectly sets the terminal to be displayed somewhere else.
        var oldShow = terminal.show;
        var firstShow = true;
        terminal.show = function() {
            if (firstShow) {
                // Set terminal size once (so resize by user is persistent across executions).
                globalTerminalWrapper.querySelector('.xterm-screen').style.height = '200px';
                firstShow = false;
            }
            oldShow.apply(terminal, arguments);
            globalTerminalWrapper.style.top = 0;
            globalTerminalWrapper.style.left = 0;
        };

        // Change close button style to match the general question style.
        var closeTerminalButton = globalTerminalWrapper.querySelector('.ui-dialog-titlebar-close');
        closeTerminalButton.innerHTML = '<i class="fa fa-close" aria-hidden="true"></i>';
        closeTerminalButton.classList.add('btn', 'btn-secondary', 'close-terminal');

        // Setup a VPL button (run, debug, or evaluate).
        var setupButton = function(action, iconClass, filestype) {
            var button = qvplButtons.querySelector('button[data-action="' + action + '"]');
            if (!button) {
                // This action is not available.
                return;
            }
            var icon = document.createElement('i');
            icon.classList.add('fa', 'fa-' + iconClass, 'ml-2');
            icon.setAttribute('aria-hidden', 'true');
            button.appendChild(icon);

            var reenableButtons = function() {
                icon.classList.add('fa-' + iconClass);
                icon.classList.remove('fa-refresh', 'fa-spin');
                // Reactivate all buttons on the page.
                document.querySelectorAll('[data-role="qvpl-buttons"] button').forEach(function(button) {
                    button.removeAttribute('disabled');
                });
            };

            button.addEventListener('click', async function() {
                // Deactivate all buttons on the page.
                document.querySelectorAll('[data-role="qvpl-buttons"] button').forEach(function(button) {
                    button.setAttribute('disabled', 'disabled');
                });
                closeTerminalButton.click();
                icon.classList.add('fa-refresh', 'fa-spin');
                icon.classList.remove('fa-' + iconClass);
                try {
                    await VPLService.call('save', questionId, textarea.value, filestype);
                    // We got nested callback, but we can't promisify it,
                    // as callback may be called several times depending on the underlying websocket messages order.
                    await VPLService.call('exec', action, vplId, userId, terminal, function(result) {
                        displayResult('vpl_result_q' + questionId, result);
                        reenableButtons();
                    });
                } catch (error) {
                    displayResult('vpl_result_q' + questionId, {execerror: error});
                    reenableButtons();
                }
            });
        };

        setupButton('run', 'rocket', 'run');
        setupButton('debug', 'check-square-o', 'precheck');
        setupButton('evaluate', 'check-square-o', 'precheck');
    }

    return {
        setup: setup,
        displayResult: displayResult,
    };
});
