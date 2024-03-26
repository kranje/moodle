@block @block_search_forums @mod_forum
Feature: The search forums block allows users to search for forum posts on course page
  In order to search for a forum post
  As a user
  I can use the search forums block

  Background:
    Given the following "users" exist:
      | username | firstname | lastname | email | idnumber |
      | teacher1 | Teacher | 1 | teacher1@example.com | T1 |
      | student1 | Student | 1 | student1@example.com | S1 |
    And the following "courses" exist:
      | fullname | shortname | category |
      | Course 1 | C1 | 0 |
    And the following "course enrolments" exist:
      | user | course | role |
      | teacher1 | C1 | editingteacher |
      | student1 | C1 | student |
<<<<<<< HEAD
    And I log in as "teacher1"
    And I am on "Course 1" course homepage
    And I navigate to "Settings" in current page administration
    And I set the field "id_newsitems" to "1"
    And I press "Save and display"
    And I turn editing mode on
    And I add the "Latest announcements" block
    And I add the "Search forums" block
    And I log out

  Scenario: Use the search forum block in a course without any forum posts
    Given I log in as "student1"
    And I am on "Course 1" course homepage
=======
    And the following "blocks" exist:
      | blockname     | contextlevel | reference | pagetypepattern | defaultregion |
      | news_items    | Course       | C1        | course-view-*   | side-pre      |
      | search_forums | Course       | C1        | course-view-*   | side-pre      |
    And I am on the "Course 1" "course editing" page logged in as teacher1
    And I set the field "id_newsitems" to "1"
    And I press "Save and display"
    And the following "mod_forum > discussions" exist:
      | user     | forum         | name        | message           |
      | teacher1 | Announcements | My subject  | My message        |

  Scenario: Use the search forum block in a course without any forum posts
    Given I am on the "Course 1" course page logged in as student1
>>>>>>> forked/LAE_400_PACKAGE
    When I set the field "Search" to "Moodle"
    And I press "Search"
    Then I should see "No posts"

  Scenario: Use the search forum block in a course with a hidden forum and search for posts
<<<<<<< HEAD
    Given I log in as "teacher1"
    And I am on "Course 1" course homepage
    And I add a new topic to "Announcements" forum with:
      | Subject | My subject |
      | Message | My message |
    And I am on "Course 1" course homepage with editing mode on
    And I follow "Announcements"
    And I navigate to "Settings" in current page administration
    And I expand all fieldsets
    And I set the field "id_visible" to "0"
    And I press "Save and return to course"
    And I log out
    When I log in as "student1"
    And I am on "Course 1" course homepage
    And "Search forums" "block" should exist
    When I set the field "Search" to "message"
=======
    Given I am on the "Announcements" "forum activity editing" page logged in as teacher1
    And I expand all fieldsets
    And I set the field "id_visible" to "0"
    And I press "Save and return to course"
    When I am on the "Course 1" course page logged in as student1
    And "Search forums" "block" should exist
    And I set the field "Search" to "message"
>>>>>>> forked/LAE_400_PACKAGE
    And I press "Search"
    Then I should see "No posts"

  Scenario: Use the search forum block in a course and search for posts
<<<<<<< HEAD
    Given I log in as "teacher1"
    And I am on "Course 1" course homepage
    And I add a new topic to "Announcements" forum with:
      | Subject | My subject |
      | Message | My message |
    And I log out
    When I log in as "student1"
    And I am on "Course 1" course homepage
    And "Search forums" "block" should exist
    When I set the field "Search" to "message"
=======
    Given I am on the "Course 1" course page logged in as student1
    And "Search forums" "block" should exist
    And I set the field "Search" to "message"
>>>>>>> forked/LAE_400_PACKAGE
    And I press "Search"
    Then I should see "My subject"
