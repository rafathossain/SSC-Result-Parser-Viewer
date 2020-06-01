<?php

use App\Models\EIIN;
use App\Models\Result;
use Illuminate\Http\Request;
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

Route::get('/add/eiin', function () {
    return view('add_eiin');
});

Route::get('/eiin/list', function () {
    $eiin = EIIN::all();
    return view('eiin_list')->with('eiin', $eiin);
});

Route::get('/eiin', function () {
    $eiin = EIIN::all();
    return response()->json(['eiin' => $eiin]);
});

Route::get('/result', function (Request $request) {
    if ($request->has('roll') && $request->has('eiin')) {
        $result = Result::select('*')
            ->where('eiin', $request->input('eiin'))
            ->where('roll', $request->input('roll'))
            ->get();
        return view('result')->with('result', $result);
    } else {
        return redirect('/');
    }
});

Route::post('/add_eiin', 'AppController@add_eiin');
Route::post('/get_result', 'AppController@get_result');

Route::get('/set_result', 'AppController@set_result');

Route::get('/eiin/flag', function (Request $request) {
    $random = time();
    $eiin = $request->input('eiin');
    EIIN::where('eiin', $eiin)->update(['flag' => $random]);
    return response()->json(['error' => false]);
});