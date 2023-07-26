<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ModelController;
use App\Http\Controllers\Admin\RentController;
use App\Http\Controllers\Admin\UserController;
// use App\Http\Controllers\Admin\ProfileController;

use App\Http\Controllers\Platform\RentCarController;
use App\Http\Controllers\Platform\LandingController;
use App\Http\Controllers\ProfileController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Landing Page
Route::get('/', [LandingController::class,'index'])->name('homepage');

//car
Route::get('cars', [RentCarController::class,'index'])->name('car.index');
Route::get('cars/show/{id}', [RentCarController::class, 'show'])->name('car.show');
Auth::routes();

//rent
Route::group(['middleware' => ['auth']], function(){
    Route::get('rents', [RentCarController::class, 'listRent'])->name('rent.list');
    Route::get('rents/detail/{id}',[RentCarController::class, 'detailRent'])->name('rent.detail');
    Route::post('rents/check', [RentCarController::class, 'checkAvailability'])->name('rent.check');
    Route::get('rents/booked/{id?}', [RentCarController::class, 'process'])->name('rent.process');
    Route::post('rents/booked', [RentCarController::class, 'store'])->name('rent.store');
    Route::put('rents/update/{rent}', [RentCarController::class, 'update'])->name('rent.update');
    Route::delete('rents/cancel/{rent}', [RentCarController::class, 'cancel'])->name('rent.cancel');
});

//Platform Page
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth','is_admin'],'prefix' => 'admin', 'as'=>'admin.'], function(){
    Route::resource('brands', BrandController::class);
    Route::resource('models', ModelController::class);
    Route::resource('cars', CarController::class);
    Route::resource('users', UserController::class);
    
    Route::get('rents', [RentController::class, 'index'])->name('rents.index');
    Route::get('rents/{id}/edit', [RentController::class, 'edit'])->name('rents.edit');
    Route::put('rents/{id}', [RentController::class, 'update'])->name('rents.update');
    Route::delete('rents/{id}', [RentController::class, 'delete'])->name('rents.destroy');
    
    Route::get('profile',[ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile',[ProfileController::class, 'update'])->name('profile.update');
});
