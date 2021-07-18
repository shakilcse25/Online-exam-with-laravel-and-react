<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\ResultController;
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

Route::post( 'register-candidate', [ AuthController::class, 'registerCandidate' ] );
Route::post( 'login-candidate', [ AuthController::class, 'loginCandidate' ] );

Route::get( 'exams', [ ExamController::class, 'index' ] );
Route::get( 'exam/{id}', [ ExamController::class, 'findExam' ] );

Route::middleware('auth:sanctum')->group(function () {
    Route::get( 'user', [ AuthController::class, 'user' ] );
    Route::get( 'exam-details/{id}', [ ExamController::class, 'findExamDetails' ] );
    Route::post( 'store-result-init', [ ResultController::class, 'storeAllResultInit' ] );
    Route::post( 'update-result', [ ResultController::class, 'storeUpdateResult' ] );
    Route::get( 'question-validity/{examId}/{quesId}', [ ResultController::class, 'questionValidity' ] );
    Route::get( 'done-exam/{examId}', [ ResultController::class, 'makeDoneExam' ] );
    Route::get( 'user-exam', [ ResultController::class, 'userExam' ] );
    Route::get( 'user-result/{examId}', [ ResultController::class, 'userResult' ] );
});


