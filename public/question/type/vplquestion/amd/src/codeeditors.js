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
 * Provides utility methods to setup resizable ace editors into a page.
 * @copyright  Astor Bizard, 2019
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/* globals ace */
define([
    'core/url',
    'core/modal_events',
    'core/modal_save_cancel',
    'core/templates',
    'qtype_vplquestion/repository'
    ], function(url, ModalEvents, ModalSaveCancel, Templates, Repository) {

    // Global Ace editor theme and font size to use for all editors.
    var aceTheme;
    var fontSize;

    /**
     * Setup each specified textarea with Ace editor, with a vertical resize feature.
     * It inherits readonly attribute from textarea.
     * @param {HTMLElement} textarea Textarea from which to set up editor.
     * @param {String} aceSize Initial CSS size of editors.
     * @param {String} aceLang (optional) Lang (mode) to setup editors from.
     * @return {Editor} The last editor set up.
     */
    function setupAceEditor(textarea, aceSize, aceLang) {
        var aceEditor;

        // Vertical resizing.
        var prevY;
        var placeholderBeingResized = null;

        if (aceLang === undefined) {
            aceLang = 'plain_text';
        }

        var editorPlaceholder = document.createElement('div');
        editorPlaceholder.style.width = '100%';
        editorPlaceholder.style.height = aceSize;
        editorPlaceholder.setAttribute('id', 'ace_placeholder_' + textarea.getAttribute('name'));
        editorPlaceholder.classList.add('ace-placeholder');
        textarea.after(editorPlaceholder);
        textarea.hidden = true;

        var resizeHandle = document.createElement('div');
        resizeHandle.classList.add('resize-handle');
        editorPlaceholder.after(resizeHandle);

        // This is what creates the Ace editor within the placeholder div.
        aceEditor = ace.edit(editorPlaceholder);
        aceEditor.setOptions({
            theme: 'ace/theme/' + aceTheme,
            mode: 'ace/mode/' + aceLang
        });
        aceEditor.setFontSize(fontSize);
        aceEditor.$blockScrolling = Infinity; // Disable ace warning.
        aceEditor.getSession().setValue(textarea.value);
        aceEditor.setReadOnly(textarea.hasAttribute('readonly'));

        // Propagate changes to textarea on every input.
        aceEditor.on('input', function() {
            // Cannot use aceEditor here, as it will have another value later.
            textarea.value = ace.edit('ace_placeholder_' + textarea.getAttribute('name')).getValue();
        });

        resizeHandle.addEventListener('mousedown', function(event) {
            prevY = event.clientY;
            placeholderBeingResized = editorPlaceholder;
            event.preventDefault();
        });
        window.addEventListener('mousemove', function(event) {
            if (placeholderBeingResized) {
                var previousHeight = placeholderBeingResized.clientHeight + 1; // Add 1 because of border-box.
                placeholderBeingResized.style.height = (previousHeight + event.clientY - prevY) + 'px';
                prevY = event.clientY;
                ace.edit(placeholderBeingResized).resize();
                event.preventDefault();
            }
        });
        window.addEventListener('mouseup', function() {
            placeholderBeingResized = null;
        });

        return aceEditor;
    }

    /**
     * Apply new font size to all Ace editors in the page.
     * @param {Number|String} newFontSize New font size to apply.
     */
    function changeFontSize(newFontSize) {
        document.querySelectorAll('.ace-placeholder').forEach(function(placeholder) {
            ace.edit(placeholder).setFontSize(Number(newFontSize));
        });
    }

    /**
     * Apply new theme to all Ace editors in the page.
     * @param {String} newTheme New theme to apply.
     */
    function changeTheme(newTheme) {
        document.querySelectorAll('.ace-placeholder').forEach(function(placeholder) {
            ace.edit(placeholder).setOptions({
                theme: 'ace/theme/' + newTheme,
            });
        });
    }

    /**
     * Setup preferences form for Ace editor.
     * This is to be called once per page so it is set globally for all editors.
     * @param {String} showPreferencesButtonsSelector CSS selector for buttons dedicated to opening the form.
     */
    async function setupEditorPreferencesForm(showPreferencesButtonsSelector) {
        // First render the form. We do not send the promise to ModalSaveCancel.create(),
        // because we will need to access rendered elements immediately.
        var formHTML = await Templates.render('qtype_vplquestion/editorpreferencesform', {
            installedthemes: JSON.parse(document.querySelector('[data-role=qvpl_installedthemes]').dataset.themes),
        });
        var icon = '<i class="fa fa-fw fa-cog icon" aria-hidden="true"></i>';
        var [prefs, modal] = await Promise.all([
            Repository.getEditorPreferences(),
            ModalSaveCancel.create({
                title: icon + M.util.get_string('editoroptions', 'qtype_vplquestion'),
                body: formHTML,
            }),
        ]);
        // Explicitly attach to DOM, so other similar modals can interact with it and maintain consistency across forms.
        modal.attachToDOM();

        var modalBody = document.getElementById('qvpl_editor_preferences_form');

        var fontSizeInput = document.getElementsByName('vpl_fontsize')[0];
        fontSizeInput.value = prefs.fontsize;

        var aceThemeInput = document.getElementsByName('vpl_editortheme')[0];
        aceThemeInput.value = prefs.acetheme;

        // Some validation around font size.
        var prevFontSize = fontSizeInput.value;
        fontSizeInput.addEventListener('input', function() {
            var newFontSize = Number(fontSizeInput.value);
            if (isNaN(newFontSize)) {
                fontSizeInput.value = prevFontSize;
            } else {
                // Clamp in [1..48].
                newFontSize = Math.min(Math.max(newFontSize, 1), 48);
                fontSizeInput.value = newFontSize;
                prevFontSize = newFontSize;
                changeFontSize(newFontSize); // Apply changes as a preview.
            }
        });

        // Setup increase and decrease font size buttons.
        modalBody.querySelector('[data-role="fontsizeincr"]').addEventListener('click', function() {
            fontSizeInput.value = Number(fontSizeInput.value) + 1;
            fontSizeInput.dispatchEvent(new CustomEvent('input'));
        });
        modalBody.querySelector('[data-role="fontsizedecr"]').addEventListener('click', function() {
            fontSizeInput.value = Number(fontSizeInput.value) - 1;
            fontSizeInput.dispatchEvent(new CustomEvent('input'));
        });

        aceThemeInput.addEventListener('change', function() {
            changeTheme(aceThemeInput.value); // Apply changes as a preview.
        });

        modal.getRoot().on(ModalEvents.shown, function() {
            fontSizeInput.dataset.saved = fontSizeInput.value;
            aceThemeInput.dataset.saved = aceThemeInput.value;
        });

        modal.getRoot().on(ModalEvents.save, function() {
            fontSizeInput.dataset.saved = fontSizeInput.value;
            aceThemeInput.dataset.saved = aceThemeInput.value;
            Repository.saveEditorPreferences(aceThemeInput.value, fontSizeInput.value);
        });

        modal.getRoot().on(ModalEvents.hidden, function() {
            fontSizeInput.value = fontSizeInput.dataset.saved;
            aceThemeInput.value = aceThemeInput.dataset.saved;
            changeFontSize(fontSizeInput.value);
            changeTheme(aceThemeInput.value);
        });

        document.querySelectorAll(showPreferencesButtonsSelector).forEach(function(showPreferencesButton) {
            showPreferencesButton.addEventListener('click', function() {
                modal.show();
            });
            showPreferencesButton.classList.remove('invisible');
        });
    }

    /**
     * Loads Ace script from VPL plugin.
     * @return {Promise} A promise that resolves upon load.
     */
    async function loadAce() {
        if (typeof ace !== 'undefined' && typeof aceTheme !== 'undefined') {
            return ace;
        }
        var ACESCRIPTLOCATION = url.relativeUrl("/mod/vpl/editor/ace9");
        await Promise.all([
            new Promise(function(resolve, reject) {
                var script = document.createElement('script');
                script.src = ACESCRIPTLOCATION + '/ace.js';
                script.async = true;
                script.onload = function() {
                    ace.config.set('basePath', ACESCRIPTLOCATION);
                    resolve(...arguments);
                };
                script.onerror = reject;
                document.body.appendChild(script);
            }),
            Repository.getEditorPreferences().then(function(prefs) {
                aceTheme = prefs.acetheme;
                fontSize = prefs.fontsize;
                return prefs;
            }),
        ]);
        return ace;
    }

    return {
        // Setup editors in question edition form.
        setupFormEditors: async function() {
            await loadAce();
            document.querySelectorAll('[data-role="code-editor"]').forEach(function(textarea) {
                // Add editor preferences button in a nice spot.
                var formElement = textarea.parentElement;
                var div = document.createElement('div');
                div.classList.add('w-100');
                div.append(...formElement.children);
                var wrapper = document.createElement('div');
                wrapper.classList.add('d-flex', 'w-100');
                wrapper.append(div);
                var openPreferencesButton = document.createElement('button');
                openPreferencesButton.setAttribute('type', 'button');
                openPreferencesButton.setAttribute('title', M.util.get_string('editoroptions', 'qtype_vplquestion'));
                openPreferencesButton.dataset.role = 'qvpl_open_editor_preferences';
                openPreferencesButton.classList.add('btn', 'btn-link', 'p-0', 'ml-2', 'align-self-start');
                openPreferencesButton.innerHTML = '<i class="fa fa-cog" aria-hidden="true"></i>';
                wrapper.append(openPreferencesButton);
                formElement.append(wrapper);

                // Setup ace editor.
                setupAceEditor(textarea, '170px');
            });
        },

        // Setup editor in answer form.
        setupQuestionEditor: async function(textarea, setTextButtons) {
            await loadAce();
            // Setup question editor.
            var aceEditor = setupAceEditor(textarea, '200px', textarea.dataset.templatelang);
            // Set first line number to match compilation messages.
            aceEditor.setOption('firstLineNumber', parseInt(textarea.dataset.lineoffset));
            // Setup reset and correction buttons (if present, ie. not review mode).
            setTextButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    if (aceEditor.getValue() != button.dataset.text) {
                        aceEditor.setValue(button.dataset.text);
                    }
                    event.preventDefault();
                });
                button.classList.remove('invisible');
            });
            return aceEditor;
        },

        setupEditorPreferencesForm: setupEditorPreferencesForm,
    };
});
