<?php

namespace App\Exceptions;

use Exception;

class ThemeNotPermissionCreateTempDirectory extends Exception
{
    public function __construct($message = 'Cannot extract theme to storage/app/themes, please check permission.', $errors = [], Exception $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}
