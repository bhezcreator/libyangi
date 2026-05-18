<?php

use Illuminate\Support\Facades\Route;
use App\Models\Theme;
use LaravelQRCode\Facades\QRCode;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', function () {
        return view('pages.home');
    })->name('home');

    Route::get('/events', function () {
        return view('pages.events.event');
    })->name('events.index');

    Route::get('/event/add/{subscription_id?}/{user_id?}', function ($subscription_id = null, $user_id = null) {
        return view('pages.events.addEvent', compact('subscription_id', 'user_id'));
    })->name('events.add');

    Route::get('/event/edit/{subscription_id?}/{user_id?}/{event?}', function ($subscription_id = null, $user_id = null, $event = null) {
        return view('pages.events.addEvent', compact('subscription_id', 'user_id', 'event'));
    })->name('events.edit');

    // Génération du Code qr
    Route::get('/event/codeqr/{url}', function ($url) {
        $url = hex2bin($url);
        $chemin = public_path() . "/storage/qrcode partager invitation.png";
        QRCode::text($url)
            ->setSize(12)
            ->setMargin(2)
            ->setOutfile($chemin)
            ->png();
        return response()->download($chemin);
    })->name('events.qr');

    Route::get('/event/detail/{id}', function ($id) {
        return view('pages.events.detailEvent', compact('id'));
    })->name('events.detail');

    Route::get('/demandes', function () {
        return view('pages.demandes.demande');
    })->name('demandes.index');

    Route::get('/demandes.add{plan}', function ($plan) {
        return view('pages.demandes.demandeAdd', compact('plan'));
    })->name('demandes.add');

    Route::get('/validations', function () {
        return view('pages.validation');
    })->name('validations');

    Route::get('/settings', function () {
        return view('pages.setting');
    })->name('settings');

    Route::get('/notifications', function () {
        return view('pages.notification');
    })->name('notifications');

    Route::get('/themes/{id}/preview', function ($id) {
        $theme = Theme::findOrFail($id);
        return view('pages.theme.preview', compact('theme'));
    })->name('themes.preview');
});


Route::get('/event/show/{slug}', function ($slug) {
    return view('pages.showEvent', compact('slug'));
})->name('events.show');
