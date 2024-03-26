<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\Engineering;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;

class BitWise
{
    use ArrayEnabled;

=======
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;

class BitWise
{
>>>>>>> forked/LAE_400_PACKAGE
    const SPLIT_DIVISOR = 2 ** 24;

    /**
     * Split a number into upper and lower portions for full 32-bit support.
     *
     * @param float|int $number
     */
    private static function splitNumber($number): array
    {
        return [floor($number / self::SPLIT_DIVISOR), fmod($number, self::SPLIT_DIVISOR)];
    }

    /**
     * BITAND.
     *
     * Returns the bitwise AND of two integer values.
     *
     * Excel Function:
     *        BITAND(number1, number2)
     *
<<<<<<< HEAD
     * @param array|int $number1
     *                      Or can be an array of values
     * @param array|int $number2
     *                      Or can be an array of values
     *
     * @return array|int|string
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function BITAND($number1, $number2)
    {
        if (is_array($number1) || is_array($number2)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $number1, $number2);
        }

=======
     * @param int $number1
     * @param int $number2
     *
     * @return int|string
     */
    public static function BITAND($number1, $number2)
    {
>>>>>>> forked/LAE_400_PACKAGE
        try {
            $number1 = self::validateBitwiseArgument($number1);
            $number2 = self::validateBitwiseArgument($number2);
        } catch (Exception $e) {
            return $e->getMessage();
        }
        $split1 = self::splitNumber($number1);
        $split2 = self::splitNumber($number2);

        return  self::SPLIT_DIVISOR * ($split1[0] & $split2[0]) + ($split1[1] & $split2[1]);
    }

    /**
     * BITOR.
     *
     * Returns the bitwise OR of two integer values.
     *
     * Excel Function:
     *        BITOR(number1, number2)
     *
<<<<<<< HEAD
     * @param array|int $number1
     *                      Or can be an array of values
     * @param array|int $number2
     *                      Or can be an array of values
     *
     * @return array|int|string
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function BITOR($number1, $number2)
    {
        if (is_array($number1) || is_array($number2)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $number1, $number2);
        }

=======
     * @param int $number1
     * @param int $number2
     *
     * @return int|string
     */
    public static function BITOR($number1, $number2)
    {
>>>>>>> forked/LAE_400_PACKAGE
        try {
            $number1 = self::validateBitwiseArgument($number1);
            $number2 = self::validateBitwiseArgument($number2);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $split1 = self::splitNumber($number1);
        $split2 = self::splitNumber($number2);

        return  self::SPLIT_DIVISOR * ($split1[0] | $split2[0]) + ($split1[1] | $split2[1]);
    }

    /**
     * BITXOR.
     *
     * Returns the bitwise XOR of two integer values.
     *
     * Excel Function:
     *        BITXOR(number1, number2)
     *
<<<<<<< HEAD
     * @param array|int $number1
     *                      Or can be an array of values
     * @param array|int $number2
     *                      Or can be an array of values
     *
     * @return array|int|string
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function BITXOR($number1, $number2)
    {
        if (is_array($number1) || is_array($number2)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $number1, $number2);
        }

=======
     * @param int $number1
     * @param int $number2
     *
     * @return int|string
     */
    public static function BITXOR($number1, $number2)
    {
>>>>>>> forked/LAE_400_PACKAGE
        try {
            $number1 = self::validateBitwiseArgument($number1);
            $number2 = self::validateBitwiseArgument($number2);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $split1 = self::splitNumber($number1);
        $split2 = self::splitNumber($number2);

        return  self::SPLIT_DIVISOR * ($split1[0] ^ $split2[0]) + ($split1[1] ^ $split2[1]);
    }

    /**
     * BITLSHIFT.
     *
     * Returns the number value shifted left by shift_amount bits.
     *
     * Excel Function:
     *        BITLSHIFT(number, shift_amount)
     *
<<<<<<< HEAD
     * @param array|int $number
     *                      Or can be an array of values
     * @param array|int $shiftAmount
     *                      Or can be an array of values
     *
     * @return array|float|int|string
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function BITLSHIFT($number, $shiftAmount)
    {
        if (is_array($number) || is_array($shiftAmount)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $number, $shiftAmount);
        }

=======
     * @param int $number
     * @param int $shiftAmount
     *
     * @return float|int|string
     */
    public static function BITLSHIFT($number, $shiftAmount)
    {
>>>>>>> forked/LAE_400_PACKAGE
        try {
            $number = self::validateBitwiseArgument($number);
            $shiftAmount = self::validateShiftAmount($shiftAmount);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $result = floor($number * (2 ** $shiftAmount));
        if ($result > 2 ** 48 - 1) {
<<<<<<< HEAD
            return ExcelError::NAN();
=======
            return Functions::NAN();
>>>>>>> forked/LAE_400_PACKAGE
        }

        return $result;
    }

    /**
     * BITRSHIFT.
     *
     * Returns the number value shifted right by shift_amount bits.
     *
     * Excel Function:
     *        BITRSHIFT(number, shift_amount)
     *
<<<<<<< HEAD
     * @param array|int $number
     *                      Or can be an array of values
     * @param array|int $shiftAmount
     *                      Or can be an array of values
     *
     * @return array|float|int|string
     *         If an array of numbers is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function BITRSHIFT($number, $shiftAmount)
    {
        if (is_array($number) || is_array($shiftAmount)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $number, $shiftAmount);
        }

=======
     * @param int $number
     * @param int $shiftAmount
     *
     * @return float|int|string
     */
    public static function BITRSHIFT($number, $shiftAmount)
    {
>>>>>>> forked/LAE_400_PACKAGE
        try {
            $number = self::validateBitwiseArgument($number);
            $shiftAmount = self::validateShiftAmount($shiftAmount);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $result = floor($number / (2 ** $shiftAmount));
        if ($result > 2 ** 48 - 1) { // possible because shiftAmount can be negative
<<<<<<< HEAD
            return ExcelError::NAN();
=======
            return Functions::NAN();
>>>>>>> forked/LAE_400_PACKAGE
        }

        return $result;
    }

    /**
     * Validate arguments passed to the bitwise functions.
     *
     * @param mixed $value
     *
<<<<<<< HEAD
     * @return float
     */
    private static function validateBitwiseArgument($value)
    {
        $value = self::nullFalseTrueToNumber($value);

        if (is_numeric($value)) {
            $value = (float) $value;
            if ($value == floor($value)) {
                if (($value > 2 ** 48 - 1) || ($value < 0)) {
                    throw new Exception(ExcelError::NAN());
=======
     * @return float|int
     */
    private static function validateBitwiseArgument($value)
    {
        self::nullFalseTrueToNumber($value);

        if (is_numeric($value)) {
            if ($value == floor($value)) {
                if (($value > 2 ** 48 - 1) || ($value < 0)) {
                    throw new Exception(Functions::NAN());
>>>>>>> forked/LAE_400_PACKAGE
                }

                return floor($value);
            }

<<<<<<< HEAD
            throw new Exception(ExcelError::NAN());
        }

        throw new Exception(ExcelError::VALUE());
=======
            throw new Exception(Functions::NAN());
        }

        throw new Exception(Functions::VALUE());
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Validate arguments passed to the bitwise functions.
     *
     * @param mixed $value
     *
     * @return int
     */
    private static function validateShiftAmount($value)
    {
<<<<<<< HEAD
        $value = self::nullFalseTrueToNumber($value);

        if (is_numeric($value)) {
            if (abs($value) > 53) {
                throw new Exception(ExcelError::NAN());
=======
        self::nullFalseTrueToNumber($value);

        if (is_numeric($value)) {
            if (abs($value) > 53) {
                throw new Exception(Functions::NAN());
>>>>>>> forked/LAE_400_PACKAGE
            }

            return (int) $value;
        }

<<<<<<< HEAD
        throw new Exception(ExcelError::VALUE());
=======
        throw new Exception(Functions::VALUE());
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Many functions accept null/false/true argument treated as 0/0/1.
     *
     * @param mixed $number
<<<<<<< HEAD
     *
     * @return mixed
     */
    private static function nullFalseTrueToNumber(&$number)
    {
=======
     */
    public static function nullFalseTrueToNumber(&$number): void
    {
        $number = Functions::flattenSingleValue($number);
>>>>>>> forked/LAE_400_PACKAGE
        if ($number === null) {
            $number = 0;
        } elseif (is_bool($number)) {
            $number = (int) $number;
        }
<<<<<<< HEAD

        return $number;
=======
>>>>>>> forked/LAE_400_PACKAGE
    }
}
