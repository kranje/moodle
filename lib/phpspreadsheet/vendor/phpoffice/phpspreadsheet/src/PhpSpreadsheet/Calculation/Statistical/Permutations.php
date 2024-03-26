<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\Statistical;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
=======
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
>>>>>>> forked/LAE_400_PACKAGE
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig;
use PhpOffice\PhpSpreadsheet\Shared\IntOrFloat;

class Permutations
{
<<<<<<< HEAD
    use ArrayEnabled;

=======
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * PERMUT.
     *
     * Returns the number of permutations for a given number of objects that can be
     *        selected from number objects. A permutation is any set or subset of objects or
     *        events where internal order is significant. Permutations are different from
     *        combinations, for which the internal order is not significant. Use this function
     *        for lottery-style probability calculations.
     *
     * @param mixed $numObjs Integer number of different objects
<<<<<<< HEAD
     *                      Or can be an array of values
     * @param mixed $numInSet Integer number of objects in each permutation
     *                      Or can be an array of values
     *
     * @return array|float|int|string Number of permutations, or a string containing an error
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function PERMUT($numObjs, $numInSet)
    {
        if (is_array($numObjs) || is_array($numInSet)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $numObjs, $numInSet);
        }
=======
     * @param mixed $numInSet Integer number of objects in each permutation
     *
     * @return float|int|string Number of permutations, or a string containing an error
     */
    public static function PERMUT($numObjs, $numInSet)
    {
        $numObjs = Functions::flattenSingleValue($numObjs);
        $numInSet = Functions::flattenSingleValue($numInSet);
>>>>>>> forked/LAE_400_PACKAGE

        try {
            $numObjs = StatisticalValidations::validateInt($numObjs);
            $numInSet = StatisticalValidations::validateInt($numInSet);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        if ($numObjs < $numInSet) {
<<<<<<< HEAD
            return ExcelError::NAN();
=======
            return Functions::NAN();
>>>>>>> forked/LAE_400_PACKAGE
        }
        $result = round(MathTrig\Factorial::fact($numObjs) / MathTrig\Factorial::fact($numObjs - $numInSet));

        return IntOrFloat::evaluate($result);
    }

    /**
     * PERMUTATIONA.
     *
     * Returns the number of permutations for a given number of objects (with repetitions)
     *     that can be selected from the total objects.
     *
     * @param mixed $numObjs Integer number of different objects
<<<<<<< HEAD
     *                      Or can be an array of values
     * @param mixed $numInSet Integer number of objects in each permutation
     *                      Or can be an array of values
     *
     * @return array|float|int|string Number of permutations, or a string containing an error
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function PERMUTATIONA($numObjs, $numInSet)
    {
        if (is_array($numObjs) || is_array($numInSet)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $numObjs, $numInSet);
        }
=======
     * @param mixed $numInSet Integer number of objects in each permutation
     *
     * @return float|int|string Number of permutations, or a string containing an error
     */
    public static function PERMUTATIONA($numObjs, $numInSet)
    {
        $numObjs = Functions::flattenSingleValue($numObjs);
        $numInSet = Functions::flattenSingleValue($numInSet);
>>>>>>> forked/LAE_400_PACKAGE

        try {
            $numObjs = StatisticalValidations::validateInt($numObjs);
            $numInSet = StatisticalValidations::validateInt($numInSet);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        if ($numObjs < 0 || $numInSet < 0) {
<<<<<<< HEAD
            return ExcelError::NAN();
=======
            return Functions::NAN();
>>>>>>> forked/LAE_400_PACKAGE
        }

        $result = $numObjs ** $numInSet;

        return IntOrFloat::evaluate($result);
    }
}
