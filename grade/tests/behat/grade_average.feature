<<<<<<< HEAD
@core @core_grades @javascript
Feature: Average grades are displayed in the gradebook
  In order to check the expected results are displayed
  As an admin
  I need to assign grades and check that they display correctly in the gradebook.
=======
@core @core_grades
Feature: Average grades are displayed in the gradebook
    In order to check the expected results are displayed
    As an admin
    I need to assign grades and check that they display correctly in the gradebook.
>>>>>>> forked/LAE_400_PACKAGE

  Background:
    Given the following "courses" exist:
      | fullname | shortname | format |
<<<<<<< HEAD
      | Course 1 | C1 | topics |
    And the following "users" exist:
      | username | firstname | lastname | email |
      | teacher1 | Teacher | 1 | teacher1@example.com |
      | student1 | Student | 1 | student1@example.com |
      | student2 | Student | 2 | student2@example.com |
      | student3 | Student | 3 | student3@example.com |
    And the following "course enrolments" exist:
      | user | course | role |
      | teacher1 | C1 | editingteacher |
      | student1 | C1 | student |
      | student2 | C1 | student |
      | student3 | C1 | student |
    And I log in as "admin"
    And I am on "Course 1" course homepage
    # Enable averages
    And I navigate to "Setup > Course grade settings" in the course gradebook
    And I set the following fields to these values:
      | Show average | Show |
    And I press "Save changes"
    # Add a manual grade item
    And I navigate to "Setup > Gradebook setup" in the course gradebook
    And I press "Add grade item"
    And I set the following fields to these values:
      | Item name | Manual item 1 |
    And I press "Save changes"
    # Give all student the same grade for the manual grade item
    And I navigate to "View > Grader report" in the course gradebook
    And I turn editing mode on
    And I give the grade "50.00" to the user "Student 1" for the grade item "Manual item 1"
    And I give the grade "50.00" to the user "Student 2" for the grade item "Manual item 1"
    And I give the grade "50.00" to the user "Student 3" for the grade item "Manual item 1"
    And I press "Save changes"
    And I turn editing mode off
    # Suspend a user
    And I am on the "Course 1" "enrolled users" page
    And I click on "Edit enrolment" "link" in the "Student 2" "table_row"
    And I set the following fields to these values:
      | Status | Suspended |
    And I press "Save changes"

  Scenario: Grade a grade item and ensure the results display correctly in the gradebook
    # Check the admin grade table
    And I navigate to "View > Grader report" in the course gradebook
    Then I should see "50.00" in the ".avg.r0.lastrow .c1" "css_element"
    Then I should see "50.00" in the ".avg.r0.lastrow .c2" "css_element"
    And I log out

    # Check the user grade table
    And I log in as "student1"
    And I am on "Course 1" course homepage
    And I navigate to "User report" in the course gradebook
    Then I should see "50.00" in the ".level2.column-grade" "css_element"
    Then I should see "50.00" in the ".level2.column-average" "css_element"
    And I log out
=======
      | Course 1 | C1        | topics |
    And the following "users" exist:
      | username | firstname | lastname | email                |
      | teacher1 | Teacher   | 1        | teacher1@example.com |
      | student1 | Student   | 1        | student1@example.com |
      | student2 | Student   | 2        | student2@example.com |
      | student3 | Student   | 3        | student3@example.com |
    And the following "course enrolments" exist:
      | user     | course | role           |
      | teacher1 | C1     | editingteacher |
      | student1 | C1     | student        |
      | student2 | C1     | student        |
      | student3 | C1     | student        |
    And the following "grade item" exists:
      | course   | C1            |
      | itemname | Manual item 1 |
    And the following "grade grades" exist:
      | gradeitem     | user     | grade |
      | Manual item 1 | student1 | 50.00 |
      | Manual item 1 | student2 | 50.00 |
      | Manual item 1 | student3 | 50.00 |
    And the following "course enrolments" exist:
      | user     | course | role    | status    |
      | student2 | C1     | student | suspended |

    # Enable averages
    And I am on the "Course 1" "grades > course grade settings" page logged in as "admin"
    And I set the following fields to these values:
      | Show average | Show |
    And I press "Save changes"

  Scenario: Grade a grade item and ensure the results display correctly in the gradebook
    # Check the admin grade table
    Given I am on the "Course 1" "grades > Grader report > View" page logged in as "admin"
    Then I should see "50.00" in the ".avg.r0.lastrow .c1" "css_element"
    Then I should see "50.00" in the ".avg.r0.lastrow .c2" "css_element"

    # Check the user grade table
    When I am on the "Course 1" "grades > user > View" page logged in as "student1"
    Then I should see "50.00" in the ".level2.column-grade" "css_element"
    Then I should see "50.00" in the ".level2.column-average" "css_element"
>>>>>>> forked/LAE_400_PACKAGE
