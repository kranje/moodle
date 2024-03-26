<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\Engineering;

use PhpOffice\PhpSpreadsheet\Calculation\Exception;
<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
=======
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
>>>>>>> forked/LAE_400_PACKAGE

class ConvertHex extends ConvertBase
{
    /**
     * toBinary.
     *
     * Return a hex value as binary.
     *
     * Excel Function:
     *        HEX2BIN(x[,places])
     *
<<<<<<< HEAD
     * @param array|string $value The hexadecimal number you want to convert.
=======
     * @param string $value The hexadecimal number you want to convert.
>>>>>>> forked/LAE_400_PACKAGE
     *                      Number cannot contain more than 10 characters.
     *                      The most significant bit of number is the sign bit (40th bit from the right).
     *                      The remaining 9 bits are magnitude bits.
     *                      Negative numbers are represented using two's-complement notation.
     *                      If number is negative, HEX2BIN ignores places and returns a 10-character binary number.
     *                      If number is negative, it cannot be less than FFFFFFFE00,
     *                          and if number is positive, it cannot be greater than 1FF.
     *                      If number is not a valid hexadecimal number, HEX2BIN returns the #NUM! error value.
     *                      If HEX2BIN requires more than places characters, it returns the #NUM! error value.
<<<<<<< HEAD
     *                      Or can be an array of values
     * @param array|int $places The number of characters to use. If places is omitted,
=======
     * @param int $places The number of characters to use. If places is omitted,
>>>>>>> forked/LAE_400_PACKAGE
     *                          HEX2BIN uses the minimum number of characters necessary. Places
     *                          is useful for padding the return value with leading 0s (zeros).
     *                      If places is not an integer, it is truncated.
     *                      If places is nonnumeric, HEX2BIN returns the #VALUE! error value.
     *                      If places is negative, HEX2BIN returns the #NUM! error value.
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
            $value = self::validateHex($value);
            $places = self::validatePlaces($places);
=======
     */
    public static function toBinary($value, $places = null): string
    {
        try {
            $value = self::validateValue(Functions::flattenSingleValue($value));
            $value = self::validateHex($value);
            $places = self::validatePlaces(Functions::flattenSingleValue($places));
>>>>>>> forked/LAE_400_PACKAGE
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $dec = self::toDecimal($value);

        return ConvertDecimal::toBinary($dec, $places);
    }

    /**
     * toDecimal.
     *
     * Return a hex value as decimal.
     *
     * Excel Function:
     *        HEX2DEC(x)
     *
<<<<<<< HEAD
     * @param array|string $value The hexadecimal number you want to convert. This number cannot
=======
     * @param string $value The hexadecimal number you want to convert. This number cannot
>>>>>>> forked/LAE_400_PACKAGE
     *                          contain more than 10 characters (40 bits). The most significant
     *                          bit of number is the sign bit. The remaining 39 bits are magnitude
     *                          bits. Negative numbers are represented using two's-complement
     *                          notation.
     *                      If number is not a valid hexadecimal number, HEX2DEC returns the
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
            $value = self::validateHex($value);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        if (strlen($value) > 10) {
<<<<<<< HEAD
            return ExcelError::NAN();
=======
            return Functions::NAN();
>>>>>>> forked/LAE_400_PACKAGE
        }

        $binX = '';
        foreach (str_split($value) as $char) {
            $binX .= str_pad(base_convert($char, 16, 2), 4, '0', STR_PAD_LEFT);
        }
        if (strlen($binX) == 40 && $binX[0] == '1') {
            for ($i = 0; $i < 40; ++$i) {
                $binX[$i] = ($binX[$i] == '1' ? '0' : '1');
            }

            return (string) ((bindec($binX) + 1) * -1);
        }

        return (string) bindec($binX);
    }

    /**
     * toOctal.
     *
     * Return a hex value as octal.
     *
     * Excel Function:
     *        HEX2OCT(x[,places])
     *
<<<<<<< HEAD
     * @param array|string $value The hexadecimal number you want to convert. Number cannot
=======
     * @param string $value The hexadecimal number you want to convert. Number cannot
>>>>>>> forked/LAE_400_PACKAGE
     *                                    contain more than 10 characters. The most significant bit of
     *                                    number is the sign bit. The remaining 39 bits are magnitude
     *                                    bits. Negative numbers are represented using two's-complement
     *                                    notation.
     *                                    If number is negative, HEX2OCT ignores places and returns a
     *                                    10-character octal number.
     *                                    If number is negative, it cannot be less than FFE0000000, and
     *                                    if number is positive, it cannot be greater than 1FFFFFFF.
     *                                    If number is not a valid hexadecimal number, HEX2OCT returns
     *                                    the #NUM! error value.
     *                                    If HEX2OCT requires more than places characters, it returns
     *                                    the #NUM! error value.
<<<<<<< HEAD
     *                      Or can be an array of values
     * @param array|int $places The number of characters to use. If places is omitted, HEX2OCT
=======
     * @param int $places The number of characters to use. If places is omitted, HEX2OCT
>>>>>>> forked/LAE_400_PACKAGE
     *                                    uses the minimum number of characters necessary. Places is
     *                                    useful for padding the return value with leading 0s (zeros).
     *                                    If places is not an integer, it is truncated.
     *                                    If places is nonnumeric, HEX2OCT returns the #VALUE! error
     *                                    value.
     *                                    If places is negative, HEX2OCT returns the #NUM! error value.
<<<<<<< HEAD
     *                      Or can be an array of values
     *
     * @return array|string Result, or an error
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function toOctal($value, $places = null)
    {
        if (is_array($value) || is_array($places)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $value, $places);
        }

        try {
            $value = self::validateValue($value);
            $value = self::validateHex($value);
            $places = self::validatePlaces($places);
=======
     */
    public static function toOctal($value, $places = null): string
    {
        try {
            $value = self::validateValue(Functions::flattenSingleValue($value));
            $value = self::validateHex($value);
            $places = self::validatePlaces(Functions::flattenSingleValue($places));
>>>>>>> forked/LAE_400_PACKAGE
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $decimal = self::toDecimal($value);

        return ConvertDecimal::toOctal($decimal, $places);
    }

    protected static function validateHex(string $value): string
    {
        if (strlen($value) > preg_match_all('/[0123456789ABCDEF]/', $value)) {
<<<<<<< HEAD
            throw new Exception(ExcelError::NAN());
=======
            throw new Exception(Functions::NAN());
>>>>>>> forked/LAE_400_PACKAGE
        }

        return $value;
    }
}
