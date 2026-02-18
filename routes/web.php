<?php

use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PriceImportController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Debug route (remove in production)
Route::get('/debug', function () {
    return view('debug');
});

// Frontend
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/{slug}', [CatalogController::class, 'show'])->name('category.show');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

// Feeds
Route::get('/feed/google-shopping.xml', [\App\Http\Controllers\FeedController::class, 'googleShopping'])->name('feed.google');
Route::get('/feed/facebook-catalog.xml', [\App\Http\Controllers\FeedController::class, 'facebookCatalog'])->name('feed.facebook');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'submit'])->name('checkout.submit');
Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

// Payment
Route::post('/payment/monobank/webhook', [PaymentController::class, 'monobankWebhook'])->name('payment.monobank.webhook');
Route::get('/payment/monobank/demo/{payment}', [PaymentController::class, 'monobankDemo'])->name('payment.monobank.demo');
Route::post('/payment/monobank/demo/{payment}/confirm', [PaymentController::class, 'monobankDemoConfirm'])->name('payment.monobank.demo.confirm');

// Admin routes (protected by admin middleware)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // Categories
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [AdminCategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');

    // Brands
    Route::get('/brands', [AdminBrandController::class, 'index'])->name('brands.index');
    Route::get('/brands/create', [AdminBrandController::class, 'create'])->name('brands.create');
    Route::post('/brands', [AdminBrandController::class, 'store'])->name('brands.store');
    Route::get('/brands/{brand}/edit', [AdminBrandController::class, 'edit'])->name('brands.edit');
    Route::put('/brands/{brand}', [AdminBrandController::class, 'update'])->name('brands.update');
    Route::delete('/brands/{brand}', [AdminBrandController::class, 'destroy'])->name('brands.destroy');

    // Attributes
    Route::get('/attributes', [\App\Http\Controllers\Admin\AttributeController::class, 'index'])->name('attributes.index');
    Route::get('/attributes/create', [\App\Http\Controllers\Admin\AttributeController::class, 'create'])->name('attributes.create');
    Route::post('/attributes', [\App\Http\Controllers\Admin\AttributeController::class, 'store'])->name('attributes.store');
    Route::get('/attributes/{attribute}/edit', [\App\Http\Controllers\Admin\AttributeController::class, 'edit'])->name('attributes.edit');
    Route::put('/attributes/{attribute}', [\App\Http\Controllers\Admin\AttributeController::class, 'update'])->name('attributes.update');
    Route::delete('/attributes/{attribute}', [\App\Http\Controllers\Admin\AttributeController::class, 'destroy'])->name('attributes.destroy');

    // Products
    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::get('/products/search', [AdminProductController::class, 'search'])->name('products.search');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');
    Route::post('/products/import', [AdminProductController::class, 'importData'])->name('products.import');

    // Price Import
    Route::get('/import', [PriceImportController::class, 'index'])->name('import.index');
    Route::post('/import', [PriceImportController::class, 'import'])->name('import.process');

    // Leads
    Route::get('/leads', [LeadController::class, 'index'])->name('leads.index');
    Route::get('/leads/{lead}', [LeadController::class, 'show'])->name('leads.show');
    Route::post('/leads/{lead}/status', [LeadController::class, 'updateStatus'])->name('leads.updateStatus');
    Route::post('/leads/{lead}/notes', [LeadController::class, 'updateNotes'])->name('leads.updateNotes');
});

require __DIR__.'/auth.php';
