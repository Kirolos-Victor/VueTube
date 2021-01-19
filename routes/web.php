<?php

use App\Http\Controllers\Web\CommentController;
use App\Http\Controllers\Web\UploadVideoController;
use App\Http\Controllers\Web\VideoController;
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



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');
Route::get('/titles', 'HomeController@search');


Route::group(['namespace'=>'Web'],function (){
    Route::resource('channel','ChannelController');
   Route::get('channel/{channel}/count','ChannelController@count');
    Route::resource('channel/{channel}/subscribe','SubscribeController')->only(['store','destroy']);
    Route::get('upload',[UploadVideoController::class,'index'])->name('upload.index');
    Route::post('upload',[UploadVideoController::class,'store'])->name('upload.index');
    Route::get('videos/{video}',[VideoController::class,'show'])->name('videos');
    Route::put('videos/{video}',[VideoController::class,'updateViews'])->name('video.increment.views');
    Route::get('comments/{video}',[CommentController::class,'index']);
    Route::post('comments/{video}',[CommentController::class,'store']);

});
