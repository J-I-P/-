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
    //$record = DB::table('package')->where('STATE',NULL)->get();

    $new = DB::table('package')
        ->join('student', 'package.NAME', '=', 'student.NAME')
        ->select('package.*', 'student.UNIT')
        ->where('STATE',NULL)
        ->get();

    return view('test', ['RECORD' => $new]);
})->name('homepage');

Route::get('history', function(){
    //$record = DB::table('package')->whereNotNull('STATE')->get();

    $new = DB::table('package')
        ->join('student', 'package.NAME', '=', 'student.NAME')
        ->select('package.*', 'student.UNIT')
        ->whereNotNull('STATE')
        ->get();
    return view('history', ['RECORD' => $new]);
});

//Route::get('/test', function(){
//return view('QAQ')->with('aa',"ㄘ大便");
//});

//Route::get('/www', 'testController@ww');

//Route::get('search', 'testController@show');                    //test -> search

Route::get('change', 'testController@update');                  //admin -> insert or update

Route::get('update', 'testController@new');                     //changedata -> update

Route::get('delete', 'testController@delete');

Route::get('adminlogin', function(){
    return view('adminlogin');
})->name('login');

Route::get('adminadd', function(){
    return view('adminadd');
});

Route::get('adminloginpage', 'testController@login')->name('adminpage');

Route::get('adminaddpage', 'testController@enroll');

Route::get('adminlogout', 'testController@logout');

Route::get('mail', 'testController@mail');

Route::get('send', 'testCOntroller@send');

Route::get('ad', function(){
    $record = DB::table('package')->where('STATE', NULL)->get();

    $new = DB::table('package')
        ->join('student', 'package.NAME', '=', 'student.NAME')
        ->select('package.*', 'student.UNIT')
        ->where('STATE', NULL)
        ->get();

    return view('admin', ['RECORD' => $new]);
});

Route::get('download', function() {
    return view('download');
});
