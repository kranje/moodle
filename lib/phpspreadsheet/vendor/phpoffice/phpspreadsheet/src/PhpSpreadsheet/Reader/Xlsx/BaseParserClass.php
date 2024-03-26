<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class BaseParserClass
{
<<<<<<< HEAD
    /**
     * @param mixed $value
     */
    protected static function boolean($value): bool
=======
    protected static function boolean($value)
>>>>>>> forked/LAE_400_PACKAGE
    {
        if (is_object($value)) {
            $value = (string) $value;
        }

        if (is_numeric($value)) {
            return (bool) $value;
        }

        return $value === strtolower('true');
    }
}
