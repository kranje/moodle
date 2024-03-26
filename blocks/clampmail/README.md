<<<<<<< HEAD
# CLAMPMail

![Moodle Plugin CI](https://github.com/CLAMP-IT/moodle-block_clampmail/workflows/Moodle%20Plugin%20CI/badge.svg)

CLAMPMail is a Moodle block that provides selective, bulk emailing within courses. This is a fork of the Quickmail block maintained by the Collaborative Liberal Arts Moodle Project which sends attachments via email instead of providing a download link within Moodle.

## Requirements

- Moodle 4.0 (build 2022041900 or later)
=======
# Quickmail

[![Build Status](https://travis-ci.org/CLAMP-IT/clampmail.svg)](https://travis-ci.org/CLAMP-IT/clampmail)

Quickmail is a Moodle block that provides selective, bulk emailing within courses. CLAMPMail is a fork maintained by the Collaborative Liberal Arts Moodle Project which sends attachments via email instead of providing a download link within Moodle.

## Requirements

- Moodle 3.11 (build 2021051700 or later)
>>>>>>> forked/LAE_400_PACKAGE

## Features

* Multiple attachments
* Drafts
* Signatures
* Filter by Role
* Filter by Groups
* Optionally allow Students to email people within their group.
* Alternate sending email
* Embed images and other content in emails and signatures

### Multiple attachments

<<<<<<< HEAD
CLAMPMail supports multiple attachments by zipping up a Moodle filearea, and
sending it along to `email_to_user`.

1. CLAMPMail assumes that `$CFG->tempdir` is in `$CFG->dataroot`. This
limitation exists because CLAMPMail uses `email_to_user`.
=======
Quickmail supports multiple attachments by zipping up a Moodle filearea, and
sending it along to `email_to_user`.

1. Quickmail assumes that `$CFG->tempdir` is in `$CFG->dataroot`. This
limitation exists because Quickmail uses `email_to_user`.
>>>>>>> forked/LAE_400_PACKAGE
2. Make sure your email service supports zip files, otherwise they will be filtered.

### Alternate emails

Teachers may define alternate emails for sending. These are available course-wide for anyone with the proper role.

## Installation

<<<<<<< HEAD
Visit <https://github.com/CLAMP-IT/moodle-block_clampmail> to either download a package or clone the git repository. Then visit the admin screen to allow the install to complete.

CLAMPMail will add a link to the course administration for accessing the module. While the block is still available for historical reasons it is not necessary for teachers to add the block to their course in order to use CLAMPMail.
=======
Visit <https://github.com/CLAMP-IT/clampmail> to either download a package or clone the git repository. Then visit the admin screen to allow the install to complete.

Quickmail will add a link to the course administration for accessing the module. While the block is still available for historical reasons it is not necessary for teachers to add the block to their course in order to use Quickmail.
>>>>>>> forked/LAE_400_PACKAGE

## Configuration

The site administrator may set the following defaults:

* **Roles to filter by**: which roles appear in the role filter selection box
* **Receive a copy**: whether, by default, a sender should receive a copy of the email
* **Prepend course name**: whether emails should have the course idnumber or shortname prepended to the email subject
* **Default group mode**: which group mode to use by default
* **Maximum attachment size**: the maximum attachment size for a single email

<<<<<<< HEAD
## Acknowledgements

CLAMPMail was forked in 2013 from v1 of the [Quickmail block](https://github.com/lsuits/quickmail) developed at Louisiana State University ITS. The principal authors of that version of the plugin are Robert Russo and Philip Cali.

## License

CLAMPMail adopts the same license that Moodle does.
=======
## License

Quickmail adopts the same license that Moodle does.
>>>>>>> forked/LAE_400_PACKAGE
