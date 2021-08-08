<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Artisan;
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

Route::middleware(['guest:web', 'guest:teacher', 'guest:student', 'preventBackHistory'])->name('auth.')->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('login/post', [AuthController::class, 'login_post'])->name('login_post');
});
Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware(['auth:web', 'preventBackHistory'])->name('admin.')->prefix('admin/my/')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    // teacher-route
    Route::get('teacher', [AdminController::class, 'teacher'])->name('teacher');
    Route::get('teacher/list', [TeacherController::class, 'list']);
    Route::post('teacher/store', [TeacherController::class, 'store']);
    Route::get('teacher/edit/{teacher}', [TeacherController::class, 'edit']);
    Route::delete('teacher/delete/{id}', [TeacherController::class, 'delete']);
    // student-route
    Route::get('student', [AdminController::class, 'student'])->name('student');
    // profile-route
    Route::get('profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('profile/save', [AdminController::class, 'storeProfile']);

    // section-route
    Route::get('section', [AdminController::class, 'section'])->name('section');
    Route::get('section/list/{grade_level}', [SectionController::class, 'list']);
    Route::post('section/save', [SectionController::class, 'store']);
    Route::get('section/edit/{section}', [SectionController::class, 'edit']);
    Route::delete('section/delete/{id}', [SectionController::class, 'destroy']);
    Route::post('section/check-section', [SectionController::class, 'checkSection']);

    // subject-route
    Route::get('subject', [AdminController::class, 'subject'])->name('subject');
    Route::get('subject/list/{grade_level}', [SubjectController::class, 'list']);
    Route::post('subject/save', [SubjectController::class, 'store']);
    Route::get('subject/edit/{subject}', [SubjectController::class, 'edit']);
    Route::delete('subject/delete/{subject}', [SubjectController::class, 'destroy']);
    Route::get('subject/check/{subject_code}/{grade_level}', [SubjectController::class, 'checkSubject']);

    // schedule
    Route::get('schedule', [AdminController::class, 'schedule'])->name('schedule');
    Route::get('search/type/{type}', [ScheduleController::class, 'searchType']);
    Route::get('search/byGradeLevel/{grade_level}', [ScheduleController::class, 'searchByGradeLevel']);
    Route::post('schedule/save', [ScheduleController::class, 'store']);
    Route::get('schedule/list/{type}/{value}', [ScheduleController::class, 'list']);

    // academic-year route
    Route::get('academic-year', [AdminController::class, 'academicYear'])->name('academicYear');
    Route::post('academic-year/save', [AdminController::class, 'storeAY']);
    Route::get('academic-year/list', [AdminController::class, 'listAY']);
    Route::post('academic-year/change/{id}', [AdminController::class, 'changeAY']);
    Route::delete('academic-year/delete/{id}', [AdminController::class, 'deleteAY']);
    Route::get('academic-year/edit/{schoolYear}', [AdminController::class, 'editAY']);
});

Route::middleware(['auth:teacher', 'preventBackHistory'])->name('teacher.')->prefix('teacher/my/')->group(function () {
    Route::get('dashboard', [TeacherController::class, 'dashboard'])->name('dashboard');
});

Route::middleware(['auth:student', 'preventBackHistory'])->name('student.')->prefix('student/my/')->group(function () {
    Route::get('dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
});



Route::get('/clear', function () { //-> tawagin mo to url sa browser -> 127.0.0.1:8000/clear
    Artisan::call('view:clear'); //   -> Clear all compiled files
    Artisan::call('route:clear'); //  -> Remove the route cache file 
    Artisan::call('optimize:clear'); //-> Remove the cache bootstrap files
    Artisan::call('event:clear'); //   -> clear all cache events and listener
    Artisan::call('config:clear'); //  -> Remove the configuration cache file
    Artisan::call('cache:clear'); //   -> Flush the application cache
    return back();
});
