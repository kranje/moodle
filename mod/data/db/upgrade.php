<?php
// This file keeps track of upgrades to
// the data module
//
// Sometimes, changes between versions involve
// alterations to database structures and other
// major things that may break installations.
//
// The upgrade function in this file will attempt
// to perform all the necessary actions to upgrade
// your older installation to the current version.
//
// If there's something it cannot do itself, it
// will tell you what you need to do.
//
// The commands in here will all be database-neutral,
// using the methods of database_manager class
//
// Please do not forget to use upgrade_set_timeout()
// before any action that may take longer time to finish.

defined('MOODLE_INTERNAL') || die();

function xmldb_data_upgrade($oldversion) {
<<<<<<< HEAD
    global $DB;

    $dbman = $DB->get_manager(); // Loads ddl manager and xmldb classes.
=======
    global $CFG, $DB;

    // Automatically generated Moodle v3.6.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.7.0 release upgrade line.
    // Put any upgrade step following this.

    if ($oldversion < 2019052001) {

        $columns = $DB->get_columns('data');

        $oldclass = "mod-data-default-template ##approvalstatus##";
        $newclass = "mod-data-default-template ##approvalstatusclass##";

        // Update existing classes.
        $DB->replace_all_text('data', $columns['singletemplate'], $oldclass, $newclass);
        $DB->replace_all_text('data', $columns['listtemplate'], $oldclass, $newclass);
        $DB->replace_all_text('data', $columns['addtemplate'], $oldclass, $newclass);
        $DB->replace_all_text('data', $columns['rsstemplate'], $oldclass, $newclass);
        $DB->replace_all_text('data', $columns['asearchtemplate'], $oldclass, $newclass);

        // Data savepoint reached.
        upgrade_mod_savepoint(true, 2019052001, 'data');
    }
    // Automatically generated Moodle v3.8.0 release upgrade line.
    // Put any upgrade step following this.
>>>>>>> forked/LAE_400_PACKAGE

    // Automatically generated Moodle v3.9.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v4.0.0 release upgrade line.
    // Put any upgrade step following this.
<<<<<<< HEAD
    if ($oldversion < 2022081600) {
        // Define key userid (foreign) to be added to data_records.
        $table = new xmldb_table('data_records');
        $key = new xmldb_key('userid', XMLDB_KEY_FOREIGN, ['userid'], 'user', ['id']);
        // Launch add key userid.
        $dbman->add_key($table, $key);

        // Data savepoint reached.
        upgrade_mod_savepoint(true, 2022081600, 'data');
    }

    // Automatically generated Moodle v4.1.0 release upgrade line.
    // Put any upgrade step following this.
=======
>>>>>>> forked/LAE_400_PACKAGE

    return true;
}
