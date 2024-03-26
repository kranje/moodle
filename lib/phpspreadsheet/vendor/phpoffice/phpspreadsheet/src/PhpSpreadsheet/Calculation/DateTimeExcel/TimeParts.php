<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
=======
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
>>>>>>> forked/LAE_400_PACKAGE
use PhpOffice\PhpSpreadsheet\Shared\Date as SharedDateHelper;

class TimeParts
{
<<<<<<< HEAD
    use ArrayEnabled;

=======
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * HOUROFDAY.
     *
     * Returns the hour of a time value.
     * The hour is given as an integer, ranging from 0 (12:00 A.M.) to 23 (11:00 P.M.).
     *
     * Excel Function:
     *        HOUR(timeValue)
     *
     * @param mixed $timeValue Excel date serial value (float), PHP date timestamp (integer),
     *                                    PHP DateTime object, or a standard time string
<<<<<<< HEAD
     *                         Or can be an array of date/time values
     *
     * @return array|int|string Hour
     *         If an array of numbers is passed as the argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function hour($timeValue)
    {
        if (is_array($timeValue)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $timeValue);
        }

        try {
=======
     *
     * @return int|string Hour
     */
    public static function hour($timeValue)
    {
        try {
            $timeValue = Functions::flattenSingleValue($timeValue);
>>>>>>> forked/LAE_400_PACKAGE
            Helpers::nullFalseTrueToNumber($timeValue);
            if (!is_numeric($timeValue)) {
                $timeValue = Helpers::getTimeValue($timeValue);
            }
            Helpers::validateNotNegative($timeValue);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        // Execute function
        $timeValue = fmod($timeValue, 1);
        $timeValue = SharedDateHelper::excelToDateTimeObject($timeValue);

        return (int) $timeValue->format('H');
    }

    /**
     * MINUTE.
     *
     * Returns the minutes of a time value.
     * The minute is given as an integer, ranging from 0 to 59.
     *
     * Excel Function:
     *        MINUTE(timeValue)
     *
     * @param mixed $timeValue Excel date serial value (float), PHP date timestamp (integer),
     *                                    PHP DateTime object, or a standard time string
<<<<<<< HEAD
     *                         Or can be an array of date/time values
     *
     * @return array|int|string Minute
     *         If an array of numbers is passed as the argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function minute($timeValue)
    {
        if (is_array($timeValue)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $timeValue);
        }

        try {
=======
     *
     * @return int|string Minute
     */
    public static function minute($timeValue)
    {
        try {
            $timeValue = Functions::flattenSingleValue($timeValue);
>>>>>>> forked/LAE_400_PACKAGE
            Helpers::nullFalseTrueToNumber($timeValue);
            if (!is_numeric($timeValue)) {
                $timeValue = Helpers::getTimeValue($timeValue);
            }
            Helpers::validateNotNegative($timeValue);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        // Execute function
        $timeValue = fmod($timeValue, 1);
        $timeValue = SharedDateHelper::excelToDateTimeObject($timeValue);

        return (int) $timeValue->format('i');
    }

    /**
     * SECOND.
     *
     * Returns the seconds of a time value.
     * The minute is given as an integer, ranging from 0 to 59.
     *
     * Excel Function:
     *        SECOND(timeValue)
     *
     * @param mixed $timeValue Excel date serial value (float), PHP date timestamp (integer),
     *                                    PHP DateTime object, or a standard time string
<<<<<<< HEAD
     *                         Or can be an array of date/time values
     *
     * @return array|int|string Second
     *         If an array of numbers is passed as the argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function second($timeValue)
    {
        if (is_array($timeValue)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $timeValue);
        }

        try {
=======
     *
     * @return int|string Second
     */
    public static function second($timeValue)
    {
        try {
            $timeValue = Functions::flattenSingleValue($timeValue);
>>>>>>> forked/LAE_400_PACKAGE
            Helpers::nullFalseTrueToNumber($timeValue);
            if (!is_numeric($timeValue)) {
                $timeValue = Helpers::getTimeValue($timeValue);
            }
            Helpers::validateNotNegative($timeValue);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        // Execute function
        $timeValue = fmod($timeValue, 1);
        $timeValue = SharedDateHelper::excelToDateTimeObject($timeValue);

        return (int) $timeValue->format('s');
    }
}
