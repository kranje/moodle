<?php

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

<<<<<<< HEAD
    $settings->add(new admin_setting_configcheckbox(
        'filter_multilang_force_old',
        get_string('forceoldsyntax', 'filter_multilang'),
        get_string('forceoldsyntax_desc', 'filter_multilang'),
        0
    ));
=======
    $settings->add(new admin_setting_configcheckbox('filter_multilang_force_old', 'filter_multilang_force_old',
                       get_string('multilangforceold', 'admin'), 0));
>>>>>>> forked/LAE_400_PACKAGE
}
