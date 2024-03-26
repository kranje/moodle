<?php

namespace Sabberworm\CSS\Parsing;

/**
<<<<<<< HEAD
 * Thrown if the CSS parser attempts to print something invalid.
 */
class OutputException extends SourceException
{
    /**
     * @param string $sMessage
     * @param int $iLineNo
     */
    public function __construct($sMessage, $iLineNo = 0)
    {
        parent::__construct($sMessage, $iLineNo);
    }
}
=======
* Thrown if the CSS parsers attempts to print something invalid
*/
class OutputException extends SourceException {
	public function __construct($sMessage, $iLineNo = 0) {
		parent::__construct($sMessage, $iLineNo);
	}
}
>>>>>>> forked/LAE_400_PACKAGE
