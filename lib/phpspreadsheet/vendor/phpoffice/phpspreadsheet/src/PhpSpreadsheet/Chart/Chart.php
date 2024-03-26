<?php

namespace PhpOffice\PhpSpreadsheet\Chart;

use PhpOffice\PhpSpreadsheet\Settings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Chart
{
    /**
     * Chart Name.
     *
     * @var string
     */
    private $name = '';

    /**
     * Worksheet.
     *
<<<<<<< HEAD
     * @var ?Worksheet
=======
     * @var Worksheet
>>>>>>> forked/LAE_400_PACKAGE
     */
    private $worksheet;

    /**
     * Chart Title.
     *
<<<<<<< HEAD
     * @var ?Title
=======
     * @var Title
>>>>>>> forked/LAE_400_PACKAGE
     */
    private $title;

    /**
     * Chart Legend.
     *
<<<<<<< HEAD
     * @var ?Legend
=======
     * @var Legend
>>>>>>> forked/LAE_400_PACKAGE
     */
    private $legend;

    /**
     * X-Axis Label.
     *
<<<<<<< HEAD
     * @var ?Title
=======
     * @var Title
>>>>>>> forked/LAE_400_PACKAGE
     */
    private $xAxisLabel;

    /**
     * Y-Axis Label.
     *
<<<<<<< HEAD
     * @var ?Title
=======
     * @var Title
>>>>>>> forked/LAE_400_PACKAGE
     */
    private $yAxisLabel;

    /**
     * Chart Plot Area.
     *
<<<<<<< HEAD
     * @var ?PlotArea
=======
     * @var PlotArea
>>>>>>> forked/LAE_400_PACKAGE
     */
    private $plotArea;

    /**
     * Plot Visible Only.
     *
     * @var bool
     */
    private $plotVisibleOnly = true;

    /**
     * Display Blanks as.
     *
     * @var string
     */
    private $displayBlanksAs = DataSeries::EMPTY_AS_GAP;

    /**
     * Chart Asix Y as.
     *
     * @var Axis
     */
    private $yAxis;

    /**
     * Chart Asix X as.
     *
     * @var Axis
     */
    private $xAxis;

    /**
<<<<<<< HEAD
=======
     * Chart Major Gridlines as.
     *
     * @var GridLines
     */
    private $majorGridlines;

    /**
     * Chart Minor Gridlines as.
     *
     * @var GridLines
     */
    private $minorGridlines;

    /**
>>>>>>> forked/LAE_400_PACKAGE
     * Top-Left Cell Position.
     *
     * @var string
     */
    private $topLeftCellRef = 'A1';

    /**
     * Top-Left X-Offset.
     *
     * @var int
     */
    private $topLeftXOffset = 0;

    /**
     * Top-Left Y-Offset.
     *
     * @var int
     */
    private $topLeftYOffset = 0;

    /**
     * Bottom-Right Cell Position.
     *
     * @var string
     */
<<<<<<< HEAD
    private $bottomRightCellRef = '';
=======
    private $bottomRightCellRef = 'A1';
>>>>>>> forked/LAE_400_PACKAGE

    /**
     * Bottom-Right X-Offset.
     *
     * @var int
     */
    private $bottomRightXOffset = 10;

    /**
     * Bottom-Right Y-Offset.
     *
     * @var int
     */
    private $bottomRightYOffset = 10;

<<<<<<< HEAD
    /** @var ?int */
    private $rotX;

    /** @var ?int */
    private $rotY;

    /** @var ?int */
    private $rAngAx;

    /** @var ?int */
    private $perspective;

    /** @var bool */
    private $oneCellAnchor = false;

    /** @var bool */
    private $autoTitleDeleted = false;

    /** @var bool */
    private $noFill = false;

    /** @var bool */
    private $roundedCorners = false;

    /**
     * Create a new Chart.
     * majorGridlines and minorGridlines are deprecated, moved to Axis.
=======
    /**
     * Create a new Chart.
>>>>>>> forked/LAE_400_PACKAGE
     *
     * @param mixed $name
     * @param mixed $plotVisibleOnly
     * @param string $displayBlanksAs
     */
    public function __construct($name, ?Title $title = null, ?Legend $legend = null, ?PlotArea $plotArea = null, $plotVisibleOnly = true, $displayBlanksAs = DataSeries::EMPTY_AS_GAP, ?Title $xAxisLabel = null, ?Title $yAxisLabel = null, ?Axis $xAxis = null, ?Axis $yAxis = null, ?GridLines $majorGridlines = null, ?GridLines $minorGridlines = null)
    {
        $this->name = $name;
        $this->title = $title;
        $this->legend = $legend;
        $this->xAxisLabel = $xAxisLabel;
        $this->yAxisLabel = $yAxisLabel;
        $this->plotArea = $plotArea;
        $this->plotVisibleOnly = $plotVisibleOnly;
        $this->displayBlanksAs = $displayBlanksAs;
<<<<<<< HEAD
        $this->xAxis = $xAxis ?? new Axis();
        $this->yAxis = $yAxis ?? new Axis();
        if ($majorGridlines !== null) {
            $this->yAxis->setMajorGridlines($majorGridlines);
        }
        if ($minorGridlines !== null) {
            $this->yAxis->setMinorGridlines($minorGridlines);
        }
=======
        $this->xAxis = $xAxis;
        $this->yAxis = $yAxis;
        $this->majorGridlines = $majorGridlines;
        $this->minorGridlines = $minorGridlines;
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Get Name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

<<<<<<< HEAD
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get Worksheet.
     */
    public function getWorksheet(): ?Worksheet
=======
    /**
     * Get Worksheet.
     *
     * @return Worksheet
     */
    public function getWorksheet()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->worksheet;
    }

    /**
     * Set Worksheet.
     *
     * @return $this
     */
    public function setWorksheet(?Worksheet $worksheet = null)
    {
        $this->worksheet = $worksheet;

        return $this;
    }

<<<<<<< HEAD
    public function getTitle(): ?Title
=======
    /**
     * Get Title.
     *
     * @return Title
     */
    public function getTitle()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->title;
    }

    /**
     * Set Title.
     *
     * @return $this
     */
    public function setTitle(Title $title)
    {
        $this->title = $title;

        return $this;
    }

<<<<<<< HEAD
    public function getLegend(): ?Legend
=======
    /**
     * Get Legend.
     *
     * @return Legend
     */
    public function getLegend()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->legend;
    }

    /**
     * Set Legend.
     *
     * @return $this
     */
    public function setLegend(Legend $legend)
    {
        $this->legend = $legend;

        return $this;
    }

<<<<<<< HEAD
    public function getXAxisLabel(): ?Title
=======
    /**
     * Get X-Axis Label.
     *
     * @return Title
     */
    public function getXAxisLabel()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->xAxisLabel;
    }

    /**
     * Set X-Axis Label.
     *
     * @return $this
     */
    public function setXAxisLabel(Title $label)
    {
        $this->xAxisLabel = $label;

        return $this;
    }

<<<<<<< HEAD
    public function getYAxisLabel(): ?Title
=======
    /**
     * Get Y-Axis Label.
     *
     * @return Title
     */
    public function getYAxisLabel()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->yAxisLabel;
    }

    /**
     * Set Y-Axis Label.
     *
     * @return $this
     */
    public function setYAxisLabel(Title $label)
    {
        $this->yAxisLabel = $label;

        return $this;
    }

<<<<<<< HEAD
    public function getPlotArea(): ?PlotArea
=======
    /**
     * Get Plot Area.
     *
     * @return PlotArea
     */
    public function getPlotArea()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->plotArea;
    }

    /**
<<<<<<< HEAD
     * Set Plot Area.
     */
    public function setPlotArea(PlotArea $plotArea): self
    {
        $this->plotArea = $plotArea;

        return $this;
    }

    /**
=======
>>>>>>> forked/LAE_400_PACKAGE
     * Get Plot Visible Only.
     *
     * @return bool
     */
    public function getPlotVisibleOnly()
    {
        return $this->plotVisibleOnly;
    }

    /**
     * Set Plot Visible Only.
     *
     * @param bool $plotVisibleOnly
     *
     * @return $this
     */
    public function setPlotVisibleOnly($plotVisibleOnly)
    {
        $this->plotVisibleOnly = $plotVisibleOnly;

        return $this;
    }

    /**
     * Get Display Blanks as.
     *
     * @return string
     */
    public function getDisplayBlanksAs()
    {
        return $this->displayBlanksAs;
    }

    /**
     * Set Display Blanks as.
     *
     * @param string $displayBlanksAs
     *
     * @return $this
     */
    public function setDisplayBlanksAs($displayBlanksAs)
    {
        $this->displayBlanksAs = $displayBlanksAs;

        return $this;
    }

<<<<<<< HEAD
    public function getChartAxisY(): Axis
    {
        return $this->yAxis;
    }

    /**
     * Set yAxis.
     */
    public function setChartAxisY(?Axis $axis): self
    {
        $this->yAxis = $axis ?? new Axis();

        return $this;
    }

    public function getChartAxisX(): Axis
    {
        return $this->xAxis;
    }

    /**
     * Set xAxis.
     */
    public function setChartAxisX(?Axis $axis): self
    {
        $this->xAxis = $axis ?? new Axis();

        return $this;
=======
    /**
     * Get yAxis.
     *
     * @return Axis
     */
    public function getChartAxisY()
    {
        if ($this->yAxis !== null) {
            return $this->yAxis;
        }

        return new Axis();
    }

    /**
     * Get xAxis.
     *
     * @return Axis
     */
    public function getChartAxisX()
    {
        if ($this->xAxis !== null) {
            return $this->xAxis;
        }

        return new Axis();
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Get Major Gridlines.
     *
<<<<<<< HEAD
     * @Deprecated 1.24.0 Use Axis->getMajorGridlines
     *
     * @codeCoverageIgnore
     */
    public function getMajorGridlines(): ?GridLines
    {
        return $this->yAxis->getMajorGridLines();
=======
     * @return GridLines
     */
    public function getMajorGridlines()
    {
        if ($this->majorGridlines !== null) {
            return $this->majorGridlines;
        }

        return new GridLines();
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Get Minor Gridlines.
     *
<<<<<<< HEAD
     * @Deprecated 1.24.0 Use Axis->getMinorGridlines
     *
     * @codeCoverageIgnore
     */
    public function getMinorGridlines(): ?GridLines
    {
        return $this->yAxis->getMinorGridLines();
=======
     * @return GridLines
     */
    public function getMinorGridlines()
    {
        if ($this->minorGridlines !== null) {
            return $this->minorGridlines;
        }

        return new GridLines();
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Set the Top Left position for the chart.
     *
<<<<<<< HEAD
     * @param string $cellAddress
=======
     * @param string $cell
>>>>>>> forked/LAE_400_PACKAGE
     * @param int $xOffset
     * @param int $yOffset
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setTopLeftPosition($cellAddress, $xOffset = null, $yOffset = null)
    {
        $this->topLeftCellRef = $cellAddress;
=======
    public function setTopLeftPosition($cell, $xOffset = null, $yOffset = null)
    {
        $this->topLeftCellRef = $cell;
>>>>>>> forked/LAE_400_PACKAGE
        if ($xOffset !== null) {
            $this->setTopLeftXOffset($xOffset);
        }
        if ($yOffset !== null) {
            $this->setTopLeftYOffset($yOffset);
        }

        return $this;
    }

    /**
     * Get the top left position of the chart.
     *
     * @return array{cell: string, xOffset: int, yOffset: int} an associative array containing the cell address, X-Offset and Y-Offset from the top left of that cell
     */
    public function getTopLeftPosition()
    {
        return [
            'cell' => $this->topLeftCellRef,
            'xOffset' => $this->topLeftXOffset,
            'yOffset' => $this->topLeftYOffset,
        ];
    }

    /**
     * Get the cell address where the top left of the chart is fixed.
     *
     * @return string
     */
    public function getTopLeftCell()
    {
        return $this->topLeftCellRef;
    }

    /**
     * Set the Top Left cell position for the chart.
     *
<<<<<<< HEAD
     * @param string $cellAddress
     *
     * @return $this
     */
    public function setTopLeftCell($cellAddress)
    {
        $this->topLeftCellRef = $cellAddress;
=======
     * @param string $cell
     *
     * @return $this
     */
    public function setTopLeftCell($cell)
    {
        $this->topLeftCellRef = $cell;
>>>>>>> forked/LAE_400_PACKAGE

        return $this;
    }

    /**
     * Set the offset position within the Top Left cell for the chart.
     *
     * @param int $xOffset
     * @param int $yOffset
     *
     * @return $this
     */
    public function setTopLeftOffset($xOffset, $yOffset)
    {
        if ($xOffset !== null) {
            $this->setTopLeftXOffset($xOffset);
        }

        if ($yOffset !== null) {
            $this->setTopLeftYOffset($yOffset);
        }

        return $this;
    }

    /**
     * Get the offset position within the Top Left cell for the chart.
     *
     * @return int[]
     */
    public function getTopLeftOffset()
    {
        return [
            'X' => $this->topLeftXOffset,
            'Y' => $this->topLeftYOffset,
        ];
    }

<<<<<<< HEAD
    /**
     * @param int $xOffset
     *
     * @return $this
     */
=======
>>>>>>> forked/LAE_400_PACKAGE
    public function setTopLeftXOffset($xOffset)
    {
        $this->topLeftXOffset = $xOffset;

        return $this;
    }

<<<<<<< HEAD
    public function getTopLeftXOffset(): int
=======
    public function getTopLeftXOffset()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->topLeftXOffset;
    }

<<<<<<< HEAD
    /**
     * @param int $yOffset
     *
     * @return $this
     */
=======
>>>>>>> forked/LAE_400_PACKAGE
    public function setTopLeftYOffset($yOffset)
    {
        $this->topLeftYOffset = $yOffset;

        return $this;
    }

<<<<<<< HEAD
    public function getTopLeftYOffset(): int
=======
    public function getTopLeftYOffset()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->topLeftYOffset;
    }

    /**
     * Set the Bottom Right position of the chart.
     *
<<<<<<< HEAD
     * @param string $cellAddress
=======
     * @param string $cell
>>>>>>> forked/LAE_400_PACKAGE
     * @param int $xOffset
     * @param int $yOffset
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setBottomRightPosition($cellAddress = '', $xOffset = null, $yOffset = null)
    {
        $this->bottomRightCellRef = $cellAddress;
=======
    public function setBottomRightPosition($cell, $xOffset = null, $yOffset = null)
    {
        $this->bottomRightCellRef = $cell;
>>>>>>> forked/LAE_400_PACKAGE
        if ($xOffset !== null) {
            $this->setBottomRightXOffset($xOffset);
        }
        if ($yOffset !== null) {
            $this->setBottomRightYOffset($yOffset);
        }

        return $this;
    }

    /**
     * Get the bottom right position of the chart.
     *
     * @return array an associative array containing the cell address, X-Offset and Y-Offset from the top left of that cell
     */
    public function getBottomRightPosition()
    {
        return [
            'cell' => $this->bottomRightCellRef,
            'xOffset' => $this->bottomRightXOffset,
            'yOffset' => $this->bottomRightYOffset,
        ];
    }

<<<<<<< HEAD
    /**
     * Set the Bottom Right cell for the chart.
     *
     * @return $this
     */
    public function setBottomRightCell(string $cellAddress = '')
    {
        $this->bottomRightCellRef = $cellAddress;
=======
    public function setBottomRightCell($cell)
    {
        $this->bottomRightCellRef = $cell;
>>>>>>> forked/LAE_400_PACKAGE

        return $this;
    }

    /**
     * Get the cell address where the bottom right of the chart is fixed.
<<<<<<< HEAD
     */
    public function getBottomRightCell(): string
=======
     *
     * @return string
     */
    public function getBottomRightCell()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->bottomRightCellRef;
    }

    /**
     * Set the offset position within the Bottom Right cell for the chart.
     *
     * @param int $xOffset
     * @param int $yOffset
     *
     * @return $this
     */
    public function setBottomRightOffset($xOffset, $yOffset)
    {
        if ($xOffset !== null) {
            $this->setBottomRightXOffset($xOffset);
        }

        if ($yOffset !== null) {
            $this->setBottomRightYOffset($yOffset);
        }

        return $this;
    }

    /**
     * Get the offset position within the Bottom Right cell for the chart.
     *
     * @return int[]
     */
    public function getBottomRightOffset()
    {
        return [
            'X' => $this->bottomRightXOffset,
            'Y' => $this->bottomRightYOffset,
        ];
    }

<<<<<<< HEAD
    /**
     * @param int $xOffset
     *
     * @return $this
     */
=======
>>>>>>> forked/LAE_400_PACKAGE
    public function setBottomRightXOffset($xOffset)
    {
        $this->bottomRightXOffset = $xOffset;

        return $this;
    }

<<<<<<< HEAD
    public function getBottomRightXOffset(): int
=======
    public function getBottomRightXOffset()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->bottomRightXOffset;
    }

<<<<<<< HEAD
    /**
     * @param int $yOffset
     *
     * @return $this
     */
=======
>>>>>>> forked/LAE_400_PACKAGE
    public function setBottomRightYOffset($yOffset)
    {
        $this->bottomRightYOffset = $yOffset;

        return $this;
    }

<<<<<<< HEAD
    public function getBottomRightYOffset(): int
=======
    public function getBottomRightYOffset()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->bottomRightYOffset;
    }

    public function refresh(): void
    {
<<<<<<< HEAD
        if ($this->worksheet !== null && $this->plotArea !== null) {
=======
        if ($this->worksheet !== null) {
>>>>>>> forked/LAE_400_PACKAGE
            $this->plotArea->refresh($this->worksheet);
        }
    }

    /**
     * Render the chart to given file (or stream).
     *
     * @param string $outputDestination Name of the file render to
     *
     * @return bool true on success
     */
    public function render($outputDestination = null)
    {
        if ($outputDestination == 'php://output') {
            $outputDestination = null;
        }

        $libraryName = Settings::getChartRenderer();
        if ($libraryName === null) {
            return false;
        }

        // Ensure that data series values are up-to-date before we render
        $this->refresh();

        $renderer = new $libraryName($this);

<<<<<<< HEAD
        return $renderer->render($outputDestination); // @phpstan-ignore-line
    }

    public function getRotX(): ?int
    {
        return $this->rotX;
    }

    public function setRotX(?int $rotX): self
    {
        $this->rotX = $rotX;

        return $this;
    }

    public function getRotY(): ?int
    {
        return $this->rotY;
    }

    public function setRotY(?int $rotY): self
    {
        $this->rotY = $rotY;

        return $this;
    }

    public function getRAngAx(): ?int
    {
        return $this->rAngAx;
    }

    public function setRAngAx(?int $rAngAx): self
    {
        $this->rAngAx = $rAngAx;

        return $this;
    }

    public function getPerspective(): ?int
    {
        return $this->perspective;
    }

    public function setPerspective(?int $perspective): self
    {
        $this->perspective = $perspective;

        return $this;
    }

    public function getOneCellAnchor(): bool
    {
        return $this->oneCellAnchor;
    }

    public function setOneCellAnchor(bool $oneCellAnchor): self
    {
        $this->oneCellAnchor = $oneCellAnchor;

        return $this;
    }

    public function getAutoTitleDeleted(): bool
    {
        return $this->autoTitleDeleted;
    }

    public function setAutoTitleDeleted(bool $autoTitleDeleted): self
    {
        $this->autoTitleDeleted = $autoTitleDeleted;

        return $this;
    }

    public function getNoFill(): bool
    {
        return $this->noFill;
    }

    public function setNoFill(bool $noFill): self
    {
        $this->noFill = $noFill;

        return $this;
    }

    public function getRoundedCorners(): bool
    {
        return $this->roundedCorners;
    }

    public function setRoundedCorners(?bool $roundedCorners): self
    {
        if ($roundedCorners !== null) {
            $this->roundedCorners = $roundedCorners;
        }

        return $this;
=======
        return $renderer->render($outputDestination);
>>>>>>> forked/LAE_400_PACKAGE
    }
}
