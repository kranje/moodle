<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\LookupRef;

use PhpOffice\PhpSpreadsheet\Calculation\Exception;
<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\Information\ErrorValue;
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
=======
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
>>>>>>> forked/LAE_400_PACKAGE

class LookupRefValidations
{
    /**
     * @param mixed $value
     */
    public static function validateInt($value): int
    {
        if (!is_numeric($value)) {
<<<<<<< HEAD
            if (ErrorValue::isError($value)) {
                throw new Exception($value);
            }

            throw new Exception(ExcelError::VALUE());
=======
            if (Functions::isError($value)) {
                throw new Exception($value);
            }

            throw new Exception(Functions::VALUE());
>>>>>>> forked/LAE_400_PACKAGE
        }

        return (int) floor((float) $value);
    }

    /**
     * @param mixed $value
     */
    public static function validatePositiveInt($value, bool $allowZero = true): int
    {
        $value = self::validateInt($value);

        if (($allowZero === false && $value <= 0) || $value < 0) {
<<<<<<< HEAD
            throw new Exception(ExcelError::VALUE());
=======
            throw new Exception(Functions::VALUE());
>>>>>>> forked/LAE_400_PACKAGE
        }

        return $value;
    }
}
