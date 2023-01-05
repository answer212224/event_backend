<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\FaceBookController;
use App\Http\Controllers\Backend\HblController;
use App\Http\Controllers\Backend\MrtController;
use App\Http\Controllers\Backend\SpringController;
use App\Http\Controllers\Backend\BdPhotoController;
use App\Http\Controllers\Backend\KeywordController;
use App\Http\Controllers\Backend\LotteryController;
use App\Http\Controllers\Backend\BdAnimalController;
use App\Http\Controllers\Backend\ElectionController;
use App\Http\Controllers\Backend\NbaBingoController;
use App\Http\Controllers\Backend\NewsVoteController;
use App\Http\Controllers\Backend\ChristmasController;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/test', [TestController::class, 'checkOrder']);

Route::get('/fb', [FaceBookController::class, 'fb']);
Route::get('/callback', [FaceBookController::class, 'callback']);

Route::prefix('food')->group(function () {
    Route::get('/', [FoodController::class, 'index']);
    Route::get('/fb', [FoodController::class, 'fb']);
    Route::get('/callback', [FoodController::class, 'callback']);
});

Route::get('supervisor', function () {
    return view('dashboard');
})->middleware(['auth']);

Route::get('supervisor/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::prefix('supervisor/mothersday')->middleware(['auth'])->group(function () {
    Route::get('/', [ChristmasController::class, 'index'])->name('mothersday.index');
    Route::post('/', [ChristmasController::class, 'export'])->name('mothersday.export');
    Route::delete('/{id}', [ChristmasController::class, 'destroy'])->name('mothersday.delete');
});

Route::prefix('supervisor/hbl')->middleware(['auth'])->group(function () {
    Route::get('/', [HblController::class, 'index'])->name('hbl');
    Route::post('/', [HblController::class, 'update'])->name('hbl.update');
    Route::post('/export', [HblController::class, 'export'])->name('hbl.export');
    Route::get('/show/{member}', [HblController::class, 'show'])->name('hbl.show');
});

Route::prefix('supervisor/nbabingo')->middleware(['auth'])->group(function () {
    Route::get('/', [NbaBingoController::class, 'index'])->name('nbabingo.index');
    Route::post('/', [NbaBingoController::class, 'update'])->name('nbabingo.update');
    Route::post('/export', [NbaBingoController::class, 'export'])->name('nbabingo.export');
    Route::get('/show/{member}', [NbaBingoController::class, 'show'])->name('nbabingo.show');
});


Route::prefix('supervisor/spring')->middleware(['auth'])->group(function () {
    Route::get('/', [SpringController::class, 'index'])->name('spring.index');
    Route::post('/export', [SpringController::class, 'export'])->name('spring.export');
    Route::delete('/{spring}', [SpringController::class, 'destroy'])->name('spring.destroy');
});

Route::prefix('supervisor/pets')->middleware(['auth'])->group(function () {
    Route::get('/', [BdAnimalController::class, 'index'])->name('pets.index');
    Route::get('/posts', [BdAnimalController::class, 'posts'])->name('pets.posts');
    Route::get('/posts/{member}', [BdAnimalController::class, 'show'])->name('pets.show');
    Route::get('/votes/{member}', [BdAnimalController::class, 'votes'])->name('pets.vote');
    Route::post('/export', [BdAnimalController::class, 'export'])->name('pets.export');
});

Route::prefix('supervisor/photos')->middleware(['auth'])->group(function () {
    Route::get('/', [BdPhotoController::class, 'index'])->name('photos.index');
    Route::get('/posts', [BdPhotoController::class, 'posts'])->name('photos.posts');
    Route::get('/posts/{member}', [BdPhotoController::class, 'show'])->name('photos.show');
    Route::get('/votes/{member}', [BdPhotoController::class, 'votes'])->name('photos.vote');
    Route::post('/export', [BdPhotoController::class, 'export'])->name('photos.export');
});

Route::prefix('supervisor/lottery')->middleware(['auth'])->group(function () {
    Route::get('/', [LotteryController::class, 'index'])->name('lottery');
    Route::get('/result', [LotteryController::class, 'result'])->name('lottery.result');
    Route::get('/export', [LotteryController::class, 'export'])->name('lottery.export');
});

Route::prefix('supervisor/election')->middleware(['auth'])->group(function () {
    Route::get('/', [ElectionController::class, 'index'])->name('election.index');
    Route::get('/members', [ElectionController::class, 'members'])->name('election.members');
    Route::get('/candidates', [ElectionController::class, 'candidates'])->name('election.candidates');
    Route::get('/votes/{member}', [ElectionController::class, 'votes'])->name('election.votes');
    Route::get('members/export', [ElectionController::class, 'export'])->name('election.export');
    Route::post('/activity', [ElectionController::class, 'activity'])->name('election.activity');
    Route::get('/member/delete/{member}', [ElectionController::class, 'delete'])->name('election.delete');
    Route::post('/member/update', [ElectionController::class, 'update'])->name('election.update');
});

Route::prefix('supervisor/keywords')->middleware(['auth'])->group(function () {
    Route::get('/', [KeywordController::class, 'index'])->name('keywords.index');
    Route::get('/members', [KeywordController::class, 'members'])->name('keywords.members');
    Route::get('/prizes', [KeywordController::class, 'prizes'])->name('keywords.prizes');
    Route::get('/lottery', [KeywordController::class, 'lottery'])->name('keywords.lottery');
    Route::get('/result', [KeywordController::class, 'result'])->name('keywords.result');
    Route::get('/prizes/delete/{prize}', [KeywordController::class, 'delete'])->name('keywords.prize.delete');
});

Route::prefix('supervisor/news')->middleware(['auth'])->group(function () {
    Route::get('/', [NewsVoteController::class, 'index'])->name('news.index');
    Route::get('/members', [NewsVoteController::class, 'members'])->name('news.members');
    Route::get('/prizes', [NewsVoteController::class, 'prizes'])->name('news.prizes');
    Route::get('/lottery', [NewsVoteController::class, 'lottery'])->name('news.lottery');
    Route::get('/result', [NewsVoteController::class, 'result'])->name('news.result');
    Route::get('/prizes/delete/{prize}', [NewsVoteController::class, 'delete'])->name('news.prize.delete');
});

Route::prefix('supervisor/mrt')->middleware(['auth'])->group(function () {
    Route::get('/', [MrtController::class, 'index'])->name('mrt.index');
    Route::get('/members', [MrtController::class, 'members'])->name('mrt.members');
    Route::get('/records', [MrtController::class, 'records'])->name('mrt.records');
    Route::get('/winners', [MrtController::class, 'winners'])->name('mrt.winners');
    Route::get('/week', [MrtController::class, 'week'])->name('mrt.week');
    Route::post('/week/store', [MrtController::class, 'weekStore'])->name('mrt.week.store');
    Route::post('/month/store', [MrtController::class, 'monthStore'])->name('mrt.month.store');
    Route::post('/everyMonth/store', [MrtController::class, 'everyMonthStore'])->name('mrt.everyMonth.store');
    Route::get('/month', [MrtController::class, 'month'])->name('mrt.month');
    Route::get('/everyMonth', [MrtController::class, 'everyMonth'])->name('mrt.everyMonth');
    Route::post('/members/export', [MrtController::class, 'memberExport'])->name('mrt.memberExport');
    Route::post('/week/export', [MrtController::class, 'weekExport'])->name('mrt.weekExport');
});


require __DIR__ . '/auth.php';
