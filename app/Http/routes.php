<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Jobs\ConvertVideo;


Route::get('/mail','MailController@mail');
Route::any('/schedule','CronController@cron');
Route::get('/diff/{e}','CronController@diff');

// Route::get('/loginas/{user}', function($user){
// Auth::loginUsingId((int)$user);
// return redirect('/locker');
// });


// Route::get('/test', 'UploadController@test');
// Route::get('/trigger', 'NotificationsController@trigger');
// Route::any('/worker', function(Request $r){
// });

// Route::any('/q', function(){
// });



Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/welcome', 'HomeController@welcome');
Route::get('/', function () {
	if(Auth::check()){
		return redirect(url('/locker'));
	}
    return view('home.welcome.welcome');
});

Route::auth();
Route::get('/home', 'HomeController@index');
Route::any('/register/save', 'Auth\RegisterController@register_save');
Route::get('/pro/signup/{user}', 'Auth\RegisterController@prosignup');


Route::get('/apply', 'Auth\RegisterController@apply');
Route::post('/apply', 'Auth\RegisterController@applySent');
Route::any('/ajaxcheck', 'Auth\RegisterController@is_valid');


Route::get('/about', 'HomeController@about');
Route::get('/how', 'HomeController@how');
Route::post('/demo', 'HomeController@demo');
Route::get('/demo', 'HomeController@demorequested');
Route::get('/video/send/{client}','VimeoController@send_video');
Route::any('/video/recieve/{vid}','VimeoController@receive_video');
Route::any('/video_processed','VimeoController@video_processed');
Route::any('/next', 'UserController@next');
Route::group(['middleware' => ['checklogin']], function () {
/////////////////////////////this requires log in//////////////////////////

Route::get('/locker', 'UserController@locker');
Route::get('/locker/{pro}', 'UserController@locker')->where('pro', '[0-9]+');
Route::get('/locker/edit', 'UserController@edit');
Route::any('/locker/save', 'UserController@save');

Route::post('/locker/{pro}', 'WatchController@add');
Route::get('/watch/{pro}', 'WatchController@add');

Route::get('/upload', 'UploadController@upload');
Route::post('/sendupload', 'UploadController@upload_sent');
Route::get('/video', 'UploadController@video');
Route::any('/video_uploaded', 'UploadController@video_uploaded');
Route::get('/video/{vid}', 'VimeoController@view');

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
Route::any('/response/recieve/{vid}', 'HireController@recieve')->where('vid', '[0-9]+');

Route::get('/notifications', 'NotificationsController@index');

Route::get('/rate/{hire}', 'RatingController@rate');
Route::post('/rate/{hire}', 'RatingController@save');
Route::get('/ratingSent', 'RatingController@sent');

Route::get('/testimonial/{user}', 'TestimonialController@write');
Route::post('/testimonial/{user}', 'TestimonialController@save');
Route::get('/testimonialSent', 'TestimonialController@sent');
Route::get('/testimonials/{pro}', 'TestimonialController@view');
Route::get('/testimonial/delete/{t}', 'TestimonialController@delete');

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
Route::any('/event/confirm/{event}', 'EventController@confirm');
Route::any('/event/alternatives/{e}', 'NewEventController@view');
Route::any('/event/done/{e}', 'NewEventController@view');

Route::get('/calendar', 'CalendarController@calendar');
Route::get('/calendar/{pro}/{page?}/{prev?}', 'CalendarController@calendar_other')->where('pro', '[0-9]+')->where('page', '[0-9]+')->where('prev', '[0-9]+');
Route::post('/calendar/{pro}/save', 'EventController@pro_save')->where('pro', '[0-9]+');

Route::any('/event/{event}/confirm', 'EventController@confirm_cal');
Route::any('/event/{event}/deny', 'EventController@deny_cal');
Route::get('/event/change/available', 'NewEventController@view');


Route::any('/event/delete/{event}', 'CalendarController@delete');
Route::post('/calendar/save', 'CalendarController@save');
Route::post('/calendar/lesson', 'CalendarController@lesson');
Route::any('/event/edit/{pro?}/{e?}', 'NewEventController@forward')->where('event', '[0-9]+')->where('pro', '[0-9]+');
Route::any('/event/save/{event?}/{pro?}', 'CalendarController@save')->where('event', '[0-9]+')->where('pro', '[0-9]+');
Route::any('/event/save', 'CalendarController@save');
Route::any('/event/save/{event}', 'CalendarController@save')->where('event', '[0-9]+');
Route::any('/event/save/{event}/{pro}', 'CalendarController@save')->where('event', '[0-9]+')->where('pro', '[0-9]+');
Route::any('/event/repeat/{event}', 'CalendarController@repeat')->where('event', '[0-9]+');
Route::any('/repeating/delete/{rp}', 'CalendarController@delete_repeating')->where('rp', '[0-9]+');

Route::get('/alternative/{event}/confirm', 'EventController@alternative_confirm')->where('event', '[0-9]+');
Route::get('/alternative/{event}/deny', 'EventController@alternative_deny')->where('event', '[0-9]+');



Route::get('/option/edit/{option?}', 'OptionController@edit')->where('option', '[0-9]+');
Route::post('/option/save/{option}', 'OptionController@save')->where('option', '[0-9]+');
Route::any('/option/save', 'OptionController@save');
Route::get('/option/delete/{option}', 'OptionController@delete')->where('option', '[0-9]+');
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
//Route::get('/checkout', 'CartController@checkout');

Route::get('/notification/forward/{note}', 'NotificationsController@forward');

Route::post('/academy/upload/{acad}', 'UploadController@academy');
Route::post('/academy/member/new/{acad}', 'AcademyController@add');
Route::get('/dashboard/academy', 'DashboardController@academy');
Route::get('/academy/primary/{acad}', 'AcademyController@primary');


Route::post('/notification/read_all', 'NotificationsController@read_all');
Route::post('/paypal', "PaymentController@pay");
Route::any('/return', "PaymentController@return");
Route::get('/paytest', "PaymentController@test");

Route::get('/payout','PayoutController@payout');
Route::get('/helpme','PaymentController@help');
Route::get('/payment','PayoutController@payment');
Route::get('/proceed/{user}/{p}','PayoutController@proceed');
Route::get('/paid/{p}','PayoutController@paid');
Route::get('/cart/remove/{cart}','CartController@remove');
Route::get('/credit/{pro}','CreditController@book');
Route::get('/credit/use/{c}','CreditController@use');

Route::get('/event/cancel/{e}','CalendarController@cancel');
Route::get('/event/cancel/request/{e}','CalendarController@cancelRequest');
//Route::get('/events','NewEventController@view');
Route::any('/lesson/cancel/{e}','NewEventController@cancel_student');
Route::get('/event/view/{e}','NewEventController@view')->where('event', '[0-9]+');
Route::get('/event/{e}', 'NewEventController@view')->where('event', '[0-9]+');

Route::get('/info/edit', 'UserInfoController@edit');
Route::post('/info/save', 'UserInfoController@store');
Route::get('/info/{user?}', 'UserInfoController@view');

Route::get('/contact', 'HomeController@contact');
Route::get('/account', 'UserInfoController@account');
Route::get('/account/menu', 'UserInfoController@accountmenu');
Route::post('/account/save', 'UserInfoController@account_store');
Route::get('/address', 'UserInfoController@address');
Route::post('/address/save', 'UserInfoController@address_store');
Route::get('/password', 'UserInfoController@password');
Route::post('/password/save', 'UserInfoController@password_store');


Route::get('/vimeo','VimeoController@exchange');
Route::any('/video_processed','VimeoController@video_processed');

Route::any('/video/title/{vid}','VimeoController@ajax_set');
Route::any('/video/view/{vid}','VimeoController@view');



Route::get('/hire/front/{hire}','HireController@upload_front');
Route::get('/hire/dtl/{hire}','HireController@upload_dtl');
Route::get('/hire/resubmit/front/{hire}','HireController@resubmit_upload_front');
Route::get('/hire/resubmit/dtl/{hire}','HireController@resubmit_upload_dtl');
Route::get('/hire/questions/{hire}','HireController@questions');
Route::post('/hire/questions/save/{hire}','HireController@questions_save');
Route::get('/hire/confirm/{hire}','HireController@confirm');
Route::get('/hire/confirmed/{hire}','HireController@confirmed');
Route::post('/hire/respond/{hire}','HireController@respond');
Route::get('/hire/decline/{hire}', 'HireController@decline');
Route::post('hire/decline/save/{hire}', 'HireController@decline_save');

Route::get('/shortgame','UserInfoController@shortgame');
Route::post('/shortgame/save','UserInfoController@shortgame_save');
Route::get('/general','UserInfoController@general');
Route::post('/general/save','UserInfoController@general_save');
Route::get('/specific','UserInfoController@specific');
Route::post('/specific/save','UserInfoController@specific_save');

Route::get('/drill/upload','DrillController@upload');
Route::get('/public/dtl/{vid}','VimeoController@public_dtl');
Route::get('/public/fv/{vid}','VimeoController@public_fv');

Route::get('/student/info/{user}','UserInfoController@student');



Route::get('/camp/edit/{camp?}', 'CampController@edit')->where('camp', '[0-9]+');
Route::any('/camp/save/{camp?}', 'CampController@save');
Route::get('/camp/delete/{camp}', 'CampController@delete')->where('camp', '[0-9]+');
Route::get('/camp/enroll/{camp}', 'CampController@enroll')->where('camp', '[0-9]+');

Route::get('/pro/track', 'StatsController@pros');
Route::get('/student/track', 'StatsController@students');
Route::get('/student/track/{user}', 'StatsController@student');
Route::get('/pro/track/{user}', 'StatsController@student');
Route::get('/hire/drill/upload/{hire}', 'DrillController@hireupload');


Route::get('/option/tag/{o}', 'OptionController@tag');
Route::post('/option/tag/done/{o}', 'OptionController@tagdone');
Route::get('/register/pro/{user}', 'OptionController@tag');

Route::get('/newevent', 'NewEventController@create');
Route::post('/newevent/save', 'NewEventController@create_save');
Route::get('/newevent/edit/{e}', 'NewEventController@edit');
Route::get('/newevent/{e}', 'NewEventController@edit');
Route::post('/newevent/edit/{e}/save', 'NewEventController@edit_save');
Route::get('/newevent/delete/{e}', 'NewEventController@delete_event');
Route::get('/newevent/student/{e}', 'NewEventController@student_edit');
Route::get('/newevent/pro/{e}', 'NewEventController@pro_edit');
Route::get('/newevent/freeup/{e}', 'NewEventController@freeup');

Route::get('/camp/unenroll/{camp}', 'CampController@unenroll');

Route::post('/drill/save/{vid}', 'DrillController@edit_save');
Route::get('/drill/delete/{vid}', 'DrillController@delete');
});/////////////////////////////////////