<<<<<<< HEAD
@mod @mod_imscp @_file_upload @core_completion @javascript
=======
@mod @mod_imscp @core_completion
>>>>>>> forked/LAE_400_PACKAGE
Feature: View activity completion information in the IMS content package activity
  In order to have visibility of IMS content package completion requirements
  As a student
  I need to be able to view my IMS content package completion progress

  Background:
    Given the following "users" exist:
      | username | firstname | lastname | email                |
      | student1 | Vinnie    | Student1 | student1@example.com |
      | teacher1 | Darrell   | Teacher1 | teacher1@example.com |
    And the following "courses" exist:
      | fullname | shortname | category | enablecompletion | showcompletionconditions |
      | Course 1 | C1        | 0        | 1                | 1                        |
    And the following "course enrolments" exist:
      | user | course | role           |
      | student1 | C1 | student        |
      | teacher1 | C1 | editingteacher |

  Scenario: View automatic completion items
<<<<<<< HEAD
    Given I log in as "teacher1"
    And I am on "Course 1" course homepage with editing mode on
    And I add a "IMS content package" to section "1"
    And I set the following fields to these values:
      | Name                | Music history                                     |
      | Completion tracking | Show activity as complete when conditions are met |
      | Require view        | 1                                                 |
    And I upload "mod/imscp/tests/packages/singlescobasic.zip" file to "Package file" filemanager
    And I click on "Save and display" "button"
    And I am on "Course 1" course homepage
    # Teacher view.
    And I am on the "Music history" "imscp activity" page
    And I log out
=======
    Given the following "activities" exist:
      | activity | course | name          | completion | completionview | packagefilepath                             |
      | imscp    | C1     | Music history | 2          | 1              | mod/imscp/tests/pacakges/singescobbasic.zip |
>>>>>>> forked/LAE_400_PACKAGE
    # Student view.
    When I am on the "Music history" "imscp activity" page logged in as student1
    Then the "View" completion condition of "Music history" is displayed as "done"

<<<<<<< HEAD
  Scenario: Use manual completion
    Given I log in as "teacher1"
    And I am on "Course 1" course homepage with editing mode on
    And I add a "IMS content package" to section "1"
    And I set the following fields to these values:
      | Name                | Music history                                        |
      | Completion tracking | Students can manually mark the activity as completed |
    And I upload "mod/imscp/tests/packages/singlescobasic.zip" file to "Package file" filemanager
    And I click on "Save and display" "button"
    And I am on the "Music history" "imscp activity" page
    # Teacher view.
    And the manual completion button for "Music history" should be disabled
    And I log out
=======
  @javascript
  Scenario: Use manual completion
    Given the following "activities" exist:
      | activity | course | name          | completion | packagefilepath                            |
      | imscp    | C1     | Music history | 1          | mod/imscp/tests/packages/singescobasic.zip |
    And I am on the "Music history" "imscp activity" page logged in as teacher1
    # Teacher view.
    And the manual completion button for "Music history" should be disabled
>>>>>>> forked/LAE_400_PACKAGE
    # Student view.
    When I am on the "Music history" "imscp activity" page logged in as student1
    Then the manual completion button of "Music history" is displayed as "Mark as done"
    And I toggle the manual completion state of "Music history"
    And the manual completion button of "Music history" is displayed as "Done"
