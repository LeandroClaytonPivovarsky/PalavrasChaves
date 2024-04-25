<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Html2Text\Html2Text;

class ToolController extends Controller
{
    public function index()
    {

        return view('tool.index');
    }

    public function calcularEDevolverDensidade(Request $request)
    {
        if($request->isMethod('POST')){
            
            if(isset($request->palavraChaveInput)){
                $html = new Html2Text($request);
                $text = $html->getText();
                $totalPalavras = str_word_count($text);
                $palavrasEOcorrimentos = array_count_values(str_word_count($text, 1));
                arsort($palavrasEOcorrimentos);

                $densidadePalavrasChavesArray = [];

                foreach ($palavrasEOcorrimentos as $key => $value) {
                    $densidadePalavrasChavesArray[] = [
                        "palavraChave" => $key,
                        "count" => $value,
                        "densidade" => round(($value / $totalPalavras) *  100.2)
                    ];
                }

                return $densidadePalavrasChavesArray;
            }
        }

    }
}
