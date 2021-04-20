<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Routing\Route as RoutingRoute;
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
//----------------------------------------------------------------------------------//
// Categories Route
Route::get('/dashboard/categories', [CategoryController::class, 'index'])->name('categories');
Route::post('/dashboard/categories/add', [CategoryController::class, 'store'])->name('store.category'); // this name is going on form
Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('edit.category');
Route::post('/categories/update/{id}', [CategoryController::class, 'update'])->name('update.category');
Route::get('/categories/softdelete/{id}', [CategoryController::class, 'softDelete']);
Route::get('/categories/restore/{id}', [CategoryController::class, 'restore']);
Route::get('/categories/emptytrash/{id}', [CategoryController::class, 'delete']);
//----------------------------------------------------------------------------------//
// Brands Route

Route::get('dashboard/brands',[BrandController::class, 'index'])->name('brands');
Route::post('/dashboard/brands/add', [BrandController::class, 'store'])->name('store.brand');
Route::get('/dashboard/brands/edit/{id}', [BrandController::class, 'edit'])->name('edit.brand');
Route::post('/dashboard/brands/update/{id}', [BrandController::class, 'update'])->name('update.brand');
Route::get('/dashboard/brands/delete/{id}', [BrandController::class, 'destroy'])->name('destroy.brand');

//----------------------------------------------------------------------------------//
