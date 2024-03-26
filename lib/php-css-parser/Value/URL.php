<?php

namespace Sabberworm\CSS\Value;

<<<<<<< HEAD
use Sabberworm\CSS\OutputFormat;
use Sabberworm\CSS\Parsing\ParserState;
use Sabberworm\CSS\Parsing\SourceException;
use Sabberworm\CSS\Parsing\UnexpectedEOFException;
use Sabberworm\CSS\Parsing\UnexpectedTokenException;

class URL extends PrimitiveValue
{
    /**
     * @var CSSString
     */
    private $oURL;

    /**
     * @param int $iLineNo
     */
    public function __construct(CSSString $oURL, $iLineNo = 0)
    {
        parent::__construct($iLineNo);
        $this->oURL = $oURL;
    }

    /**
     * @return URL
     *
     * @throws SourceException
     * @throws UnexpectedEOFException
     * @throws UnexpectedTokenException
     */
    public static function parse(ParserState $oParserState)
    {
        $bUseUrl = $oParserState->comes('url', true);
        if ($bUseUrl) {
            $oParserState->consume('url');
            $oParserState->consumeWhiteSpace();
            $oParserState->consume('(');
        }
        $oParserState->consumeWhiteSpace();
        $oResult = new URL(CSSString::parse($oParserState), $oParserState->currentLine());
        if ($bUseUrl) {
            $oParserState->consumeWhiteSpace();
            $oParserState->consume(')');
        }
        return $oResult;
    }

    /**
     * @return void
     */
    public function setURL(CSSString $oURL)
    {
        $this->oURL = $oURL;
    }

    /**
     * @return CSSString
     */
    public function getURL()
    {
        return $this->oURL;
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
        return "url({$this->oURL->render($oOutputFormat)})";
    }
}
=======
use Sabberworm\CSS\Parsing\ParserState;

class URL extends PrimitiveValue {

	private $oURL;

	public function __construct(CSSString $oURL, $iLineNo = 0) {
		parent::__construct($iLineNo);
		$this->oURL = $oURL;
	}

	public static function parse(ParserState $oParserState) {
		$bUseUrl = $oParserState->comes('url', true);
		if ($bUseUrl) {
			$oParserState->consume('url');
			$oParserState->consumeWhiteSpace();
			$oParserState->consume('(');
		}
		$oParserState->consumeWhiteSpace();
		$oResult = new URL(CSSString::parse($oParserState), $oParserState->currentLine());
		if ($bUseUrl) {
			$oParserState->consumeWhiteSpace();
			$oParserState->consume(')');
		}
		return $oResult;
	}


	public function setURL(CSSString $oURL) {
		$this->oURL = $oURL;
	}

	public function getURL() {
		return $this->oURL;
	}

	public function __toString() {
		return $this->render(new \Sabberworm\CSS\OutputFormat());
	}

	public function render(\Sabberworm\CSS\OutputFormat $oOutputFormat) {
		return "url({$this->oURL->render($oOutputFormat)})";
	}

}
>>>>>>> forked/LAE_400_PACKAGE
