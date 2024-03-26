<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\Statistical;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;

class Confidence
{
    use ArrayEnabled;

=======
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;

class Confidence
{
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * CONFIDENCE.
     *
     * Returns the confidence interval for a population mean
     *
     * @param mixed $alpha As a float
<<<<<<< HEAD
     *                      Or can be an array of values
     * @param mixed $stdDev Standard Deviation as a float
     *                      Or can be an array of values
     * @param mixed $size As an integer
     *                      Or can be an array of values
     *
     * @return array|float|string
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function CONFIDENCE($alpha, $stdDev, $size)
    {
        if (is_array($alpha) || is_array($stdDev) || is_array($size)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $alpha, $stdDev, $size);
        }
=======
     * @param mixed $stdDev Standard Deviation as a float
     * @param mixed $size As an integer
     *
     * @return float|string
     */
    public static function CONFIDENCE($alpha, $stdDev, $size)
    {
        $alpha = Functions::flattenSingleValue($alpha);
        $stdDev = Functions::flattenSingleValue($stdDev);
        $size = Functions::flattenSingleValue($size);
>>>>>>> forked/LAE_400_PACKAGE

        try {
            $alpha = StatisticalValidations::validateFloat($alpha);
            $stdDev = StatisticalValidations::validateFloat($stdDev);
            $size = StatisticalValidations::validateInt($size);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        if (($alpha <= 0) || ($alpha >= 1) || ($stdDev <= 0) || ($size < 1)) {
<<<<<<< HEAD
            return ExcelError::NAN();
        }
        /** @var float */
        $temp = Distributions\StandardNormal::inverse(1 - $alpha / 2);

        return Functions::scalar($temp * $stdDev / sqrt($size));
=======
            return Functions::NAN();
        }

        return Distributions\StandardNormal::inverse(1 - $alpha / 2) * $stdDev / sqrt($size);
>>>>>>> forked/LAE_400_PACKAGE
    }
}
