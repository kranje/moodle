<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;

class Weibull
{
    use ArrayEnabled;

=======
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;

class Weibull
{
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * WEIBULL.
     *
     * Returns the Weibull distribution. Use this distribution in reliability
     * analysis, such as calculating a device's mean time to failure.
     *
     * @param mixed $value Float value for the distribution
<<<<<<< HEAD
     *                      Or can be an array of values
     * @param mixed $alpha Float alpha Parameter
     *                      Or can be an array of values
     * @param mixed $beta Float beta Parameter
     *                      Or can be an array of values
     * @param mixed $cumulative Boolean value indicating if we want the cdf (true) or the pdf (false)
     *                      Or can be an array of values
     *
     * @return array|float|string (string if result is an error)
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function distribution($value, $alpha, $beta, $cumulative)
    {
        if (is_array($value) || is_array($alpha) || is_array($beta) || is_array($cumulative)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $value, $alpha, $beta, $cumulative);
        }
=======
     * @param mixed $alpha Float alpha Parameter
     * @param mixed $beta Float beta Parameter
     * @param mixed $cumulative Boolean value indicating if we want the cdf (true) or the pdf (false)
     *
     * @return float|string (string if result is an error)
     */
    public static function distribution($value, $alpha, $beta, $cumulative)
    {
        $value = Functions::flattenSingleValue($value);
        $alpha = Functions::flattenSingleValue($alpha);
        $beta = Functions::flattenSingleValue($beta);
        $cumulative = Functions::flattenSingleValue($cumulative);
>>>>>>> forked/LAE_400_PACKAGE

        try {
            $value = DistributionValidations::validateFloat($value);
            $alpha = DistributionValidations::validateFloat($alpha);
            $beta = DistributionValidations::validateFloat($beta);
            $cumulative = DistributionValidations::validateBool($cumulative);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        if (($value < 0) || ($alpha <= 0) || ($beta <= 0)) {
<<<<<<< HEAD
            return ExcelError::NAN();
=======
            return Functions::NAN();
>>>>>>> forked/LAE_400_PACKAGE
        }

        if ($cumulative) {
            return 1 - exp(0 - ($value / $beta) ** $alpha);
        }

        return ($alpha / $beta ** $alpha) * $value ** ($alpha - 1) * exp(0 - ($value / $beta) ** $alpha);
    }
}
