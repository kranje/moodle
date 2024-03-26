<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\Financial;

use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel;
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\Constants as FinancialConstants;
<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
=======
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
>>>>>>> forked/LAE_400_PACKAGE

class FinancialValidations
{
    /**
     * @param mixed $date
     */
    public static function validateDate($date): float
    {
        return DateTimeExcel\Helpers::getDateValue($date);
    }

    /**
     * @param mixed $settlement
     */
    public static function validateSettlementDate($settlement): float
    {
        return self::validateDate($settlement);
    }

    /**
     * @param mixed $maturity
     */
    public static function validateMaturityDate($maturity): float
    {
        return self::validateDate($maturity);
    }

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
     * @param mixed $rate
     */
    public static function validateRate($rate): float
    {
        $rate = self::validateFloat($rate);
        if ($rate < 0.0) {
<<<<<<< HEAD
            throw new Exception(ExcelError::NAN());
=======
            throw new Exception(Functions::NAN());
>>>>>>> forked/LAE_400_PACKAGE
        }

        return $rate;
    }

    /**
     * @param mixed $frequency
     */
    public static function validateFrequency($frequency): int
    {
        $frequency = self::validateInt($frequency);
        if (
            ($frequency !== FinancialConstants::FREQUENCY_ANNUAL) &&
            ($frequency !== FinancialConstants::FREQUENCY_SEMI_ANNUAL) &&
            ($frequency !== FinancialConstants::FREQUENCY_QUARTERLY)
        ) {
<<<<<<< HEAD
            throw new Exception(ExcelError::NAN());
=======
            throw new Exception(Functions::NAN());
>>>>>>> forked/LAE_400_PACKAGE
        }

        return $frequency;
    }

    /**
     * @param mixed $basis
     */
    public static function validateBasis($basis): int
    {
        if (!is_numeric($basis)) {
<<<<<<< HEAD
            throw new Exception(ExcelError::VALUE());
=======
            throw new Exception(Functions::VALUE());
>>>>>>> forked/LAE_400_PACKAGE
        }

        $basis = (int) $basis;
        if (($basis < 0) || ($basis > 4)) {
<<<<<<< HEAD
            throw new Exception(ExcelError::NAN());
=======
            throw new Exception(Functions::NAN());
>>>>>>> forked/LAE_400_PACKAGE
        }

        return $basis;
    }

    /**
     * @param mixed $price
     */
    public static function validatePrice($price): float
    {
        $price = self::validateFloat($price);
        if ($price < 0.0) {
<<<<<<< HEAD
            throw new Exception(ExcelError::NAN());
=======
            throw new Exception(Functions::NAN());
>>>>>>> forked/LAE_400_PACKAGE
        }

        return $price;
    }

    /**
     * @param mixed $parValue
     */
    public static function validateParValue($parValue): float
    {
        $parValue = self::validateFloat($parValue);
        if ($parValue < 0.0) {
<<<<<<< HEAD
            throw new Exception(ExcelError::NAN());
=======
            throw new Exception(Functions::NAN());
>>>>>>> forked/LAE_400_PACKAGE
        }

        return $parValue;
    }

    /**
     * @param mixed $yield
     */
    public static function validateYield($yield): float
    {
        $yield = self::validateFloat($yield);
        if ($yield < 0.0) {
<<<<<<< HEAD
            throw new Exception(ExcelError::NAN());
=======
            throw new Exception(Functions::NAN());
>>>>>>> forked/LAE_400_PACKAGE
        }

        return $yield;
    }

    /**
     * @param mixed $discount
     */
    public static function validateDiscount($discount): float
    {
        $discount = self::validateFloat($discount);
        if ($discount <= 0.0) {
<<<<<<< HEAD
            throw new Exception(ExcelError::NAN());
=======
            throw new Exception(Functions::NAN());
>>>>>>> forked/LAE_400_PACKAGE
        }

        return $discount;
    }
}
