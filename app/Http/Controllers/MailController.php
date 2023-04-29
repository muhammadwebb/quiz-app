<?php

namespace App\Http\Controllers;

use App\Mail\SendMAil;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    /**

     * Mark the authenticated user’s email address as verified.

     *

     * @param Request $request

     * @return Response

     */
    public function verify(Request $request)
    {

    }


    public function sends(Request $request)
    {
        Mail::to('alimukhammad7699@gmail.com')->send(
            new SendMAil([
                'name'=>'Muhammad',
            ])
        );
        return [
            'success'=> true
        ];
    }
}
