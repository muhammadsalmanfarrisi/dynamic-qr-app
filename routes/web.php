<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortLinkController;

// 1. Route Publik: Ini yang akan diakses saat QR Code dipindai
Route::get('/go/{short_code}', [ShortLinkController::class, 'redirectUrl']);

// 2. Route Admin: Ini untuk manajemen data (Create, Read, Update)
// Secara otomatis membuat route: /short_links, /short_links/create, dll.
Route::resource('/', ShortLinkController::class)->except(['show', 'destroy']);
Route::resource('short_links', ShortLinkController::class)->except(['show', 'destroy']);
