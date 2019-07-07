<?php

namespace App\Service;
use Illuminate\Http\Request;
class ContactUsService 
{
    /**
     * send email to dot gmail from contactUs
     * @param email $email
     */

    public static function sendemail(Request $request) {
        $request  = $request->all();
        dd($request);
    }
}