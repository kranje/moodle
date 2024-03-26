<<<<<<< HEAD
Description of PHPMailer 6.6.5 library import into Moodle
=======
Description of PHPMailer 6.5.3 library import into Moodle
>>>>>>> forked/LAE_400_PACKAGE

We now use a vanilla version of phpmailer and do our customisations in a
subclass.

<<<<<<< HEAD
For more information on this version of PHPMailer, check out https://github.com/PHPMailer/PHPMailer/releases/tag/v6.6.5

To upgrade this library:
1. Download the latest release of PHPMailer in https://github.com/PHPMailer/PHPMailer/releases.
2. Remove everything inside lib/phpmailer/ folder except README_MOODLE.txt, moodle_phpmailer.php and moodle_phpmailer_oauth.php.
=======
For more information on this version of PHPMailer, check out https://github.com/PHPMailer/PHPMailer/releases/tag/v6.5.3

To upgrade this library:
1. Download the latest release of PHPMailer in https://github.com/PHPMailer/PHPMailer/releases.
2. Remove everything inside lib/phpmailer/ folder except README_MOODLE.txt and moodle_phpmailer.php.
>>>>>>> forked/LAE_400_PACKAGE
3. Extract the contents of the release archive to lib/phpmailer.
4. Remove the following files that were extracted:
   - composer.json
   - get_oauth_token.php
   - SECURITY.md
<<<<<<< HEAD
=======
   - src/OAuth.php
>>>>>>> forked/LAE_400_PACKAGE
   - src/POP3.php
5. Update lib/thirdpartylibs.xml.
