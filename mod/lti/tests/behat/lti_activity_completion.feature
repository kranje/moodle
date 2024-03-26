<<<<<<< HEAD
@mod @mod_lti @core_completion @javascript
=======
@mod @mod_lti @core_completion
>>>>>>> forked/LAE_400_PACKAGE
Feature: View activity completion information in the LTI activity
  In order to have visibility of LTI completion requirements
  As a student
  I need to be able to view my LTI completion progress

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
    And the following "activities" exist:
      | activity | name          | course | idnumber | completion | completionview | completionusegrade |
      | lti      | Music history | C1     | lti1     | 2          | 1              | 1                  |

  Scenario: View automatic completion items as a teacher
    Given I am on the "Music history" "lti activity" page logged in as teacher1
    Then "Music history" should have the "Receive a grade" completion condition
    And "Music history" should have the "View" completion condition

<<<<<<< HEAD
=======
  @javascript
>>>>>>> forked/LAE_400_PACKAGE
  Scenario: View automatic completion items as a student
    Given I am on the "Music history" "lti activity" page logged in as student1
    And the "View" completion condition of "Music history" is displayed as "done"
    And the "Receive a grade" completion condition of "Music history" is displayed as "todo"
<<<<<<< HEAD
    And I log out
    And I am on the "Course 1" course page logged in as teacher1
    And I navigate to "View > Grader report" in the course gradebook
    And I turn editing mode on
    And I give the grade "90.00" to the user "Vinnie Student1" for the grade item "Music history"
    And I press "Save changes"
    And I log out
=======
    And I am on the "Course 1" "grades > Grader report > View" page logged in as "teacher1"
    And I turn editing mode on
    And I give the grade "90.00" to the user "Vinnie Student1" for the grade item "Music history"
    And I press "Save changes"
>>>>>>> forked/LAE_400_PACKAGE
    When I am on the "Music history" "lti activity" page logged in as student1
    Then the "Receive a grade" completion condition of "Music history" is displayed as "done"
    And the "View" completion condition of "Music history" is displayed as "done"

<<<<<<< HEAD
=======
  @javascript
>>>>>>> forked/LAE_400_PACKAGE
  Scenario: Use manual completion
    Given I am on the "Music history" "lti activity editing" page logged in as teacher1
    And I expand all fieldsets
    And I set the field "Completion tracking" to "Students can manually mark the activity as completed"
<<<<<<< HEAD
    And I press "Save and return to course"
    # Teacher view.
    Given I am on the "Music history" "lti activity" page
    And the manual completion button for "Music history" should be disabled
    And I log out
=======
    And I press "Save and display"
    # Teacher view.
    And the manual completion button for "Music history" should be disabled
>>>>>>> forked/LAE_400_PACKAGE
    # Student view.
    When I am on the "Music history" "lti activity" page logged in as student1
    Then the manual completion button of "Music history" is displayed as "Mark as done"
    And I toggle the manual completion state of "Music history"
    And the manual completion button of "Music history" is displayed as "Done"
