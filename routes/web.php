<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/ffmpeg', function(){
	return shell_exec('ffmpeg --version');
	
});
Route::get('/', function () {
	if(Auth::check()){
		return redirect(url('/home'));
	}
    return view('welcome');
});
Route::get('/getdata', function(){
	return App\Client::all();
	
});
Route::auth();
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index');
Route::any('/register/save', 'Auth\AuthController@register_save');
Route::get('/locker', 'UserController@locker');
Route::get('/locker/{pro}', 'UserController@locker')->where('pro', '[0-9]+');
Route::get('/locker/edit', 'UserController@edit');
Route::any('/locker/save', 'UserController@save');

Route::post('/locker/{pro}', 'WatchController@add');
Route::get('/watch/{pro}', 'WatchController@add');

Route::get('/upload', 'UploadController@upload');
Route::post('/sendupload', 'UploadController@upload_sent');
Route::get('/video', 'UploadController@video');
Route::post('/video_uploaded', 'UploadController@video_uploaded');
Route::get('/video_uploaded', 'UploadController@video_uploaded');
Route::get('/video/{vid}', 'UploadController@video_view');

Route::get('/dashboard', 'DashboardController@index');
Route::get('/watchlist', 'DashboardController@watchlist');

Route::get('/hire/pro/{pro}', 'HireController@hire');
Route::any('/hire/{hire}', 'HireController@hire_again')->where('hire', '[0-9]+');
Route::post('/hire/send/{hire}', 'HireController@sendHire');
Route::get('/hire/sent', 'HireController@hireSent');
Route::any('/response/{hire}', 'HireController@response')->where('hire', '[0-9]+');
Route::post('/response/send/{hire}', 'HireController@sendResponse');
Route::get('/response/sent', 'HireController@responseSent');
Route::get('/response/done/{hire}', 'HireController@show');

Route::get('/notifications', 'NotificationsController@index');

Route::get('/rate/{hire}', 'RatingController@rate');
Route::post('/rate/{hire}', 'RatingController@save');
Route::get('/ratingSent', 'RatingController@sent');

Route::get('/testimonial/{user}', 'TestimonialController@write');
Route::post('/testimonial/{user}', 'TestimonialController@save');
Route::get('/testimonialSent', 'TestimonialController@sent');
Route::get('/testimonials/{pro}', 'TestimonialController@view');

Route::get('/choose', 'Auth\AuthController@choose');
Route::get('/apply', 'Auth\AuthController@apply');
Route::post('/apply', 'Auth\AuthController@applySent');

Route::get('/admin', 'AdminController@approve_pros');
Route::get('/approve/{pro}', 'AdminController@approve');
Route::get('/deny/{pro}', 'AdminController@deny');

Route::get('/end/{note}', 'NotificationsController@end');

Route::get('/location', function(){
	return view('users.mylocation');
});

Route::get('/playlist/new', 'UploadController@forward');
Route::get('/playlist/manage/{playlist}', 'UploadController@manage_playlist');
Route::get('/playlist/save/{pro}/{playlist?}', 'UploadController@save_playlist');
Route::get('/playlist/{playlist}', 'UploadController@preview')->where('playlist', '[0-9]+');
Route::get('/playlist/view/{playlist}', 'UploadController@preview');
Route::get('/playlist/pay/{playlist}', 'UploadController@pay');
Route::get('/playlist/delete/{playlist}', 'UploadController@playlist_delete');
//events

Route::any('/event/send/{pro}', 'EventController@send');
Route::any('/event/sent', 'EventController@sent');
Route::get('/event/{event}', 'EventController@view')->where('event', '[0-9]+');
Route::any('/event/confirm/{event}', 'EventController@confirm');
Route::any('/event/alternatives/{event}', 'EventController@alternatives');
Route::any('/event/done/{event}', 'EventController@done');

Route::get('/calendar', 'CalendarController@calendar');
Route::get('/calendar/{pro}/{page?}/{prev?}', 'CalendarController@calendar_other')->where('pro', '[0-9]+')->where('page', '[0-9]+')->where('prev', '[0-9]+');
Route::post('/calendar/{pro}/save', 'EventController@pro_save')->where('pro', '[0-9]+');

Route::any('/event/{event}/confirm', 'EventController@confirm_cal');
Route::any('/event/{event}/deny', 'EventController@deny_cal');
Route::get('/event/change/available', 'EventController@change_available');


Route::any('/event/delete/{event}', 'CalendarController@delete');
Route::post('/calendar/save', 'CalendarController@save');
Route::post('/calendar/lesson', 'CalendarController@lesson');
Route::any('/event/edit/{pro?}/{event?}', 'CalendarController@edit')->where('event', '[0-9]+')->where('pro', '[0-9]+');
Route::any('/event/save/{event?}/{pro?}', 'CalendarController@save')->where('event', '[0-9]+')->where('pro', '[0-9]+');
Route::any('/event/save', 'CalendarController@save');
Route::any('/event/save/{event}', 'CalendarController@save')->where('event', '[0-9]+');
Route::any('/event/save/{event}/{pro}', 'CalendarController@save')->where('event', '[0-9]+')->where('pro', '[0-9]+');
Route::any('/event/repeat/{event}', 'CalendarController@repeat')->where('event', '[0-9]+');
Route::any('/repeating/delete/{rp}', 'CalendarController@delete_repeating')->where('rp', '[0-9]+');

Route::get('/alternative/{event}/confirm', 'EventController@alternative_confirm')->where('event', '[0-9]+');
Route::get('/alternative/{event}/deny', 'EventController@alternative_deny')->where('event', '[0-9]+');



Route::get('/option/edit/{option?}', 'OptionController@edit')->where('option', '[0-9]+');
Route::post('/option/save/{option?}', 'OptionController@save')->where('option', '[0-9]+');
Route::any('/options/{pro}', 'OptionController@view')->where('pro', '[0-9]+');
Route::any('/option/set/{pro}', 'OptionController@set')->where('pro', '[0-9]+');
Route::any('/option/reset/{cart}', 'OptionController@reset')->where('option', '[0-9]+')->where('pro', '[0-9]+');

Route::get('/cart', 'CartController@view');
Route::get('/pay', 'CartController@pay');

Route::get('/academy/{academy}', 'AcademyController@view')->where('academy', '[0-9]+');
Route::get('/academy/new/{academy?}', 'AcademyController@make');
Route::get('/academy/edit/{academy?}', 'AcademyController@make');
Route::post('/academy/save/{academy?}', 'AcademyController@save');
Route::get('/academy/delete/{academy}', 'AcademyController@destroy');

Route::get('/calendar/defaults', 'CalendarController@set_defaults');
Route::post('/calendar/defaults/save', 'CalendarController@save_defaults');


Route::any('/notification/check/{note}', 'NotificationsController@check')->where('note', '[0-9]+');
Route::get('/checkout', 'CartController@checkout');

Route::get('/notification/forward/{note}', 'NotificationsController@forward');

Route::post('/academy/upload/{acad}', 'UploadController@academy');
Route::post('/academy/member/new/{acad}', 'AcademyController@add');
Route::get('/dashboard/academy', 'DashboardController@academy');
