<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParcelController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// START EMAIL AUTOMATION
Route::get('/', [ParcelController::class, 'index']);
Route::post('/sync-parcel', [ParcelController::class, 'sync']);
Route::post('/send-ofd-email', [ParcelController::class, 'sendEmails']);
// END EMAIL AUTOMATION
