<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\TextData;

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\Calculation\Exception as CalcExp;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\Information\ErrorValue;
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
=======
>>>>>>> forked/LAE_400_PACKAGE

class Helpers
{
    public static function convertBooleanValue(bool $value): string
    {
        if (Functions::getCompatibilityMode() == Functions::COMPATIBILITY_OPENOFFICE) {
            return $value ? '1' : '0';
        }

        return ($value) ? Calculation::getTRUE() : Calculation::getFALSE();
    }

    /**
     * @param mixed $value String value from which to extract characters
     */
<<<<<<< HEAD
    public static function extractString($value, bool $throwIfError = false): string
    {
        if (is_bool($value)) {
            return self::convertBooleanValue($value);
        }
        if ($throwIfError && is_string($value) && ErrorValue::isError($value)) {
            throw new CalcExp($value);
        }
=======
    public static function extractString($value): string
    {
        $value = Functions::flattenSingleValue($value);
        if (is_bool($value)) {
            return self::convertBooleanValue($value);
        }
>>>>>>> forked/LAE_400_PACKAGE

        return (string) $value;
    }

    /**
     * @param mixed $value
     */
    public static function extractInt($value, int $minValue, int $gnumericNull = 0, bool $ooBoolOk = false): int
    {
<<<<<<< HEAD
=======
        $value = Functions::flattenSingleValue($value);
>>>>>>> forked/LAE_400_PACKAGE
        if ($value === null) {
            // usually 0, but sometimes 1 for Gnumeric
            $value = (Functions::getCompatibilityMode() === Functions::COMPATIBILITY_GNUMERIC) ? $gnumericNull : 0;
        }
        if (is_bool($value) && ($ooBoolOk || Functions::getCompatibilityMode() !== Functions::COMPATIBILITY_OPENOFFICE)) {
            $value = (int) $value;
        }
        if (!is_numeric($value)) {
<<<<<<< HEAD
            throw new CalcExp(ExcelError::VALUE());
        }
        $value = (int) $value;
        if ($value < $minValue) {
            throw new CalcExp(ExcelError::VALUE());
=======
            throw new CalcExp(Functions::VALUE());
        }
        $value = (int) $value;
        if ($value < $minValue) {
            throw new CalcExp(Functions::VALUE());
>>>>>>> forked/LAE_400_PACKAGE
        }

        return (int) $value;
    }

    /**
     * @param mixed $value
     */
    public static function extractFloat($value): float
    {
<<<<<<< HEAD
=======
        $value = Functions::flattenSingleValue($value);
>>>>>>> forked/LAE_400_PACKAGE
        if ($value === null) {
            $value = 0.0;
        }
        if (is_bool($value)) {
            $value = (float) $value;
        }
        if (!is_numeric($value)) {
<<<<<<< HEAD
            throw new CalcExp(ExcelError::VALUE());
=======
            throw new CalcExp(Functions::VALUE());
>>>>>>> forked/LAE_400_PACKAGE
        }

        return (float) $value;
    }

    /**
     * @param mixed $value
     */
    public static function validateInt($value): int
    {
<<<<<<< HEAD
=======
        $value = Functions::flattenSingleValue($value);
>>>>>>> forked/LAE_400_PACKAGE
        if ($value === null) {
            $value = 0;
        } elseif (is_bool($value)) {
            $value = (int) $value;
        }

        return (int) $value;
    }
}
