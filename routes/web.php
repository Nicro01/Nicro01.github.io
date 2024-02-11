<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\FolderController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Home');
});

Route::get('/folders/{folder_id}', [FolderController::class, 'getFolders']);
Route::get('/files/{folder_id}', [FileController::class, 'getFiles']);

Route::get('/upload/{folder_id}', [FolderController::class, 'uploadToFolder'])->name('upload');

Route::get('/file/{file_id}', [FileController::class, 'showFile'])->name('file.show');
Route::post('/files/edit/{file_id}', [FileController::class, 'edit'])->name('files.edit');
Route::post('/upload/{folder_id}', [FileController::class, 'uploadFile']);
Route::delete('/file/{file_id}', [FileController::class, 'delete'])->name('file.delete');
