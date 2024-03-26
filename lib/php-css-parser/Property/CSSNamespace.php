<?php

namespace Sabberworm\CSS\Property;

<<<<<<< HEAD
use Sabberworm\CSS\Comment\Comment;
use Sabberworm\CSS\OutputFormat;

/**
 * `CSSNamespace` represents an `@namespace` rule.
 */
class CSSNamespace implements AtRule
{
    /**
     * @var string
     */
    private $mUrl;

    /**
     * @var string
     */
    private $sPrefix;

    /**
     * @var int
     */
    private $iLineNo;

    /**
     * @var array<array-key, Comment>
     */
    protected $aComments;

    /**
     * @param string $mUrl
     * @param string|null $sPrefix
     * @param int $iLineNo
     */
    public function __construct($mUrl, $sPrefix = null, $iLineNo = 0)
    {
        $this->mUrl = $mUrl;
        $this->sPrefix = $sPrefix;
        $this->iLineNo = $iLineNo;
        $this->aComments = [];
    }

    /**
     * @return int
     */
    public function getLineNo()
    {
        return $this->iLineNo;
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
        return '@namespace ' . ($this->sPrefix === null ? '' : $this->sPrefix . ' ')
            . $this->mUrl->render($oOutputFormat) . ';';
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->mUrl;
    }

    /**
     * @return string|null
     */
    public function getPrefix()
    {
        return $this->sPrefix;
    }

    /**
     * @param string $mUrl
     *
     * @return void
     */
    public function setUrl($mUrl)
    {
        $this->mUrl = $mUrl;
    }

    /**
     * @param string $sPrefix
     *
     * @return void
     */
    public function setPrefix($sPrefix)
    {
        $this->sPrefix = $sPrefix;
    }

    /**
     * @return string
     */
    public function atRuleName()
    {
        return 'namespace';
    }

    /**
     * @return array<int, string>
     */
    public function atRuleArgs()
    {
        $aResult = [$this->mUrl];
        if ($this->sPrefix) {
            array_unshift($aResult, $this->sPrefix);
        }
        return $aResult;
    }

    /**
     * @param array<array-key, Comment> $aComments
     *
     * @return void
     */
    public function addComments(array $aComments)
    {
        $this->aComments = array_merge($this->aComments, $aComments);
    }

    /**
     * @return array<array-key, Comment>
     */
    public function getComments()
    {
        return $this->aComments;
    }

    /**
     * @param array<array-key, Comment> $aComments
     *
     * @return void
     */
    public function setComments(array $aComments)
    {
        $this->aComments = $aComments;
    }
}
=======
/**
* CSSNamespace represents an @namespace rule.
*/
class CSSNamespace implements AtRule {
	private $mUrl;
	private $sPrefix;
	private $iLineNo;
	protected $aComments;
	
	public function __construct($mUrl, $sPrefix = null, $iLineNo = 0) {
		$this->mUrl = $mUrl;
		$this->sPrefix = $sPrefix;
		$this->iLineNo = $iLineNo;
		$this->aComments = array();
	}

	/**
	 * @return int
	 */
	public function getLineNo() {
		return $this->iLineNo;
	}

	public function __toString() {
		return $this->render(new \Sabberworm\CSS\OutputFormat());
	}

	public function render(\Sabberworm\CSS\OutputFormat $oOutputFormat) {
		return '@namespace '.($this->sPrefix === null ? '' : $this->sPrefix.' ').$this->mUrl->render($oOutputFormat).';';
	}
	
	public function getUrl() {
		return $this->mUrl;
	}

	public function getPrefix() {
		return $this->sPrefix;
	}

	public function setUrl($mUrl) {
		$this->mUrl = $mUrl;
	}

	public function setPrefix($sPrefix) {
		$this->sPrefix = $sPrefix;
	}

	public function atRuleName() {
		return 'namespace';
	}

	public function atRuleArgs() {
		$aResult = array($this->mUrl);
		if($this->sPrefix) {
			array_unshift($aResult, $this->sPrefix);
		}
		return $aResult;
	}

	public function addComments(array $aComments) {
		$this->aComments = array_merge($this->aComments, $aComments);
	}

	public function getComments() {
		return $this->aComments;
	}

	public function setComments(array $aComments) {
		$this->aComments = $aComments;
	}
}
>>>>>>> forked/LAE_400_PACKAGE
