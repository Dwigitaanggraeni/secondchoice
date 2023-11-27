<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsC;
use App\Http\Controllers\TransactionsC;
use App\Http\Controllers\MTransactionsC;
use App\Http\Controllers\UsersR;
use App\Http\Controllers\LoginC;
use App\Http\Controllers\LogC;
use App\Http\Controllers\TransactionsPDF;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    $subtitle = 'Home Page';
    return view('login', compact('subtitle'));
});

Route::get('/dashboard', function () {
    $subtitle = 'Home Page';
    return view('dashboard', compact('subtitle'));
})->middleware('auth');



Route::get('transactions/pdf2', [TransactionsC::class, 'pdf2'])->name('transactions.pdf2')->middleware('userAkses:kasir,owner,admin');
Route::get('transactions/pdf{id}', [TransactionsC::class, 'pdf'])->name('transactions.pdf')->middleware('userAkses:kasir,owner,admin');

Route::get('logout', [LoginC::class, 'logout'])->name('logout')->middleware('auth');
Route::post('login', [LoginC::class, 'login_action'])->name('login.action')->middleware('guest');
Route::get('login', [LoginC::class, 'login'])->name('login')->middleware('guest');


// Product Routes
Route::get('products/pdf', [ProductsC::class, 'pdf'])->name('products.pdf')->middleware('userAkses:owner,admin');
// Route::resource('products', ProductsC::class)->middleware('userAkses:owner,admin,kasir');
Route::get('products', [ProductsC::class, 'index'])->name('products.index')->middleware('userAkses:kasir,admin,owner');
Route::get('products/create', [ProductsC::class, 'create'])->name('products.create')->middleware('userAkses:admin,owner');
Route::post('products/store', [ProductsC::class, 'store'])->name('products.store')->middleware('userAkses:admin,owner');
Route::get('products/edit/{id}', [ProductsC::class, 'edit'])->name('products.edit')->middleware('userAkses:admin');
Route::put('products/update/{id}', [ProductsC::class, 'update'])->name('products.update')->middleware('userAkses:admin');
Route::delete('products/delete/{id}', [ProductsC::class, 'destroy'])->name('products.destroy')->middleware('userAkses:admin');

// multiple transaction
Route::get('transactions', [MTransactionsC::class, 'index'])->name('mtransactions.index')->middleware('userAkses:kasir,admin,owner');
Route::post('mtransactions/store', [MTransactionsC::class, 'store'])->name('mtransactions.store')->middleware('userAkses:kasir');
Route::get('mtransactions/download-pdf', [MTransactionsC::class, 'downloadpdf'])->name('mtransactions.downloadpdf')->middleware('userAkses:kasir');
Route::get('mtransactions/download-single-pdf/{id}', [MTransactionsC::class, 'downloadSingle'])->name('mtransactions.downloadSingle')->middleware('userAkses:kasir');

Route::get('transactions/create', [TransactionsC::class, 'create'])->name('transactions.create')->middleware('userAkses:kasir,admin');
Route::post('transactions/store', [TransactionsC::class, 'store'])->name('transactions.store')->middleware('userAkses:kasir');

Route::get('transactions/edit/{id}', [TransactionsC::class, 'edit'])->name('transactions.edit')->middleware('userAkses:admin');
Route::put('transactions/update/{id}', [TransactionsC::class, 'update'])->name('transactions.update')->middleware('userAkses:admin');
Route::delete('transactions/delete/{id}', [TransactionsC::class, 'delete'])->name('transactions.delete')->middleware('userAkses:admin');


Route::get('users/changepassword/{id}', [UsersR::class, 'changepassword'])->name('users.changepassword')->middleware('userAkses:owner,admin');
Route::put('users/change/{id}', [UsersR::class, 'change'])->name('users.change')->middleware('userAkses:owner,admin');
Route::delete('users/delete/{id}', [UsersR::class, 'delete'])->name('users.delete')->middleware('userAkses:owner,admin');
Route::resource('users', UsersR::class)->middleware('userAkses:owner,admin');

Route::resource('log', LogC::class)->middleware('userAkses:kasir,admin,owner');
