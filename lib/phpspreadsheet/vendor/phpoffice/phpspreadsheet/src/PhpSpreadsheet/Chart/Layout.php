<?php

namespace PhpOffice\PhpSpreadsheet\Chart;

class Layout
{
    /**
     * layoutTarget.
     *
     * @var string
     */
    private $layoutTarget;

    /**
     * X Mode.
     *
     * @var string
     */
    private $xMode;

    /**
     * Y Mode.
     *
     * @var string
     */
    private $yMode;

    /**
     * X-Position.
     *
     * @var float
     */
    private $xPos;

    /**
     * Y-Position.
     *
     * @var float
     */
    private $yPos;

    /**
     * width.
     *
     * @var float
     */
    private $width;

    /**
     * height.
     *
     * @var float
     */
    private $height;

    /**
<<<<<<< HEAD
     * Position - t=top.
     *
     * @var string
     */
    private $dLblPos = '';

    /** @var string */
    private $numFmtCode = '';

    /** @var bool */
    private $numFmtLinked = false;

    /**
     * show legend key
     * Specifies that legend keys should be shown in data labels.
     *
     * @var ?bool
=======
     * show legend key
     * Specifies that legend keys should be shown in data labels.
     *
     * @var bool
>>>>>>> forked/LAE_400_PACKAGE
     */
    private $showLegendKey;

    /**
     * show value
     * Specifies that the value should be shown in a data label.
     *
<<<<<<< HEAD
     * @var ?bool
=======
     * @var bool
>>>>>>> forked/LAE_400_PACKAGE
     */
    private $showVal;

    /**
     * show category name
     * Specifies that the category name should be shown in the data label.
     *
<<<<<<< HEAD
     * @var ?bool
=======
     * @var bool
>>>>>>> forked/LAE_400_PACKAGE
     */
    private $showCatName;

    /**
     * show data series name
     * Specifies that the series name should be shown in the data label.
     *
<<<<<<< HEAD
     * @var ?bool
=======
     * @var bool
>>>>>>> forked/LAE_400_PACKAGE
     */
    private $showSerName;

    /**
     * show percentage
     * Specifies that the percentage should be shown in the data label.
     *
<<<<<<< HEAD
     * @var ?bool
=======
     * @var bool
>>>>>>> forked/LAE_400_PACKAGE
     */
    private $showPercent;

    /**
     * show bubble size.
     *
<<<<<<< HEAD
     * @var ?bool
=======
     * @var bool
>>>>>>> forked/LAE_400_PACKAGE
     */
    private $showBubbleSize;

    /**
     * show leader lines
     * Specifies that leader lines should be shown for the data label.
     *
<<<<<<< HEAD
     * @var ?bool
     */
    private $showLeaderLines;

    /** @var ?ChartColor */
    private $labelFillColor;

    /** @var ?ChartColor */
    private $labelBorderColor;

    /** @var ?ChartColor */
    private $labelFontColor;

=======
     * @var bool
     */
    private $showLeaderLines;

>>>>>>> forked/LAE_400_PACKAGE
    /**
     * Create a new Layout.
     */
    public function __construct(array $layout = [])
    {
        if (isset($layout['layoutTarget'])) {
            $this->layoutTarget = $layout['layoutTarget'];
        }
        if (isset($layout['xMode'])) {
            $this->xMode = $layout['xMode'];
        }
        if (isset($layout['yMode'])) {
            $this->yMode = $layout['yMode'];
        }
        if (isset($layout['x'])) {
            $this->xPos = (float) $layout['x'];
        }
        if (isset($layout['y'])) {
            $this->yPos = (float) $layout['y'];
        }
        if (isset($layout['w'])) {
            $this->width = (float) $layout['w'];
        }
        if (isset($layout['h'])) {
            $this->height = (float) $layout['h'];
        }
<<<<<<< HEAD
        if (isset($layout['dLblPos'])) {
            $this->dLblPos = (string) $layout['dLblPos'];
        }
        if (isset($layout['numFmtCode'])) {
            $this->numFmtCode = (string) $layout['numFmtCode'];
        }
        $this->initBoolean($layout, 'showLegendKey');
        $this->initBoolean($layout, 'showVal');
        $this->initBoolean($layout, 'showCatName');
        $this->initBoolean($layout, 'showSerName');
        $this->initBoolean($layout, 'showPercent');
        $this->initBoolean($layout, 'showBubbleSize');
        $this->initBoolean($layout, 'showLeaderLines');
        $this->initBoolean($layout, 'numFmtLinked');
        $this->initColor($layout, 'labelFillColor');
        $this->initColor($layout, 'labelBorderColor');
        $this->initColor($layout, 'labelFontColor');
    }

    private function initBoolean(array $layout, string $name): void
    {
        if (isset($layout[$name])) {
            $this->$name = (bool) $layout[$name];
        }
    }

    private function initColor(array $layout, string $name): void
    {
        if (isset($layout[$name]) && $layout[$name] instanceof ChartColor) {
            $this->$name = $layout[$name];
        }
=======
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Get Layout Target.
     *
     * @return string
     */
    public function getLayoutTarget()
    {
        return $this->layoutTarget;
    }

    /**
     * Set Layout Target.
     *
     * @param string $target
     *
     * @return $this
     */
    public function setLayoutTarget($target)
    {
        $this->layoutTarget = $target;

        return $this;
    }

    /**
     * Get X-Mode.
     *
     * @return string
     */
    public function getXMode()
    {
        return $this->xMode;
    }

    /**
     * Set X-Mode.
     *
     * @param string $mode
     *
     * @return $this
     */
    public function setXMode($mode)
    {
        $this->xMode = (string) $mode;

        return $this;
    }

    /**
     * Get Y-Mode.
     *
     * @return string
     */
    public function getYMode()
    {
        return $this->yMode;
    }

    /**
     * Set Y-Mode.
     *
     * @param string $mode
     *
     * @return $this
     */
    public function setYMode($mode)
    {
        $this->yMode = (string) $mode;

        return $this;
    }

    /**
     * Get X-Position.
     *
     * @return number
     */
    public function getXPosition()
    {
        return $this->xPos;
    }

    /**
     * Set X-Position.
     *
     * @param float $position
     *
     * @return $this
     */
    public function setXPosition($position)
    {
        $this->xPos = (float) $position;

        return $this;
    }

    /**
     * Get Y-Position.
     *
     * @return number
     */
    public function getYPosition()
    {
        return $this->yPos;
    }

    /**
     * Set Y-Position.
     *
     * @param float $position
     *
     * @return $this
     */
    public function setYPosition($position)
    {
        $this->yPos = (float) $position;

        return $this;
    }

    /**
     * Get Width.
     *
     * @return number
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set Width.
     *
     * @param float $width
     *
     * @return $this
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get Height.
     *
     * @return number
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set Height.
     *
     * @param float $height
     *
     * @return $this
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

<<<<<<< HEAD
    public function getShowLegendKey(): ?bool
=======
    /**
     * Get show legend key.
     *
     * @return bool
     */
    public function getShowLegendKey()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->showLegendKey;
    }

    /**
     * Set show legend key
     * Specifies that legend keys should be shown in data labels.
<<<<<<< HEAD
     */
    public function setShowLegendKey(?bool $showLegendKey): self
=======
     *
     * @param bool $showLegendKey Show legend key
     *
     * @return $this
     */
    public function setShowLegendKey($showLegendKey)
>>>>>>> forked/LAE_400_PACKAGE
    {
        $this->showLegendKey = $showLegendKey;

        return $this;
    }

<<<<<<< HEAD
    public function getShowVal(): ?bool
=======
    /**
     * Get show value.
     *
     * @return bool
     */
    public function getShowVal()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->showVal;
    }

    /**
     * Set show val
     * Specifies that the value should be shown in data labels.
<<<<<<< HEAD
     */
    public function setShowVal(?bool $showDataLabelValues): self
=======
     *
     * @param bool $showDataLabelValues Show val
     *
     * @return $this
     */
    public function setShowVal($showDataLabelValues)
>>>>>>> forked/LAE_400_PACKAGE
    {
        $this->showVal = $showDataLabelValues;

        return $this;
    }

<<<<<<< HEAD
    public function getShowCatName(): ?bool
=======
    /**
     * Get show category name.
     *
     * @return bool
     */
    public function getShowCatName()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->showCatName;
    }

    /**
     * Set show cat name
     * Specifies that the category name should be shown in data labels.
<<<<<<< HEAD
     */
    public function setShowCatName(?bool $showCategoryName): self
=======
     *
     * @param bool $showCategoryName Show cat name
     *
     * @return $this
     */
    public function setShowCatName($showCategoryName)
>>>>>>> forked/LAE_400_PACKAGE
    {
        $this->showCatName = $showCategoryName;

        return $this;
    }

<<<<<<< HEAD
    public function getShowSerName(): ?bool
=======
    /**
     * Get show data series name.
     *
     * @return bool
     */
    public function getShowSerName()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->showSerName;
    }

    /**
<<<<<<< HEAD
     * Set show data series name.
     * Specifies that the series name should be shown in data labels.
     */
    public function setShowSerName(?bool $showSeriesName): self
=======
     * Set show ser name
     * Specifies that the series name should be shown in data labels.
     *
     * @param bool $showSeriesName Show series name
     *
     * @return $this
     */
    public function setShowSerName($showSeriesName)
>>>>>>> forked/LAE_400_PACKAGE
    {
        $this->showSerName = $showSeriesName;

        return $this;
    }

<<<<<<< HEAD
    public function getShowPercent(): ?bool
=======
    /**
     * Get show percentage.
     *
     * @return bool
     */
    public function getShowPercent()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->showPercent;
    }

    /**
<<<<<<< HEAD
     * Set show percentage.
     * Specifies that the percentage should be shown in data labels.
     */
    public function setShowPercent(?bool $showPercentage): self
=======
     * Set show percentage
     * Specifies that the percentage should be shown in data labels.
     *
     * @param bool $showPercentage Show percentage
     *
     * @return $this
     */
    public function setShowPercent($showPercentage)
>>>>>>> forked/LAE_400_PACKAGE
    {
        $this->showPercent = $showPercentage;

        return $this;
    }

<<<<<<< HEAD
    public function getShowBubbleSize(): ?bool
=======
    /**
     * Get show bubble size.
     *
     * @return bool
     */
    public function getShowBubbleSize()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->showBubbleSize;
    }

    /**
<<<<<<< HEAD
     * Set show bubble size.
     * Specifies that the bubble size should be shown in data labels.
     */
    public function setShowBubbleSize(?bool $showBubbleSize): self
=======
     * Set show bubble size
     * Specifies that the bubble size should be shown in data labels.
     *
     * @param bool $showBubbleSize Show bubble size
     *
     * @return $this
     */
    public function setShowBubbleSize($showBubbleSize)
>>>>>>> forked/LAE_400_PACKAGE
    {
        $this->showBubbleSize = $showBubbleSize;

        return $this;
    }

<<<<<<< HEAD
    public function getShowLeaderLines(): ?bool
=======
    /**
     * Get show leader lines.
     *
     * @return bool
     */
    public function getShowLeaderLines()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->showLeaderLines;
    }

    /**
<<<<<<< HEAD
     * Set show leader lines.
     * Specifies that leader lines should be shown in data labels.
     */
    public function setShowLeaderLines(?bool $showLeaderLines): self
=======
     * Set show leader lines
     * Specifies that leader lines should be shown in data labels.
     *
     * @param bool $showLeaderLines Show leader lines
     *
     * @return $this
     */
    public function setShowLeaderLines($showLeaderLines)
>>>>>>> forked/LAE_400_PACKAGE
    {
        $this->showLeaderLines = $showLeaderLines;

        return $this;
    }
<<<<<<< HEAD

    public function getLabelFillColor(): ?ChartColor
    {
        return $this->labelFillColor;
    }

    public function setLabelFillColor(?ChartColor $chartColor): self
    {
        $this->labelFillColor = $chartColor;

        return $this;
    }

    public function getLabelBorderColor(): ?ChartColor
    {
        return $this->labelBorderColor;
    }

    public function setLabelBorderColor(?ChartColor $chartColor): self
    {
        $this->labelBorderColor = $chartColor;

        return $this;
    }

    public function getLabelFontColor(): ?ChartColor
    {
        return $this->labelFontColor;
    }

    public function setLabelFontColor(?ChartColor $chartColor): self
    {
        $this->labelFontColor = $chartColor;

        return $this;
    }

    public function getDLblPos(): string
    {
        return $this->dLblPos;
    }

    public function setDLblPos(string $dLblPos): self
    {
        $this->dLblPos = $dLblPos;

        return $this;
    }

    public function getNumFmtCode(): string
    {
        return $this->numFmtCode;
    }

    public function setNumFmtCode(string $numFmtCode): self
    {
        $this->numFmtCode = $numFmtCode;

        return $this;
    }

    public function getNumFmtLinked(): bool
    {
        return $this->numFmtLinked;
    }

    public function setNumFmtLinked(bool $numFmtLinked): self
    {
        $this->numFmtLinked = $numFmtLinked;

        return $this;
    }
=======
>>>>>>> forked/LAE_400_PACKAGE
}
