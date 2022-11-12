<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeroomTeacherController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OtherDataController;
use App\Http\Controllers\PresentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SkippingClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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



Route::get('/present', [PresentController::class, 'index']);
Route::get('/presentHome', [PresentController::class, 'returnHome']);
//Route::post('/present', [PresentController::class, 'store']);

Route::group(['prefix' => 'admin'], function () {
    //ADMIN AND TEACHER
    Route::middleware('guest:user,teacher')->group(function () {
        Route::get('/login', [LoginController::class, 'login'])->name('login');
        Route::post('/login', [LoginController::class, 'authenticate']);
    });

    Route::middleware(['auth:user,teacher'])->group(function () {
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('/home', [HomeController::class, 'index']);

        Route::get('/changePassword', [LoginController::class, 'changePassword']);
        Route::put('/changePassword', [LoginController::class, 'updatePassword']);

        Route::get('/changePic', [LoginController::class, 'changePic']);
        Route::put('/changePic', [LoginController::class, 'updatePic']);

        Route::resource('/attendances', AttendanceController::class)->only(['index', 'update', 'edit']);
        Route::get('/attendances/rekap', [AttendanceController::class, 'rekapIndex']);
        Route::get('/attendances/rekap/{nisn}', [AttendanceController::class, 'rekapShow']);
        Route::get('/attendances/gradeRekap', [AttendanceController::class, 'rekapGradeIndex']);
        Route::get('/attendances/gradeRekap/{slug}', [AttendanceController::class, 'rekapGradeShow']);

        Route::get('/attendances/export', [AttendanceController::class, 'exportExcel']);

        Route::resource('/skippingClass', SkippingClassController::class)->only(['index', 'create', 'store', 'destroy']);
    });

    //TEACHER
    Route::middleware(['auth:teacher'])->group(function () {
        Route::get('/myschedules', [ScheduleController::class, 'mySchedule']);
    });

    //ADMIN
    Route::middleware(['auth:user'])->group(function () {
        Route::get('/students/export', [StudentController::class, 'exportExcel']);
        Route::get('/teachers/export', [TeacherController::class, 'exportExcel']);

        Route::get('/otherData', [OtherDataController::class, 'index']);
        Route::get('/otherData/{id}/edit', [OtherDataController::class, 'edit']);
        Route::put('/otherData/{id}', [OtherDataController::class, 'update']);

        Route::resource('/grades', GradeController::class)->except('show');

        Route::resource('/teachers', TeacherController::class);

        Route::resource('/subjects', SubjectController::class)->except('show');

        Route::resource('/homeroomTeachers', HomeroomTeacherController::class)->except('show');

        Route::resource('/schedules', ScheduleController::class)->except('show');

        Route::resource('/students', StudentController::class);

        Route::resource('/admins', UserController::class)->except(['show']);
    });
});