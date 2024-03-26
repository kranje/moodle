<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\MathTrig;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
=======
>>>>>>> forked/LAE_400_PACKAGE
use PhpOffice\PhpSpreadsheet\Calculation\Exception;

class Trunc
{
<<<<<<< HEAD
    use ArrayEnabled;

=======
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * TRUNC.
     *
     * Truncates value to the number of fractional digits by number_digits.
     *
<<<<<<< HEAD
     * @param array|float $value
     *                      Or can be an array of values
     * @param array|int $digits
     *                      Or can be an array of values
     *
     * @return array|float|string Truncated value, or a string containing an error
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function evaluate($value = 0, $digits = 0)
    {
        if (is_array($value) || is_array($digits)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $value, $digits);
        }

=======
     * @param float $value
     * @param int $digits
     *
     * @return float|string Truncated value, or a string containing an error
     */
    public static function evaluate($value = 0, $digits = 0)
    {
>>>>>>> forked/LAE_400_PACKAGE
        try {
            $value = Helpers::validateNumericNullBool($value);
            $digits = Helpers::validateNumericNullSubstitution($digits, null);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $digits = floor($digits);

        // Truncate
        $adjust = 10 ** $digits;

        if (($digits > 0) && (rtrim((string) (int) ((abs($value) - abs((int) $value)) * $adjust), '0') < $adjust / 10)) {
            return $value;
        }

        return ((int) ($value * $adjust)) / $adjust;
    }
}
