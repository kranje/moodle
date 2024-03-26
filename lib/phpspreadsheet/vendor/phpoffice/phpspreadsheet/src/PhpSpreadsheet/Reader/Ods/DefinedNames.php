<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Ods;

use DOMElement;
use PhpOffice\PhpSpreadsheet\DefinedName;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

<<<<<<< HEAD
class DefinedNames extends BaseLoader
=======
class DefinedNames extends BaseReader
>>>>>>> forked/LAE_400_PACKAGE
{
    public function read(DOMElement $workbookData): void
    {
        $this->readDefinedRanges($workbookData);
        $this->readDefinedExpressions($workbookData);
    }

    /**
     * Read any Named Ranges that are defined in this spreadsheet.
     */
    protected function readDefinedRanges(DOMElement $workbookData): void
    {
        $namedRanges = $workbookData->getElementsByTagNameNS($this->tableNs, 'named-range');
        foreach ($namedRanges as $definedNameElement) {
            $definedName = $definedNameElement->getAttributeNS($this->tableNs, 'name');
            $baseAddress = $definedNameElement->getAttributeNS($this->tableNs, 'base-cell-address');
            $range = $definedNameElement->getAttributeNS($this->tableNs, 'cell-range-address');

<<<<<<< HEAD
            $baseAddress = FormulaTranslator::convertToExcelAddressValue($baseAddress);
            $range = FormulaTranslator::convertToExcelAddressValue($range);
=======
            $baseAddress = $this->convertToExcelAddressValue($baseAddress);
            $range = $this->convertToExcelAddressValue($range);
>>>>>>> forked/LAE_400_PACKAGE

            $this->addDefinedName($baseAddress, $definedName, $range);
        }
    }

    /**
     * Read any Named Formulae that are defined in this spreadsheet.
     */
    protected function readDefinedExpressions(DOMElement $workbookData): void
    {
        $namedExpressions = $workbookData->getElementsByTagNameNS($this->tableNs, 'named-expression');
        foreach ($namedExpressions as $definedNameElement) {
            $definedName = $definedNameElement->getAttributeNS($this->tableNs, 'name');
            $baseAddress = $definedNameElement->getAttributeNS($this->tableNs, 'base-cell-address');
            $expression = $definedNameElement->getAttributeNS($this->tableNs, 'expression');

<<<<<<< HEAD
            $baseAddress = FormulaTranslator::convertToExcelAddressValue($baseAddress);
            $expression = substr($expression, strpos($expression, ':=') + 1);
            $expression = FormulaTranslator::convertToExcelFormulaValue($expression);
=======
            $baseAddress = $this->convertToExcelAddressValue($baseAddress);
            $expression = substr($expression, strpos($expression, ':=') + 1);
            $expression = $this->convertToExcelFormulaValue($expression);
>>>>>>> forked/LAE_400_PACKAGE

            $this->addDefinedName($baseAddress, $definedName, $expression);
        }
    }

    /**
     * Assess scope and store the Defined Name.
     */
    private function addDefinedName(string $baseAddress, string $definedName, string $value): void
    {
        [$sheetReference] = Worksheet::extractSheetTitle($baseAddress, true);
        $worksheet = $this->spreadsheet->getSheetByName($sheetReference);
        // Worksheet might still be null if we're only loading selected sheets rather than the full spreadsheet
        if ($worksheet !== null) {
            $this->spreadsheet->addDefinedName(DefinedName::createInstance((string) $definedName, $worksheet, $value));
        }
    }
}
