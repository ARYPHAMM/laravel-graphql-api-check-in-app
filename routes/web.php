<?php

use Illuminate\Support\Facades\Route;
use App\CheckIn;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

function setSession()
{
    $time_now = strtotime(date('H:i', time()));
    $status = [
       "session" => 'fail',
       "status" => 'fail',
    ];
    if($time_now >= strtotime("12:30") && $time_now <= strtotime   ("13:30")) // afternoon
    {
        $status["session"] = "afternoon";
        $status["status"] = "good";
    }
    if($time_now >= strtotime("13:31") && $time_now <= strtotime   ("15:00")){
        $status["session"] = "afternoon";
        $status["status"] = "late";
    }
    if($time_now >= strtotime("07:30") && $time_now <= strtotime   ("08:10")) // morning
    {
        $status["session"] = "morning";
        $status["status"] = "good";
    }
    if($time_now >= strtotime("08:11") && $time_now <= strtotime("09:30")) 
    {
        $status["session"] = "morning";
        $status["status"] = "late";
    }  
    return $status;
}
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
Route::get('/test', function () {

//    $getDate = DB::select("select * from check_ins where FROM_UNIXTIME(time, '%d/%m/%Y') like :time and user_id = :user_id ", [":time" => date('d/m/Y', time()), ":user_id" =>1]);
//      return   $getDate->user;
});
// Route::get('/', function () {
//     return view('welcome');
// });
