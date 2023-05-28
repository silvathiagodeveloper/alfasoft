<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [ContactController::class, 'index'])->name('home.index');
Route::get('/contacts', [ContactController::class, 'index']  )->name('contacts.index');
Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::middleware(['auth', 'verified'])
    ->group(function () {
        Route::get(   'contacts/create',      [ContactController::class, 'create'] )->name('contacts.create');
        Route::post(  'contacts',             [ContactController::class, 'store']  )->name('contacts.store');
        Route::put(   'contacts/{url}',       [ContactController::class, 'update'] )->name('contacts.update');
        Route::get(   'contacts/{url}',       [ContactController::class, 'show']   )->name('contacts.show');
        Route::get(   'contacts/{url}/edit',  [ContactController::class, 'edit']   )->name('contacts.edit');
        Route::delete('contacts/{id}',        [ContactController::class, 'destroy'])->name('contacts.destroy');
});

require __DIR__.'/auth.php';

Auth::routes();


