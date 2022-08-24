<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Problem_RequestController;
use App\Http\Controllers\StudentController;
use App\Models\Problem_request;
use App\Models\Teacher;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// admin
Route::post('adminregister', [App\Http\Controllers\AdminController::class,'adminregister'])->name('adminregister');
Route::post('adminlog', [App\Http\Controllers\AdminController::class,'adminlog'])->name('adminlog');
Route::view('adminlog','Admin/login')->name('adminlog');
Route::group(['middleware' => 'admin:admin-api'], function () {
    // Route::post('adminlogout', 'AdminController@adminlogout')->name('adminlogout');
    // Route::post('me', 'AdminController@me')->name('me');
    Route::post('adminlogout', [App\Http\Controllers\AdminController::class,'adminlogout'])->name('adminlogout');
    Route::post('admin', [App\Http\Controllers\AdminController::class,'admin'])->name('admin');

});



// Teacher
Route::post('teacherregister', [App\Http\Controllers\TeacherController::class,'teacherregister'])->name('teacherregister');
Route::post('teacherlog', [App\Http\Controllers\TeacherController::class,'teacherlog'])->name('teacherlog');
Route::view('teacherlog','Teacher/login')->name('teacherlog');

Route::group(['middleware' => 'teacher:teacher-api'], function () {
    Route::post('teacherlogout', [App\Http\Controllers\TeacherController::class,'teacherlogout'])->name('teacherlogout');
    Route::post('teacher', [App\Http\Controllers\TeacherController::class,'teacher'])->name('teacher');

    Route::get('allproblems', [App\Http\Controllers\TeacherController::class,'available_problem']);
    // Route::get('changeStatus/{id}', [App\Http\Controllers\TeacherController::class,'changeStatus']);
    Route::put('changeStatus/{id}', [App\Http\Controllers\TeacherController::class,'update']);


});



// Student
Route::post('studentregister', [App\Http\Controllers\StudentController::class,'studentregister'])->name('studentregister');
Route::post('studentlog', [App\Http\Controllers\StudentController::class,'studentlog'])->name('studentlog');
Route::view('studentlog','Admin/login')->name('studentlog');

Route::group(['middleware' => 'student:student-api'], function () {
    Route::post('studentlogout', [App\Http\Controllers\StudentController::class,'studentlogout'])->name('studentlogout');
    Route::post('student', [App\Http\Controllers\StudentController::class,'student'])->name('student');
    // Route::post('problemcreate', [App\Http\Controllers\Problem_RequestController::class,'store']);
    Route::resource('/problems', Problem_RequestController::class);

});
