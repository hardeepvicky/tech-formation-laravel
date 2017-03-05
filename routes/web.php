<?php
//Home Page
Route::get("/", function ()
{
    return redirect("login");
});

//Public Pages
Route::group(['middleware' => "public"], function () 
{
    Route::get("login", "UserController@login");
    Route::post("login/attempt", "UserController@login_attempt");
    Route::get("logout", "UserController@logout");
});

//Secure Pages
Route::group(['middleware' => "secure"], function () 
{
    Route::resource("role", "RoleController");
    
    Route::resource("permission", "permissionController");
    Route::get("permission/refresh/{All_delete}", "permissionController@refresh");
    
    Route::resource("user", "UserController");
    Route::get("user/{ID}/active/toggle/{v}", "UserController@toggle_active");
    Route::get("user/password/change", "UserController@change_password");
    Route::put("user/password/update", "UserController@update_password");
    
    Route::get("log/web-service", "LogController@web_service");
    Route::get("log/cron", "LogController@cron");
});
