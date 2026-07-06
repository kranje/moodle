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
 * Module checking the state of an evaluation task and updating the question feedback when it has been evaluated.
 * @copyright  2024 Astor Bizard
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['core/log', 'qtype_vplquestion/repository'], function(log, Repository) {
    /**
     * Check if evaluation is finished and update displayed message.
     * @param {String} divid HTML id of question wrapping div.
     * @param {Number} usageid Question usage ID.
     * @param {Number} slot Question slot.
     * @param {String} url Current url.
     */
    async function updateEvaluationState(divid, usageid, slot, url) {
        try {
            var response = await Repository.checkEvaluationState(usageid, slot, url);

            var qdiv = document.getElementById(divid);

            if (response.finished) {
                var evaluationResults = response.evaluationresults;
                // Update the question feedback.
                qdiv.querySelector('.feedback')?.remove();
                qdiv.querySelector('.im-feedback')?.remove();
                var outcomeDiv = qdiv.querySelector('.outcome');
                outcomeDiv.insertAdjacentHTML('afterbegin', evaluationResults.qfeedback + evaluationResults.bfeedback);
                var scripts = document.createElement('div');
                scripts.innerHTML = evaluationResults.javascript;
                scripts.querySelectorAll('script').forEach(function(script) {
                    // For some reason, appending script directly does not work (it is not executed), but this works.
                    var scriptNode = document.createElement('script');
                    scriptNode.innerHTML = script.innerHTML;
                    qdiv.appendChild(scriptNode);
                });
                if (outcomeDiv.innerHTML === outcomeDiv.querySelector('.accesshide').outerHTML) {
                    // No feedback: remove.
                    outcomeDiv.remove();
                }

                // Update the state and grade in the question info block.
                qdiv.querySelector('.info .state').innerHTML = evaluationResults.state;
                qdiv.querySelector('.info .grade').innerHTML = evaluationResults.grade;

                // Update the navigation button color and title according to question state.
                var navbutton = document.getElementById(evaluationResults.navbutton.id);
                navbutton.setAttribute('title', evaluationResults.navbutton.title);
                navbutton.classList.remove(evaluationResults.navbutton.oldclass);
                navbutton.classList.add(evaluationResults.navbutton.newclass);

                // Add a message in the summary table if there is one, indicating that the overall quiz grade may have changed.
                var reviewSummaryTable = document.querySelector('table.quizreviewsummary');
                var messageRole = 'qtype_vplquestion-reload-page-message';
                if (reviewSummaryTable !== null && reviewSummaryTable.querySelector('[data-role="' + messageRole + '"]') === null) {
                    var message = M.util.get_string('gradehaschangedreload', 'qtype_vplquestion',
                                {aattr: 'href="#" onclick="window.location.reload();return false;"'});
                    var icon = '<i class="icon fa fa-info-circle text-info"></i>';
                    var messageElement = document.createElement('tr');
                    messageElement.dataset.role = messageRole;
                    messageElement.innerHTML = '<th class="cell" scope="row"></th><td class="cell">' + icon + message + '</td>';
                    reviewSummaryTable.querySelector('tbody').appendChild(messageElement);
                }

                // Update step history with new state and new marks.
                qdiv.querySelectorAll('.history thead th').forEach(function(header, i) {
                    if (header.textContent == M.util.get_string('state', 'question')) {
                        qdiv.querySelector('.history tbody tr.current td.c' + i).textContent = evaluationResults.state;
                    } else if (header.textContent == M.util.get_string('marks', 'question')) {
                        qdiv.querySelector('.history tbody tr.current td.c' + i).textContent = evaluationResults.marks;
                    }
                });
            } else {
                qdiv.querySelector('[data-qtype_vplquestion-role="async-eval-info"]').textContent = response.progressmessage;
                setTimeout(function() {
                    // Retry in 2 seconds.
                    updateEvaluationState(divid, usageid, slot, url);
                }, 2000);
            }
        } catch (error) {
            log.error(error);
        }
    }

    return {
        init: updateEvaluationState,
    };
});
