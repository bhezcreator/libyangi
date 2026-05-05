<?php

use Illuminate\Support\Facades\Route;
use App\Models\Theme;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', function () {
        return view('pages.home');
    })->name('home');

    Route::get('/events', function () {
        return view('pages.event');
    })->name('events.index');

    Route::get('/event.add', function () {
        return view('pages.addEvent');
    })->name('events.add');

    Route::get('/demandes', function () {
        return view('pages.demande');
    })->name('demandes.index');

    Route::get('/demandes.add{plan}', function ($plan) {
        return view('pages.demandeAdd', compact('plan'));
    })->name('demandes.add');

    Route::get('/validations', function () {
        return view('pages.validation');
    })->name('validations');

    Route::get('/settings', function () {
        return view('pages.setting');
    })->name('settings');

    /*     Route::get('/utilisateurs', function () {
        return view('pages.user');
    })->name('utilisateurs'); */

    Route::get('/notifications', function () {
        return view('pages.notification');
    })->name('notifications');

    Route::get('/themes/{id}/preview', function ($id) {
        $theme = Theme::findOrFail($id);
        return view('pages.theme.preview', compact('theme'));
    })->name('themes.preview');
});
