<?php

namespace Sabberworm\CSS\Value;

<<<<<<< HEAD
use Sabberworm\CSS\OutputFormat;

class CSSFunction extends ValueList
{
    /**
     * @var string
     */
    protected $sName;

    /**
     * @param string $sName
     * @param RuleValueList|array<int, RuleValueList|CSSFunction|CSSString|LineName|Size|URL|string> $aArguments
     * @param string $sSeparator
     * @param int $iLineNo
     */
    public function __construct($sName, $aArguments, $sSeparator = ',', $iLineNo = 0)
    {
        if ($aArguments instanceof RuleValueList) {
            $sSeparator = $aArguments->getListSeparator();
            $aArguments = $aArguments->getListComponents();
        }
        $this->sName = $sName;
        $this->iLineNo = $iLineNo;
        parent::__construct($aArguments, $sSeparator, $iLineNo);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->sName;
    }

    /**
     * @param string $sName
     *
     * @return void
     */
    public function setName($sName)
    {
        $this->sName = $sName;
    }

    /**
     * @return array<int, RuleValueList|CSSFunction|CSSString|LineName|Size|URL|string>
     */
    public function getArguments()
    {
        return $this->aComponents;
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
        $aArguments = parent::render($oOutputFormat);
        return "{$this->sName}({$aArguments})";
    }
=======
class CSSFunction extends ValueList {

	protected $sName;

	public function __construct($sName, $aArguments, $sSeparator = ',', $iLineNo = 0) {
		if($aArguments instanceof RuleValueList) {
			$sSeparator = $aArguments->getListSeparator();
			$aArguments = $aArguments->getListComponents();
		}
		$this->sName = $sName;
		$this->iLineNo = $iLineNo;
		parent::__construct($aArguments, $sSeparator, $iLineNo);
	}

	public function getName() {
		return $this->sName;
	}

	public function setName($sName) {
		$this->sName = $sName;
	}

	public function getArguments() {
		return $this->aComponents;
	}

	public function __toString() {
		return $this->render(new \Sabberworm\CSS\OutputFormat());
	}

	public function render(\Sabberworm\CSS\OutputFormat $oOutputFormat) {
		$aArguments = parent::render($oOutputFormat);
		return "{$this->sName}({$aArguments})";
	}

>>>>>>> forked/LAE_400_PACKAGE
}
