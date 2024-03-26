<?php

namespace PhpOffice\PhpSpreadsheet\Calculation;

class ExceptionHandler
{
    /**
     * Register errorhandler.
     */
    public function __construct()
    {
<<<<<<< HEAD
        /** @var callable */
        $callable = [Exception::class, 'errorHandlerCallback'];
        set_error_handler($callable, E_ALL);
=======
        set_error_handler([Exception::class, 'errorHandlerCallback'], E_ALL);
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Unregister errorhandler.
     */
    public function __destruct()
    {
        restore_error_handler();
    }
}
