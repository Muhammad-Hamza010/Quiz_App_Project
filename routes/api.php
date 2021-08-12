<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizLogController;
use App\Models\QuizLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Admin Controller Actions
// "/admin" (GET) will show all records of Admins table.
// "/admin" (POST) will create a new admin record in DB.
// "/admin/login" will verify admin and will logged him in.

Route::get('/admins', [AdminController::class, 'index']);
Route::post('/admin/signup', [AdminController::class, 'store']);
Route::post('/admin/login', [AdminController::class, 'login']);

// Candidate Controller Actions
// "/candidate" (GET) will show all records of Candidates table.
// "/candidate" (POST) will create a new Candidate record in DB.
Route::get('/candidates', [CandidateController::class, 'index']);
Route::post('/candidate/signup', [CandidateController::class, 'store']);

//To Display Candidate's Record Data In Table From Dashboard Link
Route::get('dashboard/candidates_record', [QuizLogController::class, 'index']);

//To Get Quiz URL For A User
Route::post('/dashboard/generateurl', [CandidateController::class, 'generateurl']);

Route::get('/quiz/instructions', [QuizController::class, 'quizhome'])->name('quiz')->middleware('signed');

