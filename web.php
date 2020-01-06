<?php
Route::get('/envioemailF', function(){return view('envioEmailFalha');});
Route::get('/envioemailS', function(){return view('envioEmailSucesso');});
Route::get('/envio','EnvioEmailController@index');
Route::post('/envio','EnvioEmailController@envioE');
Route::resource('/', 'Home@index');
});
