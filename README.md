Moodle News Forum Creation
==========================

[![Build Status](https://api.travis-ci.org/LafColITS/moodle-local_news_forum.png)](https://api.travis-ci.org/LafColITS/moodle-local_news_forum)

News Forum creates a course announcements forum (the former news forum) on course creation. This eliminates the requirement to have the latest announcements block installed in order to create the forum. This issue is fully described in [MDL-26707](https://tracker.moodle.org/browse/MDL-26707).

Requirements
------------
- Moodle 3.1 (build 2016052300 or later)

Installation
------------
Copy the news_forum folder into your /local directory and visit your Admin Notification page to complete the installation.

Usage
-----
The plugin has no options; once installed it will create the forum automatically on course creation. If you later delete the forum from a course it will **not** be re-created by this plugin.

Author
-----
Charles Fulton (fultonc@lafayette.edu)
