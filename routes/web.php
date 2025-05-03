<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/biodata', function () {
    return view('biodata');
});
Route::get('/namasaya', function () {
    return ('sinar');
});
//route 1 parameter
Route::get('/mahasiswa/{nama}', function ($nama) {
    return "Tampilkan data mahasiswa bernama " . $nama;
});

//route dengan 2 parameter
Route::get('/stok_barang/{kategori}/{merek}', function ($kategori, $merek) {
    return "Cek sisa stok untuk : " . $kategori . " " . $merek;
});

// Route dengan Parameter Default
Route::get('/stok_barang/{kategori?}/{merek?}', function ($kategori = 'smartphone', $merek = 'redmi') {
    return "Menampilkan produk kategori: " . $kategori . " " . $merek;
});

// Hanya menerima angka untuk parameter {id}
Route::get('/user/{id}', function ($id) {
    return "Tampilkan user dengan id: " .  $id;
})->where('id', '[0-9]+');

Route::get('/user/{id}', function ($id) {
    return "Tampilkan user dengan id: " . $id;
})->where('id', '^[a-zA-Z]{2}[0-9]+$');