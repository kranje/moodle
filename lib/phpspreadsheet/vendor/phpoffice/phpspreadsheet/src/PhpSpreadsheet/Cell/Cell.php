<?php

namespace PhpOffice\PhpSpreadsheet\Cell;

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
use PhpOffice\PhpSpreadsheet\Collection\Cells;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date as SharedDate;
use PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting\CellStyleAssessor;
=======
use PhpOffice\PhpSpreadsheet\Collection\Cells;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
>>>>>>> forked/LAE_400_PACKAGE
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Throwable;

class Cell
{
    /**
     * Value binder to use.
     *
     * @var IValueBinder
     */
    private static $valueBinder;

    /**
     * Value of the cell.
     *
     * @var mixed
     */
    private $value;

    /**
     *    Calculated value of the cell (used for caching)
     *    This returns the value last calculated by MS Excel or whichever spreadsheet program was used to
     *        create the original spreadsheet file.
     *    Note that this value is not guaranteed to reflect the actual calculated value because it is
     *        possible that auto-calculation was disabled in the original spreadsheet, and underlying data
     *        values used by the formula have changed since it was last calculated.
     *
     * @var mixed
     */
    private $calculatedValue;

    /**
     * Type of the cell data.
     *
     * @var string
     */
    private $dataType;

    /**
<<<<<<< HEAD
     * The collection of cells that this cell belongs to (i.e. The Cell Collection for the parent Worksheet).
=======
     * Collection of cells.
>>>>>>> forked/LAE_400_PACKAGE
     *
     * @var Cells
     */
    private $parent;

    /**
<<<<<<< HEAD
     * Index to the cellXf reference for the styling of this cell.
=======
     * Index to cellXf.
>>>>>>> forked/LAE_400_PACKAGE
     *
     * @var int
     */
    private $xfIndex = 0;

    /**
     * Attributes of the formula.
     */
    private $formulaAttributes;

    /**
     * Update the cell into the cell collection.
     *
     * @return $this
     */
    public function updateInCollection(): self
    {
        $this->parent->update($this);

        return $this;
    }

    public function detach(): void
    {
        // @phpstan-ignore-next-line
        $this->parent = null;
    }

    public function attach(Cells $parent): void
    {
        $this->parent = $parent;
    }

    /**
     * Create a new Cell.
     *
     * @param mixed $value
<<<<<<< HEAD
     */
    public function __construct($value, ?string $dataType, Worksheet $worksheet)
=======
     * @param string $dataType
     */
    public function __construct($value, $dataType, Worksheet $worksheet)
>>>>>>> forked/LAE_400_PACKAGE
    {
        // Initialise cell value
        $this->value = $value;

        // Set worksheet cache
        $this->parent = $worksheet->getCellCollection();

        // Set datatype?
        if ($dataType !== null) {
            if ($dataType == DataType::TYPE_STRING2) {
                $dataType = DataType::TYPE_STRING;
            }
            $this->dataType = $dataType;
<<<<<<< HEAD
        } elseif (self::getValueBinder()->bindValue($this, $value) === false) {
=======
        } elseif (!self::getValueBinder()->bindValue($this, $value)) {
>>>>>>> forked/LAE_400_PACKAGE
            throw new Exception('Value could not be bound to cell.');
        }
    }

    /**
     * Get cell coordinate column.
     *
     * @return string
     */
    public function getColumn()
    {
        return $this->parent->getCurrentColumn();
    }

    /**
     * Get cell coordinate row.
     *
     * @return int
     */
    public function getRow()
    {
        return $this->parent->getCurrentRow();
    }

    /**
     * Get cell coordinate.
     *
     * @return string
     */
    public function getCoordinate()
    {
        try {
            $coordinate = $this->parent->getCurrentCoordinate();
        } catch (Throwable $e) {
            $coordinate = null;
        }
        if ($coordinate === null) {
            throw new Exception('Coordinate no longer exists');
        }

        return $coordinate;
    }

    /**
     * Get cell value.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get cell value with formatting.
<<<<<<< HEAD
     */
    public function getFormattedValue(): string
=======
     *
     * @return string
     */
    public function getFormattedValue()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return (string) NumberFormat::toFormattedString(
            $this->getCalculatedValue(),
            $this->getStyle()
                ->getNumberFormat()->getFormatCode()
        );
    }

    /**
     * Set cell value.
     *
     *    Sets the value for a cell, automatically determining the datatype using the value binder
     *
     * @param mixed $value Value
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setValue($value): self
=======
    public function setValue($value)
>>>>>>> forked/LAE_400_PACKAGE
    {
        if (!self::getValueBinder()->bindValue($this, $value)) {
            throw new Exception('Value could not be bound to cell.');
        }

        return $this;
    }

    /**
     * Set the value for a cell, with the explicit data type passed to the method (bypassing any use of the value binder).
     *
     * @param mixed $value Value
     * @param string $dataType Explicit data type, see DataType::TYPE_*
<<<<<<< HEAD
     *        Note that PhpSpreadsheet does not validate that the value and datatype are consistent, in using this
     *             method, then it is your responsibility as an end-user developer to validate that the value and
     *             the datatype match.
     *       If you do mismatch value and datatype, then the value you enter may be changed to match the datatype
     *          that you specify.
=======
>>>>>>> forked/LAE_400_PACKAGE
     *
     * @return Cell
     */
    public function setValueExplicit($value, $dataType)
    {
        // set the value according to data type
        switch ($dataType) {
            case DataType::TYPE_NULL:
<<<<<<< HEAD
                $this->value = null;
=======
                $this->value = $value;
>>>>>>> forked/LAE_400_PACKAGE

                break;
            case DataType::TYPE_STRING2:
                $dataType = DataType::TYPE_STRING;
                // no break
            case DataType::TYPE_STRING:
                // Synonym for string
            case DataType::TYPE_INLINE:
                // Rich text
                $this->value = DataType::checkString($value);

                break;
            case DataType::TYPE_NUMERIC:
                if (is_string($value) && !is_numeric($value)) {
                    throw new Exception('Invalid numeric value for datatype Numeric');
                }
                $this->value = 0 + $value;

                break;
            case DataType::TYPE_FORMULA:
                $this->value = (string) $value;

                break;
            case DataType::TYPE_BOOL:
                $this->value = (bool) $value;

                break;
<<<<<<< HEAD
            case DataType::TYPE_ISO_DATE:
                $this->value = SharedDate::convertIsoDate($value);
                $dataType = DataType::TYPE_NUMERIC;

                break;
=======
>>>>>>> forked/LAE_400_PACKAGE
            case DataType::TYPE_ERROR:
                $this->value = DataType::checkErrorCode($value);

                break;
            default:
                throw new Exception('Invalid datatype: ' . $dataType);

                break;
        }

        // set the datatype
        $this->dataType = $dataType;

        return $this->updateInCollection();
    }

    /**
     * Get calculated cell value.
     *
     * @param bool $resetLog Whether the calculation engine logger should be reset or not
     *
     * @return mixed
     */
<<<<<<< HEAD
    public function getCalculatedValue(bool $resetLog = true)
    {
        if ($this->dataType === DataType::TYPE_FORMULA) {
=======
    public function getCalculatedValue($resetLog = true)
    {
        if ($this->dataType == DataType::TYPE_FORMULA) {
>>>>>>> forked/LAE_400_PACKAGE
            try {
                $index = $this->getWorksheet()->getParent()->getActiveSheetIndex();
                $selected = $this->getWorksheet()->getSelectedCells();
                $result = Calculation::getInstance(
                    $this->getWorksheet()->getParent()
                )->calculateCellValue($this, $resetLog);
                $this->getWorksheet()->setSelectedCells($selected);
                $this->getWorksheet()->getParent()->setActiveSheetIndex($index);
                //    We don't yet handle array returns
                if (is_array($result)) {
                    while (is_array($result)) {
                        $result = array_shift($result);
                    }
                }
            } catch (Exception $ex) {
                if (($ex->getMessage() === 'Unable to access External Workbook') && ($this->calculatedValue !== null)) {
                    return $this->calculatedValue; // Fallback for calculations referencing external files.
                } elseif (preg_match('/[Uu]ndefined (name|offset: 2|array key 2)/', $ex->getMessage()) === 1) {
<<<<<<< HEAD
                    return ExcelError::NAME();
=======
                    return \PhpOffice\PhpSpreadsheet\Calculation\Functions::NAME();
>>>>>>> forked/LAE_400_PACKAGE
                }

                throw new \PhpOffice\PhpSpreadsheet\Calculation\Exception(
                    $this->getWorksheet()->getTitle() . '!' . $this->getCoordinate() . ' -> ' . $ex->getMessage()
                );
            }

            if ($result === '#Not Yet Implemented') {
                return $this->calculatedValue; // Fallback if calculation engine does not support the formula.
            }

            return $result;
        } elseif ($this->value instanceof RichText) {
            return $this->value->getPlainText();
        }

        return $this->value;
    }

    /**
     * Set old calculated value (cached).
     *
     * @param mixed $originalValue Value
<<<<<<< HEAD
     */
    public function setCalculatedValue($originalValue): self
=======
     *
     * @return Cell
     */
    public function setCalculatedValue($originalValue)
>>>>>>> forked/LAE_400_PACKAGE
    {
        if ($originalValue !== null) {
            $this->calculatedValue = (is_numeric($originalValue)) ? (float) $originalValue : $originalValue;
        }

        return $this->updateInCollection();
    }

    /**
     *    Get old calculated value (cached)
     *    This returns the value last calculated by MS Excel or whichever spreadsheet program was used to
     *        create the original spreadsheet file.
     *    Note that this value is not guaranteed to reflect the actual calculated value because it is
     *        possible that auto-calculation was disabled in the original spreadsheet, and underlying data
     *        values used by the formula have changed since it was last calculated.
     *
     * @return mixed
     */
    public function getOldCalculatedValue()
    {
        return $this->calculatedValue;
    }

    /**
     * Get cell data type.
<<<<<<< HEAD
     */
    public function getDataType(): string
=======
     *
     * @return string
     */
    public function getDataType()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->dataType;
    }

    /**
     * Set cell data type.
     *
     * @param string $dataType see DataType::TYPE_*
<<<<<<< HEAD
     */
    public function setDataType($dataType): self
=======
     *
     * @return Cell
     */
    public function setDataType($dataType)
>>>>>>> forked/LAE_400_PACKAGE
    {
        if ($dataType == DataType::TYPE_STRING2) {
            $dataType = DataType::TYPE_STRING;
        }
        $this->dataType = $dataType;

        return $this->updateInCollection();
    }

    /**
     * Identify if the cell contains a formula.
<<<<<<< HEAD
     */
    public function isFormula(): bool
    {
        return $this->dataType === DataType::TYPE_FORMULA && $this->getStyle()->getQuotePrefix() === false;
=======
     *
     * @return bool
     */
    public function isFormula()
    {
        return $this->dataType == DataType::TYPE_FORMULA;
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     *    Does this cell contain Data validation rules?
<<<<<<< HEAD
     */
    public function hasDataValidation(): bool
=======
     *
     * @return bool
     */
    public function hasDataValidation()
>>>>>>> forked/LAE_400_PACKAGE
    {
        if (!isset($this->parent)) {
            throw new Exception('Cannot check for data validation when cell is not bound to a worksheet');
        }

        return $this->getWorksheet()->dataValidationExists($this->getCoordinate());
    }

    /**
     * Get Data validation rules.
<<<<<<< HEAD
     */
    public function getDataValidation(): DataValidation
=======
     *
     * @return DataValidation
     */
    public function getDataValidation()
>>>>>>> forked/LAE_400_PACKAGE
    {
        if (!isset($this->parent)) {
            throw new Exception('Cannot get data validation for cell that is not bound to a worksheet');
        }

        return $this->getWorksheet()->getDataValidation($this->getCoordinate());
    }

    /**
     * Set Data validation rules.
     */
    public function setDataValidation(?DataValidation $dataValidation = null): self
    {
        if (!isset($this->parent)) {
            throw new Exception('Cannot set data validation for cell that is not bound to a worksheet');
        }

        $this->getWorksheet()->setDataValidation($this->getCoordinate(), $dataValidation);

        return $this->updateInCollection();
    }

    /**
     * Does this cell contain valid value?
<<<<<<< HEAD
     */
    public function hasValidValue(): bool
=======
     *
     * @return bool
     */
    public function hasValidValue()
>>>>>>> forked/LAE_400_PACKAGE
    {
        $validator = new DataValidator();

        return $validator->isValid($this);
    }

    /**
     * Does this cell contain a Hyperlink?
<<<<<<< HEAD
     */
    public function hasHyperlink(): bool
=======
     *
     * @return bool
     */
    public function hasHyperlink()
>>>>>>> forked/LAE_400_PACKAGE
    {
        if (!isset($this->parent)) {
            throw new Exception('Cannot check for hyperlink when cell is not bound to a worksheet');
        }

        return $this->getWorksheet()->hyperlinkExists($this->getCoordinate());
    }

    /**
     * Get Hyperlink.
<<<<<<< HEAD
     */
    public function getHyperlink(): Hyperlink
=======
     *
     * @return Hyperlink
     */
    public function getHyperlink()
>>>>>>> forked/LAE_400_PACKAGE
    {
        if (!isset($this->parent)) {
            throw new Exception('Cannot get hyperlink for cell that is not bound to a worksheet');
        }

        return $this->getWorksheet()->getHyperlink($this->getCoordinate());
    }

    /**
     * Set Hyperlink.
<<<<<<< HEAD
     */
    public function setHyperlink(?Hyperlink $hyperlink = null): self
=======
     *
     * @return Cell
     */
    public function setHyperlink(?Hyperlink $hyperlink = null)
>>>>>>> forked/LAE_400_PACKAGE
    {
        if (!isset($this->parent)) {
            throw new Exception('Cannot set hyperlink for cell that is not bound to a worksheet');
        }

        $this->getWorksheet()->setHyperlink($this->getCoordinate(), $hyperlink);

        return $this->updateInCollection();
    }

    /**
     * Get cell collection.
     *
     * @return Cells
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Get parent worksheet.
<<<<<<< HEAD
     */
    public function getWorksheet(): Worksheet
=======
     *
     * @return Worksheet
     */
    public function getWorksheet()
>>>>>>> forked/LAE_400_PACKAGE
    {
        try {
            $worksheet = $this->parent->getParent();
        } catch (Throwable $e) {
            $worksheet = null;
        }

        if ($worksheet === null) {
            throw new Exception('Worksheet no longer exists');
        }

        return $worksheet;
    }

    /**
     * Is this cell in a merge range.
<<<<<<< HEAD
     */
    public function isInMergeRange(): bool
=======
     *
     * @return bool
     */
    public function isInMergeRange()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return (bool) $this->getMergeRange();
    }

    /**
     * Is this cell the master (top left cell) in a merge range (that holds the actual data value).
<<<<<<< HEAD
     */
    public function isMergeRangeValueCell(): bool
=======
     *
     * @return bool
     */
    public function isMergeRangeValueCell()
>>>>>>> forked/LAE_400_PACKAGE
    {
        if ($mergeRange = $this->getMergeRange()) {
            $mergeRange = Coordinate::splitRange($mergeRange);
            [$startCell] = $mergeRange[0];
<<<<<<< HEAD

            return $this->getCoordinate() === $startCell;
=======
            if ($this->getCoordinate() === $startCell) {
                return true;
            }
>>>>>>> forked/LAE_400_PACKAGE
        }

        return false;
    }

    /**
     * If this cell is in a merge range, then return the range.
     *
     * @return false|string
     */
    public function getMergeRange()
    {
        foreach ($this->getWorksheet()->getMergeCells() as $mergeRange) {
            if ($this->isInRange($mergeRange)) {
                return $mergeRange;
            }
        }

        return false;
    }

    /**
     * Get cell style.
<<<<<<< HEAD
     */
    public function getStyle(): Style
=======
     *
     * @return Style
     */
    public function getStyle()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->getWorksheet()->getStyle($this->getCoordinate());
    }

    /**
<<<<<<< HEAD
     * Get cell style.
     */
    public function getAppliedStyle(): Style
    {
        if ($this->getWorksheet()->conditionalStylesExists($this->getCoordinate()) === false) {
            return $this->getStyle();
        }
        $range = $this->getWorksheet()->getConditionalRange($this->getCoordinate());
        if ($range === null) {
            return $this->getStyle();
        }

        $matcher = new CellStyleAssessor($this, $range);

        return $matcher->matchConditions($this->getWorksheet()->getConditionalStyles($this->getCoordinate()));
    }

    /**
     * Re-bind parent.
     */
    public function rebindParent(Worksheet $parent): self
=======
     * Re-bind parent.
     *
     * @return Cell
     */
    public function rebindParent(Worksheet $parent)
>>>>>>> forked/LAE_400_PACKAGE
    {
        $this->parent = $parent->getCellCollection();

        return $this->updateInCollection();
    }

    /**
     *    Is cell in a specific range?
     *
     * @param string $range Cell range (e.g. A1:A1)
<<<<<<< HEAD
     */
    public function isInRange(string $range): bool
=======
     *
     * @return bool
     */
    public function isInRange($range)
>>>>>>> forked/LAE_400_PACKAGE
    {
        [$rangeStart, $rangeEnd] = Coordinate::rangeBoundaries($range);

        // Translate properties
        $myColumn = Coordinate::columnIndexFromString($this->getColumn());
        $myRow = $this->getRow();

        // Verify if cell is in range
        return ($rangeStart[0] <= $myColumn) && ($rangeEnd[0] >= $myColumn) &&
                ($rangeStart[1] <= $myRow) && ($rangeEnd[1] >= $myRow);
    }

    /**
     * Compare 2 cells.
     *
     * @param Cell $a Cell a
     * @param Cell $b Cell b
     *
     * @return int Result of comparison (always -1 or 1, never zero!)
     */
<<<<<<< HEAD
    public static function compareCells(self $a, self $b): int
=======
    public static function compareCells(self $a, self $b)
>>>>>>> forked/LAE_400_PACKAGE
    {
        if ($a->getRow() < $b->getRow()) {
            return -1;
        } elseif ($a->getRow() > $b->getRow()) {
            return 1;
        } elseif (Coordinate::columnIndexFromString($a->getColumn()) < Coordinate::columnIndexFromString($b->getColumn())) {
            return -1;
        }

        return 1;
    }

    /**
     * Get value binder to use.
<<<<<<< HEAD
     */
    public static function getValueBinder(): IValueBinder
=======
     *
     * @return IValueBinder
     */
    public static function getValueBinder()
>>>>>>> forked/LAE_400_PACKAGE
    {
        if (self::$valueBinder === null) {
            self::$valueBinder = new DefaultValueBinder();
        }

        return self::$valueBinder;
    }

    /**
     * Set value binder to use.
     */
    public static function setValueBinder(IValueBinder $binder): void
    {
        self::$valueBinder = $binder;
    }

    /**
     * Implement PHP __clone to create a deep clone, not just a shallow copy.
     */
    public function __clone()
    {
        $vars = get_object_vars($this);
<<<<<<< HEAD
        foreach ($vars as $propertyName => $propertyValue) {
            if ((is_object($propertyValue)) && ($propertyName !== 'parent')) {
                $this->$propertyName = clone $propertyValue;
            } else {
                $this->$propertyName = $propertyValue;
=======
        foreach ($vars as $key => $value) {
            if ((is_object($value)) && ($key != 'parent')) {
                $this->$key = clone $value;
            } else {
                $this->$key = $value;
>>>>>>> forked/LAE_400_PACKAGE
            }
        }
    }

    /**
     * Get index to cellXf.
<<<<<<< HEAD
     */
    public function getXfIndex(): int
=======
     *
     * @return int
     */
    public function getXfIndex()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->xfIndex;
    }

    /**
     * Set index to cellXf.
<<<<<<< HEAD
     */
    public function setXfIndex(int $indexValue): self
=======
     *
     * @param int $indexValue
     *
     * @return Cell
     */
    public function setXfIndex($indexValue)
>>>>>>> forked/LAE_400_PACKAGE
    {
        $this->xfIndex = $indexValue;

        return $this->updateInCollection();
    }

    /**
     * Set the formula attributes.
     *
     * @param mixed $attributes
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setFormulaAttributes($attributes): self
=======
    public function setFormulaAttributes($attributes)
>>>>>>> forked/LAE_400_PACKAGE
    {
        $this->formulaAttributes = $attributes;

        return $this;
    }

    /**
     * Get the formula attributes.
     */
    public function getFormulaAttributes()
    {
        return $this->formulaAttributes;
    }

    /**
     * Convert to string.
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getValue();
    }
}
