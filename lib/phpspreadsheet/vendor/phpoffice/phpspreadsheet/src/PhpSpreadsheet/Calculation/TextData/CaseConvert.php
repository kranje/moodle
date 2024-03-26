<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\TextData;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
=======
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
>>>>>>> forked/LAE_400_PACKAGE
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;

class CaseConvert
{
<<<<<<< HEAD
    use ArrayEnabled;

=======
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * LOWERCASE.
     *
     * Converts a string value to upper case.
     *
     * @param mixed $mixedCaseValue The string value to convert to lower case
<<<<<<< HEAD
     *                              Or can be an array of values
     *
     * @return array|string
     *         If an array of values is passed as the argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function lower($mixedCaseValue)
    {
        if (is_array($mixedCaseValue)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $mixedCaseValue);
        }

=======
     */
    public static function lower($mixedCaseValue): string
    {
        $mixedCaseValue = Functions::flattenSingleValue($mixedCaseValue);
>>>>>>> forked/LAE_400_PACKAGE
        $mixedCaseValue = Helpers::extractString($mixedCaseValue);

        return StringHelper::strToLower($mixedCaseValue);
    }

    /**
     * UPPERCASE.
     *
     * Converts a string value to upper case.
     *
     * @param mixed $mixedCaseValue The string value to convert to upper case
<<<<<<< HEAD
     *                              Or can be an array of values
     *
     * @return array|string
     *         If an array of values is passed as the argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function upper($mixedCaseValue)
    {
        if (is_array($mixedCaseValue)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $mixedCaseValue);
        }

=======
     */
    public static function upper($mixedCaseValue): string
    {
        $mixedCaseValue = Functions::flattenSingleValue($mixedCaseValue);
>>>>>>> forked/LAE_400_PACKAGE
        $mixedCaseValue = Helpers::extractString($mixedCaseValue);

        return StringHelper::strToUpper($mixedCaseValue);
    }

    /**
     * PROPERCASE.
     *
     * Converts a string value to proper or title case.
     *
     * @param mixed $mixedCaseValue The string value to convert to title case
<<<<<<< HEAD
     *                              Or can be an array of values
     *
     * @return array|string
     *         If an array of values is passed as the argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function proper($mixedCaseValue)
    {
        if (is_array($mixedCaseValue)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $mixedCaseValue);
        }

=======
     */
    public static function proper($mixedCaseValue): string
    {
        $mixedCaseValue = Functions::flattenSingleValue($mixedCaseValue);
>>>>>>> forked/LAE_400_PACKAGE
        $mixedCaseValue = Helpers::extractString($mixedCaseValue);

        return StringHelper::strToTitle($mixedCaseValue);
    }
}
