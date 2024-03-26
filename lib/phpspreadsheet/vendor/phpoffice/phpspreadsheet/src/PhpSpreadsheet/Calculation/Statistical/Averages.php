<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\Statistical;

use PhpOffice\PhpSpreadsheet\Calculation\Functions;
<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
=======
>>>>>>> forked/LAE_400_PACKAGE

class Averages extends AggregateBase
{
    /**
     * AVEDEV.
     *
     * Returns the average of the absolute deviations of data points from their mean.
     * AVEDEV is a measure of the variability in a data set.
     *
     * Excel Function:
     *        AVEDEV(value1[,value2[, ...]])
     *
     * @param mixed ...$args Data values
     *
     * @return float|string (string if result is an error)
     */
    public static function averageDeviations(...$args)
    {
        $aArgs = Functions::flattenArrayIndexed($args);

        // Return value
<<<<<<< HEAD
        $returnValue = 0.0;

        $aMean = self::average(...$args);
        if ($aMean === ExcelError::DIV0()) {
            return ExcelError::NAN();
        } elseif ($aMean === ExcelError::VALUE()) {
            return ExcelError::VALUE();
=======
        $returnValue = 0;

        $aMean = self::average(...$args);
        if ($aMean === Functions::DIV0()) {
            return Functions::NAN();
        } elseif ($aMean === Functions::VALUE()) {
            return Functions::VALUE();
>>>>>>> forked/LAE_400_PACKAGE
        }

        $aCount = 0;
        foreach ($aArgs as $k => $arg) {
            $arg = self::testAcceptedBoolean($arg, $k);
            // Is it a numeric value?
            // Strings containing numeric values are only counted if they are string literals (not cell values)
            //    and then only in MS Excel and in Open Office, not in Gnumeric
            if ((is_string($arg)) && (!is_numeric($arg)) && (!Functions::isCellValue($k))) {
<<<<<<< HEAD
                return ExcelError::VALUE();
=======
                return Functions::VALUE();
>>>>>>> forked/LAE_400_PACKAGE
            }
            if (self::isAcceptedCountable($arg, $k)) {
                $returnValue += abs($arg - $aMean);
                ++$aCount;
            }
        }

        // Return
        if ($aCount === 0) {
<<<<<<< HEAD
            return ExcelError::DIV0();
=======
            return Functions::DIV0();
>>>>>>> forked/LAE_400_PACKAGE
        }

        return $returnValue / $aCount;
    }

    /**
     * AVERAGE.
     *
     * Returns the average (arithmetic mean) of the arguments
     *
     * Excel Function:
     *        AVERAGE(value1[,value2[, ...]])
     *
     * @param mixed ...$args Data values
     *
     * @return float|string (string if result is an error)
     */
    public static function average(...$args)
    {
        $returnValue = $aCount = 0;

        // Loop through arguments
        foreach (Functions::flattenArrayIndexed($args) as $k => $arg) {
            $arg = self::testAcceptedBoolean($arg, $k);
            // Is it a numeric value?
            // Strings containing numeric values are only counted if they are string literals (not cell values)
            //    and then only in MS Excel and in Open Office, not in Gnumeric
            if ((is_string($arg)) && (!is_numeric($arg)) && (!Functions::isCellValue($k))) {
<<<<<<< HEAD
                return ExcelError::VALUE();
=======
                return Functions::VALUE();
>>>>>>> forked/LAE_400_PACKAGE
            }
            if (self::isAcceptedCountable($arg, $k)) {
                $returnValue += $arg;
                ++$aCount;
            }
        }

        // Return
        if ($aCount > 0) {
            return $returnValue / $aCount;
        }

<<<<<<< HEAD
        return ExcelError::DIV0();
=======
        return Functions::DIV0();
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * AVERAGEA.
     *
     * Returns the average of its arguments, including numbers, text, and logical values
     *
     * Excel Function:
     *        AVERAGEA(value1[,value2[, ...]])
     *
     * @param mixed ...$args Data values
     *
     * @return float|string (string if result is an error)
     */
    public static function averageA(...$args)
    {
        $returnValue = null;

        $aCount = 0;
        // Loop through arguments
        foreach (Functions::flattenArrayIndexed($args) as $k => $arg) {
            if ((is_bool($arg)) && (!Functions::isMatrixValue($k))) {
            } else {
                if ((is_numeric($arg)) || (is_bool($arg)) || ((is_string($arg) && ($arg != '')))) {
                    if (is_bool($arg)) {
                        $arg = (int) $arg;
                    } elseif (is_string($arg)) {
                        $arg = 0;
                    }
                    $returnValue += $arg;
                    ++$aCount;
                }
            }
        }

        if ($aCount > 0) {
            return $returnValue / $aCount;
        }

<<<<<<< HEAD
        return ExcelError::DIV0();
=======
        return Functions::DIV0();
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * MEDIAN.
     *
     * Returns the median of the given numbers. The median is the number in the middle of a set of numbers.
     *
     * Excel Function:
     *        MEDIAN(value1[,value2[, ...]])
     *
     * @param mixed ...$args Data values
     *
     * @return float|string The result, or a string containing an error
     */
    public static function median(...$args)
    {
        $aArgs = Functions::flattenArray($args);

<<<<<<< HEAD
        $returnValue = ExcelError::NAN();
=======
        $returnValue = Functions::NAN();
>>>>>>> forked/LAE_400_PACKAGE

        $aArgs = self::filterArguments($aArgs);
        $valueCount = count($aArgs);
        if ($valueCount > 0) {
            sort($aArgs, SORT_NUMERIC);
            $valueCount = $valueCount / 2;
            if ($valueCount == floor($valueCount)) {
                $returnValue = ($aArgs[$valueCount--] + $aArgs[$valueCount]) / 2;
            } else {
                $valueCount = floor($valueCount);
                $returnValue = $aArgs[$valueCount];
            }
        }

        return $returnValue;
    }

    /**
     * MODE.
     *
     * Returns the most frequently occurring, or repetitive, value in an array or range of data
     *
     * Excel Function:
     *        MODE(value1[,value2[, ...]])
     *
     * @param mixed ...$args Data values
     *
     * @return float|string The result, or a string containing an error
     */
    public static function mode(...$args)
    {
<<<<<<< HEAD
        $returnValue = ExcelError::NA();
=======
        $returnValue = Functions::NA();
>>>>>>> forked/LAE_400_PACKAGE

        // Loop through arguments
        $aArgs = Functions::flattenArray($args);
        $aArgs = self::filterArguments($aArgs);

        if (!empty($aArgs)) {
            return self::modeCalc($aArgs);
        }

        return $returnValue;
    }

    protected static function filterArguments($args)
    {
        return array_filter(
            $args,
            function ($value) {
                // Is it a numeric value?
<<<<<<< HEAD
                return  is_numeric($value) && (!is_string($value));
=======
                return  (is_numeric($value)) && (!is_string($value));
>>>>>>> forked/LAE_400_PACKAGE
            }
        );
    }

    //
    //    Special variant of array_count_values that isn't limited to strings and integers,
    //        but can work with floating point numbers as values
    //
    private static function modeCalc($data)
    {
        $frequencyArray = [];
        $index = 0;
        $maxfreq = 0;
        $maxfreqkey = '';
        $maxfreqdatum = '';
        foreach ($data as $datum) {
            $found = false;
            ++$index;
            foreach ($frequencyArray as $key => $value) {
                if ((string) $value['value'] == (string) $datum) {
                    ++$frequencyArray[$key]['frequency'];
                    $freq = $frequencyArray[$key]['frequency'];
                    if ($freq > $maxfreq) {
                        $maxfreq = $freq;
                        $maxfreqkey = $key;
                        $maxfreqdatum = $datum;
                    } elseif ($freq == $maxfreq) {
                        if ($frequencyArray[$key]['index'] < $frequencyArray[$maxfreqkey]['index']) {
                            $maxfreqkey = $key;
                            $maxfreqdatum = $datum;
                        }
                    }
                    $found = true;

                    break;
                }
            }

            if ($found === false) {
                $frequencyArray[] = [
                    'value' => $datum,
                    'frequency' => 1,
                    'index' => $index,
                ];
            }
        }

        if ($maxfreq <= 1) {
<<<<<<< HEAD
            return ExcelError::NA();
=======
            return Functions::NA();
>>>>>>> forked/LAE_400_PACKAGE
        }

        return $maxfreqdatum;
    }
}
