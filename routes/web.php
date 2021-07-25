<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ["localeCookieRedirect",'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        //--------------- Landing page Route ------------//
        Route::get('/', [App\Http\Controllers\landingController::class,"index"]);
        //--------------- end landing -----------------//

        ########### Group tasks #################
        Route::group(["prefix" => "tasks", "namespace" => "App\Http\Controllers\Front"], function () {
            Route::get('/', "UserTasksController@index")->name('tasks');
            Route::get("/json", "UserTasksController@getTasksUser")->name("allTasks");
            Route::post("/add", "UserTasksController@insertTask")->name("addTask");
            Route::post("/done","UserTasksController@doneTask")->name("doneTask");
            Route::post("/delete","UserTasksController@deleteTask")->name("deleteTask");
            Route::get("@/{username}","UserTasksController@getSingleTasks")->name("single");
            Route::get("/me","UserTasksController@profile")->name("profile");
            Route::post("/me","UserTasksController@updateProfile")->name("update.userinfo");
            Route::get("/reset","UserTasksController@resetAllTasks");
        });
        #########################################

        //------------------- Auth Route ------------------// 
        Auth::routes(["reset" => false, "confirm" => false]);
        //------------------- End Auth -------------------//
    }
);
