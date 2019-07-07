<?php

namespace App\Validator;

use Validator;

class ThemeValidator extends BaseValidator
{
    /**
     * Validate store theme.
     *
     * @param \Illuminate\Http\Request $request
     *
     *  @return bool
     */
    public function validateStore($request) : bool
    {
        $this->validator = Validator::make($request->all(), [
            'zip_path.*' => 'file|mimes:zip',
        ], [
            'zip_path.*.file'  => __('validation.file', ['attribute' => 'zip path']),
            'zip_path.*.mimes' => __('validation.mimes', ['attribute' => 'zip path']),
        ]);

        return $this->validator->fails();
    }
}
