<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;

class Gamma extends GammaBase
{
    use ArrayEnabled;

=======
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;

class Gamma extends GammaBase
{
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * GAMMA.
     *
     * Return the gamma function value.
     *
     * @param mixed $value Float value for which we want the probability
<<<<<<< HEAD
     *                      Or can be an array of values
     *
     * @return array|float|string The result, or a string containing an error
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function gamma($value)
    {
        if (is_array($value)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $value);
        }
=======
     *
     * @return float|string The result, or a string containing an error
     */
    public static function gamma($value)
    {
        $value = Functions::flattenSingleValue($value);
>>>>>>> forked/LAE_400_PACKAGE

        try {
            $value = DistributionValidations::validateFloat($value);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        if ((((int) $value) == ((float) $value)) && $value <= 0.0) {
<<<<<<< HEAD
            return ExcelError::NAN();
=======
            return Functions::NAN();
>>>>>>> forked/LAE_400_PACKAGE
        }

        return self::gammaValue($value);
    }

    /**
     * GAMMADIST.
     *
     * Returns the gamma distribution.
     *
     * @param mixed $value Float Value at which you want to evaluate the distribution
<<<<<<< HEAD
     *                      Or can be an array of values
     * @param mixed $a Parameter to the distribution as a float
     *                      Or can be an array of values
     * @param mixed $b Parameter to the distribution as a float
     *                      Or can be an array of values
     * @param mixed $cumulative Boolean value indicating if we want the cdf (true) or the pdf (false)
     *                      Or can be an array of values
     *
     * @return array|float|string
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function distribution($value, $a, $b, $cumulative)
    {
        if (is_array($value) || is_array($a) || is_array($b) || is_array($cumulative)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $value, $a, $b, $cumulative);
        }
=======
     * @param mixed $a Parameter to the distribution as a float
     * @param mixed $b Parameter to the distribution as a float
     * @param mixed $cumulative Boolean value indicating if we want the cdf (true) or the pdf (false)
     *
     * @return float|string
     */
    public static function distribution($value, $a, $b, $cumulative)
    {
        $value = Functions::flattenSingleValue($value);
        $a = Functions::flattenSingleValue($a);
        $b = Functions::flattenSingleValue($b);
>>>>>>> forked/LAE_400_PACKAGE

        try {
            $value = DistributionValidations::validateFloat($value);
            $a = DistributionValidations::validateFloat($a);
            $b = DistributionValidations::validateFloat($b);
            $cumulative = DistributionValidations::validateBool($cumulative);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        if (($value < 0) || ($a <= 0) || ($b <= 0)) {
<<<<<<< HEAD
            return ExcelError::NAN();
=======
            return Functions::NAN();
>>>>>>> forked/LAE_400_PACKAGE
        }

        return self::calculateDistribution($value, $a, $b, $cumulative);
    }

    /**
     * GAMMAINV.
     *
     * Returns the inverse of the Gamma distribution.
     *
     * @param mixed $probability Float probability at which you want to evaluate the distribution
<<<<<<< HEAD
     *                      Or can be an array of values
     * @param mixed $alpha Parameter to the distribution as a float
     *                      Or can be an array of values
     * @param mixed $beta Parameter to the distribution as a float
     *                      Or can be an array of values
     *
     * @return array|float|string
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function inverse($probability, $alpha, $beta)
    {
        if (is_array($probability) || is_array($alpha) || is_array($beta)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $probability, $alpha, $beta);
        }
=======
     * @param mixed $alpha Parameter to the distribution as a float
     * @param mixed $beta Parameter to the distribution as a float
     *
     * @return float|string
     */
    public static function inverse($probability, $alpha, $beta)
    {
        $probability = Functions::flattenSingleValue($probability);
        $alpha = Functions::flattenSingleValue($alpha);
        $beta = Functions::flattenSingleValue($beta);
>>>>>>> forked/LAE_400_PACKAGE

        try {
            $probability = DistributionValidations::validateProbability($probability);
            $alpha = DistributionValidations::validateFloat($alpha);
            $beta = DistributionValidations::validateFloat($beta);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        if (($alpha <= 0.0) || ($beta <= 0.0)) {
<<<<<<< HEAD
            return ExcelError::NAN();
=======
            return Functions::NAN();
>>>>>>> forked/LAE_400_PACKAGE
        }

        return self::calculateInverse($probability, $alpha, $beta);
    }

    /**
     * GAMMALN.
     *
     * Returns the natural logarithm of the gamma function.
     *
     * @param mixed $value Float Value at which you want to evaluate the distribution
<<<<<<< HEAD
     *                      Or can be an array of values
     *
     * @return array|float|string
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function ln($value)
    {
        if (is_array($value)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $value);
        }
=======
     *
     * @return float|string
     */
    public static function ln($value)
    {
        $value = Functions::flattenSingleValue($value);
>>>>>>> forked/LAE_400_PACKAGE

        try {
            $value = DistributionValidations::validateFloat($value);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        if ($value <= 0) {
<<<<<<< HEAD
            return ExcelError::NAN();
=======
            return Functions::NAN();
>>>>>>> forked/LAE_400_PACKAGE
        }

        return log(self::gammaValue($value));
    }
}
