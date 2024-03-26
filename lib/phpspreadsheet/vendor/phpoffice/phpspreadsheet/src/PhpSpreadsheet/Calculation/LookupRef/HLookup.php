<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\LookupRef;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
=======
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
>>>>>>> forked/LAE_400_PACKAGE
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;

class HLookup extends LookupBase
{
<<<<<<< HEAD
    use ArrayEnabled;

=======
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * HLOOKUP
     * The HLOOKUP function searches for value in the top-most row of lookup_array and returns the value
     *     in the same column based on the index_number.
     *
     * @param mixed $lookupValue The value that you want to match in lookup_array
     * @param mixed $lookupArray The range of cells being searched
     * @param mixed $indexNumber The row number in table_array from which the matching value must be returned.
     *                                The first row is 1.
     * @param mixed $notExactMatch determines if you are looking for an exact match based on lookup_value
     *
     * @return mixed The value of the found cell
     */
    public static function lookup($lookupValue, $lookupArray, $indexNumber, $notExactMatch = true)
    {
<<<<<<< HEAD
        if (is_array($lookupValue)) {
            return self::evaluateArrayArgumentsIgnore([self::class, __FUNCTION__], 1, $lookupValue, $lookupArray, $indexNumber, $notExactMatch);
        }

        $notExactMatch = (bool) ($notExactMatch ?? true);

        try {
            self::validateLookupArray($lookupArray);
            $lookupArray = self::convertLiteralArray($lookupArray);
=======
        $lookupValue = Functions::flattenSingleValue($lookupValue);
        $indexNumber = Functions::flattenSingleValue($indexNumber);
        $notExactMatch = ($notExactMatch === null) ? true : Functions::flattenSingleValue($notExactMatch);
        $lookupArray = self::convertLiteralArray($lookupArray);

        try {
>>>>>>> forked/LAE_400_PACKAGE
            $indexNumber = self::validateIndexLookup($lookupArray, $indexNumber);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $f = array_keys($lookupArray);
        $firstRow = reset($f);
        if ((!is_array($lookupArray[$firstRow])) || ($indexNumber > count($lookupArray))) {
<<<<<<< HEAD
            return ExcelError::REF();
=======
            return Functions::REF();
>>>>>>> forked/LAE_400_PACKAGE
        }

        $firstkey = $f[0] - 1;
        $returnColumn = $firstkey + $indexNumber;
<<<<<<< HEAD
        $firstColumn = array_shift($f) ?? 1;
=======
        $firstColumn = array_shift($f);
>>>>>>> forked/LAE_400_PACKAGE
        $rowNumber = self::hLookupSearch($lookupValue, $lookupArray, $firstColumn, $notExactMatch);

        if ($rowNumber !== null) {
            //  otherwise return the appropriate value
            return $lookupArray[$returnColumn][Coordinate::stringFromColumnIndex($rowNumber)];
        }

<<<<<<< HEAD
        return ExcelError::NA();
=======
        return Functions::NA();
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * @param mixed $lookupValue The value that you want to match in lookup_array
<<<<<<< HEAD
     * @param  int|string $column
     */
    private static function hLookupSearch($lookupValue, array $lookupArray, $column, bool $notExactMatch): ?int
    {
        $lookupLower = StringHelper::strToLower((string) $lookupValue);
=======
     * @param mixed $column The column to look up
     * @param mixed $notExactMatch determines if you are looking for an exact match based on lookup_value
     */
    private static function hLookupSearch($lookupValue, array $lookupArray, $column, $notExactMatch): ?int
    {
        $lookupLower = StringHelper::strToLower($lookupValue);
>>>>>>> forked/LAE_400_PACKAGE

        $rowNumber = null;
        foreach ($lookupArray[$column] as $rowKey => $rowData) {
            // break if we have passed possible keys
            $bothNumeric = is_numeric($lookupValue) && is_numeric($rowData);
            $bothNotNumeric = !is_numeric($lookupValue) && !is_numeric($rowData);
<<<<<<< HEAD
            $cellDataLower = StringHelper::strToLower((string) $rowData);
=======
            $cellDataLower = StringHelper::strToLower($rowData);
>>>>>>> forked/LAE_400_PACKAGE

            if (
                $notExactMatch &&
                (($bothNumeric && $rowData > $lookupValue) || ($bothNotNumeric && $cellDataLower > $lookupLower))
            ) {
                break;
            }

            $rowNumber = self::checkMatch(
                $bothNumeric,
                $bothNotNumeric,
                $notExactMatch,
                Coordinate::columnIndexFromString($rowKey),
                $cellDataLower,
                $lookupLower,
                $rowNumber
            );
        }

        return $rowNumber;
    }

    private static function convertLiteralArray(array $lookupArray): array
    {
        if (array_key_exists(0, $lookupArray)) {
            $lookupArray2 = [];
            $row = 0;
            foreach ($lookupArray as $arrayVal) {
                ++$row;
                if (!is_array($arrayVal)) {
                    $arrayVal = [$arrayVal];
                }
                $arrayVal2 = [];
                foreach ($arrayVal as $key2 => $val2) {
                    $index = Coordinate::stringFromColumnIndex($key2 + 1);
                    $arrayVal2[$index] = $val2;
                }
                $lookupArray2[$row] = $arrayVal2;
            }
            $lookupArray = $lookupArray2;
        }

        return $lookupArray;
    }
}
