<?php

use App\Http\Controllers\Api\NovaPoshtaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {
    // Nova Poshta API
    Route::get('/novaposhta/cities', [NovaPoshtaController::class, 'searchCities']);
    Route::get('/novaposhta/warehouses', [NovaPoshtaController::class, 'getWarehouses']);
});
