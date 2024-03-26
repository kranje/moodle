<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\TextData;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
use PhpOffice\PhpSpreadsheet\Calculation\Information\ErrorValue;
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;

class Concatenate
{
    use ArrayEnabled;

=======
use PhpOffice\PhpSpreadsheet\Calculation\Functions;

class Concatenate
{
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * CONCATENATE.
     *
     * @param array $args
     */
    public static function CONCATENATE(...$args): string
    {
        $returnValue = '';

        // Loop through arguments
        $aArgs = Functions::flattenArray($args);

        foreach ($aArgs as $arg) {
<<<<<<< HEAD
            $value = Helpers::extractString($arg);
            if (ErrorValue::isError($value)) {
                $returnValue = $value;

                break;
            }
            $returnValue .= Helpers::extractString($arg);
            if (StringHelper::countCharacters($returnValue) > DataType::MAX_STRING_LENGTH) {
                $returnValue = ExcelError::CALC();

                break;
            }
=======
            $returnValue .= Helpers::extractString($arg);
>>>>>>> forked/LAE_400_PACKAGE
        }

        return $returnValue;
    }

    /**
     * TEXTJOIN.
     *
<<<<<<< HEAD
     * @param mixed $delimiter The delimter to use between the joined arguments
     *                         Or can be an array of values
     * @param mixed $ignoreEmpty true/false Flag indicating whether empty arguments should be skipped
     *                         Or can be an array of values
     * @param mixed $args The values to join
     *
     * @return array|string The joined string
     *         If an array of values is passed for the $delimiter or $ignoreEmpty arguments, then the returned result
     *            will also be an array with matching dimensions
     */
    public static function TEXTJOIN($delimiter, $ignoreEmpty, ...$args)
    {
        if (is_array($delimiter) || is_array($ignoreEmpty)) {
            return self::evaluateArrayArgumentsSubset(
                [self::class, __FUNCTION__],
                2,
                $delimiter,
                $ignoreEmpty,
                ...$args
            );
        }

        // Loop through arguments
        $aArgs = Functions::flattenArray($args);
        $returnValue = '';
        foreach ($aArgs as $key => &$arg) {
            $value = Helpers::extractString($arg);
            if (ErrorValue::isError($value)) {
                $returnValue = $value;

                break;
            }
=======
     * @param mixed $delimiter
     * @param mixed $ignoreEmpty
     * @param mixed $args
     */
    public static function TEXTJOIN($delimiter, $ignoreEmpty, ...$args): string
    {
        $delimiter = Functions::flattenSingleValue($delimiter);
        $ignoreEmpty = Functions::flattenSingleValue($ignoreEmpty);
        // Loop through arguments
        $aArgs = Functions::flattenArray($args);
        foreach ($aArgs as $key => &$arg) {
>>>>>>> forked/LAE_400_PACKAGE
            if ($ignoreEmpty === true && is_string($arg) && trim($arg) === '') {
                unset($aArgs[$key]);
            } elseif (is_bool($arg)) {
                $arg = Helpers::convertBooleanValue($arg);
            }
        }

<<<<<<< HEAD
        $returnValue = ($returnValue !== '') ? $returnValue : implode($delimiter, $aArgs);
        if (StringHelper::countCharacters($returnValue) > DataType::MAX_STRING_LENGTH) {
            $returnValue = ExcelError::CALC();
        }

        return $returnValue;
=======
        return implode($delimiter, $aArgs);
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * REPT.
     *
     * Returns the result of builtin function round after validating args.
     *
     * @param mixed $stringValue The value to repeat
<<<<<<< HEAD
     *                         Or can be an array of values
     * @param mixed $repeatCount The number of times the string value should be repeated
     *                         Or can be an array of values
     *
     * @return array|string The repeated string
     *         If an array of values is passed for the $stringValue or $repeatCount arguments, then the returned result
     *            will also be an array with matching dimensions
     */
    public static function builtinREPT($stringValue, $repeatCount)
    {
        if (is_array($stringValue) || is_array($repeatCount)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $stringValue, $repeatCount);
        }

        $stringValue = Helpers::extractString($stringValue);

        if (!is_numeric($repeatCount) || $repeatCount < 0) {
            $returnValue = ExcelError::VALUE();
        } elseif (ErrorValue::isError($stringValue)) {
            $returnValue = $stringValue;
        } else {
            $returnValue = str_repeat($stringValue, (int) $repeatCount);
            if (StringHelper::countCharacters($returnValue) > DataType::MAX_STRING_LENGTH) {
                $returnValue = ExcelError::VALUE(); // note VALUE not CALC
            }
        }

        return $returnValue;
=======
     * @param mixed $repeatCount The number of times the string value should be repeated
     */
    public static function builtinREPT($stringValue, $repeatCount): string
    {
        $repeatCount = Functions::flattenSingleValue($repeatCount);
        $stringValue = Helpers::extractString($stringValue);

        if (!is_numeric($repeatCount) || $repeatCount < 0) {
            return Functions::VALUE();
        }

        return str_repeat($stringValue, (int) $repeatCount);
>>>>>>> forked/LAE_400_PACKAGE
    }
}
