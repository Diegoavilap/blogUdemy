<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cache;
use Mail;
use Carbon\Carbon;
use App\Message;
use App\Events\MessageWasReceived;


class MessagesController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth',['except' => ['create','store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $key = "message.page." . request('page',1);

        $messages = Cache::rememberForever($key, function(){
            
            return Message::with(['user','note','tags'])
                ->orderBy('created_at', request('sorted','DESC')) 
                ->paginate(10);
        });
        /*
        if( Cache::has($key))
        {
           $messages = Cache::get($key);
        }
        else
        {
            $messages = Message::with(['user','note','tags'])
                ->orderBy('created_at', request('sorted','DESC')) //El segundo parametro de request es un valor por defecto
                ->paginate(10);

            Cache::put($key , $messages, 5);
            //paginate() Pagina segun la cantidad que se le pase como parametro
            //simplepaginate() muestra solo flechas atras y siguiente
            //latest() sirve para ordenar los ultimos primero
        }   
        */ 
        return view('messages.index',compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('messages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Guardar el mensaje
        // DB::table('messages')->insert([
        //     'nombre' => $request->input('nombre'),
        //     'email' =>  $request->input('email'),
        //     'mensaje' => $request->input('mensaje'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()

        // ]);
        // $message = new Message;
        // $message->nombre = $request->input('nombre');
        // $message->email = $request->input('email');
        // $message->mensaje = $request->input('mensaje');
        // $message->save();

        $message = Message::create($request->all());
        
        
        if(auth()->check())
        {
            auth()->user()->messages()->save($message);
        }

        Cache::flush();
        
        //Un evento es un DTO Data Transfer Object 
        //Su unica funcion es transportar datos
        event ( new MessageWasReceived($message));

        //auth()->user()->messages()->create($request->all());

        //$message->user_id = auth()->id();
        //$message->save();
        
        //Mail::send('vista',[], function($message){});
        // Para poder usar la variable $message dentro de la función se utiliza el "use"
        
        return redirect()->route('mensajes.create')->with('info','Hemos recibido tu mensaje');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $message = DB::table('messages')->where('id',$id)->first();

        $message = Cache::rememberForever("messages.{$id}", function() use ($id){
            return  Message::findOrFail($id);
        });

        return view('messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $message = DB::table('messages')->where('id',$id)->first();
        $message = Cache::rememberForever("messages.{$id}", function() use ($id){
            return  Message::findOrFail($id);
        });
        
        return view('messages.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Actualizar el mensaje

        // DB::table('messages')->where('id' , $id)->update([
        //     'nombre' => $request->input('nombre'),
        //     'email' =>  $request->input('email'),
        //     'mensaje' => $request->input('mensaje'),
        //     'updated_at' => Carbon::now()
        // ]);
        $message = Message::findOrFail($id)->update($request->all());
        Cache::flush();
        return redirect()->route('mensajes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // DB::table('messages')->where('id',$id)->delete();
        $message = Message::findOrFail($id)->delete();
        Cache::flush();
        return redirect()->route('mensajes.index');
    }
}
