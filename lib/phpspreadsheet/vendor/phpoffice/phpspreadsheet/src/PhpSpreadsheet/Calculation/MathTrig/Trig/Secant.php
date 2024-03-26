<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Trig;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
=======
>>>>>>> forked/LAE_400_PACKAGE
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Helpers;

class Secant
{
<<<<<<< HEAD
    use ArrayEnabled;

=======
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * SEC.
     *
     * Returns the secant of an angle.
     *
<<<<<<< HEAD
     * @param array|float $angle Number, or can be an array of numbers
     *
     * @return array|float|string The secant of the angle
     *         If an array of numbers is passed as the argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function sec($angle)
    {
        if (is_array($angle)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $angle);
        }

=======
     * @param float $angle Number
     *
     * @return float|string The secant of the angle
     */
    public static function sec($angle)
    {
>>>>>>> forked/LAE_400_PACKAGE
        try {
            $angle = Helpers::validateNumericNullBool($angle);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return Helpers::verySmallDenominator(1.0, cos($angle));
    }

    /**
     * SECH.
     *
     * Returns the hyperbolic secant of an angle.
     *
<<<<<<< HEAD
     * @param array|float $angle Number, or can be an array of numbers
     *
     * @return array|float|string The hyperbolic secant of the angle
     *         If an array of numbers is passed as the argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function sech($angle)
    {
        if (is_array($angle)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $angle);
        }

=======
     * @param float $angle Number
     *
     * @return float|string The hyperbolic secant of the angle
     */
    public static function sech($angle)
    {
>>>>>>> forked/LAE_400_PACKAGE
        try {
            $angle = Helpers::validateNumericNullBool($angle);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return Helpers::verySmallDenominator(1.0, cosh($angle));
    }
}
