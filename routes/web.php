<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', action: [App\Http\Controllers\WebController::class, 'home'])->name('index');

Auth::routes();

Route::get('/home', action: [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/catalog', [App\Http\Controllers\WebController::class, 'catalog'])->name('catalog');
Route::get('/card/{id}', [App\Http\Controllers\WebController::class, 'card'])->name('card');
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'admin'])->name('admin')->middleware('auth');
Route::get('/profile', [App\Http\Controllers\WebController::class, 'profile'])->name('profile')->middleware('auth');
Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');

Route::post('/addGenres', [App\Http\Controllers\AdminController::class, 'addGenres'])->name('addGenres');
Route::delete('/dellGenres', [App\Http\Controllers\AdminController::class, 'dellGenres'])->name('dellGenres');

Route::post('/addTimes', [App\Http\Controllers\AdminController::class, 'addTimes'])->name('addTimes');
Route::delete('/dellTimes', [App\Http\Controllers\AdminController::class, 'dellTimes'])->name('dellTimes');

Route::post('/addPublishers', [App\Http\Controllers\AdminController::class, 'addPublishers'])->name('addPublishers');
Route::delete('/dellPublishers', [App\Http\Controllers\AdminController::class, 'dellPublishers'])->name('dellPublishers');

Route::post('/addRules', [App\Http\Controllers\AdminController::class, 'addRules'])->name('addRules');
Route::delete('/dellRules', [App\Http\Controllers\AdminController::class, 'dellRules'])->name('dellRules');

Route::post('/addProduct', [App\Http\Controllers\AdminController::class, 'addProduct'])->name('addProduct');
Route::get('/editProductView/{id}', [App\Http\Controllers\AdminController::class, 'editProductView'])->name('editProductView');
Route::post('/editProduct/{id}', [App\Http\Controllers\AdminController::class, 'editProduct'])->name('editProduct');
Route::delete('/dellProduct', [App\Http\Controllers\AdminController::class, 'dellProduct'])->name('dellProduct');

Route::post('/addMessage/{id}', [App\Http\Controllers\WebController::class, 'addMessage'])->name('addMessage');
Route::delete('/dellMessage', [App\Http\Controllers\AdminController::class, 'dellMessage'])->name('dellMessage');

Route::delete('/dellUser', [App\Http\Controllers\AdminController::class, 'dellUser'])->name('dellUser');
