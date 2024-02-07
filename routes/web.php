<?php
use App\Http\Controllers\Usercontroller;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::resource('/user', App\Http\Controllers\Usercontroller::class);

Route::resource('/category', App\Http\Controllers\CategoryController::class);
Route::resource('/label', App\Http\Controllers\LabelController::class);
Route::resource('/ticket', App\Http\Controllers\TicketController::class);
Route::resource('/comment', App\Http\Controllers\CommentController::class);
