<?php

use App\Events\Message;
use App\Http\Controllers\EventController;
use App\Models\Request;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/calendar', function () {
    return view('event');
});

Auth::routes();


Route::post('send_message',function (Request $request){
        event(new Message($request->username,$request->message));
        return [
            'success' =>true,

        ];
});
Route::get('calendar-event', [EventController::class, 'index']);
Route::post('calendar-crud-ajax', [EventController::class, 'calendarEvents']);
