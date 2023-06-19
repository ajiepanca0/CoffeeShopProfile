<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CoffeeController;
use App\Http\Controllers\DashboardController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [CoffeeController::class, 'index'])->name('coffee');
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/blog', [BlogController::class, 'index']);
Route::post('/add-blog', [BlogController::class, 'addBlog'])->name('addBlog');
Route::post('/blog/{id}/update', [BlogController::class,'updateBlog'])->name('blogUpdate');
Route::post('/blog/{id}/delete', [BlogController::class,'deleteBlog'])->name('blogDelete');

Route::post('/sendpromo', [CoffeeController::class, 'sendPromo'])->name('sendPromo');




