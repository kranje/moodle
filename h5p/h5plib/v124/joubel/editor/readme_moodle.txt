H5P Editor PHP Library
----------------------

Downloaded last release from: https://github.com/h5p/h5p-editor-php-library/releases

Import procedure:
<<<<<<< HEAD
 * Remove the content in this folder (but the readme_moodle.txt)
 * Copy all the files from the folder repository in this directory.
=======

- Copy all the files from the folder repository in this directory.
- In the method ns.LibrarySelector.prototype.appendTo (scripts/h5peditor-library-selector.js),
  comment the line "this.$selector.appendTo($element);" to avoid the display of the Hub Selector.
- Review strings in joubel/editor/language/en.js and compare them with
existing ones in lang/en/h5plib_vXXX.php: add the new ones and remove the
unexisting ones. Remember to use the AMOS script commands, such CPY, to copy
all the existing strings from the previous version. As you'll see, all the
strings in en.js have been converted following these rules:
  * Prefix  "editor:" has been added.
  * Keys have been lowercased.
- Add namespace to this library to avoid collision. It means:
  * Add the "namespace Moodle;" line at the top of all the h5peditor*.php files in the root folder.
  * Replace \H5Pxxx uses to H5Pxxx (for instance, in h5peditor-ajax.class.php there are several references to \H5PCore that
must be replaced with H5PCore).
  * Add "use stdClass;" in h5peditor.class.php and h5peditor-file.class.php (check that it's still used before replacing it when upgrading the library).


>>>>>>> forked/LAE_400_PACKAGE

Removed:
 * composer.json
 * .gitignore
<<<<<<< HEAD
 * ckeditor/skins/bootstrapck/sample

Changed:
 * In the method ns.LibrarySelector.prototype.appendTo (scripts/h5peditor-library-selector.js),
   comment the line "this.$selector.appendTo($element);" to avoid the display of the Hub Selector.
 * Review strings in joubel/editor/language/en.js and compare them with
   existing ones in lang/en/h5plib_vXXX.php: add the new ones and remove the
   unexisting ones. Remember to use the AMOS script commands, such CPY, to copy
   all the existing strings from the previous version. As you'll see, all the
   strings in en.js have been converted following these rules:
     - Prefix  "editor:" has been added.
     - Keys have been lowercased.
   Attention: When upgrading to 1.22.4, most of the new strings haven't been added to the lang file
   because they are related to the H5P Hub which is not currently supported by Moodle.
 * Add namespace to this library to avoid collision. It means:
     - Add the "namespace Moodle;" line at the top of all the h5peditor*.php files in the root folder.
     - Replace \H5Pxxx uses to H5Pxxx (for instance, in h5peditor-ajax.class.php there are several references to \H5PCore that
       must be replaced with H5PCore).
 * Add "use stdClass;" in h5peditor.class.php and h5peditor-file.class.php (check that it's still used before replacing it when
   upgrading the library).
 * Edit language/en.js and remove the content for 'filters' (it's a JSON with several fields, such as level or language).
 * If https://github.com/h5p/h5p-editor-php-library/pull/148 hasn't been merged, a patch needs to be added in
 h5p/h5plib/v124/joubel/editor/h5peditor-file.class.php, to replace FILTER_SANITIZE_STRING to FILTER_SANITIZE_FULL_SPECIAL_CHARS.
=======

Added:
 * readme_moodle.txt

Changed:
 * Updated H5peditor::getLibraryData parameters to fix PHP8.0 warnings. See MDL-70903 for details.
 * Make get_magic_quotes_gpc() use conditional, it has been removed in php80. See MDL-73502 for details.
 * Updated CKEditor to 4.17.1 from https://github.com/h5p/h5p-editor-php-library/commit/1ae19fdb80839b32dad3846d6b0a5c745f8f6187. It has been applied the commit on h5p-editor-php-library where CKEditor is updated to 4.17.1. Once, this library will be upgraded to the latest version, this changed should be removed.

Downloaded version: moodle-1.20.2 release
>>>>>>> forked/LAE_400_PACKAGE
