<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CountyController;
use App\Http\Controllers\FlatsBailController;
use App\Http\Controllers\OffendedController;
use App\Http\Controllers\OffenderController;
use App\Http\Controllers\OffenseCaseController;
use App\Http\Controllers\OffenseController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\StatementController;
use App\Http\Controllers\StatementFilesController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\SubcountyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WardController;
use App\Http\Controllers\WitnessController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\pages\HomePage;
use App\Http\Controllers\pages\Page2;
use App\Http\Controllers\pages\MiscError;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Main Page Route
//Route::get('/', [HomePage::class, 'index'])->name('pages-home');
Route::get('/page-2', [Page2::class, 'index'])->name('pages-page-2');
// locale
Route::get('lang/{locale}', [LanguageController::class, 'swap']);
// pages
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');

Auth::routes();

Route::redirect('/', 'login');

Route::middleware(['auth','verified'])
  ->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);

    Route::resource('bookings', BookingController::class);
    Route::resource('cases', OffenseCaseController::class);
    Route::resource('counties', CountyController::class);
    Route::resource('flats-bails', FlatsBailController::class);
    Route::resource('offenders', OffenderController::class);
    Route::resource('offended', OffendedController::class);
    Route::resource('witness', WitnessController::class);
    Route::resource('offenses', OffenseController::class);
    Route::resource('officers', OfficerController::class);
    Route::resource('signatures', SignatureController::class);
    Route::resource('statements', StatementController::class);
    Route::get('all-statement-files', [StatementFilesController::class,
      'index'])->name('all-statement-files.index');
    Route::post('all-statement-files', [
      StatementFilesController::class,
      'store',
    ])->name('all-statement-files.store');
    Route::get('all-statement-files/create', [
      StatementFilesController::class,
      'create',
    ])->name('all-statement-files.create');
    Route::get('all-statement-files/{statementFiles}', [
      StatementFilesController::class,
      'show',
    ])->name('all-statement-files.show');
    Route::get('all-statement-files/{statementFiles}/edit', [
      StatementFilesController::class,
      'edit',
    ])->name('all-statement-files.edit');
    Route::put('all-statement-files/{statementFiles}', [
      StatementFilesController::class,
      'update',
    ])->name('all-statement-files.update');
    Route::delete('all-statement-files/{statementFiles}', [
      StatementFilesController::class,
      'destroy',
    ])->name('all-statement-files.destroy');

    Route::resource('stations', StationController::class);
    Route::resource('users', UserController::class);
    Route::resource('subcounties', SubcountyController::class);
    Route::resource('wards', WardController::class);
    Route::get('wards/list/{subounty_id}', [WardController::class,'list'])->name('wards.list');
    Route::get('subcounties/list/{county_id}', [SubcountyController::class,'list'])->name('wards.list');
    Route::prefix('user')->group(function () {
      Route::get('/settings',[UserController::class,'setting'])->name('settings');
      Route::get('/profile', [UserController::class, 'profile'])->name('profile');
      Route::get('user/security', [UserController::class, 'userSecurity'])->name('user.security');
    });
    Route::resource('activity', ActivityController::class);
  });
