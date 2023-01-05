<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HblController;
use App\Http\Controllers\MrtController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\HealthController;
use App\Http\Controllers\SpringController;
use App\Http\Controllers\BdPhotoController;
use App\Http\Controllers\KeywordController;
use App\Http\Controllers\BdAnimalController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\NbaBingoController;
use App\Http\Controllers\ChristmasController;
use App\Http\Controllers\NewsVoteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
| test
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::group([
    'prefix' => 'health',
    'middleware' => 'api',
], function () {
    Route::post('/', [HealthController::class, 'update']);
});

Route::group([
    'prefix' => 'mrt',
    'middleware' => 'api',
], function () {
    Route::post('/', [MrtController::class, 'store']);
    Route::post('/click', [MrtController::class, 'click']);
});

Route::group([
    'prefix' => 'bd_animals',
], function () {
    Route::get('/', [BdAnimalController::class, 'index']);
    Route::get('/state', [BdAnimalController::class, 'state']);
    Route::post('/login', [BdAnimalController::class, 'login']);
    Route::post('/pets', [BdAnimalController::class, 'storePet']);
    Route::post('/votes', [BdAnimalController::class, 'storeVote']);
});

Route::group([
    'prefix' => 'hbl',
    'middleware' => 'api',
], function () {
    Route::get('/', [HblController::class, 'index']);
    Route::post('/login', [HblController::class, 'login']);
    Route::post('/store', [HblController::class, 'storePredictionTeam']);
});

Route::group([
    'prefix' => 'nbabingo',
    'middleware' => 'api',
], function () {
    Route::post('/login', [NbaBingoController::class, 'login']);
    Route::post('/', [NbaBingoController::class, 'store']);
    Route::get('/', [NbaBingoController::class, 'index']);
    Route::get('/testip', [NbaBingoController::class, 'testip']);
    Route::get('state', [NbaBingoController::class, 'state']);
});

Route::group([
    'prefix' => 'spring',
    'middleware' => 'api',
], function () {
    Route::post('/login', [SpringController::class, 'login']);
    Route::post('/', [SpringController::class, 'store']);
    Route::get('/', [SpringController::class, 'index']);
});

Route::group([
    'prefix' => 'mothersday',
    'middleware' => 'api',
], function () {
    Route::get('/', [ChristmasController::class, 'index']);
    Route::post('access', [ChristmasController::class, 'isAccess']);
    Route::post('award', [ChristmasController::class, 'storeAward']);
    Route::post('me', [ChristmasController::class, 'me']);
});

Route::group([
    'prefix' => 'food',
    'middleware' => 'api',
], function () {
    Route::post('access', [FoodController::class, 'isAccess']);
    Route::post('click', [FoodController::class, 'click']);
    Route::post('store', [FoodController::class, 'store']);
    Route::post('me', [FoodController::class, 'me']);
    Route::post('logout', [FoodController::class, 'logout']);
    Route::post('refresh', [FoodController::class, 'refresh']);
    Route::post('test', [FoodController::class, 'test']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'keywords',
], function () {
    Route::post('/', [KeywordController::class, 'store']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'news',
], function () {
    Route::post('/', [NewsVoteController::class, 'store']);
});

Route::group([
    'prefix' => 'bd_photos',
], function () {
    Route::get('/', [BdPhotoController::class, 'index']);
    Route::get('/state', [BdPhotoController::class, 'state']);
    Route::post('/login', [BdPhotoController::class, 'login']);
    Route::post('/pets', [BdPhotoController::class, 'storePet']);
    Route::post('/votes', [BdPhotoController::class, 'storeVote']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'election',
], function () {
    Route::get('/', [ElectionController::class, 'index']);
    Route::get('/state', [ElectionController::class, 'state']);
    Route::get('/candidates', [ElectionController::class, 'candidates']);
    Route::get('/member/isvoted', [ElectionController::class, 'isVoted']);
    Route::get('/member/votes', [ElectionController::class, 'getVote']);
    Route::post('/member/app', [ElectionController::class, 'app']);
    Route::post('member/click', [ElectionController::class, 'click']);
    Route::post('member/verify', [ElectionController::class, 'verify']);
    Route::post('member/votes', [ElectionController::class, 'storeVote']);
});
