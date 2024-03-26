<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
=======
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
>>>>>>> forked/LAE_400_PACKAGE
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig;

class Poisson
{
<<<<<<< HEAD
    use ArrayEnabled;

=======
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * POISSON.
     *
     * Returns the Poisson distribution. A common application of the Poisson distribution
     * is predicting the number of events over a specific time, such as the number of
     * cars arriving at a toll plaza in 1 minute.
     *
     * @param mixed $value Float value for which we want the probability
<<<<<<< HEAD
     *                      Or can be an array of values
     * @param mixed $mean Mean value as a float
     *                      Or can be an array of values
     * @param mixed $cumulative Boolean value indicating if we want the cdf (true) or the pdf (false)
     *                      Or can be an array of values
     *
     * @return array|float|string The result, or a string containing an error
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function distribution($value, $mean, $cumulative)
    {
        if (is_array($value) || is_array($mean) || is_array($cumulative)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $value, $mean, $cumulative);
        }
=======
     * @param mixed $mean Mean value as a float
     * @param mixed $cumulative Boolean value indicating if we want the cdf (true) or the pdf (false)
     *
     * @return float|string The result, or a string containing an error
     */
    public static function distribution($value, $mean, $cumulative)
    {
        $value = Functions::flattenSingleValue($value);
        $mean = Functions::flattenSingleValue($mean);
>>>>>>> forked/LAE_400_PACKAGE

        try {
            $value = DistributionValidations::validateFloat($value);
            $mean = DistributionValidations::validateFloat($mean);
            $cumulative = DistributionValidations::validateBool($cumulative);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        if (($value < 0) || ($mean < 0)) {
<<<<<<< HEAD
            return ExcelError::NAN();
=======
            return Functions::NAN();
>>>>>>> forked/LAE_400_PACKAGE
        }

        if ($cumulative) {
            $summer = 0;
            $floor = floor($value);
            for ($i = 0; $i <= $floor; ++$i) {
<<<<<<< HEAD
                /** @var float */
                $fact = MathTrig\Factorial::fact($i);
                $summer += $mean ** $i / $fact;
=======
                $summer += $mean ** $i / MathTrig\Factorial::fact($i);
>>>>>>> forked/LAE_400_PACKAGE
            }

            return exp(0 - $mean) * $summer;
        }
<<<<<<< HEAD
        /** @var float */
        $fact = MathTrig\Factorial::fact($value);

        return (exp(0 - $mean) * $mean ** $value) / $fact;
=======

        return (exp(0 - $mean) * $mean ** $value) / MathTrig\Factorial::fact($value);
>>>>>>> forked/LAE_400_PACKAGE
    }
}
