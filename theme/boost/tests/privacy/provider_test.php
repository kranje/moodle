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

<<<<<<< HEAD
namespace theme_boost\privacy;

use context_user;
use core_privacy\local\request\writer;

=======
>>>>>>> forked/LAE_400_PACKAGE
/**
 * Privacy tests for theme_boost.
 *
 * @package    theme_boost
 * @category   test
<<<<<<< HEAD
 * @covers     \theme_boost\privacy\provider
=======
 * @copyright  2018 Adrian Greeve <adriangreeve.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace theme_boost\privacy;

defined('MOODLE_INTERNAL') || die();

use theme_boost\privacy\provider;

/**
 * Unit tests for theme_boost/classes/privacy/policy
 *
>>>>>>> forked/LAE_400_PACKAGE
 * @copyright  2018 Adrian Greeve <adriangreeve.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider_test extends \core_privacy\tests\provider_testcase {

    /**
<<<<<<< HEAD
     * Data provider for {@see test_export_user_preferences}
     *
     * @return array[]
     */
    public function export_user_preference_provider(): array {
        return [
            'Index drawer open' => [provider::DRAWER_OPEN_INDEX, true, 'privacy:drawerindexopen'],
            'Index drawer closed' => [provider::DRAWER_OPEN_INDEX, false, 'privacy:drawerindexclosed'],
            'Block drawer open' => [provider::DRAWER_OPEN_BLOCK, true, 'privacy:drawerblockopen'],
            'Block drawer closed' => [provider::DRAWER_OPEN_BLOCK, false, 'privacy:drawerblockclosed'],
        ];
    }

    /**
     * Test for provider::test_export_user_preferences().
     *
     * @param string $preference
     * @param bool $value
     * @param string $expectdescription
     *
     * @dataProvider export_user_preference_provider
     */
    public function test_export_user_preferences(string $preference, bool $value, string $expectdescription): void {
=======
     * Test for provider::test_export_user_preferences().
     */
    public function test_export_user_preferences() {
>>>>>>> forked/LAE_400_PACKAGE
        $this->resetAfterTest();

        // Test setup.
        $user = $this->getDataGenerator()->create_user();
        $this->setUser($user);

        // Add a user home page preference for the User.
<<<<<<< HEAD
        set_user_preference($preference, $value, $user);

        // Test the user preferences export contains 1 user preference record for the User.
        provider::export_user_preferences($user->id);
        $writer = writer::with_context(context_user::instance($user->id));
=======
        set_user_preference(provider::DRAWER_OPEN_NAV, 'false', $user);

        // Test the user preferences export contains 1 user preference record for the User.
        provider::export_user_preferences($user->id);
        $contextuser = \context_user::instance($user->id);
        $writer = \core_privacy\local\request\writer::with_context($contextuser);
>>>>>>> forked/LAE_400_PACKAGE
        $this->assertTrue($writer->has_any_data());

        $exportedpreferences = $writer->get_user_preferences('theme_boost');
        $this->assertCount(1, (array) $exportedpreferences);
<<<<<<< HEAD
        $this->assertEquals($value, (bool) $exportedpreferences->{$preference}->value);
        $this->assertEquals(get_string($expectdescription, 'theme_boost'), $exportedpreferences->{$preference}->description);
=======
        $this->assertEquals('false', $exportedpreferences->{provider::DRAWER_OPEN_NAV}->value);
        $this->assertEquals(get_string('privacy:drawernavclosed', 'theme_boost'),
                $exportedpreferences->{provider::DRAWER_OPEN_NAV}->description);

        // Add a user home page preference for the User.
        set_user_preference(provider::DRAWER_OPEN_NAV, 'true', $user);

        // Test the user preferences export contains 1 user preference record for the User.
        provider::export_user_preferences($user->id);
        $contextuser = \context_user::instance($user->id);
        $writer = \core_privacy\local\request\writer::with_context($contextuser);
        $this->assertTrue($writer->has_any_data());

        $exportedpreferences = $writer->get_user_preferences('theme_boost');
        $this->assertCount(1, (array) $exportedpreferences);
        $this->assertEquals('true', $exportedpreferences->{provider::DRAWER_OPEN_NAV}->value);
        $this->assertEquals(get_string('privacy:drawernavopen', 'theme_boost'),
                $exportedpreferences->{provider::DRAWER_OPEN_NAV}->description);
>>>>>>> forked/LAE_400_PACKAGE
    }
}
