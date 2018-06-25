<?php

namespace App\Utilities;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class GerirImagens
{

    /* var $tamanho em bytes
        retorna tamanho em kpbs ou mbs
    */
    private static function converterTamanho($tamanho)
    {
        if($tamanho <= 1048576) // se não tem 1mb
        {
            return round($tamanho/1024);
        }
        else { // se tem mais do que 1mb
            return round($tamanho/1048576);
        }
    }


    public static function validarTinyMCE($formato, $tamanho) 
    {
        $formatosAceites = ['jpg', 'jpeg', 'png'];
        $formato = explode('/', $formato)[1]; // $formato é image/jpg por exemplo

        $tamanho = self::converterTamanho($tamanho);
        $maxTamanhoAceite = 2048;
        
       return in_array($formato, $formatosAceites) && $tamanho <= $maxTamanhoAceite ? true : false;
    }

    public static function guardar(Request $request, string $nomePasta, string $filename)
    {   
        if($request->file($filename)->isValid())
        {
            try {
                $ficheiro = $request->file($filename);
                $nomeImagem = $nomePasta . '/' . time() . '_' . $ficheiro->getClientOriginalName();
                self::alterarTamanho($ficheiro, $nomeImagem);
                // $ficheiro->move($localizacao, $nomeImagem);


                return $nomeImagem;

            }
            catch(Exception $e)
            {
                return false;
            }
            
        }
    }


    private static function alterarTamanho($ficheiro, $nomeImagem)
    { 
        $img = Image::make($ficheiro);
        $localizacao = public_path('\imagens\\');
        
        if(getImageSize($ficheiro) > 850)
            $img->resize(850, null, function($constraint) {
                $constraint->aspectRatio();
            });

        $img->save($localizacao . $nomeImagem);
    }



    public static function apagar(string $nomeImagem)
    {
        $ficheiro = 'imagens/' . $nomeImagem;
        if(File::exists($ficheiro)) {
            File::delete($ficheiro);
        }
    }
    
}