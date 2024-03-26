<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\Engineering;

use Complex\Complex as ComplexObject;
use Complex\Exception as ComplexException;
<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;

class ComplexOperations
{
    use ArrayEnabled;

=======
use PhpOffice\PhpSpreadsheet\Calculation\Functions;

class ComplexOperations
{
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * IMDIV.
     *
     * Returns the quotient of two complex numbers in x + yi or x + yj text format.
     *
     * Excel Function:
     *        IMDIV(complexDividend,complexDivisor)
     *
<<<<<<< HEAD
     * @param array|string $complexDividend the complex numerator or dividend
     *                      Or can be an array of values
     * @param array|string $complexDivisor the complex denominator or divisor
     *                      Or can be an array of values
     *
     * @return array|string
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function IMDIV($complexDividend, $complexDivisor)
    {
        if (is_array($complexDividend) || is_array($complexDivisor)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $complexDividend, $complexDivisor);
        }
=======
     * @param string $complexDividend the complex numerator or dividend
     * @param string $complexDivisor the complex denominator or divisor
     *
     * @return string
     */
    public static function IMDIV($complexDividend, $complexDivisor)
    {
        $complexDividend = Functions::flattenSingleValue($complexDividend);
        $complexDivisor = Functions::flattenSingleValue($complexDivisor);
>>>>>>> forked/LAE_400_PACKAGE

        try {
            return (string) (new ComplexObject($complexDividend))->divideby(new ComplexObject($complexDivisor));
        } catch (ComplexException $e) {
<<<<<<< HEAD
            return ExcelError::NAN();
=======
            return Functions::NAN();
>>>>>>> forked/LAE_400_PACKAGE
        }
    }

    /**
     * IMSUB.
     *
     * Returns the difference of two complex numbers in x + yi or x + yj text format.
     *
     * Excel Function:
     *        IMSUB(complexNumber1,complexNumber2)
     *
<<<<<<< HEAD
     * @param array|string $complexNumber1 the complex number from which to subtract complexNumber2
     *                      Or can be an array of values
     * @param array|string $complexNumber2 the complex number to subtract from complexNumber1
     *                      Or can be an array of values
     *
     * @return array|string
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function IMSUB($complexNumber1, $complexNumber2)
    {
        if (is_array($complexNumber1) || is_array($complexNumber2)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $complexNumber1, $complexNumber2);
        }
=======
     * @param string $complexNumber1 the complex number from which to subtract complexNumber2
     * @param string $complexNumber2 the complex number to subtract from complexNumber1
     *
     * @return string
     */
    public static function IMSUB($complexNumber1, $complexNumber2)
    {
        $complexNumber1 = Functions::flattenSingleValue($complexNumber1);
        $complexNumber2 = Functions::flattenSingleValue($complexNumber2);
>>>>>>> forked/LAE_400_PACKAGE

        try {
            return (string) (new ComplexObject($complexNumber1))->subtract(new ComplexObject($complexNumber2));
        } catch (ComplexException $e) {
<<<<<<< HEAD
            return ExcelError::NAN();
=======
            return Functions::NAN();
>>>>>>> forked/LAE_400_PACKAGE
        }
    }

    /**
     * IMSUM.
     *
     * Returns the sum of two or more complex numbers in x + yi or x + yj text format.
     *
     * Excel Function:
     *        IMSUM(complexNumber[,complexNumber[,...]])
     *
     * @param string ...$complexNumbers Series of complex numbers to add
     *
     * @return string
     */
    public static function IMSUM(...$complexNumbers)
    {
        // Return value
        $returnValue = new ComplexObject(0.0);
        $aArgs = Functions::flattenArray($complexNumbers);

        try {
            // Loop through the arguments
            foreach ($aArgs as $complex) {
                $returnValue = $returnValue->add(new ComplexObject($complex));
            }
        } catch (ComplexException $e) {
<<<<<<< HEAD
            return ExcelError::NAN();
=======
            return Functions::NAN();
>>>>>>> forked/LAE_400_PACKAGE
        }

        return (string) $returnValue;
    }

    /**
     * IMPRODUCT.
     *
     * Returns the product of two or more complex numbers in x + yi or x + yj text format.
     *
     * Excel Function:
     *        IMPRODUCT(complexNumber[,complexNumber[,...]])
     *
     * @param string ...$complexNumbers Series of complex numbers to multiply
     *
     * @return string
     */
    public static function IMPRODUCT(...$complexNumbers)
    {
        // Return value
        $returnValue = new ComplexObject(1.0);
        $aArgs = Functions::flattenArray($complexNumbers);

        try {
            // Loop through the arguments
            foreach ($aArgs as $complex) {
                $returnValue = $returnValue->multiply(new ComplexObject($complex));
            }
        } catch (ComplexException $e) {
<<<<<<< HEAD
            return ExcelError::NAN();
=======
            return Functions::NAN();
>>>>>>> forked/LAE_400_PACKAGE
        }

        return (string) $returnValue;
    }
}
