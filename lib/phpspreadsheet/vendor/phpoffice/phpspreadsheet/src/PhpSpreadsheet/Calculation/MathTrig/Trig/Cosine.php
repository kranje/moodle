<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Trig;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
=======
>>>>>>> forked/LAE_400_PACKAGE
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Helpers;

class Cosine
{
<<<<<<< HEAD
    use ArrayEnabled;

=======
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * COS.
     *
     * Returns the result of builtin function cos after validating args.
     *
<<<<<<< HEAD
     * @param mixed $number Should be numeric, or can be an array of numbers
     *
     * @return array|float|string cosine
     *         If an array of numbers is passed as the argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function cos($number)
    {
        if (is_array($number)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $number);
        }

=======
     * @param mixed $number Should be numeric
     *
     * @return float|string cosine
     */
    public static function cos($number)
    {
>>>>>>> forked/LAE_400_PACKAGE
        try {
            $number = Helpers::validateNumericNullBool($number);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return cos($number);
    }

    /**
     * COSH.
     *
     * Returns the result of builtin function cosh after validating args.
     *
<<<<<<< HEAD
     * @param mixed $number Should be numeric, or can be an array of numbers
     *
     * @return array|float|string hyperbolic cosine
     *         If an array of numbers is passed as the argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function cosh($number)
    {
        if (is_array($number)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $number);
        }

=======
     * @param mixed $number Should be numeric
     *
     * @return float|string hyperbolic cosine
     */
    public static function cosh($number)
    {
>>>>>>> forked/LAE_400_PACKAGE
        try {
            $number = Helpers::validateNumericNullBool($number);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return cosh($number);
    }

    /**
     * ACOS.
     *
     * Returns the arccosine of a number.
     *
<<<<<<< HEAD
     * @param array|float $number Number, or can be an array of numbers
     *
     * @return array|float|string The arccosine of the number
     *         If an array of numbers is passed as the argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function acos($number)
    {
        if (is_array($number)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $number);
        }

=======
     * @param float $number Number
     *
     * @return float|string The arccosine of the number
     */
    public static function acos($number)
    {
>>>>>>> forked/LAE_400_PACKAGE
        try {
            $number = Helpers::validateNumericNullBool($number);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return Helpers::numberOrNan(acos($number));
    }

    /**
     * ACOSH.
     *
     * Returns the arc inverse hyperbolic cosine of a number.
     *
<<<<<<< HEAD
     * @param array|float $number Number, or can be an array of numbers
     *
     * @return array|float|string The inverse hyperbolic cosine of the number, or an error string
     *         If an array of numbers is passed as the argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function acosh($number)
    {
        if (is_array($number)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $number);
        }

=======
     * @param float $number Number
     *
     * @return float|string The inverse hyperbolic cosine of the number, or an error string
     */
    public static function acosh($number)
    {
>>>>>>> forked/LAE_400_PACKAGE
        try {
            $number = Helpers::validateNumericNullBool($number);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return Helpers::numberOrNan(acosh($number));
    }
}
