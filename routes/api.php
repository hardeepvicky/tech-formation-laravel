<?php
Route::group(['middleware' => ['api']], function() 
{
    Route::post('web-service/login', 'WebServiceController@Login');
});