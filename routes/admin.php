<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;


// Admin Routes

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'store', 'as' => 'store.'], function () {
        Route::get('/', [StoreController::class, 'index'])->name('index');
        Route::get('create', [StoreController::class, 'create'])->name('create');
        Route::post('store', [StoreController::class, 'store'])->name('store');
        Route::get('edit/{store}', [StoreController::class, 'edit'])->name('edit');
        Route::put('update/{store}', [StoreController::class, 'update'])->name('update');
        Route::get('destroy/{store}', [StoreController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('create', [CategoryController::class, 'create'])->name('create');
        Route::post('store', [CategoryController::class, 'store'])->name('store');
        Route::get('edit/{store}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('update/{store}', [CategoryController::class, 'update'])->name('update');
        Route::get('destroy/{store}', [CategoryController::class, 'destroy'])->name('destroy');
    });


});