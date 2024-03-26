<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\LookupRef;

use PhpOffice\PhpSpreadsheet\Cell\AddressHelper;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\DefinedName;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Helpers
{
    public const CELLADDRESS_USE_A1 = true;

    public const CELLADDRESS_USE_R1C1 = false;

<<<<<<< HEAD
    private static function convertR1C1(string &$cellAddress1, ?string &$cellAddress2, bool $a1, ?int $baseRow = null, ?int $baseCol = null): string
    {
        if ($a1 === self::CELLADDRESS_USE_R1C1) {
            $cellAddress1 = AddressHelper::convertToA1($cellAddress1, $baseRow ?? 1, $baseCol ?? 1);
            if ($cellAddress2) {
                $cellAddress2 = AddressHelper::convertToA1($cellAddress2, $baseRow ?? 1, $baseCol ?? 1);
=======
    private static function convertR1C1(string &$cellAddress1, ?string &$cellAddress2, bool $a1): string
    {
        if ($a1 === self::CELLADDRESS_USE_R1C1) {
            $cellAddress1 = AddressHelper::convertToA1($cellAddress1);
            if ($cellAddress2) {
                $cellAddress2 = AddressHelper::convertToA1($cellAddress2);
>>>>>>> forked/LAE_400_PACKAGE
            }
        }

        return $cellAddress1 . ($cellAddress2 ? ":$cellAddress2" : '');
    }

    private static function adjustSheetTitle(string &$sheetTitle, ?string $value): void
    {
        if ($sheetTitle) {
            $sheetTitle .= '!';
            if (stripos($value ?? '', $sheetTitle) === 0) {
                $sheetTitle = '';
            }
        }
    }

<<<<<<< HEAD
    public static function extractCellAddresses(string $cellAddress, bool $a1, Worksheet $sheet, string $sheetName = '', ?int $baseRow = null, ?int $baseCol = null): array
=======
    public static function extractCellAddresses(string $cellAddress, bool $a1, Worksheet $sheet, string $sheetName = ''): array
>>>>>>> forked/LAE_400_PACKAGE
    {
        $cellAddress1 = $cellAddress;
        $cellAddress2 = null;
        $namedRange = DefinedName::resolveName($cellAddress1, $sheet, $sheetName);
        if ($namedRange !== null) {
            $workSheet = $namedRange->getWorkSheet();
            $sheetTitle = ($workSheet === null) ? '' : $workSheet->getTitle();
<<<<<<< HEAD
            $value = (string) preg_replace('/^=/', '', $namedRange->getValue());
=======
            $value = preg_replace('/^=/', '', $namedRange->getValue());
>>>>>>> forked/LAE_400_PACKAGE
            self::adjustSheetTitle($sheetTitle, $value);
            $cellAddress1 = $sheetTitle . $value;
            $cellAddress = $cellAddress1;
            $a1 = self::CELLADDRESS_USE_A1;
        }
        if (strpos($cellAddress, ':') !== false) {
            [$cellAddress1, $cellAddress2] = explode(':', $cellAddress);
        }
<<<<<<< HEAD
        $cellAddress = self::convertR1C1($cellAddress1, $cellAddress2, $a1, $baseRow, $baseCol);
=======
        $cellAddress = self::convertR1C1($cellAddress1, $cellAddress2, $a1);
>>>>>>> forked/LAE_400_PACKAGE

        return [$cellAddress1, $cellAddress2, $cellAddress];
    }

    public static function extractWorksheet(string $cellAddress, Cell $cell): array
    {
        $sheetName = '';
        if (strpos($cellAddress, '!') !== false) {
            [$sheetName, $cellAddress] = Worksheet::extractSheetTitle($cellAddress, true);
            $sheetName = trim($sheetName, "'");
        }

        $worksheet = ($sheetName !== '')
            ? $cell->getWorksheet()->getParent()->getSheetByName($sheetName)
            : $cell->getWorksheet();

        return [$cellAddress, $worksheet, $sheetName];
    }
}
