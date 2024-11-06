<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemoController;
use App\Http\Controllers\CategoryController;



// メモ
Route::get('/', [MemoController::class, 'index'])->name('memo.index');
Route::get('/create', [MemoController::class, 'create'])->name('memo.create');
Route::post('/store', [MemoController::class, 'store'])->name('memo.store');
Route::get('/edit/{id}', [MemoController::class, 'edit'])->name('memo.edit');
Route::put('/memo/{id}', [MemoController::class, 'update'])->name('memo.update');
Route::delete('/destroy/{id}', [MemoController::class, 'destroy'])->name('memo.destroy');

// カテゴリ
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/destroy/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

