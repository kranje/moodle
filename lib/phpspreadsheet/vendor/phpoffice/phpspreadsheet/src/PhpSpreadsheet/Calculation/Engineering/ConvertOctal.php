<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\Engineering;

use PhpOffice\PhpSpreadsheet\Calculation\Exception;
<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
=======
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
>>>>>>> forked/LAE_400_PACKAGE

class ConvertOctal extends ConvertBase
{
    /**
     * toBinary.
     *
     * Return an octal value as binary.
     *
     * Excel Function:
     *        OCT2BIN(x[,places])
     *
<<<<<<< HEAD
     * @param array|string $value The octal number you want to convert. Number may not
=======
     * @param string $value The octal number you want to convert. Number may not
>>>>>>> forked/LAE_400_PACKAGE
     *                          contain more than 10 characters. The most significant
     *                          bit of number is the sign bit. The remaining 29 bits
     *                          are magnitude bits. Negative numbers are represented
     *                          using two's-complement notation.
     *                      If number is negative, OCT2BIN ignores places and returns
     *                          a 10-character binary number.
     *                      If number is negative, it cannot be less than 7777777000,
     *                          and if number is positive, it cannot be greater than 777.
     *                      If number is not a valid octal number, OCT2BIN returns
     *                          the #NUM! error value.
     *                      If OCT2BIN requires more than places characters, it
     *                          returns the #NUM! error value.
<<<<<<< HEAD
     *                      Or can be an array of values
     * @param array|int $places The number of characters to use. If places is omitted,
=======
     * @param int $places The number of characters to use. If places is omitted,
>>>>>>> forked/LAE_400_PACKAGE
     *                          OCT2BIN uses the minimum number of characters necessary.
     *                          Places is useful for padding the return value with
     *                          leading 0s (zeros).
     *                      If places is not an integer, it is truncated.
     *                      If places is nonnumeric, OCT2BIN returns the #VALUE!
     *                          error value.
     *                      If places is negative, OCT2BIN returns the #NUM! error
     *                          value.
<<<<<<< HEAD
     *                      Or can be an array of values
     *
     * @return array|string Result, or an error
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function toBinary($value, $places = null)
    {
        if (is_array($value) || is_array($places)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $value, $places);
        }

        try {
            $value = self::validateValue($value);
            $value = self::validateOctal($value);
            $places = self::validatePlaces($places);
=======
     */
    public static function toBinary($value, $places = null): string
    {
        try {
            $value = self::validateValue(Functions::flattenSingleValue($value));
            $value = self::validateOctal($value);
            $places = self::validatePlaces(Functions::flattenSingleValue($places));
>>>>>>> forked/LAE_400_PACKAGE
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return ConvertDecimal::toBinary(self::toDecimal($value), $places);
    }

    /**
     * toDecimal.
     *
     * Return an octal value as decimal.
     *
     * Excel Function:
     *        OCT2DEC(x)
     *
<<<<<<< HEAD
     * @param array|string $value The octal number you want to convert. Number may not contain
=======
     * @param string $value The octal number you want to convert. Number may not contain
>>>>>>> forked/LAE_400_PACKAGE
     *                          more than 10 octal characters (30 bits). The most significant
     *                          bit of number is the sign bit. The remaining 29 bits are
     *                          magnitude bits. Negative numbers are represented using
     *                          two's-complement notation.
     *                      If number is not a valid octal number, OCT2DEC returns the
     *                          #NUM! error value.
<<<<<<< HEAD
     *                      Or can be an array of values
     *
     * @return array|string Result, or an error
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function toDecimal($value)
    {
        if (is_array($value)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $value);
        }

        try {
            $value = self::validateValue($value);
=======
     */
    public static function toDecimal($value): string
    {
        try {
            $value = self::validateValue(Functions::flattenSingleValue($value));
>>>>>>> forked/LAE_400_PACKAGE
            $value = self::validateOctal($value);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $binX = '';
        foreach (str_split($value) as $char) {
            $binX .= str_pad(decbin((int) $char), 3, '0', STR_PAD_LEFT);
        }
        if (strlen($binX) == 30 && $binX[0] == '1') {
            for ($i = 0; $i < 30; ++$i) {
                $binX[$i] = ($binX[$i] == '1' ? '0' : '1');
            }

            return (string) ((bindec($binX) + 1) * -1);
        }

        return (string) bindec($binX);
    }

    /**
     * toHex.
     *
     * Return an octal value as hex.
     *
     * Excel Function:
     *        OCT2HEX(x[,places])
     *
<<<<<<< HEAD
     * @param array|string $value The octal number you want to convert. Number may not contain
=======
     * @param string $value The octal number you want to convert. Number may not contain
>>>>>>> forked/LAE_400_PACKAGE
     *                          more than 10 octal characters (30 bits). The most significant
     *                          bit of number is the sign bit. The remaining 29 bits are
     *                          magnitude bits. Negative numbers are represented using
     *                          two's-complement notation.
     *                      If number is negative, OCT2HEX ignores places and returns a
     *                          10-character hexadecimal number.
     *                      If number is not a valid octal number, OCT2HEX returns the
     *                          #NUM! error value.
     *                      If OCT2HEX requires more than places characters, it returns
     *                          the #NUM! error value.
<<<<<<< HEAD
     *                      Or can be an array of values
     * @param array|int $places The number of characters to use. If places is omitted, OCT2HEX
=======
     * @param int $places The number of characters to use. If places is omitted, OCT2HEX
>>>>>>> forked/LAE_400_PACKAGE
     *                          uses the minimum number of characters necessary. Places is useful
     *                          for padding the return value with leading 0s (zeros).
     *                      If places is not an integer, it is truncated.
     *                      If places is nonnumeric, OCT2HEX returns the #VALUE! error value.
     *                      If places is negative, OCT2HEX returns the #NUM! error value.
<<<<<<< HEAD
     *                      Or can be an array of values
     *
     * @return array|string Result, or an error
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function toHex($value, $places = null)
    {
        if (is_array($value) || is_array($places)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $value, $places);
        }

        try {
            $value = self::validateValue($value);
            $value = self::validateOctal($value);
            $places = self::validatePlaces($places);
=======
     */
    public static function toHex($value, $places = null): string
    {
        try {
            $value = self::validateValue(Functions::flattenSingleValue($value));
            $value = self::validateOctal($value);
            $places = self::validatePlaces(Functions::flattenSingleValue($places));
>>>>>>> forked/LAE_400_PACKAGE
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $hexVal = strtoupper(dechex((int) self::toDecimal($value)));
<<<<<<< HEAD
        $hexVal = (PHP_INT_SIZE === 4 && strlen($value) === 10 && $value[0] >= '4') ? "FF{$hexVal}" : $hexVal;
=======
        $hexVal = (PHP_INT_SIZE === 4 && strlen($value) === 10 && $value[0] >= '4') ? "FF$hexVal" : $hexVal;
>>>>>>> forked/LAE_400_PACKAGE

        return self::nbrConversionFormat($hexVal, $places);
    }

    protected static function validateOctal(string $value): string
    {
        $numDigits = (int) preg_match_all('/[01234567]/', $value);
        if (strlen($value) > $numDigits || $numDigits > 10) {
<<<<<<< HEAD
            throw new Exception(ExcelError::NAN());
=======
            throw new Exception(Functions::NAN());
>>>>>>> forked/LAE_400_PACKAGE
        }

        return $value;
    }
}
