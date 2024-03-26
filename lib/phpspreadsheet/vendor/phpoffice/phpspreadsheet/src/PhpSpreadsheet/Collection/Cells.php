<?php

namespace PhpOffice\PhpSpreadsheet\Collection;

use Generator;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Exception as PhpSpreadsheetException;
<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Settings;
=======
>>>>>>> forked/LAE_400_PACKAGE
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Psr\SimpleCache\CacheInterface;

class Cells
{
<<<<<<< HEAD
    protected const MAX_COLUMN_ID = 16384;

=======
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * @var CacheInterface
     */
    private $cache;

    /**
     * Parent worksheet.
     *
     * @var null|Worksheet
     */
    private $parent;

    /**
     * The currently active Cell.
     *
     * @var null|Cell
     */
    private $currentCell;

    /**
     * Coordinate of the currently active Cell.
     *
     * @var null|string
     */
    private $currentCoordinate;

    /**
     * Flag indicating whether the currently active Cell requires saving.
     *
     * @var bool
     */
    private $currentCellIsDirty = false;

    /**
<<<<<<< HEAD
     * An index of existing cells. int pointer to the coordinate (0-base-indexed row * 16,384 + 1-base indexed column)
     *    indexed by their coordinate.
     *
     * @var int[]
=======
     * An index of existing cells. Booleans indexed by their coordinate.
     *
     * @var bool[]
>>>>>>> forked/LAE_400_PACKAGE
     */
    private $index = [];

    /**
     * Prefix used to uniquely identify cache data for this worksheet.
     *
     * @var string
     */
    private $cachePrefix;

    /**
     * Initialise this new cell collection.
     *
     * @param Worksheet $parent The worksheet for this cell collection
     */
    public function __construct(Worksheet $parent, CacheInterface $cache)
    {
        // Set our parent worksheet.
        // This is maintained here to facilitate re-attaching it to Cell objects when
        // they are woken from a serialized state
        $this->parent = $parent;
        $this->cache = $cache;
        $this->cachePrefix = $this->getUniqueID();
    }

    /**
     * Return the parent worksheet for this cell collection.
     *
     * @return null|Worksheet
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Whether the collection holds a cell for the given coordinate.
     *
     * @param string $cellCoordinate Coordinate of the cell to check
<<<<<<< HEAD
     */
    public function has($cellCoordinate): bool
    {
        return ($cellCoordinate === $this->currentCoordinate) || isset($this->index[$cellCoordinate]);
=======
     *
     * @return bool
     */
    public function has($cellCoordinate)
    {
        if ($cellCoordinate === $this->currentCoordinate) {
            return true;
        }

        // Check if the requested entry exists in the index
        return isset($this->index[$cellCoordinate]);
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Add or update a cell in the collection.
     *
     * @param Cell $cell Cell to update
<<<<<<< HEAD
     */
    public function update(Cell $cell): Cell
=======
     *
     * @return Cell
     */
    public function update(Cell $cell)
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->add($cell->getCoordinate(), $cell);
    }

    /**
     * Delete a cell in cache identified by coordinate.
     *
     * @param string $cellCoordinate Coordinate of the cell to delete
     */
    public function delete($cellCoordinate): void
    {
        if ($cellCoordinate === $this->currentCoordinate && $this->currentCell !== null) {
            $this->currentCell->detach();
            $this->currentCoordinate = null;
            $this->currentCell = null;
            $this->currentCellIsDirty = false;
        }

        unset($this->index[$cellCoordinate]);

        // Delete the entry from cache
        $this->cache->delete($this->cachePrefix . $cellCoordinate);
    }

    /**
     * Get a list of all cell coordinates currently held in the collection.
     *
     * @return string[]
     */
    public function getCoordinates()
    {
        return array_keys($this->index);
    }

    /**
     * Get a sorted list of all cell coordinates currently held in the collection by row and column.
     *
     * @return string[]
     */
    public function getSortedCoordinates()
    {
<<<<<<< HEAD
        asort($this->index);

        return array_keys($this->index);
=======
        $sortKeys = [];
        foreach ($this->getCoordinates() as $coord) {
            $column = '';
            $row = 0;
            sscanf($coord, '%[A-Z]%d', $column, $row);
            $sortKeys[sprintf('%09d%3s', $row, $column)] = $coord;
        }
        ksort($sortKeys);

        return array_values($sortKeys);
    }

    /**
     * Get highest worksheet column and highest row that have cell records.
     *
     * @return array Highest column name and highest row number
     */
    public function getHighestRowAndColumn()
    {
        // Lookup highest column and highest row
        $col = ['A' => '1A'];
        $row = [1];
        foreach ($this->getCoordinates() as $coord) {
            $c = '';
            $r = 0;
            sscanf($coord, '%[A-Z]%d', $c, $r);
            $row[$r] = $r;
            $col[$c] = strlen($c) . $c;
        }

        // Determine highest column and row
        $highestRow = max($row);
        $highestColumn = substr((string) @max($col), 1);

        return [
            'row' => $highestRow,
            'column' => $highestColumn,
        ];
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Return the cell coordinate of the currently active cell object.
     *
     * @return null|string
     */
    public function getCurrentCoordinate()
    {
        return $this->currentCoordinate;
    }

    /**
     * Return the column coordinate of the currently active cell object.
<<<<<<< HEAD
     */
    public function getCurrentColumn(): string
    {
=======
     *
     * @return string
     */
    public function getCurrentColumn()
    {
        $column = '';
        $row = 0;

>>>>>>> forked/LAE_400_PACKAGE
        sscanf($this->currentCoordinate ?? '', '%[A-Z]%d', $column, $row);

        return $column;
    }

    /**
     * Return the row coordinate of the currently active cell object.
<<<<<<< HEAD
     */
    public function getCurrentRow(): int
    {
=======
     *
     * @return int
     */
    public function getCurrentRow()
    {
        $column = '';
        $row = 0;

>>>>>>> forked/LAE_400_PACKAGE
        sscanf($this->currentCoordinate ?? '', '%[A-Z]%d', $column, $row);

        return (int) $row;
    }

    /**
<<<<<<< HEAD
     * Get highest worksheet column and highest row that have cell records.
     *
     * @return array Highest column name and highest row number
     */
    public function getHighestRowAndColumn()
    {
        // Lookup highest column and highest row
        $maxRow = $maxColumn = 1;
        foreach ($this->index as $coordinate) {
            $row = (int) floor($coordinate / self::MAX_COLUMN_ID) + 1;
            $maxRow = ($maxRow > $row) ? $maxRow : $row;
            $column = $coordinate % self::MAX_COLUMN_ID;
            $maxColumn = ($maxColumn > $column) ? $maxColumn : $column;
        }

        return [
            'row' => $maxRow,
            'column' => Coordinate::stringFromColumnIndex($maxColumn),
        ];
    }

    /**
=======
>>>>>>> forked/LAE_400_PACKAGE
     * Get highest worksheet column.
     *
     * @param null|int|string $row Return the highest column for the specified row,
     *                    or the highest column of any row if no row number is passed
     *
     * @return string Highest column name
     */
    public function getHighestColumn($row = null)
    {
        if ($row === null) {
<<<<<<< HEAD
            return $this->getHighestRowAndColumn()['column'];
        }

        $row = (int) $row;
        if ($row <= 0) {
            throw new PhpSpreadsheetException('Row number must be a positive integer');
        }

        $maxColumn = 1;
        $toRow = $row * self::MAX_COLUMN_ID;
        $fromRow = --$row * self::MAX_COLUMN_ID;
        foreach ($this->index as $coordinate) {
            if ($coordinate < $fromRow || $coordinate >= $toRow) {
                continue;
            }
            $column = $coordinate % self::MAX_COLUMN_ID;
            $maxColumn = $maxColumn > $column ? $maxColumn : $column;
        }

        return Coordinate::stringFromColumnIndex($maxColumn);
=======
            $colRow = $this->getHighestRowAndColumn();

            return $colRow['column'];
        }

        $columnList = [1];
        foreach ($this->getCoordinates() as $coord) {
            $c = '';
            $r = 0;

            sscanf($coord, '%[A-Z]%d', $c, $r);
            if ($r != $row) {
                continue;
            }
            $columnList[] = Coordinate::columnIndexFromString($c);
        }

        return Coordinate::stringFromColumnIndex((int) @max($columnList));
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Get highest worksheet row.
     *
     * @param null|string $column Return the highest row for the specified column,
     *                       or the highest row of any column if no column letter is passed
     *
     * @return int Highest row number
     */
    public function getHighestRow($column = null)
    {
        if ($column === null) {
<<<<<<< HEAD
            return $this->getHighestRowAndColumn()['row'];
        }

        $maxRow = 1;
        $columnIndex = Coordinate::columnIndexFromString($column);
        foreach ($this->index as $coordinate) {
            if ($coordinate % self::MAX_COLUMN_ID !== $columnIndex) {
                continue;
            }
            $row = (int) floor($coordinate / self::MAX_COLUMN_ID) + 1;
            $maxRow = ($maxRow > $row) ? $maxRow : $row;
        }

        return $maxRow;
=======
            $colRow = $this->getHighestRowAndColumn();

            return $colRow['row'];
        }

        $rowList = [0];
        foreach ($this->getCoordinates() as $coord) {
            $c = '';
            $r = 0;

            sscanf($coord, '%[A-Z]%d', $c, $r);
            if ($c != $column) {
                continue;
            }
            $rowList[] = $r;
        }

        return max($rowList);
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Generate a unique ID for cache referencing.
     *
     * @return string Unique Reference
     */
    private function getUniqueID()
    {
<<<<<<< HEAD
        $cacheType = Settings::getCache();

        return ($cacheType instanceof Memory\SimpleCache1 || $cacheType instanceof Memory\SimpleCache3)
            ? random_bytes(7) . ':'
            : uniqid('phpspreadsheet.', true) . '.';
=======
        return uniqid('phpspreadsheet.', true) . '.';
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Clone the cell collection.
     *
     * @return self
     */
    public function cloneCellCollection(Worksheet $worksheet)
    {
        $this->storeCurrentCell();
        $newCollection = clone $this;

        $newCollection->parent = $worksheet;
<<<<<<< HEAD
        $newCollection->cachePrefix = $newCollection->getUniqueID();

        foreach ($this->index as $key => $value) {
            $newCollection->index[$key] = $value;
            $stored = $newCollection->cache->set(
                $newCollection->cachePrefix . $key,
                clone $this->cache->get($this->cachePrefix . $key)
            );
            if ($stored === false) {
                $this->destructIfNeeded($newCollection, 'Failed to copy cells in cache');
            }
        }

=======
        if (is_object($newCollection->currentCell)) {
            $newCollection->currentCell->attach($this);
        }

        // Get old values
        $oldKeys = $newCollection->getAllCacheKeys();
        $oldValues = $newCollection->cache->getMultiple($oldKeys);
        $newValues = [];
        $oldCachePrefix = $newCollection->cachePrefix;

        // Change prefix
        $newCollection->cachePrefix = $newCollection->getUniqueID();
        foreach ($oldValues as $oldKey => $value) {
            /** @var string $newKey */
            $newKey = str_replace($oldCachePrefix, $newCollection->cachePrefix, $oldKey);
            $newValues[$newKey] = clone $value;
        }

        // Store new values
        $stored = $newCollection->cache->setMultiple($newValues);
        $this->destructIfNeeded($stored, $newCollection, 'Failed to copy cells in cache');

>>>>>>> forked/LAE_400_PACKAGE
        return $newCollection;
    }

    /**
     * Remove a row, deleting all cells in that row.
     *
<<<<<<< HEAD
     * @param int|string $row Row number to remove
     */
    public function removeRow($row): void
    {
        $this->storeCurrentCell();
        $row = (int) $row;
        if ($row <= 0) {
            throw new PhpSpreadsheetException('Row number must be a positive integer');
        }

        $toRow = $row * self::MAX_COLUMN_ID;
        $fromRow = --$row * self::MAX_COLUMN_ID;
        foreach ($this->index as $coordinate) {
            if ($coordinate >= $fromRow && $coordinate < $toRow) {
                $row = (int) floor($coordinate / self::MAX_COLUMN_ID) + 1;
                $column = Coordinate::stringFromColumnIndex($coordinate % self::MAX_COLUMN_ID);
                $this->delete("{$column}{$row}");
=======
     * @param string $row Row number to remove
     */
    public function removeRow($row): void
    {
        foreach ($this->getCoordinates() as $coord) {
            $c = '';
            $r = 0;

            sscanf($coord, '%[A-Z]%d', $c, $r);
            if ($r == $row) {
                $this->delete($coord);
>>>>>>> forked/LAE_400_PACKAGE
            }
        }
    }

    /**
     * Remove a column, deleting all cells in that column.
     *
     * @param string $column Column ID to remove
     */
    public function removeColumn($column): void
    {
<<<<<<< HEAD
        $this->storeCurrentCell();

        $columnIndex = Coordinate::columnIndexFromString($column);
        foreach ($this->index as $coordinate) {
            if ($coordinate % self::MAX_COLUMN_ID === $columnIndex) {
                $row = (int) floor($coordinate / self::MAX_COLUMN_ID) + 1;
                $column = Coordinate::stringFromColumnIndex($coordinate % self::MAX_COLUMN_ID);
                $this->delete("{$column}{$row}");
=======
        foreach ($this->getCoordinates() as $coord) {
            $c = '';
            $r = 0;

            sscanf($coord, '%[A-Z]%d', $c, $r);
            if ($c == $column) {
                $this->delete($coord);
>>>>>>> forked/LAE_400_PACKAGE
            }
        }
    }

    /**
     * Store cell data in cache for the current cell object if it's "dirty",
     * and the 'nullify' the current cell object.
     */
    private function storeCurrentCell(): void
    {
        if ($this->currentCellIsDirty && isset($this->currentCoordinate, $this->currentCell)) {
            $this->currentCell->detach();

            $stored = $this->cache->set($this->cachePrefix . $this->currentCoordinate, $this->currentCell);
<<<<<<< HEAD
            if ($stored === false) {
                $this->destructIfNeeded($this, "Failed to store cell {$this->currentCoordinate} in cache");
            }
=======
            $this->destructIfNeeded($stored, $this, "Failed to store cell {$this->currentCoordinate} in cache");
>>>>>>> forked/LAE_400_PACKAGE
            $this->currentCellIsDirty = false;
        }

        $this->currentCoordinate = null;
        $this->currentCell = null;
    }

<<<<<<< HEAD
    private function destructIfNeeded(self $cells, string $message): void
    {
        $cells->__destruct();

        throw new PhpSpreadsheetException($message);
=======
    private function destructIfNeeded(bool $stored, self $cells, string $message): void
    {
        if (!$stored) {
            $cells->__destruct();

            throw new PhpSpreadsheetException($message);
        }
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Add or update a cell identified by its coordinate into the collection.
     *
     * @param string $cellCoordinate Coordinate of the cell to update
     * @param Cell $cell Cell to update
     *
     * @return Cell
     */
    public function add($cellCoordinate, Cell $cell)
    {
        if ($cellCoordinate !== $this->currentCoordinate) {
            $this->storeCurrentCell();
        }
<<<<<<< HEAD
        sscanf($cellCoordinate, '%[A-Z]%d', $column, $row);
        $this->index[$cellCoordinate] = (--$row * self::MAX_COLUMN_ID) + Coordinate::columnIndexFromString($column);
=======
        $this->index[$cellCoordinate] = true;
>>>>>>> forked/LAE_400_PACKAGE

        $this->currentCoordinate = $cellCoordinate;
        $this->currentCell = $cell;
        $this->currentCellIsDirty = true;

        return $cell;
    }

    /**
     * Get cell at a specific coordinate.
     *
     * @param string $cellCoordinate Coordinate of the cell
     *
     * @return null|Cell Cell that was found, or null if not found
     */
    public function get($cellCoordinate)
    {
        if ($cellCoordinate === $this->currentCoordinate) {
            return $this->currentCell;
        }
        $this->storeCurrentCell();

        // Return null if requested entry doesn't exist in collection
<<<<<<< HEAD
        if ($this->has($cellCoordinate) === false) {
            return null;
        }

        // Check if the entry that has been requested actually exists in the cache
=======
        if (!$this->has($cellCoordinate)) {
            return null;
        }

        // Check if the entry that has been requested actually exists
>>>>>>> forked/LAE_400_PACKAGE
        $cell = $this->cache->get($this->cachePrefix . $cellCoordinate);
        if ($cell === null) {
            throw new PhpSpreadsheetException("Cell entry {$cellCoordinate} no longer exists in cache. This probably means that the cache was cleared by someone else.");
        }

        // Set current entry to the requested entry
        $this->currentCoordinate = $cellCoordinate;
        $this->currentCell = $cell;
        // Re-attach this as the cell's parent
        $this->currentCell->attach($this);

        // Return requested entry
        return $this->currentCell;
    }

    /**
     * Clear the cell collection and disconnect from our parent.
     */
    public function unsetWorksheetCells(): void
    {
        if ($this->currentCell !== null) {
            $this->currentCell->detach();
            $this->currentCell = null;
            $this->currentCoordinate = null;
        }

        // Flush the cache
        $this->__destruct();

        $this->index = [];

        // detach ourself from the worksheet, so that it can then delete this object successfully
        $this->parent = null;
    }

    /**
     * Destroy this cell collection.
     */
    public function __destruct()
    {
        $this->cache->deleteMultiple($this->getAllCacheKeys());
    }

    /**
     * Returns all known cache keys.
     *
     * @return Generator|string[]
     */
    private function getAllCacheKeys()
    {
        foreach ($this->getCoordinates() as $coordinate) {
            yield $this->cachePrefix . $coordinate;
        }
    }
}
