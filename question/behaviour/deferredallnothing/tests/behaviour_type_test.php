<?php
// This file is part of Moodle - http://moodle.org/
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

namespace qbehaviour_deferredallnothing;

use question_engine;

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once(__DIR__ . '/../../../engine/lib.php');
require_once(__DIR__ . '/../../../engine/tests/helpers.php');


/**
 * Unit tests for the deferred feedback all or nothing behaviour type class.
 *
 * @package    qbehaviour_deferredallnothing
 * @category   test
 * @copyright  2025 Daniel Thies
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @covers     \qbehaviour_deferredallnothing
 * @group      qbehaviour_deferredallnothing
 */
final class behaviour_type_test extends \qbehaviour_walkthrough_test_base {

    /** @var qbehaviour_deferredallnothing_type */
    protected $behaviourtype;

    public function setUp(): void {
        parent::setUp();
        $this->behaviourtype = question_engine::get_behaviour_type('deferredallnothing');
    }

    public function test_is_archetypal(): void {
        $this->assertTrue($this->behaviourtype->is_archetypal());
    }

    public function test_can_questions_finish_during_the_attempt(): void {
        $this->assertFalse($this->behaviourtype->can_questions_finish_during_the_attempt());
    }

    public function test_get_unused_display_options(): void {
        $this->assertEquals(['correctness', 'marks', 'specificfeedback', 'generalfeedback', 'rightanswer'],
                $this->behaviourtype->get_unused_display_options());
    }

    public function test_adjust_random_guess_score(): void {
        $this->assertEquals(0, $this->behaviourtype->adjust_random_guess_score(0));
        $this->assertEquals(1, $this->behaviourtype->adjust_random_guess_score(1));
    }
}
