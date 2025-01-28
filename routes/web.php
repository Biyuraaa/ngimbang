<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UmkmController;
use App\Models\Gallery;

Route::controller(PageController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/informasi-desa', 'informasiDesa')->name('informasi-desa');
    Route::get('/sejarah-desa', 'sejarahDesa')->name('sejarah-desa');
    Route::get('/visi-misi', 'visiMisi')->name('visi-misi');
    Route::get('/sejarah-dusun', 'sejarahDusun')->name('sejarah-dusun');

    // Informasi Routes
    Route::prefix('')->group(function () {
        Route::get('/blog', 'indexBlog')->name('blog');
        Route::get('/blog/{slug}', 'showBlog')->name('blog.show');
        Route::get('/event', 'indexEvent')->name('event');
        Route::get('/event/{slug}', 'showEvent')->name('event.show');
        Route::get('/faqs', 'faqs')->name('faqs');
    });

    Route::prefix('')->group(function () {
        Route::get('/wisata', 'indexDestination')->name('wisata');
        Route::get('/wisata/{slug}', 'showDestination')->name('wisata.show');
        Route::get('/umkm', 'indexUmkm')->name('umkm');
        Route::get('/umkm/{slug}', 'showUmkm')->name('umkm.show');
        Route::get('/umkm/{umkmSlug}/{productSlug}', 'showProduct')->name('umkm.product.show');
    });

    Route::get('/galeri', 'indexGallery')->name('galeri');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('blogs', BlogController::class);
    Route::resource('events', EventController::class);
    Route::resource('umkms', UmkmController::class);

    Route::prefix('umkms')->group(function () {
        Route::get('{umkm}/products/create', [UmkmController::class, 'createProduct'])
            ->name('umkms.products.create');
        Route::post('{umkm}/products', [UmkmController::class, 'storeProduct'])
            ->name('umkms.products.store');
        Route::get('{umkm}/products/{product}', [UmkmController::class, 'showProduct'])
            ->name('umkms.products.show');
        Route::get('{umkm}/products/{product}/edit', [UmkmController::class, 'editProduct'])
            ->name('umkms.products.edit');
        Route::put('{umkm}/products/{product}', [UmkmController::class, 'updateProduct'])
            ->name('umkms.products.update');
        Route::delete('{umkm}/products/{product}', [UmkmController::class, 'destroyProduct'])
            ->name('umkms.products.destroy');
        Route::get('{umkm}/products/{product}/socialMedia/create', [UmkmController::class, 'createProductSocialMedia'])
            ->name('umkms.products.socialMedia.create');
        Route::post('{umkm}/products/{product}/socialMedia', [UmkmController::class, 'storeProductSocialMedia'])
            ->name('umkms.products.socialMedia.store');
        Route::get('{umkm}/products/{product}/socialMedia/{modelSocialMedia}/edit', [UmkmController::class, 'editProductSocialMedia'])
            ->name('umkms.products.socialMedia.edit');
        Route::put('{umkm}/products/{product}/socialMedia/{modelSocialMedia}', [UmkmController::class, 'updateProductSocialMedia'])
            ->name('umkms.products.socialMedia.update');
        Route::delete('{umkm}/products/{product}/socialMedia/{modelSocialMedia}', [UmkmController::class, 'destroyProductSocialMedia'])
            ->name('umkms.products.socialMedia.destroy');
        Route::get('{umkm}/socialMedia/create', [UmkmController::class, 'createSocialMedia'])
            ->name('umkms.socialMedia.create');
        Route::post('{umkm}/socialMedia', [UmkmController::class, 'storeSocialMedia'])
            ->name('umkms.socialMedia.store');
        Route::get('{umkm}/socialMedia/{modelSocialMedia}/edit', [UmkmController::class, 'editSocialMedia'])
            ->name('umkms.socialMedia.edit');
        Route::put('{umkm}/socialMedia/{modelSocialMedia}', [UmkmController::class, 'updateSocialMedia'])
            ->name('umkms.socialMedia.update');
        Route::delete('{umkm}/socialMedia/{modelSocialMedia}', [UmkmController::class, 'destroySocialMedia'])
            ->name('umkms.socialMedia.destroy');
    });

    Route::prefix('destinations')->group(function () {
        Route::get('{destination}/prices/create', [DestinationController::class, 'destinationPriceCreate'])->name('destinations.prices.create');
        Route::post('{destination}/prices', [DestinationController::class, 'destinationPriceStore'])->name('destinations.prices.store');
        Route::get('{destination}/prices/{destinationPriceRule}/edit', [DestinationController::class, 'destinationPriceEdit'])->name('destinations.prices.edit');
        Route::put('{destination}/prices/{destinationPriceRule}', [DestinationController::class, 'destinationPriceUpdate'])->name('destinations.prices.update');
        Route::delete('{destination}/prices/{destinationPriceRule}', [DestinationController::class, 'destinationPriceDestroy'])->name('destinations.prices.destroy');
        Route::get('{destination}/attractions/create', [DestinationController::class, 'destinationAttractionCreate'])->name('destinations.attractions.create');
        Route::post('{destination}/attractions', [DestinationController::class, 'destinationAttractionStore'])->name('destinations.attractions.store');
        Route::get('{destination}/attractions/{attraction}/edit', [DestinationController::class, 'destinationAttractionEdit'])->name('destinations.attractions.edit');
        Route::put('{destination}/attractions/{attraction}', [DestinationController::class, 'destinationAttractionUpdate'])->name('destinations.attractions.update');
        Route::delete('{destination}/attractions/{attraction}', [DestinationController::class, 'destinationAttractionDestroy'])->name('destinations.attractions.destroy');
        Route::get('{destination}/facilities/create', [DestinationController::class, 'destinationFacilityCreate'])->name('destinations.facilities.create');
        Route::post('{destination}/facilities', [DestinationController::class, 'destinationFacilityStore'])->name('destinations.facilities.store');
        Route::get('{destination}/facilities/{facility}/edit', [DestinationController::class, 'destinationFacilityEdit'])->name('destinations.facilities.edit');
        Route::put('{destination}/facilities/{facility}', [DestinationController::class, 'destinationFacilityUpdate'])->name('destinations.facilities.update');
        Route::delete('{destination}/facilities/{facility}', [DestinationController::class, 'destinationFacilityDestroy'])->name('destinations.facilities.destroy');
        Route::get('{destination}/social-media/create', [DestinationController::class, 'destinationSocialMediaCreate'])->name('destinations.social-media.create');
        Route::post('{destination}/social-media', [DestinationController::class, 'destinationSocialMediaStore'])->name('destinations.social-media.store');
        Route::get('{destination}/social-media/{socialMedia}/edit', [DestinationController::class, 'destinationSocialMediaEdit'])->name('destinations.social-media.edit');
        Route::put('{destination}/social-media/{socialMedia}', [DestinationController::class, 'destinationSocialMediaUpdate'])->name('destinations.social-media.update');
        Route::delete('{destination}/social-media/{socialMedia}', [DestinationController::class, 'destinationSocialMediaDestroy'])->name('destinations.social-media.destroy');
    });
    Route::resource('destinations', DestinationController::class);
    Route::resource('galleries', GalleryController::class);
    Route::resource('faqs', FaqController::class);
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
