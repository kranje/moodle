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

namespace core\task;

defined('MOODLE_INTERNAL') || die();
require_once(__DIR__ . '/../fixtures/task_fixtures.php');

/**
 * This file contains the unit tests for the task manager.
 *
 * @package   core
 * @category  test
 * @copyright 2019 Brendan Heywood <brendan@catalyst-au.net>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class manager_test extends \advanced_testcase {

<<<<<<< HEAD
    /**
     * Data provider for test_get_candidate_adhoc_tasks.
     *
     * @return array
     */
    public function get_candidate_adhoc_tasks_provider(): array {
        return [
            [
                'concurrencylimit' => 5,
                'limit' => 100,
                'pertasklimits' => [],
                'tasks' => [
                    new adhoc_test_task(time() - 20, null),
                    new adhoc_test_task(time() - 20, null),
                    new adhoc_test_task(time() - 20, null),
                    new adhoc_test_task(time() - 20, null),
                    new adhoc_test_task(time() - 20, null)
                ],
                'expected' => [
                    adhoc_test_task::class,
                    adhoc_test_task::class,
                    adhoc_test_task::class,
                    adhoc_test_task::class,
                    adhoc_test_task::class
                ]
            ],
            [
                'concurrencylimit' => 5,
                'limit' => 100,
                'pertasklimits' => [],
                'tasks' => [
                    new adhoc_test_task(time() - 20, time()),
                    new adhoc_test_task(time() - 20, null),
                    new adhoc_test_task(time() - 20, null),
                    new adhoc_test_task(time() - 20, null),
                    new adhoc_test_task(time() - 20, null)
                ],
                'expected' => [
                    adhoc_test_task::class,
                    adhoc_test_task::class,
                    adhoc_test_task::class,
                    adhoc_test_task::class
                ]
            ],
            [
                'concurrencylimit' => 1,
                'limit' => 100,
                'pertasklimits' => [],
                'tasks' => [
                    new adhoc_test_task(time() - 20, time()),
                    new adhoc_test_task(time() - 20, null),
                    new adhoc_test_task(time() - 20, null),
                    new adhoc_test_task(time() - 20, null),
                    new adhoc_test_task(time() - 20, null)
                ],
                'expected' => []
            ],
            [
                'concurrencylimit' => 2,
                'limit' => 100,
                'pertasklimits' => [],
                'tasks' => [
                    new adhoc_test_task(time() - 20, time()),
                    new adhoc_test_task(time() - 20, time()),
                    new adhoc_test_task(time() - 20, null),
                    new adhoc_test_task(time() - 20, null),
                    new adhoc_test_task(time() - 20, null)
                ],
                'expected' => []
            ],
            [
                'concurrencylimit' => 2,
                'limit' => 100,
                'pertasklimits' => [],
                'tasks' => [
                    new adhoc_test_task(time() - 20, time()),
                    new adhoc_test_task(time() - 20, time()),
                    new adhoc_test2_task(time() - 20, time()),
                    new adhoc_test2_task(time() - 20, time()),
                    new adhoc_test3_task(time() - 20, null)
                ],
                'expected' => [adhoc_test3_task::class]
            ],
            [
                'concurrencylimit' => 2,
                'limit' => 2,
                'pertasklimits' => [],
                'tasks' => [
                    new adhoc_test_task(time() - 20, null),
                    new adhoc_test_task(time() - 20, null),
                    new adhoc_test_task(time() - 20, null),
                    new adhoc_test2_task(time() - 20, null),
                ],
                'expected' => [
                    adhoc_test_task::class,
                    adhoc_test_task::class
                ]
            ],
            [
                'concurrencylimit' => 2,
                'limit' => 2,
                'pertasklimits' => [],
                'tasks' => [
                    new adhoc_test_task(time() - 20, time()),
                    new adhoc_test_task(time() - 20, time()),
                    new adhoc_test_task(time() - 20, null),
                    new adhoc_test2_task(time() - 20, null),
                ],
                'expected' => [
                    adhoc_test2_task::class
                ]
            ],
            [
                'concurrencylimit' => 3,
                'limit' => 100,
                'pertasklimits' => [],
                'tasks' => [
                    new adhoc_test_task(time() - 20, time()),
                    new adhoc_test_task(time() - 20, time()),
                    new adhoc_test_task(time() - 20, null),
                    new adhoc_test2_task(time() - 20, time()),
                    new adhoc_test2_task(time() - 20, time()),
                    new adhoc_test2_task(time() - 20, null),
                    new adhoc_test3_task(time() - 20, time()),
                    new adhoc_test3_task(time() - 20, time()),
                    new adhoc_test3_task(time() - 20, null),
                    new adhoc_test4_task(time() - 20, time()),
                    new adhoc_test4_task(time() - 20, time()),
                    new adhoc_test4_task(time() - 20, null),
                    new adhoc_test5_task(time() - 20, time()),
                    new adhoc_test5_task(time() - 20, time()),
                    new adhoc_test5_task(time() - 20, null),
                ],
                'expected' => [
                    adhoc_test_task::class,
                    adhoc_test2_task::class,
                    adhoc_test3_task::class,
                    adhoc_test4_task::class,
                    adhoc_test5_task::class
                ]
            ],
            [
                'concurrencylimit' => 3,
                'limit' => 100,
                'pertasklimits' => [
                    'adhoc_test_task' => 2,
                    'adhoc_test2_task' => 2,
                    'adhoc_test3_task' => 2,
                    'adhoc_test4_task' => 2,
                    'adhoc_test5_task' => 2
                ],
                'tasks' => [
                    new adhoc_test_task(time() - 20, time()),
                    new adhoc_test_task(time() - 20, time()),
                    new adhoc_test_task(time() - 20, null),
                    new adhoc_test2_task(time() - 20, time()),
                    new adhoc_test2_task(time() - 20, time()),
                    new adhoc_test2_task(time() - 20, null),
                    new adhoc_test3_task(time() - 20, time()),
                    new adhoc_test3_task(time() - 20, time()),
                    new adhoc_test3_task(time() - 20, null),
                    new adhoc_test4_task(time() - 20, time()),
                    new adhoc_test4_task(time() - 20, time()),
                    new adhoc_test4_task(time() - 20, null),
                    new adhoc_test5_task(time() - 20, time()),
                    new adhoc_test5_task(time() - 20, time()),
                    new adhoc_test5_task(time() - 20, null),
                ],
                'expected' => []
            ]
=======
    public function ensure_adhoc_task_qos_provider() {
        return [
            [
                [],
                [],
            ],
            // A queue with a lopside initial load that needs to be staggered.
            [
                [
                    (object)['id' => 1, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 2, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 3, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 4, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 5, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 6, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 7, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 8, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 9, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 10, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 11, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 12, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 13, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 14, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 15, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                ],
                [
                    (object)['id' => 1, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 7, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 2, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 8, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 3, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 9, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 4, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 10, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 5, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 6, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 11, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 12, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 13, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 14, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 15, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                ],
            ],
            // The same lopsided queue but now the first item is gone.
            [
                [
                    (object)['id' => 2, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 3, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 4, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 5, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 6, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 7, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 8, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 9, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                ],
                [
                    (object)['id' => 7, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 2, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 8, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 3, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 9, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 4, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 5, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 6, 'classname' => '\core\task\asynchronous_backup_task'],
                ],
            ],
            // The same lopsided queue but now the first two items is gone.
            [
                [
                    (object)['id' => 3, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 4, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 5, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 6, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 7, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 8, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 9, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                ],
                [
                    (object)['id' => 3, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 7, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 4, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 8, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 5, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 9, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 6, 'classname' => '\core\task\asynchronous_backup_task'],
                ],
            ],
            // The same lopsided queue but now the first three items are gone.
            [
                [
                    (object)['id' => 4, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 5, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 6, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 7, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 8, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 9, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                ],
                [
                    (object)['id' => 7, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 4, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 8, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 5, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 9, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 6, 'classname' => '\core\task\asynchronous_backup_task'],
                ],
            ],
            [
                [
                    (object)['id' => 5, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 6, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 7, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 8, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                    (object)['id' => 9, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                ],
                [
                    (object)['id' => 5, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 7, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],

                    (object)['id' => 6, 'classname' => '\core\task\asynchronous_backup_task'],
                    (object)['id' => 8, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],

                    (object)['id' => 9, 'classname' => '\tool_dataprivacy\task\process_data_request_task'],
                ],
            ],
>>>>>>> forked/LAE_400_PACKAGE
        ];
    }

    /**
<<<<<<< HEAD
     * Test that the candidate adhoc tasks are returned in the right order.
     *
     * @dataProvider get_candidate_adhoc_tasks_provider
     *
     * @param int $concurrencylimit The max number of runners each task can consume
     * @param int $limit SQL limit
     * @param array $pertasklimits Per-task limits
     * @param array $tasks Array of tasks to put in DB and retrieve
     * @param array $expected Array of expected classnames
     * @return void
     * @covers \manager::get_candidate_adhoc_tasks
     */
    public function test_get_candidate_adhoc_tasks(
        int $concurrencylimit,
        int $limit,
        array $pertasklimits,
        array $tasks,
        array $expected
    ): void {
        $this->resetAfterTest();

        foreach ($tasks as $task) {
            manager::queue_adhoc_task($task);
        }

        $candidates = manager::get_candidate_adhoc_tasks(time(), $limit, $concurrencylimit, $pertasklimits);
        $this->assertEquals(
            array_map(
                function(string $classname): string {
                    return '\\' . $classname;
                },
                $expected
            ),
            array_column($candidates, 'classname')
        );
    }
=======
     * Reduces a list of tasks into a simpler string
     *
     * @param array $input array of tasks
     * @return string list of task ids
     */
    function flatten($tasks) {
        $list = '';
        foreach ($tasks as $id => $task) {
            $list .= ' ' . $task->id;
        }
        return $list;
    }

    /**
     * Test that the Quality of Service reordering works.
     *
     * @dataProvider ensure_adhoc_task_qos_provider
     *
     * @param array $input array of tasks
     * @param array $expected array of reordered tasks
     * @return void
     */
    public function test_ensure_adhoc_task_qos(array $input, array $expected) {
        $this->resetAfterTest();
        $result = \core\task\manager::ensure_adhoc_task_qos($input);


        $result = $this->flatten($result);
        $expected = $this->flatten($expected);

        $this->assertEquals($expected, $result);
    }

>>>>>>> forked/LAE_400_PACKAGE
}
