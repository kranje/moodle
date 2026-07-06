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
    'jquery',
    'core/config',
    'core/modal_factory',
    'core/modal_events',
    'core/templates',
    'qtype_vplquestion/codeeditors',
    'mod_vpl/vplterminal',
    'qtype_vplquestion/vplservice'
    ], function($, cfg, ModalFactory, ModalEvents, Templates, CodeEditors, VPLTerminal, VPLService) {

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
     * Escape special html characters in a text.
     * @param {String} text HTML text to escape.
     * @return {String} Escaped text.
     */
    function escapeHtml(text) {
        var map = {'&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;'};
        return text.replace(/[&<>"']/g, function(c) {
            return map[c];
        });
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
     * @param {Boolean} pre Whether the result should be wrapped in a preformatted or interpreted.
     * @return {String} Formatted result as HTML fragment.
     */
    function makeResultHtml(result, field, level, pre) {
        if (result[field]) {
            var formattedText = '';
            var text = pre ? escapeHtml(result[field]) : sanitizeHTML(result[field]);
            text.split(/\n|<br\s*\/?>/).forEach(function(line) {
                if (pre) {
                    formattedText += line + '\n';
                } else {
                    line = line.trim();
                    if (line.charAt(0) == '-') {
                        formattedText += '<b class="vpl-test-title rounded px-1">' + line.substring(1) + '</b><br>';
                    } else if (line.substring(0, 4) == '&gt;') {
                        formattedText += '<pre class="m-0">' + line.substring(4) + '</pre>';
                    } else {
                        // Add an effective carriage return that works for both inline and block elements, and for empty lines.
                        formattedText += line + (line > '' ? '<div class="clearfix"></div>' : '<br>');
                    }
                }
            });
            return '<span class="vpl-result-title vpl-title-' + level + ' d-block font-weight-bold border border-dark pl-1 mb-1">' +
                        M.util.get_string(field, 'qtype_vplquestion') +
                    '</span>' +
                    (pre ? '<pre>' + formattedText.trim() + '</pre>' : formattedText.trim());
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
        var $display = $('#' + displayId);
        if (result === null) {
            // This method parses the JSON by itself - no need to parse it.
            result = $display.data('result');
        }
        var html = makeResultHtml(result, 'compilation', 'error', true)
            + makeResultHtml(result, 'evaluation', 'info', false)
            + makeResultHtml(result, 'execerror', 'error', true)
            + makeResultHtml(result, 'evaluationerror', 'error', true);
        if (!html) {
            html = makeResultHtml(result, 'execution', 'error', true);
        }
        $display[html ? 'show' : 'hide']();
        $display.html(html);
    }

    /**
     * Set up student answer box (ace editor, terminal and reset/correction, run and pre-check buttons).
     * @param {String|Number} questionId Question ID, used for DOM identifiers.
     * @param {String|Number} vplId VPL ID, used for ajax calls.
     * @param {String|Number} userId User ID, used for ajax calls.
     * @param {String} textareaName HTML name attribute of textarea used for student answer.
     */
    function setup(questionId, vplId, userId, textareaName) {
        // This is the textarea that will recieve student's answer.
        var $textarea = $('textarea[name="' + textareaName + '"]');

        var $resetAndCorrectionButtons = $('#qvpl_reset_q' + questionId + ', #qvpl_correction_q' + questionId);

        // Setup ace editor THEN buttons (so Run and Check correctly take current ace text).
        CodeEditors.setupQuestionEditor($textarea, $resetAndCorrectionButtons, $textarea.data('lineoffset'))
        .done(function() {
            if ($textarea.attr('readonly') == 'readonly') {
                // We are in review (readonly) mode - do nothing more.
                return;
            }

            // Initialize the terminal on the wrapper.
            var wrapperId = 'terminal_wrapper_q' + questionId;
            var terminal = new VPLTerminal(wrapperId, wrapperId, str);
            $('#' + wrapperId).dialog('option', 'draggable', false);

            // Deactivate message function (it normally displays a ticking timer, which is annoying).
            terminal.setMessage = function() {
                return;
            };

            // Move the terminal to a nice place within the question box.
            var qvplButtons = '#qvpl_buttons_q' + questionId;
            var $globalTerminalWrapper = $('#' + wrapperId).parent();
            $globalTerminalWrapper.insertAfter(qvplButtons);

            // Override connect function, that indirectly sets the terminal to be displayed somewhere else.
            var oldConnect = terminal.connect;
            terminal.connect = function() {
                oldConnect.apply(terminal, arguments);
                $globalTerminalWrapper.css('top', 0).css('left', 0);
                $('body > .ui-widget-overlay.ui-front').first().remove(); // Remove the modal lock overlay.
            };

            // Change close button style to match the general question style.
            $globalTerminalWrapper.find('.ui-dialog-titlebar-close')
            .html('<i class="fa fa-close"></i>')
            .addClass('btn btn-secondary close-terminal');

            // Setup a VPL button (run, debug, or evaluate).
            var setupButton = function(action, icon, filestype) {
                var $button = $(qvplButtons + ' button[data-action="' + action + '"]');
                var $icon = $('<i class="fa fa-' + icon + ' ml-2"></i>');
                $icon.appendTo($button);
                var reenableButtons = function() {
                    $icon.addClass('fa-' + icon).removeClass('fa-refresh fa-spin');
                    $('.qvpl-buttons *').removeAttr('disabled');
                };

                $button.click(function() {
                    $('.qvpl-buttons *').attr('disabled', 'disabled');
                    $('.close-terminal').trigger('click');
                    $icon.addClass('fa-refresh fa-spin').removeClass('fa-' + icon);
                    // We got nested callbacks, but we can't promisify them,
                    // as callback may be called several times depending on the underlying websocket messages order.
                    VPLService.call('save', vplId, questionId, $textarea.val(), filestype)
                    .then(function() {
                        return VPLService.call('exec', action, vplId, userId, terminal, function(result) {
                            displayResult('vpl_result_q' + questionId, result);
                            reenableButtons();
                        });
                    })
                    .fail(function(details) {
                        displayResult('vpl_result_q' + questionId, {execerror: details});
                        reenableButtons();
                    });
                });
            };

            setupButton('run', 'rocket', 'run');
            setupButton('debug', 'check-square-o', 'precheck');
            setupButton('evaluate', 'check-square-o', 'precheck');
        });

        // First render the form. We do not send the promise to ModalFactory.create(),
        // because we will need to access rendered elements immediately.
        Templates.render('qtype_vplquestion/editorpreferencesform', {
            qid: questionId,
            installedthemes: JSON.parse(document.querySelector('[data-role=qvpl_installedthemes]').dataset.themes),
        }).done(function(formHTML) {
            $.when(
                CodeEditors.getEditorPreferences(),
                ModalFactory.create({
                    type: ModalFactory.types.SAVE_CANCEL,
                    title: '<i class="fa fa-fw fa-cog icon"></i>' + M.util.get_string('editoroptions', 'qtype_vplquestion'),
                    body: formHTML,
                }),
            )
            .done(function(prefs, modal) {
                // Explicitly attach to DOM, so other similar modals can interact with it and maintain consistency across forms.
                modal.attachToDOM();

                var $fontSizeInput = modal.getBody().find('[name="vpl_fontsize' + questionId + '"]');
                $fontSizeInput.val(prefs.fontSize);

                var $aceThemeInput = modal.getBody().find('[name="vpl_editortheme' + questionId + '"]');
                $aceThemeInput.val(prefs.aceTheme);

                // Some validation around font size.
                var prevFontSize = $fontSizeInput.val();
                $fontSizeInput.on('input', function() {
                    var newFontSize = Number($(this).val());
                    if (isNaN(newFontSize)) {
                        $(this).val(prevFontSize);
                    } else {
                        // Clamp in [1..48].
                        newFontSize = Math.min(Math.max(newFontSize, 1), 48);
                        $(this).val(newFontSize);
                        prevFontSize = newFontSize;
                        CodeEditors.changeFontSize(newFontSize); // Apply changes as a preview.
                    }
                });

                // Setup increase and decrease font size buttons.
                modal.getBody().find('[data-role="fontsizeincr"]').click(function() {
                    $fontSizeInput.val(Number($fontSizeInput.val()) + 1);
                    $fontSizeInput.trigger('input');
                });
                modal.getBody().find('[data-role="fontsizedecr"]').click(function() {
                    $fontSizeInput.val(Number($fontSizeInput.val()) - 1);
                    $fontSizeInput.trigger('input');
                });

                $aceThemeInput.on('change', function() {
                    CodeEditors.changeTheme($(this).val()); // Apply changes as a preview.
                });

                modal.getRoot().on(ModalEvents.save, function() {
                    $fontSizeInput.data('save', $fontSizeInput.val());
                    $aceThemeInput.data('save', $aceThemeInput.val());
                    CodeEditors.saveEditorPreferences($aceThemeInput.val(), $fontSizeInput.val());
                });

                modal.getRoot().on(ModalEvents.shown, function() {
                    $fontSizeInput.data('save', $fontSizeInput.val());
                    $aceThemeInput.data('save', $aceThemeInput.val());
                });

                modal.getRoot().on(ModalEvents.hidden, function() {
                    $fontSizeInput.val($fontSizeInput.data('save'));
                    $aceThemeInput.val($aceThemeInput.data('save'));
                    CodeEditors.changeFontSize($fontSizeInput.val());
                    CodeEditors.changeTheme($aceThemeInput.val());
                    // Set all the preferences forms to the same values for consistency.
                    $('[name^="vpl_fontsize"]').val($fontSizeInput.val());
                    $('[name^="vpl_editortheme"]').val($aceThemeInput.val());
                });

                $('#qvpl_editor_preferences' + questionId).css('visibility', 'visible').click(function() {
                    modal.show();
                });
            });
        });
    }

    return {
        setup: setup,
        displayResult: displayResult
    };
});
