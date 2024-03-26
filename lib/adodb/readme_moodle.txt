<<<<<<< HEAD
Description of ADOdb library import into Moodle
=======
Description of ADOdb v5.21.4 library import into Moodle 4.0 and up
>>>>>>> forked/LAE_400_PACKAGE

Source: https://github.com/ADOdb/ADOdb

This library will be probably removed sometime in the future
because it is now used only by enrol and auth db plugins.

Removed:
 * Any invisible file (dot suffixed)
 * composer.json
 * contrib/ (if present)
 * cute_icons_for_site/ (if present)
 * docs/
 * lang/* everything but adodb-en.inc.php (originally because they were not utf-8, now because of not used)
 * nbproject/ (if present)
 * pear/
 * replicate/ (if present)
 * scripts/ (if present)
<<<<<<< HEAD
 * server.php (if present)
=======
 * server.php
>>>>>>> forked/LAE_400_PACKAGE
 * session/
 * tests/ (if present)

Added:
 * index.html - prevent directory browsing on misconfigured servers
 * readme_moodle.txt - this file ;-)
<<<<<<< HEAD
=======

Our changes (to be checked on next update if they are already applied upstream):
 * https://github.com/ADOdb/ADOdb/issues/791
>>>>>>> forked/LAE_400_PACKAGE
