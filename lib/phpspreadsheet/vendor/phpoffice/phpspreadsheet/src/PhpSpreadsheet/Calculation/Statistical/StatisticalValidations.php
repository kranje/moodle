<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\Statistical;

use PhpOffice\PhpSpreadsheet\Calculation\Exception;
<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
=======
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
>>>>>>> forked/LAE_400_PACKAGE

class StatisticalValidations
{
    /**
     * @param mixed $value
     */
    public static function validateFloat($value): float
    {
        if (!is_numeric($value)) {
<<<<<<< HEAD
            throw new Exception(ExcelError::VALUE());
=======
            throw new Exception(Functions::VALUE());
>>>>>>> forked/LAE_400_PACKAGE
        }

        return (float) $value;
    }

    /**
     * @param mixed $value
     */
    public static function validateInt($value): int
    {
        if (!is_numeric($value)) {
<<<<<<< HEAD
            throw new Exception(ExcelError::VALUE());
=======
            throw new Exception(Functions::VALUE());
>>>>>>> forked/LAE_400_PACKAGE
        }

        return (int) floor((float) $value);
    }

    /**
     * @param mixed $value
     */
    public static function validateBool($value): bool
    {
        if (!is_bool($value) && !is_numeric($value)) {
<<<<<<< HEAD
            throw new Exception(ExcelError::VALUE());
=======
            throw new Exception(Functions::VALUE());
>>>>>>> forked/LAE_400_PACKAGE
        }

        return (bool) $value;
    }
}
