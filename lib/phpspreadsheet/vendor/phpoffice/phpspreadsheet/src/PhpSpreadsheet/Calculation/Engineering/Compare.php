<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\Engineering;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
use PhpOffice\PhpSpreadsheet\Calculation\Exception;

class Compare
{
    use ArrayEnabled;

=======
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;

class Compare
{
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * DELTA.
     *
     *    Excel Function:
     *        DELTA(a[,b])
     *
     *    Tests whether two values are equal. Returns 1 if number1 = number2; returns 0 otherwise.
     *    Use this function to filter a set of values. For example, by summing several DELTA
     *        functions you calculate the count of equal pairs. This function is also known as the
     *        Kronecker Delta function.
     *
<<<<<<< HEAD
     * @param array|float $a the first number
     *                      Or can be an array of values
     * @param array|float $b The second number. If omitted, b is assumed to be zero.
     *                      Or can be an array of values
     *
     * @return array|int|string (string in the event of an error)
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function DELTA($a, $b = 0.0)
    {
        if (is_array($a) || is_array($b)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $a, $b);
        }
=======
     * @param float $a the first number
     * @param float $b The second number. If omitted, b is assumed to be zero.
     *
     * @return int|string (string in the event of an error)
     */
    public static function DELTA($a, $b = 0)
    {
        $a = Functions::flattenSingleValue($a);
        $b = Functions::flattenSingleValue($b);
>>>>>>> forked/LAE_400_PACKAGE

        try {
            $a = EngineeringValidations::validateFloat($a);
            $b = EngineeringValidations::validateFloat($b);
        } catch (Exception $e) {
            return $e->getMessage();
        }

<<<<<<< HEAD
        return (int) (abs($a - $b) < 1.0e-15);
=======
        return (int) ($a == $b);
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * GESTEP.
     *
     *    Excel Function:
     *        GESTEP(number[,step])
     *
     *    Returns 1 if number >= step; returns 0 (zero) otherwise
     *    Use this function to filter a set of values. For example, by summing several GESTEP
     *        functions you calculate the count of values that exceed a threshold.
     *
<<<<<<< HEAD
     * @param array|float $number the value to test against step
     *                      Or can be an array of values
     * @param null|array|float $step The threshold value. If you omit a value for step, GESTEP uses zero.
     *                      Or can be an array of values
     *
     * @return array|int|string (string in the event of an error)
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function GESTEP($number, $step = 0.0)
    {
        if (is_array($number) || is_array($step)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $number, $step);
        }

        try {
            $number = EngineeringValidations::validateFloat($number);
            $step = EngineeringValidations::validateFloat($step ?? 0.0);
=======
     * @param float $number the value to test against step
     * @param float $step The threshold value. If you omit a value for step, GESTEP uses zero.
     *
     * @return int|string (string in the event of an error)
     */
    public static function GESTEP($number, $step = 0)
    {
        $number = Functions::flattenSingleValue($number);
        $step = Functions::flattenSingleValue($step);

        try {
            $number = EngineeringValidations::validateFloat($number);
            $step = EngineeringValidations::validateFloat($step);
>>>>>>> forked/LAE_400_PACKAGE
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return (int) ($number >= $step);
    }
}
