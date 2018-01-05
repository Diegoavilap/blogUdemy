<?php


    //Muestra todas las consultas que se estan ejecutando en cada función
    //$query->sql Muestra las consultas
    //$query->time el tiempo en en milisengundos que tarda cada consulta
    
DB::listen(function($query){
    echo "<pre>{{$query->sql}}</pre>";
});
    

Route::get('/', ['as'=>'home', 'uses' => 'PagesController@home'])/*->middleware('example')*/;



Route::get('saludos/{nombre?}', ['as'=>'saludos', 'uses' => 'PagesController@saludo'])->where('nombre','[A-Za-z]+');


Route::resource('mensajes', 'MessagesController');
Route::resource('usuarios','UsersController');

Route::get('roles', function(){
    return \App\Role::with('user')->get();
});

// Route::get('mensajes',['as' => 'messages.index', 'uses' => 'MessagesController@index']);
// Route::get('mensajes/create',['as' => 'messages.create', 'uses' => 'MessagesController@create']);
// Route::post('mensajes',['as' => 'messages.store', 'uses' => 'MessagesController@store']);
// Route::get('mensajes/{id}',['as' => 'messages.show', 'uses' => 'MessagesController@show']);
// Route::get('mensajes/{id}/edit',['as' => 'messages.edit', 'uses' => 'MessagesController@edit']);
// Route::put('mensajes/{id}',['as' => 'messages.update', 'uses' => 'MessagesController@update']);
// Route::delete('mensajes/{id}',['as' => 'messages.destroy', 'uses' => 'MessagesController@destroy']);


Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



/*
App\User::create([
    'name' => 'OtroAdmin',
    'email' => 'diego@diego.com',
    'role_id' => '1',
    'password' => bcrypt('qwerty'),
    
]); 
App\User::create([
    'name' => 'Moderador',
    'email' => 'tata@tata.com',
    'role_id' => '2',
    'password' => bcrypt('qwerty'),
    
]);
*/