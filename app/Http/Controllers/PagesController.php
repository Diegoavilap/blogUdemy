<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateMessageRequest;
class PagesController extends Controller
{
    public function __construct()
    {
        
        //Un Middleware es una clase que se dedicada a interceptar un request verificar que
        // se cumplan ciertas reglas y dejarlo continuar o no
        // En el segundo parametro puedo dejar que se aplique el middleware a solo un metodo
        // con Only o indicar a cual no se le aplica el middleware con Except
        $this->middleware('example', ['except' => ['home']]);
    }

    public function home(){
        return view('home');
    //    return response( "Todo ok", 201)
    //                 ->header('X_TOKEN', 'secret');
    }
    public function contact(){
        return view('contacto');
    }

    public function saludo($nombre = "Invitado"){
        
        $consolas = [
            'Play 1',
            'Xbox'
        ];
        return view('saludo',compact('nombre', 'consolas'));
    }

    public function mensaje( CreateMessageRequest $request)
    {
        $data = $request->all();
       /* return response()->json([
            'data' => $data,

        ],202)
        ->header('TOKEN', 'secret');*/

        return back()->with('info','Tu mensaje ha sido enviado correctamente :)');
    }
}
