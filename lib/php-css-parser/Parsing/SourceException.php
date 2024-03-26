<?php

namespace Sabberworm\CSS\Parsing;

<<<<<<< HEAD
class SourceException extends \Exception
{
    /**
     * @var int
     */
    private $iLineNo;

    /**
     * @param string $sMessage
     * @param int $iLineNo
     */
    public function __construct($sMessage, $iLineNo = 0)
    {
        $this->iLineNo = $iLineNo;
        if (!empty($iLineNo)) {
            $sMessage .= " [line no: $iLineNo]";
        }
        parent::__construct($sMessage);
    }

    /**
     * @return int
     */
    public function getLineNo()
    {
        return $this->iLineNo;
    }
}
=======
class SourceException extends \Exception {
	private $iLineNo;
	public function __construct($sMessage, $iLineNo = 0) {
		$this->iLineNo = $iLineNo;
		if (!empty($iLineNo)) {
			$sMessage .= " [line no: $iLineNo]";
		}
		parent::__construct($sMessage);
	}

	public function getLineNo() {
		return $this->iLineNo;
	}
}
>>>>>>> forked/LAE_400_PACKAGE
