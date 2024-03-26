Description of Markdown Extra import into Moodle

Procedure:
<<<<<<< HEAD
* download latest version from https://github.com/michelf/php-markdown/tags
* copy the classes and Readme.md file to lib/markdown/* , Note .inc files need not be copied.
* update function markdown_to_html() in lib/weblib.php if necessary,
  note that we require the php files manually for performance reasons
* run phpunit tests (all PHP versions)

=======
* download latest version from http://michelf.ca/projects/php-markdown/
* copy the classes and readme file to lib/markdown/* , Note .inc files need not be copied.
* update function markdown_to_html() in weblib.php if necessary,
  note that we require the php files manually for performance reasons
* run phpunit tests (all PHP versions)

Petr Skoda

* Removed fixup step in procedure
* Currently using the 1.9.0 release(includes php74 fixup commit)

Peter Dias
>>>>>>> forked/LAE_400_PACKAGE
