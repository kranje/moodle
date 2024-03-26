<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions;

use PhpOffice\PhpSpreadsheet\Calculation\Exception;
<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
=======
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
>>>>>>> forked/LAE_400_PACKAGE
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\StatisticalValidations;

class DistributionValidations extends StatisticalValidations
{
    /**
     * @param mixed $probability
     */
    public static function validateProbability($probability): float
    {
        $probability = self::validateFloat($probability);

        if ($probability < 0.0 || $probability > 1.0) {
<<<<<<< HEAD
            throw new Exception(ExcelError::NAN());
=======
            throw new Exception(Functions::NAN());
>>>>>>> forked/LAE_400_PACKAGE
        }

        return $probability;
    }
}
