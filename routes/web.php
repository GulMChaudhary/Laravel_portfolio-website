<?php

use App\Http\Controllers\AboutSection;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserProfileController;

use App\Models\Brand;
use App\Models\Slider;
use App\Models\User;
use App\Models\Skills;
use App\Models\Service;
use App\Models\Contact;


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
//|--------------------------------------------------------------------------
// For The Email Verification Notice
//|--------------------------------------------------------------------------
Route::get('/email/verify', function() {
    return view('auth.verify-email');
    })->middleware(['auth'])->name('verification.notice');
//----------------------------------------------------------------------------------//
// To display content on home page
Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $about_section = DB::table('home_abouts')->first();
    return view('home', compact('brands', 'about_section'));
});
// //----------------------------------------------------------------------------------//
// Route::get('/about', function() {
//     return view('about');
// });
//----------------------------------------------------------------------------------//
// Contact Form data on front page

Route::get('/contact', function() {
    $contact = DB::table('contacts')->first();
    return view('contact', compact('contact'));
});
// Backend
Route::post('/contact/form', [ContactController::class, 'contactForm'])->name('contact.form');
Route::get('/dashboard/messages', [ContactController::class, 'displayMessages'])->name('messages');
Route::get('/dashboard/messages/delete/{id}', [ContactController::class, 'destroyMessages'])->name('destroyMessages');

//----------------------------------------------------------------------------------//
// Manage contact information in backend
// // Old Format (Upto Laravel 7)
// Route::get('/contact', 'ContactController@index');

// New Format:
Route::get('/dashboard/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/dashboard/contact/create', [ContactController::class, 'create'])->name('contact.create');
Route::post('/dashboard/contact/store', [ContactController::class, 'store'])->name('contact.store');
Route::get('/dashboard/contact/edit/{id}', [ContactController::class, 'edit'])->name('contact.edit');
Route::post('/dashboard/contact/update/{id}', [ContactController::class, 'update'])->name('contact.update');
Route::get('/dashboard/contact/delete/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');

//----------------------------------------------------------------------------------//
// Dashboard and User Profile route
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // getting data using Eloquent ORM model
    //$users = User::all();

    // getting data using query builder

    // $users = DB::table('users')->get();

    return view('admin.index');
})->name('dashboard');

Route::get('/dashboard/user/password', [UserProfileController::class, 'changePassword'])->name('change.password');
Route::post('/dashboard/user/update/password', [UserProfileController::class, 'updatePassword'])->name('password.update');

Route::get('/user/logout', [AdminController::class, 'Logout'])->name('user.logout');


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

// Brands/clients Route

Route::get('/dashboard/brands',[BrandController::class, 'index'])->name('brands');
Route::post('/dashboard/brands/add', [BrandController::class, 'store'])->name('store.brand');
Route::get('/dashboard/brands/edit/{id}', [BrandController::class, 'edit'])->name('edit.brand');
Route::post('/dashboard/brands/update/{id}', [BrandController::class, 'update'])->name('update.brand');
Route::get('/dashboard/brands/delete/{id}', [BrandController::class, 'destroy'])->name('destroy.brand');

//----------------------------------------------------------------------------------//

// Slider Route

Route::get('/dashboard/slider', [SliderController::class, 'index'])->name('home.slider');
Route::get('/dashboard/slider/create', [SliderController::class, 'create'])->name('create.slider');
Route::post('/dashboard/slider/store', [SliderController::class, 'store'])->name('store.slider');
Route::get('users/{id}', function ($id) {

});
//----------------------------------------------------------------------------------//

// About Section Route
Route::get('/dashboard/home-about', [AboutSection::class, 'index'])->name('home.about');
Route::get('/dashboard/home-about/create', [AboutSection::class, 'create'])->name('home.about_create');
Route::post('/dashboard/home-about/store', [AboutSection::class, 'store'])->name('home.about_store');
Route::get('/dashboard/home-about/edit/{id}', [AboutSection::class, 'edit'])->name('home.about_edit');
Route::post('/dashboard/home-about/update/{id}', [AboutSection::class, 'update'])->name('home.about_update');
Route::get('/dashboard/home-about/delete/{id}', [AboutSection::class, 'destroy'])->name('home.about_destroy');

//----------------------------------------------------------------------------------//

// Services Section Route
Route::get('/dashboard/services', [ServicesController::class, 'index'])->name('services');
Route::post('/dashboard/services/add', [ServicesController::class, 'store'])->name('services.store');
Route::get('/dashboard/services/edit/{id}', [ServicesController::class, 'edit'])->name('services.edit');
Route::post('/dashboard/services/update/{id}', [ServicesController::class, 'update'])->name('services.update');
Route::get('/dashboard/services/delete/{id}', [ServicesController::class, 'destroy'])->name('services.destroy');

//----------------------------------------------------------------------------------//

// Skills Section Route

Route::get('/dashboard/skills', [SkillsController::class, 'index'])->name('skills');

//----------------------------------------------------------------------------------//

// Portfolio Section Route

Route::get('/dashboard/portfolio', [PortfolioController::class, 'index'])->name('portfolio');

//----------------------------------------------------------------------------------//

// Contact Section Route

