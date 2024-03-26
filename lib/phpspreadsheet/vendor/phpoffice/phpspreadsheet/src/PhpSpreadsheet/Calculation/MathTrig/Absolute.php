<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\MathTrig;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
=======
>>>>>>> forked/LAE_400_PACKAGE
use PhpOffice\PhpSpreadsheet\Calculation\Exception;

class Absolute
{
<<<<<<< HEAD
    use ArrayEnabled;

=======
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * ABS.
     *
     * Returns the result of builtin function abs after validating args.
     *
<<<<<<< HEAD
     * @param mixed $number Should be numeric, or can be an array of numbers
     *
     * @return array|float|int|string rounded number
     *         If an array of numbers is passed as the argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function evaluate($number)
    {
        if (is_array($number)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $number);
        }

=======
     * @param mixed $number Should be numeric
     *
     * @return float|int|string Rounded number
     */
    public static function evaluate($number)
    {
>>>>>>> forked/LAE_400_PACKAGE
        try {
            $number = Helpers::validateNumericNullBool($number);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return abs($number);
    }
}
