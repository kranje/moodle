<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\TextData;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;

class Trim
{
    use ArrayEnabled;

=======
class Trim
{
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * CLEAN.
     *
     * @param mixed $stringValue String Value to check
<<<<<<< HEAD
     *                              Or can be an array of values
     *
     * @return array|string
     *         If an array of values is passed as the argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function nonPrintable($stringValue = '')
    {
        if (is_array($stringValue)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $stringValue);
        }

        $stringValue = Helpers::extractString($stringValue);

        return (string) preg_replace('/[\\x00-\\x1f]/', '', "$stringValue");
=======
     *
     * @return null|string
     */
    public static function nonPrintable($stringValue = '')
    {
        $stringValue = Helpers::extractString($stringValue);

        return preg_replace('/[\\x00-\\x1f]/', '', "$stringValue");
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * TRIM.
     *
     * @param mixed $stringValue String Value to check
<<<<<<< HEAD
     *                              Or can be an array of values
     *
     * @return array|string
     *         If an array of values is passed as the argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function spaces($stringValue = '')
    {
        if (is_array($stringValue)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $stringValue);
        }

=======
     *
     * @return string
     */
    public static function spaces($stringValue = '')
    {
>>>>>>> forked/LAE_400_PACKAGE
        $stringValue = Helpers::extractString($stringValue);

        return trim(preg_replace('/ +/', ' ', trim("$stringValue", ' ')) ?? '', ' ');
    }
}
