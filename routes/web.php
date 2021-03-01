<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\backendController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ForestController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ConfigurationController;

use GuzzleHttp\Psr7\Request;

Route::get('/', function () {
    return view('auth.login');
});
// Route::get('/checkUser', [backendController::class, 'userCheck']);

Route::get('/contacs', function () {
    return view('contacts');
});
Route::get('/about', function () {
    return view('about');
});





// ***** Account control *****
Route::group(['prefix' => 'account'], function() {
    Route::get('/', [AccountController::class, 'getAccount']);
    Route::post('/update', [AccountController::class, 'updateGeneralAccount']);
    Route::post('/password_update', [AccountController::class, 'updatePasswordAccount']);
});


//Only for admin 

Route::group(['middleware' => 'admin'], function() {
    
    
    // ***** User control *****
    Route::group(['prefix' => 'users'], function() {
        Route::get('/', [UserController::class, 'getUsers']);
        Route::delete('/destroy/{id}', [UserController::class, 'delete_user']);
        Route::post('/submit', [UserController::class, 'submit_updated']);
        Route::post('/new', [UserController::class, 'new_user']);
    });
    
    
    // ***** Configuration *****
    Route::post('/configCreateDefaults', [ConfigurationController::class, 'configCreateDefaults']);
    Route::get('/configuration', [ConfigurationController::class, 'config']);
    
    // ***** Forest(Admin) *****
    Route::group(['prefix' => 'forest'], function() {
        Route::delete('/delete/{id}', [ForestController::class, 'delete']);
        Route::post('/update', [ForestController::class, 'update']);
    });
    
    
});

// ***** Forest forests*****
Route::group(['prefix' => 'forest'], function() {
    Route::get('/create', [ForestController::class, 'create']);
    Route::post('/submit',[ForestController::class, 'submit']);
    Route::post('/identification_Number/{id}', [ForestController::class, 'forestIDnum']);
    Route::get('/get/submited/{id}', [ForestController::class, 'get']);
});


// ***** View Pictures *****
Route::group(['prefix' => 'pictures'], function() {
    Route::post('/add/{id}/{redirect}',[PhotoController::class, 'add']);
    Route::get('/get/{id}', [PhotoController::class, 'get']);
    Route::delete('/delete/{id}', [PhotoController::class, 'delete']);
});

Auth::routes();


Route::get('/userpanel', [backendController::class, 'user']);

