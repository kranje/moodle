<?php

namespace Sabberworm\CSS\CSSList;

<<<<<<< HEAD
use Sabberworm\CSS\OutputFormat;
use Sabberworm\CSS\Property\AtRule;

/**
 * A `BlockList` constructed by an unknown at-rule. `@media` rules are rendered into `AtRuleBlockList` objects.
 */
class AtRuleBlockList extends CSSBlockList implements AtRule
{
    /**
     * @var string
     */
    private $sType;

    /**
     * @var string
     */
    private $sArgs;

    /**
     * @param string $sType
     * @param string $sArgs
     * @param int $iLineNo
     */
    public function __construct($sType, $sArgs = '', $iLineNo = 0)
    {
        parent::__construct($iLineNo);
        $this->sType = $sType;
        $this->sArgs = $sArgs;
    }

    /**
     * @return string
     */
    public function atRuleName()
    {
        return $this->sType;
    }

    /**
     * @return string
     */
    public function atRuleArgs()
    {
        return $this->sArgs;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render(new OutputFormat());
    }

    /**
     * @return string
     */
    public function render(OutputFormat $oOutputFormat)
    {
        $sArgs = $this->sArgs;
        if ($sArgs) {
            $sArgs = ' ' . $sArgs;
        }
        $sResult = $oOutputFormat->sBeforeAtRuleBlock;
        $sResult .= "@{$this->sType}$sArgs{$oOutputFormat->spaceBeforeOpeningBrace()}{";
        $sResult .= parent::render($oOutputFormat);
        $sResult .= '}';
        $sResult .= $oOutputFormat->sAfterAtRuleBlock;
        return $sResult;
    }

    /**
     * @return bool
     */
    public function isRootList()
    {
        return false;
    }
}
=======
use Sabberworm\CSS\Property\AtRule;

/**
 * A BlockList constructed by an unknown @-rule. @media rules are rendered into AtRuleBlockList objects.
 */
class AtRuleBlockList extends CSSBlockList implements AtRule {

	private $sType;
	private $sArgs;

	public function __construct($sType, $sArgs = '', $iLineNo = 0) {
		parent::__construct($iLineNo);
		$this->sType = $sType;
		$this->sArgs = $sArgs;
	}

	public function atRuleName() {
		return $this->sType;
	}

	public function atRuleArgs() {
		return $this->sArgs;
	}

	public function __toString() {
		return $this->render(new \Sabberworm\CSS\OutputFormat());
	}

	public function render(\Sabberworm\CSS\OutputFormat $oOutputFormat) {
		$sArgs = $this->sArgs;
		if($sArgs) {
			$sArgs = ' ' . $sArgs;
		}
		$sResult  = $oOutputFormat->sBeforeAtRuleBlock;
		$sResult .= "@{$this->sType}$sArgs{$oOutputFormat->spaceBeforeOpeningBrace()}{";
		$sResult .= parent::render($oOutputFormat);
		$sResult .= '}';
		$sResult .= $oOutputFormat->sAfterAtRuleBlock;
		return $sResult;
	}

	public function isRootList() {
		return false;
	}

}
>>>>>>> forked/LAE_400_PACKAGE
