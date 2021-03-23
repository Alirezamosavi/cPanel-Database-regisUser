

<?php
// routes
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('register');
});
Route::get('/login', function () {
    return view('login');
});

Route::get('/home', function ($guard=null) {
        if(Auth::guard($guard)->check()){
            return view('home');
        }else{
             return redirect()->to('/login');
        }
    });


Route::post('new','App\Http\Controllers\AuthController@register');
Route::post('log', 'App\Http\Controllers\AuthController@login');
Route::post('logout', 'App\Http\Controllers\AuthController@logout');
Route::get('user-profile', 'App\Http\Controllers\AuthController@userProfile');
