<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
=======
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
>>>>>>> forked/LAE_400_PACKAGE
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Combinations;

class Binomial
{
<<<<<<< HEAD
    use ArrayEnabled;

=======
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * BINOMDIST.
     *
     * Returns the individual term binomial distribution probability. Use BINOMDIST in problems with
     *        a fixed number of tests or trials, when the outcomes of any trial are only success or failure,
     *        when trials are independent, and when the probability of success is constant throughout the
     *        experiment. For example, BINOMDIST can calculate the probability that two of the next three
     *        babies born are male.
     *
     * @param mixed $value Integer number of successes in trials
<<<<<<< HEAD
     *                      Or can be an array of values
     * @param mixed $trials Integer umber of trials
     *                      Or can be an array of values
     * @param mixed $probability Probability of success on each trial as a float
     *                      Or can be an array of values
     * @param mixed $cumulative Boolean value indicating if we want the cdf (true) or the pdf (false)
     *                      Or can be an array of values
     *
     * @return array|float|string
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function distribution($value, $trials, $probability, $cumulative)
    {
        if (is_array($value) || is_array($trials) || is_array($probability) || is_array($cumulative)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $value, $trials, $probability, $cumulative);
        }
=======
     * @param mixed $trials Integer umber of trials
     * @param mixed $probability Probability of success on each trial as a float
     * @param mixed $cumulative Boolean value indicating if we want the cdf (true) or the pdf (false)
     *
     * @return float|string
     */
    public static function distribution($value, $trials, $probability, $cumulative)
    {
        $value = Functions::flattenSingleValue($value);
        $trials = Functions::flattenSingleValue($trials);
        $probability = Functions::flattenSingleValue($probability);
>>>>>>> forked/LAE_400_PACKAGE

        try {
            $value = DistributionValidations::validateInt($value);
            $trials = DistributionValidations::validateInt($trials);
            $probability = DistributionValidations::validateProbability($probability);
            $cumulative = DistributionValidations::validateBool($cumulative);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        if (($value < 0) || ($value > $trials)) {
<<<<<<< HEAD
            return ExcelError::NAN();
=======
            return Functions::NAN();
>>>>>>> forked/LAE_400_PACKAGE
        }

        if ($cumulative) {
            return self::calculateCumulativeBinomial($value, $trials, $probability);
        }
<<<<<<< HEAD
        /** @var float */
        $comb = Combinations::withoutRepetition($trials, $value);

        return $comb * $probability ** $value
=======

        return Combinations::withoutRepetition($trials, $value) * $probability ** $value
>>>>>>> forked/LAE_400_PACKAGE
            * (1 - $probability) ** ($trials - $value);
    }

    /**
     * BINOM.DIST.RANGE.
     *
     * Returns returns the Binomial Distribution probability for the number of successes from a specified number
     *     of trials falling into a specified range.
     *
     * @param mixed $trials Integer number of trials
<<<<<<< HEAD
     *                      Or can be an array of values
     * @param mixed $probability Probability of success on each trial as a float
     *                      Or can be an array of values
     * @param mixed $successes The integer number of successes in trials
     *                      Or can be an array of values
     * @param mixed $limit Upper limit for successes in trials as null, or an integer
     *                           If null, then this will indicate the same as the number of Successes
     *                      Or can be an array of values
     *
     * @return array|float|string
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function range($trials, $probability, $successes, $limit = null)
    {
        if (is_array($trials) || is_array($probability) || is_array($successes) || is_array($limit)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $trials, $probability, $successes, $limit);
        }

        $limit = $limit ?? $successes;
=======
     * @param mixed $probability Probability of success on each trial as a float
     * @param mixed $successes The integer number of successes in trials
     * @param mixed $limit Upper limit for successes in trials as null, or an integer
     *                           If null, then this will indicate the same as the number of Successes
     *
     * @return float|string
     */
    public static function range($trials, $probability, $successes, $limit = null)
    {
        $trials = Functions::flattenSingleValue($trials);
        $probability = Functions::flattenSingleValue($probability);
        $successes = Functions::flattenSingleValue($successes);
        $limit = ($limit === null) ? $successes : Functions::flattenSingleValue($limit);
>>>>>>> forked/LAE_400_PACKAGE

        try {
            $trials = DistributionValidations::validateInt($trials);
            $probability = DistributionValidations::validateProbability($probability);
            $successes = DistributionValidations::validateInt($successes);
            $limit = DistributionValidations::validateInt($limit);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        if (($successes < 0) || ($successes > $trials)) {
<<<<<<< HEAD
            return ExcelError::NAN();
        }
        if (($limit < 0) || ($limit > $trials) || $limit < $successes) {
            return ExcelError::NAN();
=======
            return Functions::NAN();
        }
        if (($limit < 0) || ($limit > $trials) || $limit < $successes) {
            return Functions::NAN();
>>>>>>> forked/LAE_400_PACKAGE
        }

        $summer = 0;
        for ($i = $successes; $i <= $limit; ++$i) {
<<<<<<< HEAD
            /** @var float */
            $comb = Combinations::withoutRepetition($trials, $i);
            $summer += $comb * $probability ** $i
=======
            $summer += Combinations::withoutRepetition($trials, $i) * $probability ** $i
>>>>>>> forked/LAE_400_PACKAGE
                * (1 - $probability) ** ($trials - $i);
        }

        return $summer;
    }

    /**
     * NEGBINOMDIST.
     *
     * Returns the negative binomial distribution. NEGBINOMDIST returns the probability that
     *        there will be number_f failures before the number_s-th success, when the constant
     *        probability of a success is probability_s. This function is similar to the binomial
     *        distribution, except that the number of successes is fixed, and the number of trials is
     *        variable. Like the binomial, trials are assumed to be independent.
     *
     * @param mixed $failures Number of Failures as an integer
<<<<<<< HEAD
     *                      Or can be an array of values
     * @param mixed $successes Threshold number of Successes as an integer
     *                      Or can be an array of values
     * @param mixed $probability Probability of success on each trial as a float
     *                      Or can be an array of values
     *
     * @return array|float|string The result, or a string containing an error
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
=======
     * @param mixed $successes Threshold number of Successes as an integer
     * @param mixed $probability Probability of success on each trial as a float
     *
     * @return float|string The result, or a string containing an error
>>>>>>> forked/LAE_400_PACKAGE
     *
     * TODO Add support for the cumulative flag not present for NEGBINOMDIST, but introduced for NEGBINOM.DIST
     *      The cumulative default should be false to reflect the behaviour of NEGBINOMDIST
     */
    public static function negative($failures, $successes, $probability)
    {
<<<<<<< HEAD
        if (is_array($failures) || is_array($successes) || is_array($probability)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $failures, $successes, $probability);
        }
=======
        $failures = Functions::flattenSingleValue($failures);
        $successes = Functions::flattenSingleValue($successes);
        $probability = Functions::flattenSingleValue($probability);
>>>>>>> forked/LAE_400_PACKAGE

        try {
            $failures = DistributionValidations::validateInt($failures);
            $successes = DistributionValidations::validateInt($successes);
            $probability = DistributionValidations::validateProbability($probability);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        if (($failures < 0) || ($successes < 1)) {
<<<<<<< HEAD
            return ExcelError::NAN();
        }
        if (Functions::getCompatibilityMode() == Functions::COMPATIBILITY_GNUMERIC) {
            if (($failures + $successes - 1) <= 0) {
                return ExcelError::NAN();
            }
        }
        /** @var float */
        $comb = Combinations::withoutRepetition($failures + $successes - 1, $successes - 1);

        return $comb
=======
            return Functions::NAN();
        }
        if (Functions::getCompatibilityMode() == Functions::COMPATIBILITY_GNUMERIC) {
            if (($failures + $successes - 1) <= 0) {
                return Functions::NAN();
            }
        }

        return (Combinations::withoutRepetition($failures + $successes - 1, $successes - 1))
>>>>>>> forked/LAE_400_PACKAGE
            * ($probability ** $successes) * ((1 - $probability) ** $failures);
    }

    /**
<<<<<<< HEAD
     * BINOM.INV.
=======
     * CRITBINOM.
>>>>>>> forked/LAE_400_PACKAGE
     *
     * Returns the smallest value for which the cumulative binomial distribution is greater
     *        than or equal to a criterion value
     *
     * @param mixed $trials number of Bernoulli trials as an integer
<<<<<<< HEAD
     *                      Or can be an array of values
     * @param mixed $probability probability of a success on each trial as a float
     *                      Or can be an array of values
     * @param mixed $alpha criterion value as a float
     *                      Or can be an array of values
     *
     * @return array|int|string
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function inverse($trials, $probability, $alpha)
    {
        if (is_array($trials) || is_array($probability) || is_array($alpha)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $trials, $probability, $alpha);
        }
=======
     * @param mixed $probability probability of a success on each trial as a float
     * @param mixed $alpha criterion value as a float
     *
     * @return int|string
     */
    public static function inverse($trials, $probability, $alpha)
    {
        $trials = Functions::flattenSingleValue($trials);
        $probability = Functions::flattenSingleValue($probability);
        $alpha = Functions::flattenSingleValue($alpha);
>>>>>>> forked/LAE_400_PACKAGE

        try {
            $trials = DistributionValidations::validateInt($trials);
            $probability = DistributionValidations::validateProbability($probability);
            $alpha = DistributionValidations::validateFloat($alpha);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        if ($trials < 0) {
<<<<<<< HEAD
            return ExcelError::NAN();
        } elseif (($alpha < 0.0) || ($alpha > 1.0)) {
            return ExcelError::NAN();
=======
            return Functions::NAN();
        } elseif (($alpha < 0.0) || ($alpha > 1.0)) {
            return Functions::NAN();
>>>>>>> forked/LAE_400_PACKAGE
        }

        $successes = 0;
        while ($successes <= $trials) {
            $result = self::calculateCumulativeBinomial($successes, $trials, $probability);
            if ($result >= $alpha) {
                break;
            }
            ++$successes;
        }

        return $successes;
    }

    /**
     * @return float|int
     */
    private static function calculateCumulativeBinomial(int $value, int $trials, float $probability)
    {
        $summer = 0;
        for ($i = 0; $i <= $value; ++$i) {
<<<<<<< HEAD
            /** @var float */
            $comb = Combinations::withoutRepetition($trials, $i);
            $summer += $comb * $probability ** $i
=======
            $summer += Combinations::withoutRepetition($trials, $i) * $probability ** $i
>>>>>>> forked/LAE_400_PACKAGE
                * (1 - $probability) ** ($trials - $i);
        }

        return $summer;
    }
}
