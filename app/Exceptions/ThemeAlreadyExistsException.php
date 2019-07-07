<?php

namespace App\Exceptions;

use Exception;

class ThemeAlreadyExistsException extends Exception
{
    public function __construct($message = 'Theme is already exists, please delete and install.', $errors = [], Exception $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}
