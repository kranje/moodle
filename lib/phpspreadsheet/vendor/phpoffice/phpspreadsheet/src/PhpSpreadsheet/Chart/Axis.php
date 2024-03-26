<?php

namespace PhpOffice\PhpSpreadsheet\Chart;

/**
 * Created by PhpStorm.
 * User: Wiktor Trzonkowski
 * Date: 6/17/14
 * Time: 12:11 PM.
 */
class Axis extends Properties
{
<<<<<<< HEAD
    const AXIS_TYPE_CATEGORY = 'catAx';
    const AXIS_TYPE_DATE = 'dateAx';
    const AXIS_TYPE_VALUE = 'valAx';

    const TIME_UNIT_DAYS = 'days';
    const TIME_UNIT_MONTHS = 'months';
    const TIME_UNIT_YEARS = 'years';

    public function __construct()
    {
        parent::__construct();
        $this->fillColor = new ChartColor();
    }

    /**
     * Chart Major Gridlines as.
     *
     * @var ?GridLines
     */
    private $majorGridlines;

    /**
     * Chart Minor Gridlines as.
     *
     * @var ?GridLines
     */
    private $minorGridlines;

=======
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * Axis Number.
     *
     * @var mixed[]
     */
    private $axisNumber = [
        'format' => self::FORMAT_CODE_GENERAL,
        'source_linked' => 1,
<<<<<<< HEAD
        'numeric' => null,
    ];

    /** @var string */
    private $axisType = '';

=======
    ];

>>>>>>> forked/LAE_400_PACKAGE
    /**
     * Axis Options.
     *
     * @var mixed[]
     */
    private $axisOptions = [
        'minimum' => null,
        'maximum' => null,
        'major_unit' => null,
        'minor_unit' => null,
        'orientation' => self::ORIENTATION_NORMAL,
        'minor_tick_mark' => self::TICK_MARK_NONE,
        'major_tick_mark' => self::TICK_MARK_NONE,
        'axis_labels' => self::AXIS_LABELS_NEXT_TO,
        'horizontal_crosses' => self::HORIZONTAL_CROSSES_AUTOZERO,
        'horizontal_crosses_value' => null,
<<<<<<< HEAD
        'textRotation' => null,
        'hidden' => null,
        'majorTimeUnit' => self::TIME_UNIT_YEARS,
        'minorTimeUnit' => self::TIME_UNIT_MONTHS,
        'baseTimeUnit' => self::TIME_UNIT_DAYS,
=======
>>>>>>> forked/LAE_400_PACKAGE
    ];

    /**
     * Fill Properties.
     *
<<<<<<< HEAD
     * @var ChartColor
     */
    private $fillColor;

    private const NUMERIC_FORMAT = [
        Properties::FORMAT_CODE_NUMBER,
        Properties::FORMAT_CODE_DATE,
        Properties::FORMAT_CODE_DATE_ISO8601,
=======
     * @var mixed[]
     */
    private $fillProperties = [
        'type' => self::EXCEL_COLOR_TYPE_ARGB,
        'value' => null,
        'alpha' => 0,
    ];

    /**
     * Line Properties.
     *
     * @var mixed[]
     */
    private $lineProperties = [
        'type' => self::EXCEL_COLOR_TYPE_ARGB,
        'value' => null,
        'alpha' => 0,
    ];

    /**
     * Line Style Properties.
     *
     * @var mixed[]
     */
    private $lineStyleProperties = [
        'width' => '9525',
        'compound' => self::LINE_STYLE_COMPOUND_SIMPLE,
        'dash' => self::LINE_STYLE_DASH_SOLID,
        'cap' => self::LINE_STYLE_CAP_FLAT,
        'join' => self::LINE_STYLE_JOIN_BEVEL,
        'arrow' => [
            'head' => [
                'type' => self::LINE_STYLE_ARROW_TYPE_NOARROW,
                'size' => self::LINE_STYLE_ARROW_SIZE_5,
            ],
            'end' => [
                'type' => self::LINE_STYLE_ARROW_TYPE_NOARROW,
                'size' => self::LINE_STYLE_ARROW_SIZE_8,
            ],
        ],
    ];

    /**
     * Shadow Properties.
     *
     * @var mixed[]
     */
    private $shadowProperties = [
        'presets' => self::SHADOW_PRESETS_NOSHADOW,
        'effect' => null,
        'color' => [
            'type' => self::EXCEL_COLOR_TYPE_STANDARD,
            'value' => 'black',
            'alpha' => 40,
        ],
        'size' => [
            'sx' => null,
            'sy' => null,
            'kx' => null,
        ],
        'blur' => null,
        'direction' => null,
        'distance' => null,
        'algn' => null,
        'rotWithShape' => null,
    ];

    /**
     * Glow Properties.
     *
     * @var mixed[]
     */
    private $glowProperties = [
        'size' => null,
        'color' => [
            'type' => self::EXCEL_COLOR_TYPE_STANDARD,
            'value' => 'black',
            'alpha' => 40,
        ],
    ];

    /**
     * Soft Edge Properties.
     *
     * @var mixed[]
     */
    private $softEdges = [
        'size' => null,
>>>>>>> forked/LAE_400_PACKAGE
    ];

    /**
     * Get Series Data Type.
     *
     * @param mixed $format_code
     */
<<<<<<< HEAD
    public function setAxisNumberProperties($format_code, ?bool $numeric = null, int $sourceLinked = 0): void
    {
        $format = (string) $format_code;
        $this->axisNumber['format'] = $format;
        $this->axisNumber['source_linked'] = $sourceLinked;
        if (is_bool($numeric)) {
            $this->axisNumber['numeric'] = $numeric;
        } elseif (in_array($format, self::NUMERIC_FORMAT, true)) {
            $this->axisNumber['numeric'] = true;
        }
=======
    public function setAxisNumberProperties($format_code): void
    {
        $this->axisNumber['format'] = (string) $format_code;
        $this->axisNumber['source_linked'] = 0;
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Get Axis Number Format Data Type.
     *
     * @return string
     */
    public function getAxisNumberFormat()
    {
        return $this->axisNumber['format'];
    }

    /**
     * Get Axis Number Source Linked.
     *
     * @return string
     */
    public function getAxisNumberSourceLinked()
    {
        return (string) $this->axisNumber['source_linked'];
    }

<<<<<<< HEAD
    public function getAxisIsNumericFormat(): bool
    {
        return $this->axisType === self::AXIS_TYPE_DATE || (bool) $this->axisNumber['numeric'];
    }

    public function setAxisOption(string $key, ?string $value): void
    {
        if ($value !== null && $value !== '') {
            $this->axisOptions[$key] = $value;
        }
    }

    /**
     * Set Axis Options Properties.
     */
    public function setAxisOptionsProperties(
        string $axisLabels,
        ?string $horizontalCrossesValue = null,
        ?string $horizontalCrosses = null,
        ?string $axisOrientation = null,
        ?string $majorTmt = null,
        ?string $minorTmt = null,
        ?string $minimum = null,
        ?string $maximum = null,
        ?string $majorUnit = null,
        ?string $minorUnit = null,
        ?string $textRotation = null,
        ?string $hidden = null,
        ?string $baseTimeUnit = null,
        ?string $majorTimeUnit = null,
        ?string $minorTimeUnit = null
    ): void {
        $this->axisOptions['axis_labels'] = $axisLabels;
        $this->setAxisOption('horizontal_crosses_value', $horizontalCrossesValue);
        $this->setAxisOption('horizontal_crosses', $horizontalCrosses);
        $this->setAxisOption('orientation', $axisOrientation);
        $this->setAxisOption('major_tick_mark', $majorTmt);
        $this->setAxisOption('minor_tick_mark', $minorTmt);
        $this->setAxisOption('minimum', $minimum);
        $this->setAxisOption('maximum', $maximum);
        $this->setAxisOption('major_unit', $majorUnit);
        $this->setAxisOption('minor_unit', $minorUnit);
        $this->setAxisOption('textRotation', $textRotation);
        $this->setAxisOption('hidden', $hidden);
        $this->setAxisOption('baseTimeUnit', $baseTimeUnit);
        $this->setAxisOption('majorTimeUnit', $majorTimeUnit);
        $this->setAxisOption('minorTimeUnit', $minorTimeUnit);
=======
    /**
     * Set Axis Options Properties.
     *
     * @param string $axisLabels
     * @param string $horizontalCrossesValue
     * @param string $horizontalCrosses
     * @param string $axisOrientation
     * @param string $majorTmt
     * @param string $minorTmt
     * @param string $minimum
     * @param string $maximum
     * @param string $majorUnit
     * @param string $minorUnit
     */
    public function setAxisOptionsProperties($axisLabels, $horizontalCrossesValue = null, $horizontalCrosses = null, $axisOrientation = null, $majorTmt = null, $minorTmt = null, $minimum = null, $maximum = null, $majorUnit = null, $minorUnit = null): void
    {
        $this->axisOptions['axis_labels'] = (string) $axisLabels;
        ($horizontalCrossesValue !== null) ? $this->axisOptions['horizontal_crosses_value'] = (string) $horizontalCrossesValue : null;
        ($horizontalCrosses !== null) ? $this->axisOptions['horizontal_crosses'] = (string) $horizontalCrosses : null;
        ($axisOrientation !== null) ? $this->axisOptions['orientation'] = (string) $axisOrientation : null;
        ($majorTmt !== null) ? $this->axisOptions['major_tick_mark'] = (string) $majorTmt : null;
        ($minorTmt !== null) ? $this->axisOptions['minor_tick_mark'] = (string) $minorTmt : null;
        ($minorTmt !== null) ? $this->axisOptions['minor_tick_mark'] = (string) $minorTmt : null;
        ($minimum !== null) ? $this->axisOptions['minimum'] = (string) $minimum : null;
        ($maximum !== null) ? $this->axisOptions['maximum'] = (string) $maximum : null;
        ($majorUnit !== null) ? $this->axisOptions['major_unit'] = (string) $majorUnit : null;
        ($minorUnit !== null) ? $this->axisOptions['minor_unit'] = (string) $minorUnit : null;
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Get Axis Options Property.
     *
     * @param string $property
     *
<<<<<<< HEAD
     * @return ?string
=======
     * @return string
>>>>>>> forked/LAE_400_PACKAGE
     */
    public function getAxisOptionsProperty($property)
    {
        return $this->axisOptions[$property];
    }

    /**
     * Set Axis Orientation Property.
     *
     * @param string $orientation
     */
    public function setAxisOrientation($orientation): void
    {
        $this->axisOptions['orientation'] = (string) $orientation;
    }

<<<<<<< HEAD
    public function getAxisType(): string
    {
        return $this->axisType;
    }

    public function setAxisType(string $type): self
    {
        if ($type === self::AXIS_TYPE_CATEGORY || $type === self::AXIS_TYPE_VALUE || $type === self::AXIS_TYPE_DATE) {
            $this->axisType = $type;
        } else {
            $this->axisType = '';
        }

        return $this;
    }

    /**
     * Set Fill Property.
     *
     * @param ?string $color
     * @param ?int $alpha
     * @param ?string $AlphaType
     */
    public function setFillParameters($color, $alpha = null, $AlphaType = ChartColor::EXCEL_COLOR_TYPE_RGB): void
    {
        $this->fillColor->setColorProperties($color, $alpha, $AlphaType);
=======
    /**
     * Set Fill Property.
     *
     * @param string $color
     * @param int $alpha
     * @param string $AlphaType
     */
    public function setFillParameters($color, $alpha = 0, $AlphaType = self::EXCEL_COLOR_TYPE_ARGB): void
    {
        $this->fillProperties = $this->setColorProperties($color, $alpha, $AlphaType);
    }

    /**
     * Set Line Property.
     *
     * @param string $color
     * @param int $alpha
     * @param string $alphaType
     */
    public function setLineParameters($color, $alpha = 0, $alphaType = self::EXCEL_COLOR_TYPE_ARGB): void
    {
        $this->lineProperties = $this->setColorProperties($color, $alpha, $alphaType);
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Get Fill Property.
     *
     * @param string $property
     *
     * @return string
     */
    public function getFillProperty($property)
    {
<<<<<<< HEAD
        return (string) $this->fillColor->getColorProperty($property);
    }

    public function getFillColorObject(): ChartColor
    {
        return $this->fillColor;
    }

    /**
     * Get Line Color Property.
     *
     * @Deprecated 1.24.0
     *
     * @See Properties::getLineColorProperty()
     *      Use the getLineColor property in the Properties class instead
     *
     * @param string $propertyName
     *
     * @return null|int|string
     */
    public function getLineProperty($propertyName)
    {
        return $this->getLineColorProperty($propertyName);
    }

    /** @var string */
    private $crossBetween = ''; // 'between' or 'midCat' might be better

    public function setCrossBetween(string $crossBetween): self
    {
        $this->crossBetween = $crossBetween;
=======
        return $this->fillProperties[$property];
    }

    /**
     * Get Line Property.
     *
     * @param string $property
     *
     * @return string
     */
    public function getLineProperty($property)
    {
        return $this->lineProperties[$property];
    }

    /**
     * Set Line Style Properties.
     *
     * @param float $lineWidth
     * @param string $compoundType
     * @param string $dashType
     * @param string $capType
     * @param string $joinType
     * @param string $headArrowType
     * @param string $headArrowSize
     * @param string $endArrowType
     * @param string $endArrowSize
     */
    public function setLineStyleProperties($lineWidth = null, $compoundType = null, $dashType = null, $capType = null, $joinType = null, $headArrowType = null, $headArrowSize = null, $endArrowType = null, $endArrowSize = null): void
    {
        ($lineWidth !== null) ? $this->lineStyleProperties['width'] = $this->getExcelPointsWidth((float) $lineWidth) : null;
        ($compoundType !== null) ? $this->lineStyleProperties['compound'] = (string) $compoundType : null;
        ($dashType !== null) ? $this->lineStyleProperties['dash'] = (string) $dashType : null;
        ($capType !== null) ? $this->lineStyleProperties['cap'] = (string) $capType : null;
        ($joinType !== null) ? $this->lineStyleProperties['join'] = (string) $joinType : null;
        ($headArrowType !== null) ? $this->lineStyleProperties['arrow']['head']['type'] = (string) $headArrowType : null;
        ($headArrowSize !== null) ? $this->lineStyleProperties['arrow']['head']['size'] = (string) $headArrowSize : null;
        ($endArrowType !== null) ? $this->lineStyleProperties['arrow']['end']['type'] = (string) $endArrowType : null;
        ($endArrowSize !== null) ? $this->lineStyleProperties['arrow']['end']['size'] = (string) $endArrowSize : null;
    }

    /**
     * Get Line Style Property.
     *
     * @param array|string $elements
     *
     * @return string
     */
    public function getLineStyleProperty($elements)
    {
        return $this->getArrayElementsValue($this->lineStyleProperties, $elements);
    }

    /**
     * Get Line Style Arrow Excel Width.
     *
     * @param string $arrow
     *
     * @return string
     */
    public function getLineStyleArrowWidth($arrow)
    {
        return $this->getLineStyleArrowSize($this->lineStyleProperties['arrow'][$arrow]['size'], 'w');
    }

    /**
     * Get Line Style Arrow Excel Length.
     *
     * @param string $arrow
     *
     * @return string
     */
    public function getLineStyleArrowLength($arrow)
    {
        return $this->getLineStyleArrowSize($this->lineStyleProperties['arrow'][$arrow]['size'], 'len');
    }

    /**
     * Set Shadow Properties.
     *
     * @param int $shadowPresets
     * @param string $colorValue
     * @param string $colorType
     * @param string $colorAlpha
     * @param float $blur
     * @param int $angle
     * @param float $distance
     */
    public function setShadowProperties($shadowPresets, $colorValue = null, $colorType = null, $colorAlpha = null, $blur = null, $angle = null, $distance = null): void
    {
        $this->setShadowPresetsProperties((int) $shadowPresets)
            ->setShadowColor(
                $colorValue ?? $this->shadowProperties['color']['value'],
                $colorAlpha ?? (int) $this->shadowProperties['color']['alpha'],
                $colorType ?? $this->shadowProperties['color']['type']
            )
            ->setShadowBlur($blur)
            ->setShadowAngle($angle)
            ->setShadowDistance($distance);
    }

    /**
     * Set Shadow Color.
     *
     * @param int $presets
     *
     * @return $this
     */
    private function setShadowPresetsProperties($presets)
    {
        $this->shadowProperties['presets'] = $presets;
        $this->setShadowPropertiesMapValues($this->getShadowPresetsMap($presets));
>>>>>>> forked/LAE_400_PACKAGE

        return $this;
    }

<<<<<<< HEAD
    public function getCrossBetween(): string
    {
        return $this->crossBetween;
    }

    public function getMajorGridlines(): ?GridLines
    {
        return $this->majorGridlines;
    }

    public function getMinorGridlines(): ?GridLines
    {
        return $this->minorGridlines;
    }

    public function setMajorGridlines(?GridLines $gridlines): self
    {
        $this->majorGridlines = $gridlines;
=======
    /**
     * Set Shadow Properties from Mapped Values.
     *
     * @param mixed $reference
     *
     * @return $this
     */
    private function setShadowPropertiesMapValues(array $propertiesMap, &$reference = null)
    {
        $base_reference = $reference;
        foreach ($propertiesMap as $property_key => $property_val) {
            if (is_array($property_val)) {
                if ($reference === null) {
                    $reference = &$this->shadowProperties[$property_key];
                } else {
                    $reference = &$reference[$property_key];
                }
                $this->setShadowPropertiesMapValues($property_val, $reference);
            } else {
                if ($base_reference === null) {
                    $this->shadowProperties[$property_key] = $property_val;
                } else {
                    $reference[$property_key] = $property_val;
                }
            }
        }
>>>>>>> forked/LAE_400_PACKAGE

        return $this;
    }

<<<<<<< HEAD
    public function setMinorGridlines(?GridLines $gridlines): self
    {
        $this->minorGridlines = $gridlines;

        return $this;
    }
=======
    /**
     * Set Shadow Color.
     *
     * @param string $color
     * @param int $alpha
     * @param string $alphaType
     *
     * @return $this
     */
    private function setShadowColor($color, $alpha, $alphaType)
    {
        $this->shadowProperties['color'] = $this->setColorProperties($color, $alpha, $alphaType);

        return $this;
    }

    /**
     * Set Shadow Blur.
     *
     * @param float $blur
     *
     * @return $this
     */
    private function setShadowBlur($blur)
    {
        if ($blur !== null) {
            $this->shadowProperties['blur'] = (string) $this->getExcelPointsWidth($blur);
        }

        return $this;
    }

    /**
     * Set Shadow Angle.
     *
     * @param int $angle
     *
     * @return $this
     */
    private function setShadowAngle($angle)
    {
        if ($angle !== null) {
            $this->shadowProperties['direction'] = (string) $this->getExcelPointsAngle($angle);
        }

        return $this;
    }

    /**
     * Set Shadow Distance.
     *
     * @param float $distance
     *
     * @return $this
     */
    private function setShadowDistance($distance)
    {
        if ($distance !== null) {
            $this->shadowProperties['distance'] = (string) $this->getExcelPointsWidth($distance);
        }

        return $this;
    }

    /**
     * Get Shadow Property.
     *
     * @param string|string[] $elements
     *
     * @return null|array|int|string
     */
    public function getShadowProperty($elements)
    {
        return $this->getArrayElementsValue($this->shadowProperties, $elements);
    }

    /**
     * Set Glow Properties.
     *
     * @param float $size
     * @param string $colorValue
     * @param int $colorAlpha
     * @param string $colorType
     */
    public function setGlowProperties($size, $colorValue = null, $colorAlpha = null, $colorType = null): void
    {
        $this->setGlowSize($size)
            ->setGlowColor(
                $colorValue ?? $this->glowProperties['color']['value'],
                $colorAlpha ?? (int) $this->glowProperties['color']['alpha'],
                $colorType ?? $this->glowProperties['color']['type']
            );
    }

    /**
     * Get Glow Property.
     *
     * @param array|string $property
     *
     * @return string
     */
    public function getGlowProperty($property)
    {
        return $this->getArrayElementsValue($this->glowProperties, $property);
    }

    /**
     * Set Glow Color.
     *
     * @param float $size
     *
     * @return $this
     */
    private function setGlowSize($size)
    {
        if ($size !== null) {
            $this->glowProperties['size'] = $this->getExcelPointsWidth($size);
        }

        return $this;
    }

    /**
     * Set Glow Color.
     *
     * @param string $color
     * @param int $alpha
     * @param string $colorType
     *
     * @return $this
     */
    private function setGlowColor($color, $alpha, $colorType)
    {
        $this->glowProperties['color'] = $this->setColorProperties($color, $alpha, $colorType);

        return $this;
    }

    /**
     * Set Soft Edges Size.
     *
     * @param float $size
     */
    public function setSoftEdges($size): void
    {
        if ($size !== null) {
            $softEdges['size'] = (string) $this->getExcelPointsWidth($size);
        }
    }

    /**
     * Get Soft Edges Size.
     *
     * @return string
     */
    public function getSoftEdgesSize()
    {
        return $this->softEdges['size'];
    }
>>>>>>> forked/LAE_400_PACKAGE
}
