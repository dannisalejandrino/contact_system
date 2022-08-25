<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\ContactController;
use App\Models\Contact;

Route::get('/', [ContactController::class, 'contacts'])->name('contacts');
Route::post('/add-contact', [ContactController::class, 'addContact'])->name('add.contact');
Route::post('/update-contact', [ContactController::class, 'updateContact'])->name('update.contact');
Route::post('/delete-contact', [ContactController::class, 'deleteContact'])->name('delete.contact');
Route::get('/pagination/paginate-data', [ContactController::class, 'searchContact']);
Route::get('/search-contact', [ContactController::class, 'searchContact'])->name('search.contact');

Auth::routes();
