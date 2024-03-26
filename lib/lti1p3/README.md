# LTI 1.3 Tool Library

A library used for building IMS-certified LTI 1.3 tool providers in PHP.

This library is a fork of the [packbackbooks/lti-1-3-php-library](https://github.com/packbackbooks/lti-1-3-php-library), patched specifically for use in [Moodle](https://github.com/moodle/moodle).

<<<<<<< HEAD
It is currently based on version [5.2.1 of the packbackbooks/lti-1-3-php-library](https://github.com/packbackbooks/lti-1-3-php-library/releases/tag/v5.2.1) library.
=======
It is currently based on version [5.1.0 of the packbackbooks/lti-1-3-php-library](https://github.com/packbackbooks/lti-1-3-php-library/releases/tag/v5.1.0) library.
>>>>>>> forked/LAE_400_PACKAGE

The following changes are included so that the library may be used with Moodle:

  * Replace the phpseclib dependency with openssl equivalent call in public key generation code.
  * Replace the Guzzle dependency with generic HTTP client interfaces for client, response, exception.
  * Small fix to http_build_query() calls, which now explicitly include the '&' arg separator param, for compatibility with applications that override PHP's arg_separator.output value via an ini_set() call, like Moodle does.
<<<<<<< HEAD
=======
  * Upgrade the firebase/php-jwt requirement from ^5.2 to ^6.0, to match Moodle's shipped version of the lib. This change can be dropped when [this upstream issue](https://github.com/packbackbooks/lti-1-3-php-library/pull/46) is merged.
>>>>>>> forked/LAE_400_PACKAGE

Please see the original [README](https://github.com/packbackbooks/lti-1-3-php-library/blob/master/README.md) for more information about the upstream library.


