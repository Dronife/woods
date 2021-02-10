<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\backendController;
use GuzzleHttp\Psr7\Request;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/checkUser', [backendController::class, 'userCheck']);

Route::get('/userpanel', function () {
    return view('user');
});

Route::post('/update-general-account', [backendController::class, 'updateGeneralAccount']);
Route::post('/update-password-account', [backendController::class, 'updatePasswordAccount']);
Route::get('/account', [backendController::class, 'getAccount']);
Route::get('/adminpanel', [backendController::class, 'userAdmin']);
Route::get('/create-forest', [backendController::class, 'createForestConf']);
Route::post('/submit-forest',[backendController::class, 'addForestConf']);
Route::post('/add-pictures/{id}/{redirect}',[backendController::class, 'addPictures']);
Route::get('/slide-show/{id}', [backendController::class, 'getPictures']);

Route::delete('/deleteSubmittion/{id}', [backendController::class, 'deleteSubmitedForest']);
Route::delete('/deletepic/{id}', [backendController::class, 'deletePicture']);
Route::delete('/destroyUser/{id}', [backendController::class, 'deleteUser']);
Route::get('/getsubmitedForest/{id}', [backendController::class, 'getSubmitedForest']);
Route::post('/updatesubmitedForest', [backendController::class, 'updateSubmitedForest']);

Route::get('/users', [backendController::class, 'getUsers']);
Route::post('/submit-user-list', [backendController::class, 'submitUserList']);
Route::post('/admin-register-submit', [backendController::class, 'adminRegister']);

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

