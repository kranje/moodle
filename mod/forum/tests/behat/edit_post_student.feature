@mod @mod_forum
Feature: Students can edit or delete their forum posts within a set time limit
  In order to refine forum posts
  As a user
  I need to edit or delete my forum posts within a certain period of time after posting

  Background:
    Given the following "users" exist:
      | username | firstname | lastname | email |
      | student1 | Student | 1 | student1@example.com |
    And the following "courses" exist:
      | fullname | shortname | category |
      | Course 1 | C1 | 0 |
    And the following "course enrolments" exist:
      | user | course | role |
      | student1 | C1 | student |
    And the following "activities" exist:
<<<<<<< HEAD
      | activity   | name                   | intro                   | course  | idnumber  |
      | forum      | Test forum name        | Test forum description  | C1      | forum     |
    And I log in as "student1"
    And I am on "Course 1" course homepage
    And I add a new discussion to "Test forum name" forum with:
      | Subject | Forum post subject |
      | Message | This is the body |

  Scenario: Edit forum post
    Given I follow "Forum post subject"
=======
      | activity   | name                   | course  | idnumber  |
      | forum      | Test forum name        | C1      | forum     |

  Scenario: Edit forum post
    Given the following "mod_forum > discussions" exist:
      | user     | forum | name               | message          |
      | student1 | forum | Forum post subject | This is the body |
    And I am on the "Test forum name" "forum activity" page logged in as "student1"
    And I follow "Forum post subject"
>>>>>>> forked/LAE_400_PACKAGE
    And I follow "Edit"
    When I set the following fields to these values:
      | Subject | Edited post subject |
      | Message | Edited post body |
    And I press "Save changes"
    And I wait to be redirected
    Then I should see "Edited post subject"
    And I should see "Edited post body"

  Scenario: Delete forum post
<<<<<<< HEAD
    Given I follow "Forum post subject"
=======
    Given the following "mod_forum > discussions" exist:
      | user     | forum | name               | message          |
      | student1 | forum | Forum post subject | This is the body |
    And I am on the "Test forum name" "forum activity" page logged in as "student1"
    And I follow "Forum post subject"
>>>>>>> forked/LAE_400_PACKAGE
    When I follow "Delete"
    And I press "Continue"
    Then I should not see "Forum post subject"

<<<<<<< HEAD
  @javascript @block_recent_activity
  Scenario: Time limit expires
    Given I log out
    And I log in as "admin"
    And the following config values are set as admin:
      | maxeditingtime | 1 |
    And I am on "Course 1" course homepage with editing mode on
    And I add the "Recent activity" block
    And I log out
    And I log in as "student1"
    And I am on "Course 1" course homepage
=======
  @block_recent_activity
  Scenario: Time limit expires
    Given the following "blocks" exist:
      | blockname       | contextlevel | reference | pagetypepattern | defaultregion |
      | recent_activity | Course       | C1        | course-view-*   | side-pre      |
    And the following config values are set as admin:
      | maxeditingtime | 1 |
    And the following "mod_forum > discussions" exist:
      | user     | forum | name               | message          | timemodified       |
      | student1 | forum | Forum post subject | This is the body | ##now +1 second##  |
    And I am on the "Course 1" course page logged in as student1
>>>>>>> forked/LAE_400_PACKAGE
    And I should see "New forum posts:" in the "Recent activity" "block"
    And I should see "Forum post subject" in the "Recent activity" "block"
    When I wait "2" seconds
    And I follow "Forum post subject"
    Then I should not see "Edit" in the "region-main" "region"
    And I should not see "Delete" in the "region-main" "region"
