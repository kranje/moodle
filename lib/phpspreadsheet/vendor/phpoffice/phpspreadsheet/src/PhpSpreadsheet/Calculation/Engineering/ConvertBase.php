<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\Engineering;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;

abstract class ConvertBase
{
    use ArrayEnabled;

=======
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;

class ConvertBase
{
>>>>>>> forked/LAE_400_PACKAGE
    protected static function validateValue($value): string
    {
        if (is_bool($value)) {
            if (Functions::getCompatibilityMode() !== Functions::COMPATIBILITY_OPENOFFICE) {
<<<<<<< HEAD
                throw new Exception(ExcelError::VALUE());
=======
                throw new Exception(Functions::VALUE());
>>>>>>> forked/LAE_400_PACKAGE
            }
            $value = (int) $value;
        }

        if (is_numeric($value)) {
            if (Functions::getCompatibilityMode() == Functions::COMPATIBILITY_GNUMERIC) {
                $value = floor((float) $value);
            }
        }

        return strtoupper((string) $value);
    }

    protected static function validatePlaces($places = null): ?int
    {
        if ($places === null) {
            return $places;
        }

        if (is_numeric($places)) {
            if ($places < 0 || $places > 10) {
<<<<<<< HEAD
                throw new Exception(ExcelError::NAN());
=======
                throw new Exception(Functions::NAN());
>>>>>>> forked/LAE_400_PACKAGE
            }

            return (int) $places;
        }

<<<<<<< HEAD
        throw new Exception(ExcelError::VALUE());
=======
        throw new Exception(Functions::VALUE());
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Formats a number base string value with leading zeroes.
     *
     * @param string $value The "number" to pad
     * @param ?int $places The length that we want to pad this value
     *
     * @return string The padded "number"
     */
    protected static function nbrConversionFormat(string $value, ?int $places): string
    {
        if ($places !== null) {
            if (strlen($value) <= $places) {
                return substr(str_pad($value, $places, '0', STR_PAD_LEFT), -10);
            }

<<<<<<< HEAD
            return ExcelError::NAN();
=======
            return Functions::NAN();
>>>>>>> forked/LAE_400_PACKAGE
        }

        return substr($value, -10);
    }
}
