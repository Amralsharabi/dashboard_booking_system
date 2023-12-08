<?php

use App\Mail\TestMaile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\ProvincesController;
use App\Http\Controllers\CommonDataController;
use App\Http\Controllers\AutoCompletController;
use App\Http\Controllers\BirthRestrictionController;
use App\Http\Controllers\CardDamagedRenewalController;
use App\Http\Controllers\DirectorateController;
use App\Http\Controllers\NewRequestsController;
use App\Http\Controllers\RequestsCardsController;
use App\Http\Controllers\CommonDataCardController;
use App\Http\Controllers\FamilyCardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RequestsCancelController;
use App\Http\Controllers\RequestsTimeOkController;
use App\Http\Controllers\NewRequestsCardsController;
use App\Http\Controllers\RequestsChangeDataController;
use App\Http\Controllers\ReqChangeDataCommonController;
use App\Http\Controllers\RequestsRestrictionsController;
use App\Http\Controllers\NewRequestsRestrictionsController;
use App\Http\Controllers\ReqTimeOkController;
use App\Http\Controllers\TimeAttendeesFamilyCardController;
use App\Http\Controllers\TimeAttendeesCardPersonaController;
use App\Http\Controllers\RequestsChangeTimeAttendanceController;

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
//     return view ('home');
// })->middleware('auth');

Auth::routes(['register' => false ]);
// Route::get('/', function () {
//     return view ('home');
// })->middleware('auth');

Route::resource('/', HomeController::class)->middleware('auth');
Route::resource('/home', HomeController::class)->middleware('auth');
Route::resource('/provinces', ProvincesController::class)->middleware('auth');
Route::resource('/center', CenterController::class)->middleware('auth');
Route::resource('/directorate', DirectorateController::class)->middleware('auth');
Route::resource('/requests/change/time/attendance', RequestsChangeTimeAttendanceController::class)->middleware('auth');
Route::resource('/requests/change/data', RequestsChangeDataController::class)->middleware('auth');
Route::resource('/requests/requests/cancel', RequestsCancelController::class)->middleware('auth');
Route::resource('/requests/requests/time/ok', RequestsTimeOkController::class)->middleware('auth');
Route::resource('/requests/cards', RequestsCardsController::class)->middleware('auth');
Route::resource('/requests/restrictions', RequestsRestrictionsController::class)->middleware('auth');
Route::resource('newRequestsCards', NewRequestsCardsController::class)->middleware('auth');
Route::resource('/newRequestsRestrictions', NewRequestsRestrictionsController::class)->middleware('auth');
Route::resource('/req/change/data/common', ReqChangeDataCommonController::class)->middleware('auth');
Route::resource('commondata', CommonDataController::class)->middleware('auth');
Route::resource('/posts', PostController::class)->middleware('auth');
Route::resource('/CardDamagedRenewal', CardDamagedRenewalController::class)->middleware('auth');
Route::resource('/FamilyCard', FamilyCardController::class)->middleware('auth');
Route::resource('/BirthRestriction', BirthRestrictionController::class)->middleware('auth');
// Route::resource('/CardPersonaNew', CardPersonaNew::class)->middleware('auth');
Route::get('/autocomplete/names', [AutoCompletController::class, 'getNames'])->name('autocomplete.names');
Route::get('/autocomplete/userdata', [AutoCompletController::class, 'getUserData'])->name('autocomplete.userdata');
Route::post('/FamilyCardshow/{id}', [App\Http\Controllers\FamilyCardController::class, 'show'])
->name('FamilyCardshow')->middleware(['auth']);

Route::post('/show_card_pers/{id}', [App\Http\Controllers\CardPersonaNewController::class, 'show'])
->name('show.card.pers')->middleware(['auth']);

Route::post('/LogMarriage/{id}', [App\Http\Controllers\LogMarriageController::class, 'show'])
->name('LogMarriage')->middleware(['auth']);

Route::post('/BirthRestriction/{id}', [App\Http\Controllers\BirthRestrictionController::class, 'show'])
->name('BirthRestriction')->middleware(['auth']);

Route::post('/LogDivorce/{id}', [App\Http\Controllers\LogDivorceController::class, 'show'])
->name('LogDivorce')->middleware(['auth']);

Route::post('/DeathStatement/{id}', [App\Http\Controllers\DeathStatementController::class, 'show'])
->name('DeathStatement')->middleware(['auth']);

// الدول والمحافظات والمراكز
Route::resource('Location', LocationController::class);
Route::post('getGovernoratesByCountry', [App\Http\Controllers\LocationController::class, 'getGovernoratesByCountry'])->name('getGovernoratesByCountry');
Route::post('getDirectoratesByGovernorate', [App\Http\Controllers\LocationController::class, 'getDirectoratesByGovernorate'])->name('getDirectoratesByGovernorate');
Route::post('getCentersByDirectorate', [App\Http\Controllers\LocationController::class, 'getCentersByDirectorate'])->name('getCentersByDirectorate');
Route::post('getDirectoratesByProvinceAccom', [App\Http\Controllers\LocationController::class, 'getDirectoratesByProvinceAccom'])->name('getDirectoratesByProvinceAccom');
Route::post('getProvincesByCountryBirth', [App\Http\Controllers\LocationController::class, 'getProvincesByCountryBirth'])->name('getProvincesByCountryBirth');
Route::post('getDirectoratesByProvinceBirth', [App\Http\Controllers\LocationController::class, 'getDirectoratesByProvinceBirth'])->name('getDirectoratesByProvinceBirth');
Route::post('getDirectoratesByGovernorateVersion', [App\Http\Controllers\LocationController::class, 'getDirectoratesByGovernorateVersion'])
->name('getDirectoratesByGovernorateVersion');

Route::post('getCentersByDirectorateVersion', [App\Http\Controllers\LocationController::class, 'getCentersByDirectorateVersion'])
->name('getCentersByDirectorateVersion');
Route::get('indexprovince', [App\Http\Controllers\LocationController::class, 'indexprovince'])->name('indexprovince');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

// Route::get('/send', function(){
//     Mail::to('amralsharabi085@gmail.com')->send(new TestMaile);
//     return response('تم الارسال');
// });

Route::get('/{page}', 'App\Http\Controllers\AdminController@index')->middleware('auth');
