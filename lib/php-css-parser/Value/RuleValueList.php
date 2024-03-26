<?php

namespace Sabberworm\CSS\Value;

<<<<<<< HEAD
class RuleValueList extends ValueList
{
    /**
     * @param string $sSeparator
     * @param int $iLineNo
     */
    public function __construct($sSeparator = ',', $iLineNo = 0)
    {
        parent::__construct([], $sSeparator, $iLineNo);
    }
}
=======
class RuleValueList extends ValueList {
	public function __construct($sSeparator = ',', $iLineNo = 0) {
		parent::__construct(array(), $sSeparator, $iLineNo);
	}
}
>>>>>>> forked/LAE_400_PACKAGE
