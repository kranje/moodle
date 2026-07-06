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
 * Strings for component 'qbehaviour_deferredcbm', language 'en_us', version '5.1'.
 *
 * @package     qbehaviour_deferredcbm
 * @category    string
 * @copyright   1999 Martin Dougiamas and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['cbmgrades_help'] = 'With Certainty Based Marking (CBM) getting every question correct with C=1 (low certainty) gives a grade of 100%. Grades may be as high as 300% if every question is correct with C=3 (high certainty). Misconceptions (confident wrong responses) lower grades much more than wrong responses that are acknowledged to be uncertain. This may even lead to negative overall grades.

**Accuracy** is the % correct ignoring certainty but weighted for the maximum point of each question. Successfully distinguishing more and less reliable responses gives a better grade than selecting the same certainty for each question. This is reflected in the **CBM Bonus**. **Accuracy** + **CBM Bonus** is a better measure of knowledge than **Accuracy**. Misconceptions can lead to a negative bonus, a warning to look carefully at what is and is not known.';
$string['privacy:metadata'] = 'The Deferred feedback with CBM question behavior plugin does not store any personal data.';
