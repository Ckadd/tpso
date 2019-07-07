<?php

namespace App\Exceptions;

use Exception;

class ThemeJsonNotFoundException extends Exception
{
    public function __construct($message = 'Your theme not contains theme.json.', $errors = [], Exception $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}
