<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;

class Exponential
{
    use ArrayEnabled;

=======
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;

class Exponential
{
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * EXPONDIST.
     *
     *    Returns the exponential distribution. Use EXPONDIST to model the time between events,
     *        such as how long an automated bank teller takes to deliver cash. For example, you can
     *        use EXPONDIST to determine the probability that the process takes at most 1 minute.
     *
     * @param mixed $value Float value for which we want the probability
<<<<<<< HEAD
     *                      Or can be an array of values
     * @param mixed $lambda The parameter value as a float
     *                      Or can be an array of values
     * @param mixed $cumulative Boolean value indicating if we want the cdf (true) or the pdf (false)
     *                      Or can be an array of values
     *
     * @return array|float|string
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function distribution($value, $lambda, $cumulative)
    {
        if (is_array($value) || is_array($lambda) || is_array($cumulative)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $value, $lambda, $cumulative);
        }
=======
     * @param mixed $lambda The parameter value as a float
     * @param mixed $cumulative Boolean value indicating if we want the cdf (true) or the pdf (false)
     *
     * @return float|string
     */
    public static function distribution($value, $lambda, $cumulative)
    {
        $value = Functions::flattenSingleValue($value);
        $lambda = Functions::flattenSingleValue($lambda);
        $cumulative = Functions::flattenSingleValue($cumulative);
>>>>>>> forked/LAE_400_PACKAGE

        try {
            $value = DistributionValidations::validateFloat($value);
            $lambda = DistributionValidations::validateFloat($lambda);
            $cumulative = DistributionValidations::validateBool($cumulative);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        if (($value < 0) || ($lambda < 0)) {
<<<<<<< HEAD
            return ExcelError::NAN();
=======
            return Functions::NAN();
>>>>>>> forked/LAE_400_PACKAGE
        }

        if ($cumulative === true) {
            return 1 - exp(0 - $value * $lambda);
        }

        return $lambda * exp(0 - $value * $lambda);
    }
}
