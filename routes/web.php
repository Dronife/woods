<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\backendController;
use GuzzleHttp\Psr7\Request;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/checkUser', [backendController::class, 'userCheck']);

Route::get('/contacs', function () {
    return view('contacts');
});
Route::get('/about', function () {
    return view('about');
});





// ***** Account control *****
Route::get('/account', [backendController::class, 'getAccount']);
Route::post('/update-general-account', [backendController::class, 'updateGeneralAccount']);
Route::post('/update-password-account', [backendController::class, 'updatePasswordAccount']);

// ***** User control *****
Route::delete('/destroyUser/{id}', [backendController::class, 'deleteUser']);
Route::get('/users', [backendController::class, 'getUsers']);
Route::post('/admin-register-submit', [backendController::class, 'adminRegister']);



// ***** Configuration *****

Route::post('/submit-user-list', [backendController::class, 'submitUserList']);
Route::post('/configCreateDefaults', [backendController::class, 'configCreateDefaults']);
Route::get('/configuration', [backendController::class, 'config']);


// ***** Forest forests*****

Route::get('/create-forest', [backendController::class, 'createForestConf']);
Route::post('/submit-forest',[backendController::class, 'addForestConf']);
Route::post('/identificationNumber/{id}', [backendController::class, 'forestIDnum']);
Route::delete('/deleteSubmittion/{id}', [backendController::class, 'deleteSubmitedForest']);
Route::get('/getsubmitedForest/{id}', [backendController::class, 'getSubmitedForest']);
Route::post('/updatesubmitedForest', [backendController::class, 'updateSubmitedForest']);


// ***** View Pictures *****
Route::post('/add-pictures/{id}/{redirect}',[backendController::class, 'addPictures']);
Route::get('/slide-show/{id}', [backendController::class, 'getPictures']);
Route::delete('/deletepic/{id}', [backendController::class, 'deletePicture']);








Auth::routes();
Route::get('/userpanel', [backendController::class, 'userAdmin']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

