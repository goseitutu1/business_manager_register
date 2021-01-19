<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

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

Route::permanentRedirect('/', '/welcome');

Route::get('/', 'WelcomeController@index')->name('welcome.index');
// Route::permanentRedirect('/','/register');
Route::view('/myregister', 'auth.register', ['name' => 'myregister']);
Route::get('/myregister',function (){
    return view('auth.register');
})->name('myregister');

Auth::routes();

Route::any('tmp/register/{tmpcode}','apiController@register')->name('register.company.tmp');


// handle application settings after successfull login
Route::get('/post-login', function () {
    $user     = auth()->user();
    if ("admin" == $user->type) {
        return redirect()->route('admin.home');
    } else {
        return redirect()->route('home');
    }
})->middleware('auth');


Route::get('/login',function (){
    return view('login');
});

// dd(Request::is('admin/*'));
// if (Request::is('admin/*')) {
require __DIR__ . '/admin_web.php';
// } else {
require __DIR__ . '/clients_web.php';
// }

// Route::get('/register',function (){
//     return view('auth.register');
// });