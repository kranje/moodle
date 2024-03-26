<?php

namespace Sabberworm\CSS\Value;

<<<<<<< HEAD
use Sabberworm\CSS\OutputFormat;

class CalcRuleValueList extends RuleValueList
{
    /**
     * @param int $iLineNo
     */
    public function __construct($iLineNo = 0)
    {
        parent::__construct(',', $iLineNo);
    }

    /**
     * @return string
     */
    public function render(OutputFormat $oOutputFormat)
    {
        return $oOutputFormat->implode(' ', $this->aComponents);
    }
=======
class CalcRuleValueList extends RuleValueList {
	public function __construct($iLineNo = 0) {
		parent::__construct(array(), ',', $iLineNo);
	}

	public function render(\Sabberworm\CSS\OutputFormat $oOutputFormat) {
		return $oOutputFormat->implode(' ', $this->aComponents);
	}

>>>>>>> forked/LAE_400_PACKAGE
}
