<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\MathTrig;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
=======
>>>>>>> forked/LAE_400_PACKAGE
use PhpOffice\PhpSpreadsheet\Calculation\Exception;

class Logarithms
{
<<<<<<< HEAD
    use ArrayEnabled;

=======
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * LOG_BASE.
     *
     * Returns the logarithm of a number to a specified base. The default base is 10.
     *
     * Excel Function:
     *        LOG(number[,base])
     *
     * @param mixed $number The positive real number for which you want the logarithm
<<<<<<< HEAD
     *                      Or can be an array of values
     * @param mixed $base The base of the logarithm. If base is omitted, it is assumed to be 10.
     *                      Or can be an array of values
     *
     * @return array|float|string The result, or a string containing an error
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function withBase($number, $base = 10)
    {
        if (is_array($number) || is_array($base)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $number, $base);
        }

=======
     * @param mixed $base The base of the logarithm. If base is omitted, it is assumed to be 10.
     *
     * @return float|string The result, or a string containing an error
     */
    public static function withBase($number, $base = 10)
    {
>>>>>>> forked/LAE_400_PACKAGE
        try {
            $number = Helpers::validateNumericNullBool($number);
            Helpers::validatePositive($number);
            $base = Helpers::validateNumericNullBool($base);
            Helpers::validatePositive($base);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return log($number, $base);
    }

    /**
     * LOG10.
     *
     * Returns the result of builtin function log after validating args.
     *
     * @param mixed $number Should be numeric
<<<<<<< HEAD
     *                      Or can be an array of values
     *
     * @return array|float|string Rounded number
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function base10($number)
    {
        if (is_array($number)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $number);
        }

=======
     *
     * @return float|string Rounded number
     */
    public static function base10($number)
    {
>>>>>>> forked/LAE_400_PACKAGE
        try {
            $number = Helpers::validateNumericNullBool($number);
            Helpers::validatePositive($number);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return log10($number);
    }

    /**
     * LN.
     *
     * Returns the result of builtin function log after validating args.
     *
     * @param mixed $number Should be numeric
<<<<<<< HEAD
     *                      Or can be an array of values
     *
     * @return array|float|string Rounded number
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function natural($number)
    {
        if (is_array($number)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $number);
        }

=======
     *
     * @return float|string Rounded number
     */
    public static function natural($number)
    {
>>>>>>> forked/LAE_400_PACKAGE
        try {
            $number = Helpers::validateNumericNullBool($number);
            Helpers::validatePositive($number);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return log($number);
    }
}
