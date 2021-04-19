<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB; // In case of using query builder import this line

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

Route::get('/about', function() {
    return view('about');
});
// // Old Format (Upto Laravel 7)
// Route::get('/contact', 'ContactController@index');

// New Format:
Route::get('/contact', [ContactController::class, 'index'])->name('con');

// Dashboard route
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // getting data using Eloquent ORM model
    $users = User::all();

    // getting data using query builder

    // $users = DB::table('users')->get();

    return view('dashboard', compact('users'));
})->name('dashboard');

// Categories Route
Route::get('/dashboard/categories', [categoryController::class, 'index'])->name('categories');
Route::post('/dashboard/categories/add', [CategoryController::class, 'store'])->name('store.category'); // this name is going on form
Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('edit.category');
Route::post('/categories/update/{id}', [CategoryController::class, 'update'])->name('update.category');
Route::get('/categories/softdelete/{id}', [CategoryController::class, 'softDelete']);
Route::get('/categories/restore/{id}', [CategoryController::class, 'restore']);
Route::get('categories/emptytrash/{id}', [CategoryController::class, 'delete']);
