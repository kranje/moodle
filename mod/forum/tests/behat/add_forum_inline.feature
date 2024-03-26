@mod @mod_forum @javascript
Feature: Add forum activities and discussions utilizing the inline add discussion form

  Background: Add a forum and a discussion attaching files
    Given the following "users" exist:
      | username | firstname | lastname | email                |
      | teacher1 | Teacher   | 1        | teacher1@example.com |
      | student1 | Student   | 1        | student1@example.com |
    And the following "courses" exist:
      | fullname | shortname | category |
      | Course 1 | C1        | 0        |
    And the following "course enrolments" exist:
      | user     | course | role           |
      | teacher1 | C1     | editingteacher |
      | student1 | C1     | student        |
<<<<<<< HEAD
    And I log in as "teacher1"
    And I am on "Course 1" course homepage with editing mode on
    And I add a "Forum" to section "1" and I fill the form with:
      | Forum name  | Test forum name                |
      | Forum type  | Standard forum for general use |
      | Description | Test forum description         |
    And I add a new discussion to "Test forum name" forum with:
      | Subject | Forum post 1     |
      | Message | This is the body |
    And I log out

  Scenario: Student can add a discussion via the inline form
    Given I log in as "student1"
    And I am on "Course 1" course homepage
=======
    And the following "activity" exists:
      | activity    | forum                  |
      | course      | C1                     |
      | idnumber    | 0001                   |
      | name        | Test forum name        |
      | type        | general                |
    And the following "mod_forum > discussion" exists:
      | forum   | 0001             |
      | course  | C1               |
      | user    | teacher1         |
      | name    | Forum post 1     |
      | message | This is the body |

  Scenario: Student can add a discussion via the inline form
    Given I am on the "Course 1" course page logged in as student1
>>>>>>> forked/LAE_400_PACKAGE
    Then I add a new discussion to "Test forum name" forum inline with:
      | Subject | Post with attachment |
      | Message | This is the body     |
