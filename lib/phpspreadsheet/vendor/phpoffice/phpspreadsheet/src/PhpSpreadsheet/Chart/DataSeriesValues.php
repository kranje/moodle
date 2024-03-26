<?php

namespace PhpOffice\PhpSpreadsheet\Chart;

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

<<<<<<< HEAD
class DataSeriesValues extends Properties
=======
class DataSeriesValues
>>>>>>> forked/LAE_400_PACKAGE
{
    const DATASERIES_TYPE_STRING = 'String';
    const DATASERIES_TYPE_NUMBER = 'Number';

<<<<<<< HEAD
    private const DATA_TYPE_VALUES = [
=======
    private static $dataTypeValues = [
>>>>>>> forked/LAE_400_PACKAGE
        self::DATASERIES_TYPE_STRING,
        self::DATASERIES_TYPE_NUMBER,
    ];

    /**
     * Series Data Type.
     *
     * @var string
     */
    private $dataType;

    /**
     * Series Data Source.
     *
<<<<<<< HEAD
     * @var ?string
=======
     * @var string
>>>>>>> forked/LAE_400_PACKAGE
     */
    private $dataSource;

    /**
     * Format Code.
     *
     * @var string
     */
    private $formatCode;

    /**
     * Series Point Marker.
     *
     * @var string
     */
    private $pointMarker;

<<<<<<< HEAD
    /** @var ChartColor */
    private $markerFillColor;

    /** @var ChartColor */
    private $markerBorderColor;

    /**
     * Series Point Size.
     *
     * @var int
     */
    private $pointSize = 3;

=======
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * Point Count (The number of datapoints in the dataseries).
     *
     * @var int
     */
    private $pointCount = 0;

    /**
     * Data Values.
     *
     * @var mixed[]
     */
    private $dataValues = [];

    /**
     * Fill color (can be array with colors if dataseries have custom colors).
     *
<<<<<<< HEAD
     * @var null|ChartColor|ChartColor[]
     */
    private $fillColor;

    /** @var bool */
    private $scatterLines = true;

    /** @var bool */
    private $bubble3D = false;

    /** @var ?Layout */
    private $labelLayout;

    /** @var TrendLine[] */
    private $trendLines = [];
=======
     * @var string|string[]
     */
    private $fillColor;

    /**
     * Line Width.
     *
     * @var int
     */
    private $lineWidth = 12700;
>>>>>>> forked/LAE_400_PACKAGE

    /**
     * Create a new DataSeriesValues object.
     *
     * @param string $dataType
     * @param string $dataSource
     * @param null|mixed $formatCode
     * @param int $pointCount
     * @param mixed $dataValues
     * @param null|mixed $marker
<<<<<<< HEAD
     * @param null|ChartColor|ChartColor[]|string|string[] $fillColor
     * @param string $pointSize
     */
    public function __construct($dataType = self::DATASERIES_TYPE_NUMBER, $dataSource = null, $formatCode = null, $pointCount = 0, $dataValues = [], $marker = null, $fillColor = null, $pointSize = '3')
    {
        parent::__construct();
        $this->markerFillColor = new ChartColor();
        $this->markerBorderColor = new ChartColor();
=======
     * @param null|string|string[] $fillColor
     */
    public function __construct($dataType = self::DATASERIES_TYPE_NUMBER, $dataSource = null, $formatCode = null, $pointCount = 0, $dataValues = [], $marker = null, $fillColor = null)
    {
>>>>>>> forked/LAE_400_PACKAGE
        $this->setDataType($dataType);
        $this->dataSource = $dataSource;
        $this->formatCode = $formatCode;
        $this->pointCount = $pointCount;
        $this->dataValues = $dataValues;
        $this->pointMarker = $marker;
<<<<<<< HEAD
        if ($fillColor !== null) {
            $this->setFillColor($fillColor);
        }
        if (is_numeric($pointSize)) {
            $this->pointSize = (int) $pointSize;
        }
=======
        $this->fillColor = $fillColor;
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Get Series Data Type.
     *
     * @return string
     */
    public function getDataType()
    {
        return $this->dataType;
    }

    /**
     * Set Series Data Type.
     *
     * @param string $dataType Datatype of this data series
     *                                Typical values are:
     *                                    DataSeriesValues::DATASERIES_TYPE_STRING
     *                                        Normally used for axis point values
     *                                    DataSeriesValues::DATASERIES_TYPE_NUMBER
     *                                        Normally used for chart data values
     *
     * @return $this
     */
    public function setDataType($dataType)
    {
<<<<<<< HEAD
        if (!in_array($dataType, self::DATA_TYPE_VALUES)) {
=======
        if (!in_array($dataType, self::$dataTypeValues)) {
>>>>>>> forked/LAE_400_PACKAGE
            throw new Exception('Invalid datatype for chart data series values');
        }
        $this->dataType = $dataType;

        return $this;
    }

    /**
     * Get Series Data Source (formula).
     *
<<<<<<< HEAD
     * @return ?string
=======
     * @return string
>>>>>>> forked/LAE_400_PACKAGE
     */
    public function getDataSource()
    {
        return $this->dataSource;
    }

    /**
     * Set Series Data Source (formula).
     *
<<<<<<< HEAD
     * @param ?string $dataSource
=======
     * @param string $dataSource
>>>>>>> forked/LAE_400_PACKAGE
     *
     * @return $this
     */
    public function setDataSource($dataSource)
    {
        $this->dataSource = $dataSource;

        return $this;
    }

    /**
     * Get Point Marker.
     *
     * @return string
     */
    public function getPointMarker()
    {
        return $this->pointMarker;
    }

    /**
     * Set Point Marker.
     *
     * @param string $marker
     *
     * @return $this
     */
    public function setPointMarker($marker)
    {
        $this->pointMarker = $marker;

        return $this;
    }

<<<<<<< HEAD
    public function getMarkerFillColor(): ChartColor
    {
        return $this->markerFillColor;
    }

    public function getMarkerBorderColor(): ChartColor
    {
        return $this->markerBorderColor;
    }

    /**
     * Get Point Size.
     */
    public function getPointSize(): int
    {
        return $this->pointSize;
    }

    /**
     * Set Point Size.
     *
     * @return $this
     */
    public function setPointSize(int $size = 3)
    {
        $this->pointSize = $size;

        return $this;
    }

=======
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * Get Series Format Code.
     *
     * @return string
     */
    public function getFormatCode()
    {
        return $this->formatCode;
    }

    /**
     * Set Series Format Code.
     *
     * @param string $formatCode
     *
     * @return $this
     */
    public function setFormatCode($formatCode)
    {
        $this->formatCode = $formatCode;

        return $this;
    }

    /**
     * Get Series Point Count.
     *
     * @return int
     */
    public function getPointCount()
    {
        return $this->pointCount;
    }

    /**
<<<<<<< HEAD
     * Get fill color object.
     *
     * @return null|ChartColor|ChartColor[]
     */
    public function getFillColorObject()
    {
        return $this->fillColor;
    }

    private function stringToChartColor(string $fillString): ChartColor
    {
        $value = $type = '';
        if (substr($fillString, 0, 1) === '*') {
            $type = 'schemeClr';
            $value = substr($fillString, 1);
        } elseif (substr($fillString, 0, 1) === '/') {
            $type = 'prstClr';
            $value = substr($fillString, 1);
        } elseif ($fillString !== '') {
            $type = 'srgbClr';
            $value = $fillString;
            $this->validateColor($value);
        }

        return new ChartColor($value, null, $type);
    }

    private function chartColorToString(ChartColor $chartColor): string
    {
        $type = (string) $chartColor->getColorProperty('type');
        $value = (string) $chartColor->getColorProperty('value');
        if ($type === '' || $value === '') {
            return '';
        }
        if ($type === 'schemeClr') {
            return "*$value";
        }
        if ($type === 'prstClr') {
            return "/$value";
        }

        return $value;
    }

    /**
=======
>>>>>>> forked/LAE_400_PACKAGE
     * Get fill color.
     *
     * @return string|string[] HEX color or array with HEX colors
     */
    public function getFillColor()
    {
<<<<<<< HEAD
        if ($this->fillColor === null) {
            return '';
        }
        if (is_array($this->fillColor)) {
            $array = [];
            foreach ($this->fillColor as $chartColor) {
                $array[] = $this->chartColorToString($chartColor);
            }

            return $array;
        }

        return $this->chartColorToString($this->fillColor);
=======
        return $this->fillColor;
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Set fill color for series.
     *
<<<<<<< HEAD
     * @param ChartColor|ChartColor[]|string|string[] $color HEX color or array with HEX colors
=======
     * @param string|string[] $color HEX color or array with HEX colors
>>>>>>> forked/LAE_400_PACKAGE
     *
     * @return   DataSeriesValues
     */
    public function setFillColor($color)
    {
        if (is_array($color)) {
<<<<<<< HEAD
            $this->fillColor = [];
            foreach ($color as $fillString) {
                if ($fillString instanceof ChartColor) {
                    $this->fillColor[] = $fillString;
                } else {
                    $this->fillColor[] = $this->stringToChartColor($fillString);
                }
            }
        } elseif ($color instanceof ChartColor) {
            $this->fillColor = $color;
        } else {
            $this->fillColor = $this->stringToChartColor($color);
        }
=======
            foreach ($color as $colorValue) {
                $this->validateColor($colorValue);
            }
        } else {
            $this->validateColor($color);
        }
        $this->fillColor = $color;
>>>>>>> forked/LAE_400_PACKAGE

        return $this;
    }

    /**
     * Method for validating hex color.
     *
     * @param string $color value for color
     *
     * @return bool true if validation was successful
     */
    private function validateColor($color)
    {
        if (!preg_match('/^[a-f0-9]{6}$/i', $color)) {
            throw new Exception(sprintf('Invalid hex color for chart series (color: "%s")', $color));
        }

        return true;
    }

    /**
     * Get line width for series.
     *
<<<<<<< HEAD
     * @return null|float|int
     */
    public function getLineWidth()
    {
        return $this->lineStyleProperties['width'];
=======
     * @return int
     */
    public function getLineWidth()
    {
        return $this->lineWidth;
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Set line width for the series.
     *
<<<<<<< HEAD
     * @param null|float|int $width
=======
     * @param int $width
>>>>>>> forked/LAE_400_PACKAGE
     *
     * @return $this
     */
    public function setLineWidth($width)
    {
<<<<<<< HEAD
        $this->lineStyleProperties['width'] = $width;
=======
        $minWidth = 12700;
        $this->lineWidth = max($minWidth, $width);
>>>>>>> forked/LAE_400_PACKAGE

        return $this;
    }

    /**
     * Identify if the Data Series is a multi-level or a simple series.
     *
     * @return null|bool
     */
    public function isMultiLevelSeries()
    {
<<<<<<< HEAD
        if (!empty($this->dataValues)) {
=======
        if (count($this->dataValues) > 0) {
>>>>>>> forked/LAE_400_PACKAGE
            return is_array(array_values($this->dataValues)[0]);
        }

        return null;
    }

    /**
     * Return the level count of a multi-level Data Series.
     *
     * @return int
     */
    public function multiLevelCount()
    {
        $levelCount = 0;
        foreach ($this->dataValues as $dataValueSet) {
            $levelCount = max($levelCount, count($dataValueSet));
        }

        return $levelCount;
    }

    /**
     * Get Series Data Values.
     *
     * @return mixed[]
     */
    public function getDataValues()
    {
        return $this->dataValues;
    }

    /**
     * Get the first Series Data value.
     *
     * @return mixed
     */
    public function getDataValue()
    {
        $count = count($this->dataValues);
        if ($count == 0) {
            return null;
        } elseif ($count == 1) {
            return $this->dataValues[0];
        }

        return $this->dataValues;
    }

    /**
     * Set Series Data Values.
     *
     * @param array $dataValues
     *
     * @return $this
     */
    public function setDataValues($dataValues)
    {
        $this->dataValues = Functions::flattenArray($dataValues);
        $this->pointCount = count($dataValues);

        return $this;
    }

<<<<<<< HEAD
    public function refresh(Worksheet $worksheet, bool $flatten = true): void
=======
    public function refresh(Worksheet $worksheet, $flatten = true): void
>>>>>>> forked/LAE_400_PACKAGE
    {
        if ($this->dataSource !== null) {
            $calcEngine = Calculation::getInstance($worksheet->getParent());
            $newDataValues = Calculation::unwrapResult(
                $calcEngine->_calculateFormulaValue(
                    '=' . $this->dataSource,
                    null,
                    $worksheet->getCell('A1')
                )
            );
            if ($flatten) {
                $this->dataValues = Functions::flattenArray($newDataValues);
                foreach ($this->dataValues as &$dataValue) {
                    if (is_string($dataValue) && !empty($dataValue) && $dataValue[0] == '#') {
                        $dataValue = 0.0;
                    }
                }
                unset($dataValue);
            } else {
                [$worksheet, $cellRange] = Worksheet::extractSheetTitle($this->dataSource, true);
                $dimensions = Coordinate::rangeDimension(str_replace('$', '', $cellRange));
                if (($dimensions[0] == 1) || ($dimensions[1] == 1)) {
                    $this->dataValues = Functions::flattenArray($newDataValues);
                } else {
                    $newArray = array_values(array_shift($newDataValues));
                    foreach ($newArray as $i => $newDataSet) {
                        $newArray[$i] = [$newDataSet];
                    }

                    foreach ($newDataValues as $newDataSet) {
                        $i = 0;
                        foreach ($newDataSet as $newDataVal) {
                            array_unshift($newArray[$i++], $newDataVal);
                        }
                    }
                    $this->dataValues = $newArray;
                }
            }
            $this->pointCount = count($this->dataValues);
        }
    }
<<<<<<< HEAD

    public function getScatterLines(): bool
    {
        return $this->scatterLines;
    }

    public function setScatterLines(bool $scatterLines): self
    {
        $this->scatterLines = $scatterLines;

        return $this;
    }

    public function getBubble3D(): bool
    {
        return $this->bubble3D;
    }

    public function setBubble3D(bool $bubble3D): self
    {
        $this->bubble3D = $bubble3D;

        return $this;
    }

    /**
     * Smooth Line. Must be specified for both DataSeries and DataSeriesValues.
     *
     * @var bool
     */
    private $smoothLine;

    /**
     * Get Smooth Line.
     *
     * @return bool
     */
    public function getSmoothLine()
    {
        return $this->smoothLine;
    }

    /**
     * Set Smooth Line.
     *
     * @param bool $smoothLine
     *
     * @return $this
     */
    public function setSmoothLine($smoothLine)
    {
        $this->smoothLine = $smoothLine;

        return $this;
    }

    public function getLabelLayout(): ?Layout
    {
        return $this->labelLayout;
    }

    public function setLabelLayout(?Layout $labelLayout): self
    {
        $this->labelLayout = $labelLayout;

        return $this;
    }

    public function setTrendLines(array $trendLines): self
    {
        $this->trendLines = $trendLines;

        return $this;
    }

    public function getTrendLines(): array
    {
        return $this->trendLines;
    }
=======
>>>>>>> forked/LAE_400_PACKAGE
}
