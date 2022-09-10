<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Problem_RequestController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\StudentController;

use App\Models\Problem_request;
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

Route::post('studentregister', [App\Http\Controllers\StudentController::class,'studentregister'])->name('studentregister');
Route::post('teacherregister', [App\Http\Controllers\TeacherController::class,'teacherregister'])->name('teacherregister');
Route::post('login', [App\Http\Controllers\HomeController::class,'login']);
Route::post('logout', [App\Http\Controllers\HomeController::class,'logout']);


Route::post('/comment', [CommentController::class, 'store']);
Route::post('/reply', [CommentController::class, 'replyStore']);



// Route::post('user.register', [App\Http\Controllers\Api\AuthController::class,'register']);
// Route::post('user.login', [App\Http\Controllers\Api\AuthController::class,'login']);



// Teacher
Route::post('teacherregister', [App\Http\Controllers\TeacherController::class,'teacherregister'])->name('teacherregister');
Route::middleware(['auth:teacher-api'])->group(function () {

// Route::group(['middleware' => 'teacher:teacher-api'], function () {
    // Route::post('teacherlogout', [App\Http\Controllers\TeacherController::class,'teacherlogout'])->name('teacherlogout');
    Route::post('teacher', [App\Http\Controllers\TeacherController::class,'teacher'])->name('teacher');
    Route::post('teacherUpdate', [App\Http\Controllers\TeacherController::class,'update'])->name('updateteacher');

    Route::get('allproblems', [App\Http\Controllers\TeacherController::class,'available_problem']);
    Route::get('accepted_problem', [App\Http\Controllers\TeacherController::class,'accepted_problem']);
    // Route::get('changeStatus/{id}', [App\Http\Controllers\TeacherController::class,'changeStatus']);
    Route::put('changeStatus/{id}', [App\Http\Controllers\TeacherController::class,'statusupdate']);
    Route::get('message', [App\Http\Controllers\TeacherController::class,'message']);
    // Route::get('calendaradd/{id}', [App\Http\Controllers\TeacherController::class,'calendaradd']);
    // Route::get('event', [App\Http\Controllers\EventController::class,'index']);
    // Route::post('classtime', [App\Http\Controllers\EventController::class,'calendarEvents']);
    // Route::resource('/message', MessageController::class);
    // Route::get('/tmessage', [App\Http\Controllers\TeacherController::class,'message']);



});





// Student


Route::post('studentregister', [App\Http\Controllers\StudentController::class,'studentregister'])->name('studentregister');

// Route::view('studentlog','Admin/login')->name('studentlog');

Route::middleware(['auth:student-api'])->group(function () {
// Route::group(['middleware' => 'student:student-api'], function () {
    Route::post('studentlogout', [App\Http\Controllers\StudentController::class,'studentlogout'])->name('studentlogout');
    Route::post('student', [App\Http\Controllers\StudentController::class,'student'])->name('student');
    Route::post('studentUpdate', [App\Http\Controllers\StudentController::class,'update'])->name('updatestudent');
   Route::get('requested_problem', [App\Http\Controllers\StudentController::class,'requested_problem']);
   Route::get('requested_group_problem', [App\Http\Controllers\StudentController::class,'requested_group_problem']);
   Route::post('join_class/{id}', [App\Http\Controllers\StudentController::class,'join_class']);


   Route::get('/payment', [StripeController::class, 'handleGet']);
   Route::post('/payment', [StripeController::class, 'post']);

    // Route::post('problemcreate', [App\Http\Controllers\Problem_RequestController::class,'store']);
    Route::resource('/problems', Problem_RequestController::class);
    // Route::resource('/message', MessageController::class);
    // Route::get('/tmessage', [App\Http\Controllers\TeacherController::class,'message']);
    // Route::get('/test', function () {
    //     return 'student';
    // });

});
