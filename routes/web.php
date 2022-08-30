<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeroomTeacherController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OtherDataController;
use App\Http\Controllers\PresentController;
use App\Http\Controllers\ScheduleController;
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

Route::get('/admin/login', [LoginController::class, 'login'])->name('login')->middleware('guest:user,teacher');
Route::post('/admin/login', [LoginController::class, 'authenticate'])->middleware('guest:user,teacher');

Route::get('/present', [PresentController::class, 'index']);
//Route::post('/present', [PresentController::class, 'store']);

Route::middleware(['auth:user,teacher'])->group(function () {
    Route::post('/admin/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/admin/home', [HomeController::class, 'index']);

    Route::get('/admin/changePassword', [LoginController::class, 'changePassword']);
    Route::put('/admin/changePassword', [LoginController::class, 'updatePassword']);

    Route::get('/admin/changePic', [LoginController::class, 'changePic']);
    Route::put('/admin/changePic', [LoginController::class, 'updatePic']);

    Route::resource('/admin/attendances', AttendanceController::class)->only(['index', 'update', 'edit']);
    Route::get('/admin/attendances/rekap', [AttendanceController::class, 'rekapIndex']);
    Route::get('/admin/attendances/rekap/{nisn}', [AttendanceController::class, 'rekapShow']);
    Route::get('/admin/attendances/gradeRekap', [AttendanceController::class, 'rekapGradeIndex']);
    Route::get('/admin/attendances/gradeRekap/{slug}', [AttendanceController::class, 'rekapGradeShow']);

    Route::get('/admin/attendances/export', [AttendanceController::class, 'exportExcel']);
});


Route::middleware(['auth:teacher'])->group(function () {
    Route::get('/admin/myschedules', [ScheduleController::class, 'mySchedule']);
});

Route::middleware(['auth:user'])->group(function () {
    Route::get('/admin/students/export', [StudentController::class, 'exportExcel']);
    Route::get('/admin/teachers/export', [TeacherController::class, 'exportExcel']);

    Route::get('/admin/otherData', [OtherDataController::class, 'index']);
    Route::get('/admin/otherData/{id}/edit', [OtherDataController::class, 'edit']);
    Route::put('/admin/otherData/{id}', [OtherDataController::class, 'update']);

    Route::resource('/admin/grades', GradeController::class)->except('show');

    Route::resource('/admin/teachers', TeacherController::class);

    Route::resource('/admin/subjects', SubjectController::class)->except('show');

    Route::resource('/admin/homeroomTeachers', HomeroomTeacherController::class)->except('show');

    Route::resource('/admin/schedules', ScheduleController::class)->except('show');

    Route::resource('/admin/students', StudentController::class);

    Route::resource('/admin/admins', UserController::class)->except(['show']);
});



// Route::fallback(function () {
//     return redirect('/present');
// });