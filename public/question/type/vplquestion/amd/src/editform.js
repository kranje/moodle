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
 * Defines the behavior of the editing form for a vplquestion.
 * @copyright  Astor Bizard, 2019
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/* globals ace */
define([
    'core/log',
    'core/modal',
    'core/modal_save_cancel',
    'core/modal_events',
    'core/custom_interaction_events',
    'qtype_vplquestion/vplservice',
    'qtype_vplquestion/codeeditors',
    ], function(log, Modal, ModalSaveCancel, ModalEvents, CustomEvents, VPLService, CodeEditors) {

    var execfilesEditor = null;
    var precheckExecfilesEditor = null;
    var programaticChangeEditor = null;

    var execfilesHiddenField = document.getElementsByName('execfiles')[0];
    var precheckExecfilesHiddenField = document.getElementsByName('precheckexecfiles')[0];

    /**
     * Set editor content to a new content.
     * @param {Editor} aceEditor Ace editor object to reset.
     * @param {String} newContent The new content to put in the editor.
     * @param {Boolean} clearUndoHistory Whether to clear the undo history (hard reset).
     */
    function updateEditorContent(aceEditor, newContent, clearUndoHistory) {
        programaticChangeEditor = aceEditor;
        aceEditor.getSession().getDocument().setValue(newContent); // Call setValue on Document directly to bypass undo reset.
        programaticChangeEditor = null;
        if (clearUndoHistory) {
            aceEditor.getSession().setUndoManager(new ace.UndoManager());
        }
    }

    /**
     * Update display of execution files editors.
     * This does not include file tabs nor content updating. This is only a visibility update on some elements.
     */
    function updateExecfilesVisibility() {
        var selectedVpl = document.getElementById('id_templatevpl').value > '';
        document.querySelectorAll('[data-role="novplmessage"]').forEach(function(message) {
            message.hidden = selectedVpl;
        });
        document.getElementById('execfilesnavigation').hidden = !selectedVpl;
        document.getElementById('fitem_id_execfile').hidden = !selectedVpl;

        var showPrecheckSection = document.getElementById('id_precheckpreference').value == 'diff';
        var showPrecheckEditor = selectedVpl && showPrecheckSection;
        document.getElementById('fitem_id_precheckexecfileslist').hidden = !showPrecheckSection;
        document.getElementById('precheckexecfilesnavigation').hidden = !showPrecheckEditor;
        document.getElementById('fitem_id_precheckexecfile').hidden = !showPrecheckEditor;

        // Refresh previously hidden editor (which otherwise does not display correctly).
        if (document.getElementById('ace_placeholder_precheckexecfile')) {
            ace.edit('ace_placeholder_precheckexecfile').resize();
        }
    }

    /**
     * Apply the current VPL template choice to form elements that depends on it (template content, execution files, ...).
     * @param {Boolean} keepContents Whether editors contents should be kept.
     *  This is typically false on initialization, true otherwise.
     */
    async function applyTemplateChoice(keepContents) {
        var selectedVpl = document.getElementById('id_templatevpl').value;
        document.getElementById('fitem_id_templatecontext').hidden = !selectedVpl;
        updateExecfilesVisibility();
        if (!selectedVpl) {
            // No template VPL selected, no files to fetch.
            return;
        }
        try {
            // Update template content.
            var reqfile = await VPLService.call('info', 'reqfile', selectedVpl);
            // Check that a required file is present. If not, display a warning.
            document.querySelector('[data-role="noreqfile-warning"]').hidden = !!reqfile;
            reqfile = reqfile || {name: 'ERROR.txt', contents: ''}; // Fill reqfile with default value if needed.

            var lang = VPLService.langOfFile(reqfile.name);
            // Apply language change on editors.
            document.querySelectorAll('[data-role="code-editor"]:not([data-manylangs])~.ace-placeholder')
            .forEach(function(placeholder) {
                ace.edit(placeholder).getSession().setMode('ace/mode/' + lang);
            });

            // Store lang in hidden form element.
            document.getElementsByName('templatelang')[0].value = lang;

            if (!keepContents) {
                // Choice changed (it is not initialization):
                // Reinitialize template content to its original (VPL) state.
                updateEditorContent(ace.edit('ace_placeholder_templatecontext'), reqfile.contents, true);
            }
        } catch (error) {
            log.error(error, 'Error retrieving required files info for VPL ' + selectedVpl);
        }

        try {
            // Update execution files.
            var execfiles = await VPLService.call('info', 'execfiles', selectedVpl);
            // Check that pre_vpl_run.sh is present. If not, display a warning.
            var hasprevplrun = execfiles.find((execfile) => execfile.name === 'pre_vpl_run.sh');
            document.querySelector('[data-role="noprevplrun-warning"]').hidden = hasprevplrun;
            // Filter new exec files to exclude standard scripts.
            var standardScripts = ['vpl_run.sh', 'vpl_debug.sh', 'vpl_evaluate.sh', 'pre_vpl_run.sh'];
            execfiles = execfiles.filter((execfile) => !standardScripts.includes(execfile.name));
            updateNewExecfiles(execfiles, keepContents,
                'execfileslist', execfilesEditor, execfilesHiddenField);
            updateNewExecfiles(execfiles, keepContents,
                'precheckexecfileslist', precheckExecfilesEditor, precheckExecfilesHiddenField);
        } catch (error) {
            log.error(error, 'Error retrieving execution files info for VPL ' + selectedVpl);
        }
    }

    /**
     * Generate HTML for a status chip (overwrite or inherit from VPL).
     * @param {String} status Typically either 'overwrite' or 'inherit'
     * @returns {String} HTML fragment.
     */
    function getStatusChipHTML(status) {
        return '<span class="d-inline-block ml-1 status-chip" data-status="' + status + '" aria-hidden="true"></span>';
    }

    /**
     * Setup one editor for execution files (with file tabs). Call this once on loading, then use updateNewExecfiles when changing.
     * @param {String} fileTabsSelector Tabs selector for execution files.
     * @param {Editor} aceEditor Ace editor object.
     * @param {HTMLElement} hiddenField Hidden form field in which files data is stored.
     */
    function setupExecfilesEditor(fileTabsSelector, aceEditor, hiddenField) {
        var fileTabs = document.querySelector(fileTabsSelector);
        fileTabs.parentElement.querySelectorAll('[data-role="scrollerarrow"]').forEach(function(arrow) {
            arrow.addEventListener('click', function() {
                if (arrow.dataset.direction === 'left') {
                    fileTabs.scrollLeft = Math.max(fileTabs.scrollLeft - 42, 0);
                } else {
                    fileTabs.scrollLeft = Math.min(fileTabs.scrollLeft + 42, fileTabs.scrollLeftMax);
                }
            });
        });

        // On form submit, write current editor value to the field that will be saved.
        document.querySelectorAll('input[type=submit]').forEach(function(submitButton) {
            submitButton.addEventListener('click', function() {
                var fileTab = fileTabs.querySelector('.currentfile');
                var status = fileTab.querySelector('.status-chip').dataset.status;
                storeExecfile(fileTab.textContent, status == 'overwrite' ? aceEditor.getValue() : null, hiddenField);
            });
        });

        var filemanagement = fileTabs.parentElement.querySelector('[data-role="filemanagement"]');
        filemanagement.querySelectorAll('input[type=radio]').forEach(function(radio) {
            // Add status chip to radio button for readability.
            radio.closest('label').insertAdjacentHTML('beforeend', getStatusChipHTML(radio.value));
            radio.addEventListener('click', function() {
                // Update status chip on current file.
                fileTabs.querySelector('.currentfile .status-chip').outerHTML = getStatusChipHTML(radio.value);
            });
        });

        // Display a confirmation dialog when user switches back to "Inherit" mode.
        ModalSaveCancel.create({
            title: M.util.get_string('switchbacktodefaultfile', 'qtype_vplquestion'),
            body: '<div class="py-3">' + M.util.get_string('switchbacktodefaultfileprompt', 'qtype_vplquestion') + '</div>',
        })
        .then(function(modal) {
            modal.setSaveButtonText(M.util.get_string('confirm', 'moodle'));

            var isConfirmed;
            modal.getRoot().on(ModalEvents.shown, function() {
                isConfirmed = false;
            });
            modal.getRoot().on(ModalEvents.save, function() {
                isConfirmed = true;
                var fileName = fileTabs.querySelector('.currentfile').textContent;
                updateEditorContent(aceEditor, hiddenField.dataset['default_' + fileName], false);
            });
            modal.getRoot().on(ModalEvents.hidden, function() {
                if (!isConfirmed) {
                    filemanagement.querySelector('input[type=radio][value="overwrite"]').click();
                }
            });

            filemanagement.querySelector('input[type=radio][value="inherit"]').addEventListener('click', function() {
                var fileName = fileTabs.querySelector('.currentfile').textContent;
                if (hiddenField.dataset['default_' + fileName].trim() !== aceEditor.getValue().trim()) {
                    modal.show();
                }
            });

            return modal;
        });
    }

    /**
     * Update execution files and tabs to specified files.
     * @param {Object[]} execfiles Array of execution files.
     * @param {String} execfiles.name File name.
     * @param {?String} execfiles.contents File contents, null means inherit from VPL.
     * @param {Boolean} keepContents Whether current contents should be kept, or overwritten.
     * @param {String} fileTabsID Tabs ID for execution files.
     * @param {Editor} aceEditor Ace editor object.
     * @param {HTMLElement} hiddenField Hidden form field in which files data is stored.
     */
    function updateNewExecfiles(execfiles, keepContents, fileTabsID, aceEditor, hiddenField) {
        // Empty exec files list.
        var fileTabs = document.getElementById(fileTabsID);
        fileTabs.innerHTML = '';

        // Create exec files object to store in hidden form element, and create file tabs.
        var execfilesObj = {};
        var initialContents = hiddenField.value.length > 0 ? JSON.parse(hiddenField.value) : {};
        execfiles.forEach(function(execfile) {
            var content = keepContents ? initialContents[execfile.name] : execfile.contents;
            var status = (keepContents && content !== undefined) ? 'overwrite' : 'inherit';
            var defaultContent = execfile.contents;
            if (VPLService.isBinary(execfile.name)) {
                // Binary files are not editable here.
                status = 'inherit';
                defaultContent = null;
            }
            if (status == 'overwrite') {
                execfilesObj[execfile.name] = content;
            }
            fileTabs.insertAdjacentHTML('beforeend',
                                 '<button type="button" class="btn execfilename"' +
                                    'role="tab" aria-controls="' + aceEditor.container.getAttribute('id') + '">' +
                                     execfile.name + getStatusChipHTML(status) +
                                 '</button>');
            hiddenField.dataset['default_' + execfile.name] = defaultContent;
        });
        hiddenField.value = JSON.stringify(execfilesObj);

        // Setup file tabs navigation.
        fileTabs.querySelectorAll('.execfilename').forEach(function(fileTab) {
            fileTab.addEventListener('click', function() {
                if (!fileTab.classList.contains('currentfile')) {
                    updateExecfile(fileTabs.querySelector('.currentfile'), fileTab, aceEditor, hiddenField);
                }
            });
        });

        aceEditor.on('change', function() {
            if (programaticChangeEditor == aceEditor) {
                // This event is fired by setValue, do not treat it as a user input.
                return;
            }
            // When user types something, change status to "overwrite".
            fileTabs.parentElement.querySelector('[data-role="filemanagement"] input[type=radio][value="overwrite"]').click();
        });

        // Initialize/re-initialize editor.
        updateExecfile(null, fileTabs.querySelector('.execfilename'), aceEditor, hiddenField);
    }

    /**
     * Store a file's content to hidden form element.
     * @param {String} fileName File name.
     * @param {String} fileContent File content.
     * @param {HTMLElement} hiddenField Hidden form field in which files data is stored.
     */
    function storeExecfile(fileName, fileContent, hiddenField) {
        var execfiles = JSON.parse(hiddenField.value);
        if (fileContent === null) {
            delete execfiles[fileName];
        } else {
            execfiles[fileName] = fileContent;
        }
        hiddenField.value = JSON.stringify(execfiles);
    }

    /**
     * Update Ace editor and tabs after user swapped to another file.
     * @param {HTMLElement} prevFile The previously selected tab.
     * @param {HTMLElement} newFile The new tab selected by the user.
     * @param {Editor} aceEditor Ace editor object.
     * @param {HTMLElement} hiddenField Hidden form field in which files data is stored.
     */
    function updateExecfile(prevFile, newFile, aceEditor, hiddenField) {
        if (prevFile !== null) {
            prevFile.classList.remove('currentfile');
            prevFile.removeAttribute('aria-selected');
            var prevStatus = prevFile.querySelector('.status-chip').dataset.status;
            storeExecfile(prevFile.textContent, prevStatus == 'overwrite' ? aceEditor.getValue() : null, hiddenField);
        }
        newFile.classList.add('currentfile');
        newFile.setAttribute('aria-selected', true);
        var fileManagement = newFile.parentElement.parentElement.querySelector('[data-role="filemanagement"]');

        // Update radio selection.
        var newStatus = newFile.querySelector('.status-chip').dataset.status;
        fileManagement.querySelector('input[type=radio][value="' + newStatus + '"]').checked = true;

        var newFileName = newFile.textContent;

        if (VPLService.isBinary(newFileName)) {
            // If binary file, replace editor with blank space (and display "Binary file").
            aceEditor.container.classList.add('invisible');
            var binaryFileLabel = document.createElement('pre');
            binaryFileLabel.classList.add('visible', 'bg-white', 'text-center', 'h-100', 'p-3', 'position-relative');
            binaryFileLabel.style.zIndex = 1;
            binaryFileLabel.dataset.role = 'binaryfile';
            binaryFileLabel.textContent = M.util.get_string('binaryfile', 'mod_vpl');
            aceEditor.container.appendChild(binaryFileLabel);
            fileManagement.querySelector('input[type=radio][value="overwrite"]').setAttribute('disabled', 'disabled');
        } else {
            // Normal file, display editor.
            aceEditor.container.querySelector('[data-role="binaryfile"]')?.remove();
            aceEditor.container.classList.remove('invisible');
            fileManagement.querySelector('input[type=radio][value="overwrite"]').removeAttribute('disabled');

            aceEditor.getSession().setMode('ace/mode/' + VPLService.langOfFile(newFileName));
            var newFileContents = JSON.parse(hiddenField.value)[newFileName];
            if (newFileContents === undefined) {
                newFileContents = hiddenField.dataset['default_' + newFileName];
            }
            updateEditorContent(aceEditor, newFileContents, true);
        }
    }

    /**
     * Setup behaviour for template VPL change, by displaying a dialog with Overwrite/Merge/Cancel options.
     * The dialog will only show up if there is data to merge/overwrite.
     * @param {String} helpButton HTML fragment for help button.
     */
    function setupTemplateChangeManager(helpButton) {
        class TemplateVPLChangeModal extends Modal {
            static TYPE = 'qtype_vplquestion/templatevplchangemodal';
            static TEMPLATE = 'qtype_vplquestion/templatevplchangemodal';
            static buttonsEvents = {
                overwrite: 'templatevplchangemodal:overwrite',
                merge: 'templatevplchangemodal:merge',
                cancel: ModalEvents.cancel,
            };
            registerEventListeners() {
                // Apply parent event listeners.
                Modal.prototype.registerEventListeners.call(this);

                Object.keys(TemplateVPLChangeModal.buttonsEvents).forEach(function(buttonAction) {
                    this.getModal().on(CustomEvents.events.activate, '[data-action="' + buttonAction + '"]', function() {
                        this.getRoot().trigger(TemplateVPLChangeModal.buttonsEvents[buttonAction], this);
                        this.hide();
                    }.bind(this));
                }.bind(this));
            }
        }

        TemplateVPLChangeModal.create()
        .then(function(modal) {
            modal.getBody().find('div').append(helpButton);

            var templateSelect = document.getElementById('id_templatevpl');
            // Save the previous value to manage cancel.
            templateSelect.dataset.current = templateSelect.value;

            modal.getRoot().on(TemplateVPLChangeModal.buttonsEvents.overwrite, function() {
                // Apply the change without merging.
                templateSelect.dataset.current = templateSelect.value;
                applyTemplateChoice(false);
            });

            modal.getRoot().on(TemplateVPLChangeModal.buttonsEvents.merge, function() {
                // Apply the change with merging.
                templateSelect.dataset.current = templateSelect.value;
                applyTemplateChoice(true);
            });

            modal.getRoot().on(ModalEvents.hidden, function() {
                templateSelect.value = templateSelect.dataset.current;
            });

            templateSelect.addEventListener('change', function() {
                if (templateSelect.value && execfilesHiddenField.value != '') {
                    // There is data to merge/overwrite, open a dialog to prompt the user.
                    modal.show();
                } else {
                    // There is nothing to merge/overwrite, simply apply the change.
                    templateSelect.dataset.current = templateSelect.value;
                    applyTemplateChoice(false);
                }
            });

            return modal;
        });
    }

    return {
        setup: async function(templateChangeHelpButton) {
            // Setup all form editors.
            await CodeEditors.setupFormEditors();
            execfilesEditor = ace.edit('ace_placeholder_execfile');
            precheckExecfilesEditor = ace.edit('ace_placeholder_precheckexecfile');
            setupExecfilesEditor('#execfileslist', execfilesEditor, execfilesHiddenField);
            setupExecfilesEditor('#precheckexecfileslist', precheckExecfilesEditor, precheckExecfilesHiddenField);
            // Setup form behavior (VPL template, execution files, etc).
            applyTemplateChoice(true);
            // Manage VPL template change.
            setupTemplateChangeManager(templateChangeHelpButton);
            document.getElementById('id_precheckpreference').addEventListener('change', updateExecfilesVisibility);
            CodeEditors.setupEditorPreferencesForm('[data-role="qvpl_open_editor_preferences"]');
        }
    };
});
