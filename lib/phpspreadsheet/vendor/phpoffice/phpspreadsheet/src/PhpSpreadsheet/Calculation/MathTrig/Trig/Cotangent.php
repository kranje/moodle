<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Trig;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
=======
>>>>>>> forked/LAE_400_PACKAGE
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Helpers;

class Cotangent
{
<<<<<<< HEAD
    use ArrayEnabled;

=======
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * COT.
     *
     * Returns the cotangent of an angle.
     *
<<<<<<< HEAD
     * @param array|float $angle Number, or can be an array of numbers
     *
     * @return array|float|string The cotangent of the angle
     *         If an array of numbers is passed as the argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function cot($angle)
    {
        if (is_array($angle)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $angle);
        }

=======
     * @param float $angle Number
     *
     * @return float|string The cotangent of the angle
     */
    public static function cot($angle)
    {
>>>>>>> forked/LAE_400_PACKAGE
        try {
            $angle = Helpers::validateNumericNullBool($angle);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return Helpers::verySmallDenominator(cos($angle), sin($angle));
    }

    /**
     * COTH.
     *
     * Returns the hyperbolic cotangent of an angle.
     *
<<<<<<< HEAD
     * @param array|float $angle Number, or can be an array of numbers
     *
     * @return array|float|string The hyperbolic cotangent of the angle
     *         If an array of numbers is passed as the argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function coth($angle)
    {
        if (is_array($angle)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $angle);
        }

=======
     * @param float $angle Number
     *
     * @return float|string The hyperbolic cotangent of the angle
     */
    public static function coth($angle)
    {
>>>>>>> forked/LAE_400_PACKAGE
        try {
            $angle = Helpers::validateNumericNullBool($angle);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return Helpers::verySmallDenominator(1.0, tanh($angle));
    }

    /**
     * ACOT.
     *
     * Returns the arccotangent of a number.
     *
<<<<<<< HEAD
     * @param array|float $number Number, or can be an array of numbers
     *
     * @return array|float|string The arccotangent of the number
     *         If an array of numbers is passed as the argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function acot($number)
    {
        if (is_array($number)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $number);
        }

=======
     * @param float $number Number
     *
     * @return float|string The arccotangent of the number
     */
    public static function acot($number)
    {
>>>>>>> forked/LAE_400_PACKAGE
        try {
            $number = Helpers::validateNumericNullBool($number);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return (M_PI / 2) - atan($number);
    }

    /**
     * ACOTH.
     *
     * Returns the hyperbolic arccotangent of a number.
     *
<<<<<<< HEAD
     * @param array|float $number Number, or can be an array of numbers
     *
     * @return array|float|string The hyperbolic arccotangent of the number
     *         If an array of numbers is passed as the argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function acoth($number)
    {
        if (is_array($number)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $number);
        }

=======
     * @param float $number Number
     *
     * @return float|string The hyperbolic arccotangent of the number
     */
    public static function acoth($number)
    {
>>>>>>> forked/LAE_400_PACKAGE
        try {
            $number = Helpers::validateNumericNullBool($number);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $result = ($number === 1) ? NAN : (log(($number + 1) / ($number - 1)) / 2);

        return Helpers::numberOrNan($result);
    }
}
