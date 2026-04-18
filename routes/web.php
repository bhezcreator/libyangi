<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', function () {
        return view('pages.home');
    })->name('home');

    Route::get('/utilisateurs', function () {
        return view('pages.user');
    })->name('utilisateurs');

    Route::get('/settings', function () {
        return view('pages.setting');
    })->name('settings');

    Route::get('/notifications', function () {
        return view('pages.notification');
    })->name('notifications');
});
