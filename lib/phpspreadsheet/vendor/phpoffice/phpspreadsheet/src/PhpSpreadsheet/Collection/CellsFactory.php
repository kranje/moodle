<?php

namespace PhpOffice\PhpSpreadsheet\Collection;

use PhpOffice\PhpSpreadsheet\Settings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

abstract class CellsFactory
{
    /**
     * Initialise the cache storage.
     *
     * @param Worksheet $worksheet Enable cell caching for this worksheet
     *
<<<<<<< HEAD
     * */
    public static function getInstance(Worksheet $worksheet): Cells
=======
     * @return Cells
     * */
    public static function getInstance(Worksheet $worksheet)
>>>>>>> forked/LAE_400_PACKAGE
    {
        return new Cells($worksheet, Settings::getCache());
    }
}
