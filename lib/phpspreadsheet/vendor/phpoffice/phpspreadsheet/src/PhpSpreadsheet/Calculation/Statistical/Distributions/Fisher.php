<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;

class Fisher
{
    use ArrayEnabled;

=======
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;

class Fisher
{
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * FISHER.
     *
     * Returns the Fisher transformation at x. This transformation produces a function that
     *        is normally distributed rather than skewed. Use this function to perform hypothesis
     *        testing on the correlation coefficient.
     *
     * @param mixed $value Float value for which we want the probability
<<<<<<< HEAD
     *                      Or can be an array of values
     *
     * @return array|float|string
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function distribution($value)
    {
        if (is_array($value)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $value);
        }
=======
     *
     * @return float|string
     */
    public static function distribution($value)
    {
        $value = Functions::flattenSingleValue($value);
>>>>>>> forked/LAE_400_PACKAGE

        try {
            DistributionValidations::validateFloat($value);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        if (($value <= -1) || ($value >= 1)) {
<<<<<<< HEAD
            return ExcelError::NAN();
=======
            return Functions::NAN();
>>>>>>> forked/LAE_400_PACKAGE
        }

        return 0.5 * log((1 + $value) / (1 - $value));
    }

    /**
     * FISHERINV.
     *
     * Returns the inverse of the Fisher transformation. Use this transformation when
     *        analyzing correlations between ranges or arrays of data. If y = FISHER(x), then
     *        FISHERINV(y) = x.
     *
     * @param mixed $probability Float probability at which you want to evaluate the distribution
<<<<<<< HEAD
     *                      Or can be an array of values
     *
     * @return array|float|string
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function inverse($probability)
    {
        if (is_array($probability)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $probability);
        }
=======
     *
     * @return float|string
     */
    public static function inverse($probability)
    {
        $probability = Functions::flattenSingleValue($probability);
>>>>>>> forked/LAE_400_PACKAGE

        try {
            DistributionValidations::validateFloat($probability);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return (exp(2 * $probability) - 1) / (exp(2 * $probability) + 1);
    }
}
