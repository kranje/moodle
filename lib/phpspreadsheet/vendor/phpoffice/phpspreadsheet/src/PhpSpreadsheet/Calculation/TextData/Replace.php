<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\TextData;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
use PhpOffice\PhpSpreadsheet\Calculation\Exception as CalcExp;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;

class Replace
{
    use ArrayEnabled;

=======
use PhpOffice\PhpSpreadsheet\Calculation\Exception as CalcExp;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;

class Replace
{
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * REPLACE.
     *
     * @param mixed $oldText The text string value to modify
<<<<<<< HEAD
     *                         Or can be an array of values
     * @param mixed $start Integer offset for start character of the replacement
     *                         Or can be an array of values
     * @param mixed $chars Integer number of characters to replace from the start offset
     *                         Or can be an array of values
     * @param mixed $newText String to replace in the defined position
     *                         Or can be an array of values
     *
     * @return array|string
     *         If an array of values is passed for either of the arguments, then the returned result
     *            will also be an array with matching dimensions
     */
    public static function replace($oldText, $start, $chars, $newText)
    {
        if (is_array($oldText) || is_array($start) || is_array($chars) || is_array($newText)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $oldText, $start, $chars, $newText);
        }

        try {
            $start = Helpers::extractInt($start, 1, 0, true);
            $chars = Helpers::extractInt($chars, 0, 0, true);
            $oldText = Helpers::extractString($oldText, true);
            $newText = Helpers::extractString($newText, true);
            $left = StringHelper::substring($oldText, 0, $start - 1);

            $right = StringHelper::substring($oldText, $start + $chars - 1, null);
        } catch (CalcExp $e) {
            return $e->getMessage();
        }
        $returnValue = $left . $newText . $right;
        if (StringHelper::countCharacters($returnValue) > DataType::MAX_STRING_LENGTH) {
            $returnValue = ExcelError::VALUE();
        }

        return $returnValue;
=======
     * @param mixed $start Integer offset for start character of the replacement
     * @param mixed $chars Integer number of characters to replace from the start offset
     * @param mixed $newText String to replace in the defined position
     */
    public static function replace($oldText, $start, $chars, $newText): string
    {
        try {
            $start = Helpers::extractInt($start, 1, 0, true);
            $chars = Helpers::extractInt($chars, 0, 0, true);
            $oldText = Helpers::extractString($oldText);
            $newText = Helpers::extractString($newText);
            $left = mb_substr($oldText, 0, $start - 1, 'UTF-8');

            $right = mb_substr($oldText, $start + $chars - 1, null, 'UTF-8');
        } catch (CalcExp $e) {
            return $e->getMessage();
        }

        return $left . $newText . $right;
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * SUBSTITUTE.
     *
     * @param mixed $text The text string value to modify
<<<<<<< HEAD
     *                         Or can be an array of values
     * @param mixed $fromText The string value that we want to replace in $text
     *                         Or can be an array of values
     * @param mixed $toText The string value that we want to replace with in $text
     *                         Or can be an array of values
     * @param mixed $instance Integer instance Number for the occurrence of frmText to change
     *                         Or can be an array of values
     *
     * @return array|string
     *         If an array of values is passed for either of the arguments, then the returned result
     *            will also be an array with matching dimensions
     */
    public static function substitute($text = '', $fromText = '', $toText = '', $instance = null)
    {
        if (is_array($text) || is_array($fromText) || is_array($toText) || is_array($instance)) {
            return self::evaluateArrayArguments([self::class, __FUNCTION__], $text, $fromText, $toText, $instance);
        }

        try {
            $text = Helpers::extractString($text, true);
            $fromText = Helpers::extractString($fromText, true);
            $toText = Helpers::extractString($toText, true);
            if ($instance === null) {
                $returnValue = str_replace($fromText, $toText, $text);
            } else {
                if (is_bool($instance)) {
                    if ($instance === false || Functions::getCompatibilityMode() !== Functions::COMPATIBILITY_OPENOFFICE) {
                        return ExcelError::Value();
                    }
                    $instance = 1;
                }
                $instance = Helpers::extractInt($instance, 1, 0, true);
                $returnValue = self::executeSubstitution($text, $fromText, $toText, $instance);
            }
        } catch (CalcExp $e) {
            return $e->getMessage();
        }
        if (StringHelper::countCharacters($returnValue) > DataType::MAX_STRING_LENGTH) {
            $returnValue = ExcelError::VALUE();
        }

        return $returnValue;
    }

    /**
     * @return string
     */
    private static function executeSubstitution(string $text, string $fromText, string $toText, int $instance)
    {
=======
     * @param mixed $fromText The string value that we want to replace in $text
     * @param mixed $toText The string value that we want to replace with in $text
     * @param mixed $instance Integer instance Number for the occurrence of frmText to change
     */
    public static function substitute($text = '', $fromText = '', $toText = '', $instance = null): string
    {
        try {
            $text = Helpers::extractString($text);
            $fromText = Helpers::extractString($fromText);
            $toText = Helpers::extractString($toText);
            $instance = Functions::flattenSingleValue($instance);
            if ($instance === null) {
                return str_replace($fromText, $toText, $text);
            }
            if (is_bool($instance)) {
                if ($instance === false || Functions::getCompatibilityMode() !== Functions::COMPATIBILITY_OPENOFFICE) {
                    return Functions::Value();
                }
                $instance = 1;
            }
            $instance = Helpers::extractInt($instance, 1, 0, true);
        } catch (CalcExp $e) {
            return $e->getMessage();
        }

>>>>>>> forked/LAE_400_PACKAGE
        $pos = -1;
        while ($instance > 0) {
            $pos = mb_strpos($text, $fromText, $pos + 1, 'UTF-8');
            if ($pos === false) {
                break;
            }
            --$instance;
        }

        if ($pos !== false) {
<<<<<<< HEAD
            return Functions::scalar(self::REPLACE($text, ++$pos, StringHelper::countCharacters($fromText), $toText));
=======
            return self::REPLACE($text, ++$pos, mb_strlen($fromText, 'UTF-8'), $toText);
>>>>>>> forked/LAE_400_PACKAGE
        }

        return $text;
    }
}
