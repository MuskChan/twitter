<?php

use App\Events\PublicMessageEvent;

Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');

Route::get('signup', 'UsersController@create')->name('signup');
Route::resource('users', 'UsersController');

Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');

Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::resource('statuses', 'StatusesController');

//回复
Route::resource('replies', 'RepliesController');

//消息
Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);

//邮件
Route::get('send_emails', 'sendEmailController@index')->name('send_emails.index');

//时间粒子
Route::get('time_particles', 'TimeParticlesController@index')->name('time_particles.index');

//广播
Route::get('test-broadcast', function(){
    broadcast(new \App\Events\ExampleEvent);
});

Route::get('/echo', function () {
    return view('echo');
});

Route::get('/push/{message}', function ($message) {
    broadcast(new PublicMessageEvent($message));
});


//$app = new Ratchet\App('twitter.test', 8080);
//$app->route('/chat', new MyChat, array('*'));
//$app->route('/echo', new Ratchet\Server\EchoServer, array('*'));
//$app->run();


Route::get('/users/{user}/followings', 'UsersController@followings')->name('users.followings');
Route::get('/users/{user}/followers', 'UsersController@followers')->name('users.followers');

Route::post('/users/followers/{user}', 'FollowersController@store')->name('followers.store');
Route::delete('/users/followers/{user}', 'FollowersController@destroy')->name('followers.destroy');
