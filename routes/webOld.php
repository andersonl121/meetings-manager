<?php

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
    return view('login');
})->name('login');


Route::post('auth','Login@authenticate');

Route::post('auth','Login@authenticate');

Route::middleware('auth')->group(function(){
    Route::get('logout','Login@logout');

Route::post('signup','Login@cadastro');

Route::post('cpwd','Login@trocarSenha');

Route::post('upFiles','Documents@upFiles');

Route::post('procDoc','Documents@incluirDocumento');

Route::post('cadDoc','Documents@cadastrarDocumento');

Route::post('cadMeeting','Documents@cadastrarReuniao');

Route::post('cadReuniao','Documents@cadReuniao');

Route::post('editDoc','Documents@editDocs');

Route::post('procEditedDocs','Documents@procEditDocs');

Route::post('openFolder','Documents@openFolder');

Route::post('deleteFile','Documents@deleteFolder');


Route::get('cadDocs', function () {
    return view('cadDoc');
});

Route::get('editDocuments', function () {
    return view('editDocs');
});

Route::get('cadMeetings', function () {
    return view('cadMeeting');
});

Route::get('index', function () {
    return view('welcome');
});

Route::get('signup', function () {
    return view('signup');
});

Route::get('documentView', function () {
    return view('documentView');
});

Route::get('createDocument', function () {
    return view('createDoc');
});

Route::get('changePassword', function () {
    return view('changePassword');
});


//DocumentViewer Library
Route::any('ViewerJS/{all?}', function(){
    return View::make('ViewerJS.index');
});
});



