<?php

namespace App\Validator;

class BaseValidator
{
    protected $validator;

    /**
     * Redirect back when validation fail.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function redirectBack()
    {
        if (empty($this->validator)) {
            return false;
        }

        return redirect()->back()->with([
            'message'    => $this->validator->errors()->first(),
            'alert-type' => 'error',
        ]);
    }
}
