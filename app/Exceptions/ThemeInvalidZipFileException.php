<?php

namespace App\Exceptions;

use Exception;

class ThemeInvalidZipFileException extends Exception
{
    public function __construct($message = 'Theme Zip File Invalid.', $errors = [], Exception $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}
