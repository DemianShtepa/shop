<?php

use \Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix("category")
    ->middleware("can:manage-category")
    ->name("category.")
    ->group(function () {
        Route::get("", "CategoryController@index")->name("index");
        Route::get("create", "CategoryController@create")->name("create");
        Route::post("", "CategoryController@store")->name("store");
        Route::get("edit/{id}", "CategoryController@edit")->name("edit");
        Route::put("edit/{currentCategory}", "CategoryController@update")->name("update");
        Route::put("restore/{id}", "CategoryController@restore")->name("restore");
        Route::put("activate/{currentCategory}", "CategoryController@toggleActivate")->name("activate");
        Route::delete("delete/{currentCategory}", "CategoryController@delete")->name("delete");
        Route::delete("force-delete/{currentCategory}", "CategoryController@forceDelete")->name("forceDelete");
    });
Auth::routes();

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
