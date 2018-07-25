<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// user forgot password
Route::post('/password/email', 'Auth\ForgotPasswordController@reset_password')->middleware('api');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->middleware('api')->name('api_password.reset');

// confirm_reject_request
Route::post('/confirm_reject_request', 'api\apps_specialUserController@confirm_reject_request')->middleware('api');

// event related route
Route::post('/new_event', 'api\apps_eventController@index')->middleware('api');
Route::post('/get_ongoing_events', 'api\apps_eventController@get_ongoing_events')->middleware('api');
Route::post('/get_completed_events', 'api\apps_eventController@get_completed_events')->middleware('api');
Route::post('/get_all_events', 'api\apps_eventController@get_all_events')->middleware('api');
Route::post('/get_current_events', 'api\apps_eventController@get_current_events')->middleware('api');
Route::post('/new_comments', 'api\apps_eventController@new_comments')->middleware('api');
Route::post('/like_this_event', 'api\apps_eventController@like_this_event')->middleware('api');
Route::post('/bookmark_this_event', 'api\apps_eventController@bookmark_this_event')->middleware('api');
Route::post('/new_feedback', 'api\apps_eventController@new_feedback')->middleware('api');
Route::post('/get_feedback', 'api\apps_eventController@get_feedback')->middleware('api');
Route::post('/register_event', 'api\apps_eventController@register_event')->middleware('api');
Route::post('/search_all_event', 'api\apps_eventController@search_all_events')->middleware('api');

Route::post('/search_user', 'api\apps_specialUserController@search_user')->middleware('api');
Route::post('/select_user', 'api\apps_specialUserController@select_user')->middleware('api');
Route::post('/list_officer', 'api\apps_specialUserController@list_officer')->middleware('api');
Route::post('/list_pending_officer', 'api\apps_specialUserController@list_pending_officer')->middleware('api');
Route::post('/get_invited_vip', 'api\apps_specialUserController@get_invited_vip')->middleware('api');
Route::post('/agree_officer', 'api\apps_specialUserController@agree_officer')->middleware('api');
Route::post('/disagree_officer', 'api\apps_specialUserController@disagree_officer')->middleware('api');
Route::post('/agree_vip', 'api\apps_specialUserController@agree_vip')->middleware('api');
Route::post('/assign_officer_list', 'api\apps_eventController@assign_officer_list')->middleware('api');
Route::post('/assign_officer', 'api\apps_eventController@assign_officer')->middleware('api');

// officer section
Route::post('/get_officer_task', 'api\apps_eventController@get_officer_task')->middleware('api');

// bookmark section
Route::post('/bookmarked_events', 'api\apps_eventController@bookmarked_events')->middleware('api');
Route::post('/remove_bookmarked_event', 'api\apps_eventController@remove_bookmarked_event')->middleware('api');

// Notification section
Route::post('/get_notification', 'api\apps_eventNotificationController@get_notification')->middleware('api');

// authentication related route
Route::post('/login', 'api\apps_loginController@auth')->middleware('api');
Route::post('/register', 'api\apps_loginController@register')->middleware('api');

// category related route
Route::get('/category', 'helper\categoryController@getAllCategory')->middleware('api');

// messaging
Route::post('/fetch_chat_room', 'api\apps_eventMessageController@fetch_chat_room')->middleware('api');
Route::post('/fetch_selected_chat', 'api\apps_eventMessageController@fetch_selected_chat')->middleware('api');
Route::post('/send_message', 'api\apps_eventMessageController@send_message')->middleware('api');
Route::post('/touch_chat_room', 'api\apps_eventMessageController@touch_chat_room')->middleware('api');

// user profile
Route::post('/update_profile', 'api\apps_loginController@update_profile')->middleware('api');

// get apps info
Route::post('/get_apps_info', 'api\apps_eventController@get_apps_info')->middleware('api');

// get joined events
Route::post('/get_joined_events', 'api\apps_eventController@get_joined_events')->middleware('api');

// get participant
Route::post('/get_participants', 'api\apps_eventController@event_participants')->middleware('api');