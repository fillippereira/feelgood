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
    return view('welcome');
});

Auth::routes();

//Home ---------------------------------------------------------------------------------------
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/therapist','TherapistController@index')->name('therapist.dashboard');
Route::get('/student','StudentController@index')->name('student.dashboard');


//Register -----------------------------------------------------------------------------------
Route::get('/register/student', function () {
    return view('Auth\register-student');
});

Route::get('/register/pacient', function () {
    return view('Auth\register');

})->name('register/pacient');

Route::get('/register/therapist', function () {
    return view('Auth\register-therapist');
});

//Login ---------------------------------------------------------------------------------------------
Route::get('/student/login','Auth\StudentLoginController@index')->name('student.login');
Route::get('/therapist/login','Auth\TherapistLoginController@index')->name('therapist.login');

//Post Login ----------------------------------------------------------------------------------------
Route::post('/student/login','Auth\StudentLoginController@login')->name('student.login.submit');
Route::post('/therapist/login','Auth\TherapistLoginController@login')->name('therapist.login.submit');


//Cadastro -------------------------------------------------------------------------------------
Route::get('register/student', 'Auth\RegisterStudentController@index')->name('register.student');
Route::get('register/therapist', 'Auth\RegisterTherapistController@index')->name('register.therapist');

//Post Cadastro -------------------------------------------------------------------------------------
Route::post('register/student', 'Auth\RegisterStudentController@register')->name('register.student.submit');
Route::post('register/therapist', 'Auth\RegisterTherapistController@register')->name('register.therapist.submit');


//Humor -------------------------------------------------------------------------------------
Route::get('/humor', 'HumorController@index')->name('humor.index');
Route::get('/humor/remove/{valor}', 'HumorController@destroy');
Route::post('/humor/update/system', 'HumorController@updateSystem');
Route::post('/humor/update', 'HumorController@update');
Route::post('/humor/add', 'HumorController@store')->name('humor.submit');


//Sentimento -------------------------------------------------------------------------------------
Route::get('/feeling', 'FeelingController@index')->name('feeling.index');
Route::get('/feeling/remove/{valor}', 'FeelingController@destroy');
Route::post('/feeling/update/system', 'FeelingController@updateSystem');
Route::post('/feeling/update', 'FeelingController@update');
Route::post('/feeling/add', 'FeelingController@store')->name('feeling.submit');

//Atividade -------------------------------------------------------------------------------------
Route::get('/activity', 'ActivityController@index')->name('activity.index');
Route::get('/activity/remove/{valor}', 'ActivityController@destroy');
Route::post('/activity/update/system', 'ActivityController@updateSystem');
Route::post('/activity/update', 'ActivityController@update');
Route::post('/activity/add', 'ActivityController@store')->name('activity.submit');



//Permissao------------------------------------------------------------------------
Route::post('/permission', 'UserController@autorizaracesso')->name('permission.submit');



//Registro ------------------------------------------------------------------------
Route::post('/create/register', 'RegisterController@store')->name('register.submit');