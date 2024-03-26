<?php

namespace PhpOffice\PhpSpreadsheet\Chart;

class Legend
{
    /** Legend positions */
    const XL_LEGEND_POSITION_BOTTOM = -4107; //    Below the chart.
    const XL_LEGEND_POSITION_CORNER = 2; //    In the upper right-hand corner of the chart border.
    const XL_LEGEND_POSITION_CUSTOM = -4161; //    A custom position.
    const XL_LEGEND_POSITION_LEFT = -4131; //    Left of the chart.
    const XL_LEGEND_POSITION_RIGHT = -4152; //    Right of the chart.
    const XL_LEGEND_POSITION_TOP = -4160; //    Above the chart.

    const POSITION_RIGHT = 'r';
    const POSITION_LEFT = 'l';
    const POSITION_BOTTOM = 'b';
    const POSITION_TOP = 't';
    const POSITION_TOPRIGHT = 'tr';

<<<<<<< HEAD
    const POSITION_XLREF = [
=======
    private static $positionXLref = [
>>>>>>> forked/LAE_400_PACKAGE
        self::XL_LEGEND_POSITION_BOTTOM => self::POSITION_BOTTOM,
        self::XL_LEGEND_POSITION_CORNER => self::POSITION_TOPRIGHT,
        self::XL_LEGEND_POSITION_CUSTOM => '??',
        self::XL_LEGEND_POSITION_LEFT => self::POSITION_LEFT,
        self::XL_LEGEND_POSITION_RIGHT => self::POSITION_RIGHT,
        self::XL_LEGEND_POSITION_TOP => self::POSITION_TOP,
    ];

    /**
     * Legend position.
     *
     * @var string
     */
    private $position = self::POSITION_RIGHT;

    /**
     * Allow overlay of other elements?
     *
     * @var bool
     */
    private $overlay = true;

    /**
     * Legend Layout.
     *
<<<<<<< HEAD
     * @var ?Layout
=======
     * @var Layout
>>>>>>> forked/LAE_400_PACKAGE
     */
    private $layout;

    /**
     * Create a new Legend.
     *
     * @param string $position
     * @param bool $overlay
     */
    public function __construct($position = self::POSITION_RIGHT, ?Layout $layout = null, $overlay = false)
    {
        $this->setPosition($position);
        $this->layout = $layout;
        $this->setOverlay($overlay);
    }

    /**
     * Get legend position as an excel string value.
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Get legend position using an excel string value.
     *
     * @param string $position see self::POSITION_*
     *
     * @return bool
     */
    public function setPosition($position)
    {
<<<<<<< HEAD
        if (!in_array($position, self::POSITION_XLREF)) {
=======
        if (!in_array($position, self::$positionXLref)) {
>>>>>>> forked/LAE_400_PACKAGE
            return false;
        }

        $this->position = $position;

        return true;
    }

    /**
     * Get legend position as an Excel internal numeric value.
     *
<<<<<<< HEAD
     * @return false|int
     */
    public function getPositionXL()
    {
        return array_search($this->position, self::POSITION_XLREF);
=======
     * @return int
     */
    public function getPositionXL()
    {
        return array_search($this->position, self::$positionXLref);
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Set legend position using an Excel internal numeric value.
     *
     * @param int $positionXL see self::XL_LEGEND_POSITION_*
     *
     * @return bool
     */
    public function setPositionXL($positionXL)
    {
<<<<<<< HEAD
        if (!isset(self::POSITION_XLREF[$positionXL])) {
            return false;
        }

        $this->position = self::POSITION_XLREF[$positionXL];
=======
        if (!isset(self::$positionXLref[$positionXL])) {
            return false;
        }

        $this->position = self::$positionXLref[$positionXL];
>>>>>>> forked/LAE_400_PACKAGE

        return true;
    }

    /**
     * Get allow overlay of other elements?
     *
     * @return bool
     */
    public function getOverlay()
    {
        return $this->overlay;
    }

    /**
     * Set allow overlay of other elements?
     *
     * @param bool $overlay
     */
    public function setOverlay($overlay): void
    {
        $this->overlay = $overlay;
    }

    /**
     * Get Layout.
     *
<<<<<<< HEAD
     * @return ?Layout
=======
     * @return Layout
>>>>>>> forked/LAE_400_PACKAGE
     */
    public function getLayout()
    {
        return $this->layout;
    }
}
