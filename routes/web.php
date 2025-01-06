<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FaqController;

Route::controller(PageController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/informasi-desa', 'informasiDesa')->name('informasi-desa');
    Route::get('/sejarah', 'sejarah')->name('sejarah');
    Route::get('/visi-misi', 'visiMisi')->name('visi-misi');
});
Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('blogs', BlogController::class);
    Route::resource('events', EventController::class);
    Route::prefix('destinations')->group(function () {
        Route::get('/edit', [DestinationController::class, 'edit'])->name('destinations.edit');
        Route::put('/', [DestinationController::class, 'update'])->name('destinations.update');
        Route::get('/prices/create', [DestinationController::class, 'destinationPriceCreate'])->name('destinations.prices.create');
        Route::post('/prices', [DestinationController::class, 'destinationPriceStore'])->name('destinations.prices.store');
        Route::get('/prices/{destinationPriceRule}/edit', [DestinationController::class, 'destinationPriceEdit'])->name('destinations.prices.edit');
        Route::put('/prices/{destinationPriceRule}', [DestinationController::class, 'destinationPriceUpdate'])->name('destinations.prices.update');
        Route::delete('/prices/{destinationPriceRule}', [DestinationController::class, 'destinationPriceDestroy'])->name('destinations.prices.destroy');
        Route::get('/attractions/create', [DestinationController::class, 'destinationAttractionCreate'])->name('destinations.attractions.create');
        Route::post('/attractions', [DestinationController::class, 'destinationAttractionStore'])->name('destinations.attractions.store');
        Route::get('/attractions/{attraction}/edit', [DestinationController::class, 'destinationAttractionEdit'])->name('destinations.attractions.edit');
        Route::put('/attractions/{attraction}', [DestinationController::class, 'destinationAttractionUpdate'])->name('destinations.attractions.update');
        Route::delete('/attractions/{attraction}', [DestinationController::class, 'destinationAttractionDestroy'])->name('destinations.attractions.destroy');
        Route::get('/facilities/create', [DestinationController::class, 'destinationFacilityCreate'])->name('destinations.facilities.create');
        Route::post('/facilities', [DestinationController::class, 'destinationFacilityStore'])->name('destinations.facilities.store');
        Route::get('/facilities/{facility}/edit', [DestinationController::class, 'destinationFacilityEdit'])->name('destinations.facilities.edit');
        Route::put('/facilities/{facility}', [DestinationController::class, 'destinationFacilityUpdate'])->name('destinations.facilities.update');
        Route::delete('/facilities/{facility}', [DestinationController::class, 'destinationFacilityDestroy'])->name('destinations.facilities.destroy');
        Route::get('/galleries/create', [DestinationController::class, 'destinationGalleryCreate'])->name('destinations.galleries.create');
        Route::post('/galleries', [DestinationController::class, 'destinationGalleryStore'])->name('destinations.galleries.store');
        Route::get('/galleries/{gallery}/edit', [DestinationController::class, 'destinationGalleryEdit'])->name('destinations.galleries.edit');
        Route::put('/galleries/{gallery}', [DestinationController::class, 'destinationGalleryUpdate'])->name('destinations.galleries.update');
        Route::delete('/galleries/{gallery}', [DestinationController::class, 'destinationGalleryDestroy'])->name('destinations.galleries.destroy');
        Route::get('/social-media/create', [DestinationController::class, 'destinationSocialMediaCreate'])->name('destinations.social-media.create');
        Route::post('/social-media', [DestinationController::class, 'destinationSocialMediaStore'])->name('destinations.social-media.store');
        Route::get('/social-media/{socialMedia}/edit', [DestinationController::class, 'destinationSocialMediaEdit'])->name('destinations.social-media.edit');
        Route::put('/social-media/{socialMedia}', [DestinationController::class, 'destinationSocialMediaUpdate'])->name('destinations.social-media.update');
        Route::delete('/social-media/{socialMedia}', [DestinationController::class, 'destinationSocialMediaDestroy'])->name('destinations.social-media.destroy');
    });
    Route::resource('destinations', DestinationController::class)->except(['edit', 'update']);
    Route::resource('faqs', FaqController::class);



    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';
