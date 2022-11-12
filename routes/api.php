<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\PresentController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post("/student/login", [LoginController::class, 'login']);
Route::get("/getAttendances", [PresentController::class, 'getAttendances']);
Route::get("/getAttendances/{grade}", [PresentController::class, 'getAttendancesWithGrade']);
Route::get("/getAttendancesHome", [PresentController::class, 'getAttendancesHome']);
Route::get("/getAttendancesHome/{grade}", [PresentController::class, 'getAttendancesHomeWithGrade']);
Route::get("/getSchedules/{studentId}", [ScheduleController::class, 'getClassSchedules']);

Route::group(['prefix' => 'student', 'middleware' => 'auth:sanctum'], function () {
    Route::get("/me", [LoginController::class, 'profile']);
    Route::get("/myAttendance", [PresentController::class, 'recap']);
    Route::post("/logout", [LoginController::class, 'logout']);
    Route::post("/changePassword", [LoginController::class, 'changePassword']);
    Route::post('/present', [PresentController::class, 'store']);
    Route::get('/myschedules', [ScheduleController::class, 'index']);
});