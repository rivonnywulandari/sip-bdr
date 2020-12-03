<?php

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

Route::get('/', function () {
    return [
        'app' => config('app.name'),
        'version' => '1.0.0',
    ];
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//  Authentication
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');
Route::get('user', 'AuthController@getAuthUser');

//Classroom Schedule
Route::apiResource('schedule', 'ClassroomScheduleController'); // for retrieving classroom schedule

// Student Classroom
Route::apiResource('student', 'StudentController');
Route::apiResource('krs', 'KrsController'); //for retrieving student classrooms
Route::apiResource('classroom', 'ClassroomController'); // for retrieving student classroom detail

// Lecturer Classroom
Route::apiResource('lecturer', 'LecturerController');
Route::apiResource('lecturerclassroom','LecturerClassroomController'); // for retrieving lecturer classrooms

// Student Location Submission
Route::apiResource('studentlocation', 'StudentLocationController');
Route::get('studentsubmission/{lecturer}', 'LecturerController@showStudentLocations'); // for retrieving student location submissions

//Student Attendances
Route::apiResource('studentattendance', 'StudentAttendanceController')->except('index');
Route::get('classattendance/{classroom_id}', 'StudentAttendanceController@showStudentAttendances');
Route::get('attendance/{student}', 'StudentController@showAttendances');

// Meeting
Route::apiResource('meeting', 'MeetingController')->except('index');
Route::get('meetings/{classroom}', 'ClassroomController@showMeetings');