<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


use App\Http\Controllers\Api\OffendedController;
use App\Http\Controllers\Api\WitnessController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WardController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CountyController;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\OffenseController;
use App\Http\Controllers\Api\OfficerController;
use App\Http\Controllers\Api\StationController;
use App\Http\Controllers\Api\OffenderController;
use App\Http\Controllers\Api\FlatsBailController;
use App\Http\Controllers\Api\SignatureController;
use App\Http\Controllers\Api\StatementController;
use App\Http\Controllers\Api\SubcountyController;
use App\Http\Controllers\Api\OffenseCaseController;
use App\Http\Controllers\Api\WardStationsController;
use App\Http\Controllers\Api\WardOffendersController;
use App\Http\Controllers\Api\RegionStationsController;
use App\Http\Controllers\Api\StatementFilesController;
use App\Http\Controllers\Api\SubcountyWardsController;
use App\Http\Controllers\Api\CountyOffendersController;
use App\Http\Controllers\Api\OfficerBookingsController;
use App\Http\Controllers\Api\OfficerStationsController;
use App\Http\Controllers\Api\CountySubcountiesController;
use App\Http\Controllers\Api\OfficerStatementsController;
use App\Http\Controllers\Api\SubcountyStationsController;
use App\Http\Controllers\Api\SubcountyOffendersController;
use App\Http\Controllers\Api\OffenseCaseOffensesController;
use App\Http\Controllers\Api\StatementAllStatementFilesController;

Route::post('/login', [AuthController::class, 'login'])->name('api.login');
Route::post('verify/otp/{number}/{otp}', [AuthController::class, 'verifyOTP']);
Route::middleware(['auth:sanctum','checkUserStatus'])
  ->get('/user', function (Request $request) {
    return $request->user();
  })
  ->name('api.user');

Route::middleware(['auth:sanctum', 'checkUserStatus'])
  ->group(function () {
    Route::post('/reset-password', 'AuthController@updatePassword');
    Route::post('verify/otp/{otp}', [AuthController::class, 'verifyOTP1']);
    Route::apiResource('bookings', BookingController::class);

    Route::apiResource('cases', OffenseCaseController::class);

    // OffenseCase Offenses
    Route::get('/offense-cases/{offenseCase}/offenses', [
      OffenseCaseOffensesController::class,
      'index'])->name('offense-cases.offenses.index');
    Route::post('/offense-cases/{offenseCase}/offenses', [
      OffenseCaseOffensesController::class,
      'store',
    ])->name('offense-cases.offenses.store');

    Route::apiResource('counties', CountyController::class);

    // County Subcounties
    Route::get('/counties/{county}/subcounties', [
      CountySubcountiesController::class,
      'index',
    ])->name('counties.subcounties.index');
    Route::post('/counties/{county}/subcounties', [
      CountySubcountiesController::class,
      'store',
    ])->name('counties.subcounties.store');

    // County Offenders
    Route::get('/counties/{county}/offenders', [
      CountyOffendersController::class,
      'index',
    ])->name('counties.offenders.index');
    Route::post('/counties/{county}/offenders', [
      CountyOffendersController::class,
      'store',
    ])->name('counties.offenders.store');

    Route::apiResource('flats-bails', FlatsBailController::class);

    Route::apiResource('offenders', OffenderController::class);
    Route::get('all/offenders', [OffenderController::class, 'all']);
    Route::get('search/offenders', [OffenderController::class, 'search']);
    Route::apiResource('offended', OffendedController::class);
    Route::get('all/offended', [OffendedController::class, 'all']);
    Route::apiResource('witness', WitnessController::class);
    Route::get('all/witness', [WitnessController::class, 'all']);

    Route::apiResource('offenses', OffenseController::class);

    Route::apiResource('officers', OfficerController::class);

    // Officer Bookings
    Route::get('/officers/{officer}/bookings', [
      OfficerBookingsController::class,
      'index',
    ])->name('officers.bookings.index');
    Route::post('/officers/{officer}/bookings', [
      OfficerBookingsController::class,
      'store',
    ])->name('officers.bookings.store');

    // Officer Statements
    Route::get('/officers/{officer}/statements', [
      OfficerStatementsController::class,
      'index',
    ])->name('officers.statements.index');
    Route::post('/officers/{officer}/statements', [
      OfficerStatementsController::class,
      'store',
    ])->name('officers.statements.store');

    // Officer Stations
    Route::get('/officers/{officer}/stations', [
      OfficerStationsController::class,
      'index',
    ])->name('officers.stations.index');
    Route::post('/officers/{officer}/stations', [
      OfficerStationsController::class,
      'store',
    ])->name('officers.stations.store');

    Route::apiResource('regions', RegionController::class);

    // Region Stations
    Route::get('/regions/{region}/stations', [
      RegionStationsController::class,
      'index',
    ])->name('regions.stations.index');
    Route::post('/regions/{region}/stations', [
      RegionStationsController::class,
      'store',
    ])->name('regions.stations.store');

    Route::apiResource('signatures', SignatureController::class);

    Route::apiResource('statements', StatementController::class);

    // Statement All Statement Files
    Route::get('/statements/{statement}/all-statement-files', [
      StatementAllStatementFilesController::class,
      'index',
    ])->name('statements.all-statement-files.index');
    Route::post('/statements/{statement}/all-statement-files', [
      StatementAllStatementFilesController::class,
      'store',
    ])->name('statements.all-statement-files.store');

    Route::apiResource(
      'all-statement-files',
      StatementFilesController::class
    );

    Route::apiResource('stations', StationController::class);

    Route::apiResource('users', UserController::class);

    Route::apiResource('subcounties', SubcountyController::class);
    Route::apiResource('countries', CountryController::class);

    // Subcounty Wards
    Route::get('/subcounties/{subcounty}/wards', [
      SubcountyWardsController::class,
      'index',
    ])->name('subcounties.wards.index');
    Route::post('/subcounties/{subcounty}/wards', [
      SubcountyWardsController::class,
      'store',
    ])->name('subcounties.wards.store');

    // Subcounty Offenders
    Route::get('/subcounties/{subcounty}/offenders', [
      SubcountyOffendersController::class,
      'index',
    ])->name('subcounties.offenders.index');
    Route::post('/subcounties/{subcounty}/offenders', [
      SubcountyOffendersController::class,
      'store',
    ])->name('subcounties.offenders.store');

    // Subcounty Stations
    Route::get('/subcounties/{subcounty}/stations', [
      SubcountyStationsController::class,
      'index',
    ])->name('subcounties.stations.index');
    Route::post('/subcounties/{subcounty}/stations', [
      SubcountyStationsController::class,
      'store',
    ])->name('subcounties.stations.store');

    Route::apiResource('wards', WardController::class);

    // Ward Offenders
    Route::get('/wards/{ward}/offenders', [
      WardOffendersController::class,
      'index',
    ])->name('wards.offenders.index');
    Route::post('/wards/{ward}/offenders', [
      WardOffendersController::class,
      'store',
    ])->name('wards.offenders.store');

    // Ward Stations
    Route::get('/wards/{ward}/stations', [
      WardStationsController::class,
      'index',
    ])->name('wards.stations.index');
    Route::post('/wards/{ward}/stations', [
      WardStationsController::class,
      'store',
    ])->name('wards.stations.store');
  });
