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

/**
 * The gradebook user report
 *
 * @package   gradereport_user
 * @copyright 2007 Moodle Pty Ltd (http://moodle.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once '../../../config.php';
require_once $CFG->libdir.'/gradelib.php';
require_once $CFG->dirroot.'/grade/lib.php';
require_once $CFG->dirroot.'/grade/report/user/lib.php';

$courseid = required_param('id', PARAM_INT);
<<<<<<< HEAD
$userid   = optional_param('userid', null, PARAM_INT);
$userview = optional_param('userview', 0, PARAM_INT);

$PAGE->set_url(new moodle_url('/grade/report/user/index.php', ['id' => $courseid]));
=======
$userid   = optional_param('userid', $USER->id, PARAM_INT);
$userview = optional_param('userview', 0, PARAM_INT);

$PAGE->set_url(new moodle_url('/grade/report/user/index.php', array('id'=>$courseid)));
>>>>>>> forked/LAE_400_PACKAGE

if ($userview == 0) {
    $userview = get_user_preferences('gradereport_user_view_user', GRADE_REPORT_USER_VIEW_USER);
} else {
    set_user_preference('gradereport_user_view_user', $userview);
}

<<<<<<< HEAD
// Basic access checks.
if (!$course = $DB->get_record('course', ['id' => $courseid])) {
    throw new \moodle_exception('invalidcourseid');
=======
/// basic access checks
if (!$course = $DB->get_record('course', array('id' => $courseid))) {
    print_error('invalidcourseid');
>>>>>>> forked/LAE_400_PACKAGE
}
require_login($course);
$PAGE->set_pagelayout('report');

$context = context_course::instance($course->id);
require_capability('gradereport/user:view', $context);

<<<<<<< HEAD
if ($userid === 0) {
    require_capability('moodle/grade:viewall', $context);
} else if ($userid) {
    if (!$DB->get_record('user', ['id' => $userid, 'deleted' => 0]) || isguestuser($userid)) {
        throw new \moodle_exception('invaliduser');
=======
if (empty($userid)) {
    require_capability('moodle/grade:viewall', $context);

} else {
    if (!$DB->get_record('user', array('id'=>$userid, 'deleted'=>0)) or isguestuser($userid)) {
        print_error('invaliduser');
>>>>>>> forked/LAE_400_PACKAGE
    }
}

$access = false;
if (has_capability('moodle/grade:viewall', $context)) {
<<<<<<< HEAD
    // User can view all course grades.
    $access = true;
} else if (($userid == $USER->id || is_null($userid)) && has_capability('moodle/grade:view', $context) && $course->showgrades) {
    // User can view own grades.
    $access = true;
} else if (has_capability('moodle/grade:viewall', context_user::instance($userid)) && $course->showgrades) {
    // User can view grades of this user, The user is an parent most probably.
=======
    //ok - can view all course grades
    $access = true;

} else if ($userid == $USER->id and has_capability('moodle/grade:view', $context) and $course->showgrades) {
    //ok - can view own grades
    $access = true;

} else if (has_capability('moodle/grade:viewall', context_user::instance($userid)) and $course->showgrades) {
    // ok - can view grades of this user- parent most probably
>>>>>>> forked/LAE_400_PACKAGE
    $access = true;
}

if (!$access) {
<<<<<<< HEAD
    // The user has no access to grades.
    throw new \moodle_exception('nopermissiontoviewgrades', 'error',  $CFG->wwwroot.'/course/view.php?id='.$courseid);
}

// Initialise the grade tracking object.
$gpr = new grade_plugin_return(['type' => 'report', 'plugin' => 'user', 'courseid' => $courseid, 'userid' => $userid]);

// Infer the users previously selected report via session tracking.
if (!isset($USER->grade_last_report)) {
    $USER->grade_last_report = [];
=======
    // no access to grades!
    print_error('nopermissiontoviewgrades', 'error',  $CFG->wwwroot.'/course/view.php?id='.$courseid);
}

/// return tracking object
$gpr = new grade_plugin_return(array('type'=>'report', 'plugin'=>'user', 'courseid'=>$courseid, 'userid'=>$userid));

/// last selected report session tracking
if (!isset($USER->grade_last_report)) {
    $USER->grade_last_report = array();
>>>>>>> forked/LAE_400_PACKAGE
}
$USER->grade_last_report[$course->id] = 'user';

// First make sure we have proper final grades.
grade_regrade_final_grades_if_required($course);

<<<<<<< HEAD
$gradesrenderer = $PAGE->get_renderer('core_grades');

// Teachers will see all student reports.
if (has_capability('moodle/grade:viewall', $context)) {
    // Verify if we are using groups or not.
    $groupmode = groups_get_course_groupmode($course);
    $currentgroup = $gpr->groupid;

    // To make some other functions work better later.
    if (!$currentgroup) {
        $currentgroup = null;
    }

    $isseparategroups = ($course->groupmode == SEPARATEGROUPS && !has_capability('moodle/site:accessallgroups', $context));

    if ($isseparategroups && (!$currentgroup)) {
        // No separate group access, The user can view only themselves.
        $userid = $USER->id;
=======
if (has_capability('moodle/grade:viewall', $context)) { //Teachers will see all student reports
    $groupmode    = groups_get_course_groupmode($course);   // Groups are being used
    $currentgroup = $gpr->groupid;

    if (!$currentgroup) {      // To make some other functions work better later
        $currentgroup = NULL;
    }

    $isseparategroups = ($course->groupmode == SEPARATEGROUPS and !has_capability('moodle/site:accessallgroups', $context));

    if ($isseparategroups and (!$currentgroup)) {
        // no separate group access, can view only self
        $userid = $USER->id;
        $user_selector = false;
    } else {
        $user_selector = true;
>>>>>>> forked/LAE_400_PACKAGE
    }

    $defaultgradeshowactiveenrol = !empty($CFG->grade_report_showonlyactiveenrol);
    $showonlyactiveenrol = get_user_preferences('grade_report_showonlyactiveenrol', $defaultgradeshowactiveenrol);
    $showonlyactiveenrol = $showonlyactiveenrol || !has_capability('moodle/course:viewsuspendedusers', $context);

<<<<<<< HEAD
=======
    $renderer = $PAGE->get_renderer('gradereport_user');

>>>>>>> forked/LAE_400_PACKAGE
    if ($userview == GRADE_REPORT_USER_VIEW_USER) {
        $viewasuser = true;
    } else {
        $viewasuser = false;
    }

<<<<<<< HEAD
    $gui = new graded_users_iterator($course, null, $currentgroup);
    $gui->require_active_enrolment($showonlyactiveenrol);
    $gui->init();

    if (is_null($userid)) { // Zero state.
        $report = new gradereport_user\report\user($courseid, $gpr, $context, $USER->id, $viewasuser);

        if (isset($report)) {
            // Trigger report viewed event.
            $report->viewed();
        }

        $actionbar = new \gradereport_user\output\action_bar($context, $userview, null, $currentgroup);
        // Print header.
        print_grade_page_head($courseid, 'report', 'user', ' ', false, null, true,
            null, null, null, $actionbar);

        echo $report->output_report_zerostate();
    } else if ($userid == 0) { // Show all reports.
        $actionbar = new \gradereport_user\output\action_bar($context, $userview, 0, $currentgroup);
        print_grade_page_head($courseid, 'report', 'user', ' ', false, null, true,
            null, null, null, $actionbar);

        while ($userdata = $gui->next_user()) {
            $user = $userdata->user;
            $report = new gradereport_user\report\user($courseid, $gpr, $context, $user->id, $viewasuser);
            $userheading = $gradesrenderer->user_heading($report->user, $courseid, false);

            echo $OUTPUT->heading($userheading);

            if ($report->fill_table()) {
                echo $report->print_table(true);
            }
        }
        $gui->close();
    } else { // Show one user's report.
        $report = new gradereport_user\report\user($courseid, $gpr, $context, $userid, $viewasuser);
        $actionbar = new \gradereport_user\output\action_bar($context, $userview, $report->user->id, $currentgroup);

        print_grade_page_head($courseid, 'report', 'user',
            $gradesrenderer->user_heading($report->user, $courseid),
            false, false, true, null, null, null, $actionbar);

        if ($currentgroup && !groups_is_member($currentgroup, $userid)) {
            echo $OUTPUT->notification(get_string('groupusernotmember', 'error'));
        } else {
            if ($report->fill_table()) {
                echo $report->print_table(true);
            }
        }
        $userreportrenderer = $PAGE->get_renderer('gradereport_user');
        // Add previous/next user navigation.
        echo $userreportrenderer->user_navigation($gui, $userid, $courseid);
    }
} else {
    // Students will see just their own report.
    // Create a report instance.
    $report = new gradereport_user\report\user($courseid, $gpr, $context, $userid ?? $USER->id);
    $userheading = $gradesrenderer->user_heading($report->user, $courseid, false);

    // Print the page.
    print_grade_page_head($courseid, 'report', 'user', ' ');

    echo $OUTPUT->heading($userheading);

    if ($report->fill_table()) {
        echo $report->print_table(true);
=======
    if (empty($userid)) {
        $gui = new graded_users_iterator($course, null, $currentgroup);
        $gui->require_active_enrolment($showonlyactiveenrol);
        $gui->init();
        // Add tabs
        print_grade_page_head($courseid, 'report', 'user');
        groups_print_course_menu($course, $gpr->get_return_url('index.php?id='.$courseid, array('userid'=>0)));

        if ($user_selector) {
            echo $renderer->graded_users_selector('user', $course, $userid, $currentgroup, true);
        }

        echo $renderer->view_user_selector($userid, $userview);

        while ($userdata = $gui->next_user()) {
            $user = $userdata->user;
            $report = new grade_report_user($courseid, $gpr, $context, $user->id, $viewasuser);

            $studentnamelink = html_writer::link(new moodle_url('/user/view.php', array('id' => $report->user->id, 'course' => $courseid)), fullname($report->user));
            echo $OUTPUT->heading($studentnamelink);

            if ($report->fill_table()) {
                echo '<br />'.$report->print_table(true);
            }
            echo "<p style = 'page-break-after: always;'></p>";
        }
        $gui->close();
    } else { // Only show one user's report
        $report = new grade_report_user($courseid, $gpr, $context, $userid, $viewasuser);

        $studentnamelink = html_writer::link(new moodle_url('/user/view.php', array('id' => $report->user->id, 'course' => $courseid)), fullname($report->user));
        print_grade_page_head($courseid, 'report', 'user', get_string('pluginname', 'gradereport_user') . ' - ' . $studentnamelink,
                false, false, true, null, null, $report->user);

        groups_print_course_menu($course, $gpr->get_return_url('index.php?id='.$courseid, array('userid'=>0)));

        if ($user_selector) {
            $showallusersoptions = true;
            echo $renderer->graded_users_selector('user', $course, $userid, $currentgroup, $showallusersoptions);
        }

        echo $renderer->view_user_selector($userid, $userview);

        if ($currentgroup and !groups_is_member($currentgroup, $userid)) {
            echo $OUTPUT->notification(get_string('groupusernotmember', 'error'));
        } else {
            if ($report->fill_table()) {
                echo '<br />'.$report->print_table(true);
            }
        }
    }
} else { //Students will see just their own report

    // Create a report instance
    $report = new grade_report_user($courseid, $gpr, $context, $userid);

    // print the page
    print_grade_page_head($courseid, 'report', 'user', get_string('pluginname', 'gradereport_user'). ' - '.fullname($report->user));

    if ($report->fill_table()) {
        echo '<br />'.$report->print_table(true);
>>>>>>> forked/LAE_400_PACKAGE
    }
}

if (isset($report)) {
    // Trigger report viewed event.
    $report->viewed();
} else {
<<<<<<< HEAD
    echo html_writer::tag('div', '', ['class' => 'clearfix']);
=======
    echo html_writer::tag('div', '', array('class' => 'clearfix'));
>>>>>>> forked/LAE_400_PACKAGE
    echo $OUTPUT->notification(get_string('nostudentsyet'));
}

echo $OUTPUT->footer();
