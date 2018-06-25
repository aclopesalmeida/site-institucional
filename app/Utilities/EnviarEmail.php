<?php

namespace App\Utilities;

use Illuminate\Http\Request;
use App\Mail\FormularioContacto;
use Illuminate\Support\Facades\Mail;

class EnviarEmail 
{
    public static function enviar(Request $request)
    {
        $to = 'carollinalmeida@gmail.com';

        $tentativas = 5;
        $sucesso = true;

        while($sucesso === true) {
            try {   // try to send email
                 Mail::to($to)->send(new FormularioContacto($request));
                 break;
            }
            catch(\Exception $e) 
            {
                if($tentativas != 0) {
                    $tentativas--;
                }
                else {
                    $sucesso = false;
                    return false;
                }
            }
        }

        return true;
    }

}