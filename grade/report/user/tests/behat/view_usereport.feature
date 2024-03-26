@core @core_grades @gradereport_user
Feature: We can use the user report
  As a user
  I browse to the User report

  Background:
    Given the following "courses" exist:
<<<<<<< HEAD
      | fullname | shortname | category |
      | Course 1 | C1 | 0 |

  @javascript
  Scenario: Verify we can view a user grade report with no users enrolled.
    Given I log in as "admin"
    And I am on "Course 1" course homepage
    And I navigate to "View > User report" in the course gradebook
    And I click on "All users (0)" in the "user" search widget
=======
      | fullname | shortname | category | groupmode |
      | Course 1 | C1        | 0        | 1         |

  Scenario: Verify we can view a user grade report with no users enrolled.
    When I am on the "Course 1" "grades > User report > View" page logged in as "admin"
    And I select "All users (0)" from the "Select all or one user" singleselect
>>>>>>> forked/LAE_400_PACKAGE
    Then I should see "There are no students enrolled in this course."
