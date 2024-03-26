<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Trig;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
=======
>>>>>>> forked/LAE_400_PACKAGE
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Helpers;

class Sine
{
<<<<<<< HEAD
    use ArrayEnabled;

=======
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * SIN.
     *
     * Returns the result of builtin function sin after validating args.
     *
<<<<<<< HEAD
     * @param mixed $angle Should be numeric, or can be an array of numbers
     *
     * @return array|float|string sine
     *         If an array of numbers is passed as the argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function sin($angle)
    {
        if (is_array($angle)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $angle);
        }

=======
     * @param mixed $angle Should be numeric
     *
     * @return float|string sine
     */
    public static function sin($angle)
    {
>>>>>>> forked/LAE_400_PACKAGE
        try {
            $angle = Helpers::validateNumericNullBool($angle);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return sin($angle);
    }

    /**
     * SINH.
     *
     * Returns the result of builtin function sinh after validating args.
     *
<<<<<<< HEAD
     * @param mixed $angle Should be numeric, or can be an array of numbers
     *
     * @return array|float|string hyperbolic sine
     *         If an array of numbers is passed as the argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function sinh($angle)
    {
        if (is_array($angle)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $angle);
        }

=======
     * @param mixed $angle Should be numeric
     *
     * @return float|string hyperbolic sine
     */
    public static function sinh($angle)
    {
>>>>>>> forked/LAE_400_PACKAGE
        try {
            $angle = Helpers::validateNumericNullBool($angle);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return sinh($angle);
    }

    /**
     * ASIN.
     *
     * Returns the arcsine of a number.
     *
<<<<<<< HEAD
     * @param array|float $number Number, or can be an array of numbers
     *
     * @return array|float|string The arcsine of the number
     *         If an array of numbers is passed as the argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function asin($number)
    {
        if (is_array($number)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $number);
        }

=======
     * @param float $number Number
     *
     * @return float|string The arcsine of the number
     */
    public static function asin($number)
    {
>>>>>>> forked/LAE_400_PACKAGE
        try {
            $number = Helpers::validateNumericNullBool($number);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return Helpers::numberOrNan(asin($number));
    }

    /**
     * ASINH.
     *
     * Returns the inverse hyperbolic sine of a number.
     *
<<<<<<< HEAD
     * @param array|float $number Number, or can be an array of numbers
     *
     * @return array|float|string The inverse hyperbolic sine of the number
     *         If an array of numbers is passed as the argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function asinh($number)
    {
        if (is_array($number)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $number);
        }

=======
     * @param float $number Number
     *
     * @return float|string The inverse hyperbolic sine of the number
     */
    public static function asinh($number)
    {
>>>>>>> forked/LAE_400_PACKAGE
        try {
            $number = Helpers::validateNumericNullBool($number);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return Helpers::numberOrNan(asinh($number));
    }
}
