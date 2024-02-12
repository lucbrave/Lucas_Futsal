<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Goal\GoalController;
use App\Http\Controllers\Team\TeamController;
use App\Http\Controllers\Matche\MatcheController;
use App\Http\Controllers\Player\PlayerController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return 'Enjoy the Silence...';
});

Route::prefix('teams')
    ->name('teams.')
    ->group(function () {
        Route::prefix('v1')
            ->controller('TeamController')
            ->group(function () {
                Route::post('{id}/restore', 'restore')->name('restore');
                Route::resource('', 'TeamController')->except([
                    'create', 'edit',
                ])->parameters([
                    '' => 'id',
                ]);
            });
    });


Route::get('/teams', [TeamController::class, 'index']);
Route::post('/teams', [TeamController::class, 'store']);
Route::put('/teams/{id}', [TeamController::class, 'update']);
Route::get('/teams/{id}', [TeamController::class, 'show']);
Route::delete('/teams/{id}', [TeamController::class, 'delete']);
Route::get('/teams/{id}/points', [TeamController::class, 'points']);
Route::get('/teams/{id}/ranking', [TeamController::class, 'ranking']);


Route::get('/players', [PlayerController::class, 'index']);
Route::post('/players', [PlayerController::class, 'store']);
Route::put('/players/{id}', [PlayerController::class, 'update']);
Route::get('/players/{id}', [PlayerController::class, 'show']);
Route::delete('/players/{id}', [PlayerController::class, 'delete']);

Route::get('/matches', [MatcheController::class, 'index']);
Route::post('/matches', [MatcheController::class, 'store']);
Route::put('/matches/{id}', [MatcheController::class, 'update']);
Route::get('/matches/{id}', [MatcheController::class, 'show']);
Route::delete('/matches/{id}', [MatcheController::class, 'delete']);



Route::get('/ranking', [TeamController::class, 'index']);
Route::post('/ranking', [TeamController::class, 'store']);
Route::put('/ranking/{id}', [TeamController::class, 'update']);
Route::get('/ranking/{id}', [TeamController::class, 'show']);
Route::delete('/ranking/{id}', [TeamController::class, 'delete']);


Route::post('/goal', [GoalController::class, 'store']);
Route::get('/goal', [GoalController::class, 'index']);
