<?php

use App\Models\Media;
use App\Models\Theme;
use Illuminate\Support\Facades\Route;
use LaravelQRCode\Facades\QRCode;
use Illuminate\Support\Facades\Storage;

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


// Pages show invitation public
Route::get('/event/show/{slug}/{id}', function ($slug, $id) {
    $id = hex2bin($id);
    return view('pages.showEvent', compact('slug', 'id'));
})->name('events.show');

// Pages show medias public
Route::get('/event/show/picture/public/{id}', function ($id) {
    return view('pages.showPictureEvent', compact('id'));
})->name('events.show.picture');

// Télécharger les medias
Route::get('/event/show/download/medias/{id}', function ($id) {
    $image = Media::findOrFail($id);
    $file = $image->files->first();
    $mediaUrl = $file ? public_path() . "/storage/" . $file->id . '/' . $file->file_name : null;

    if (!$mediaUrl) {
        abort(404, 'Fichier introuvable.');
    }

    return response()->download($mediaUrl);
})->name('events.show.download');

// Télécharger l'invitation public
Route::get('events/download/{chemin}-{invite}-{event}', 'App\Http\Controllers\EvenementController@download')->name('events.download');

// Show page de confirmation public
Route::get('events/confirmation/{chemin}-{invite}-{event}', function ($chemin, $invite, $event) {
    return view('pages.confirmation', compact('chemin', 'invite', 'event'));
})->name('confirmation');

// Show page de refus, en cas d'échec de l'invitation
Route::get('events/refus/{invite}', function ($invite) {
    return view('pages.refus', compact('invite'));
})->name('refus');


// Route pour vérifié l'invitation
Route::get('/verify/invitation/{code}', 'App\Http\Controllers\EvenementController@verify')->middleware(['auth'])->name('invitation.verify');
