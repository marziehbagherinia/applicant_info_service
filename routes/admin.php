<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Operators\StoreOperatorController;
use App\Http\Controllers\Admin\Operators\IndexOperatorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group( [ 'prefix' => 'admin' ], function ()
{
    Route::group( [ 'prefix' => 'operators' ], function ()
    {
        Route::get( '/', IndexOperatorController::class )->name( 'operators.list' );
        Route::post( '/', StoreOperatorController::class );
    } );
} );

