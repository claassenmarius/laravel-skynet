<?php

use Claassenmarius\LaravelSkynet\Http\Controllers\QuoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', QuoteController::class)->name('quote');
