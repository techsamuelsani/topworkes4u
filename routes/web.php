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


Route::get('/how', 'ServiceController@how');

Route::post('/send/link', 'Auth\RegisterController@sendLink');
Route::get('/reg/{email}/{token}', 'Auth\RegisterController@viewRegister');

Route::get('/admin', 'AdminController@index');
Route::get('/admin/services', 'AdminController@pendingServices');
Route::get('/admin/service/{id}', 'AdminController@service');
Route::post('/admin/service/{id}', 'AdminController@serviceAction');

Route::get('/admin/sellers', 'AdminController@pendingSellers');
Route::post('/admin/sellers', 'AdminController@sellerAction');

Route::get('/admin/jobs', 'AdminController@pendingJobs');
Route::post('/admin/jobs', 'AdminController@jobAction');

Route::get('/admin/recharges', 'AdminController@pendingRecharges');
Route::post('/admin/recharges', 'AdminController@actionRecharge');
Route::get('/admin/withdrawals', 'AdminController@pendingWithdrawals');
Route::post('/admin/withdrawals', 'AdminController@actionWithdrawals');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/order/verify', 'OrderController@verify')->name('verify');

Route::get('/tickets', 'TicketController@tickets');
Route::get('/ticket/{id}', 'TicketController@ticket');
Route::post('/open/ticket', 'TicketController@open');
Route::post('/ticket/{id}', 'TicketController@reply');

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::get('view/services/{page?}', 'ServiceController@index')->name('services');

Route::get('/inbox', 'MessageController@index');


Route::get('/jobs', 'JobController@index');
Route::post('/jobs', 'JobController@saveOffer');
Route::get('/job/add', 'JobController@showForm');
Route::post('/job/add/save', 'JobController@saveJob')->name('saveJob');
Route::get('/jobs/manage', 'JobController@manageJobs');
Route::get('/job/view/{id}', 'JobController@showJob');
Route::get('/job/view/{id}/remove', 'JobController@removeJob');
Route::get('/job/view/{id}/deactivate', 'JobController@deactivateJob');

Route::post('offer/{id}/buy', 'OrderController@offerBuy');

Route::get('/file/{id}/{name}', 'FileController@getTicketFile');
Route::get('/file/{id}', 'FileController@getFile')->name('getFile');

Route::get('/ajax/notifications/{id}', 'HomeController@ajaxNote');

Route::get('/ajax/{username}/conversation/new', 'MessageController@ajaxNew');


Route::get('{username}/service/add', 'ServiceController@showAddForm');


Route::post('{username}/startSell', 'UserController@becomeSeller');

Route::post('{username}/service/add', 'ServiceController@saveService');
Route::get('{username}/services/manage', 'ServiceController@manage');

Route::get('{username}/purchases/', 'UserController@purchases');
Route::get('{username}/sales/', 'UserController@sales');

Route::get('{username}/selling/{id}', 'OrderController@sellerView')->name('sellerView');
Route::post('{username}/selling/{id}', 'OrderController@deliver')->name('deliver');
Route::get('{username}/buying/{id}', 'OrderController@buyerView')->name('buyerView');
Route::post('{username}/buying/{id}', 'OrderController@action')->name('action');

Route::post('{username}/buying/{id}/review', 'OrderController@writeReview')->name('review');
Route::get('{username}/buying/{id}/review', function (){ return abort(404);});

Route::post('{username}/selling/{id}/action', 'OrderController@sellerAction');
Route::get('{username}/selling/{id}/action', function (){ return abort(404);});

Route::post('{username}/selling/{id}/message', 'OrderController@saveMessage')->name('orderMessage');
Route::get('{username}/selling/{id}/message', function (){ return abort(404);});
Route::post('{username}/buying/{id}/message', 'OrderController@saveMessage')->name('orderMessage');
Route::get('{username}/buying/{id}/message', function (){ return abort(404);});

Route::post('{username}/{title}/{id}/buy', 'OrderController@balanceBuy');


Route::get('{username}/recharge', 'RechargeController@index')->name('viewRecharge');
Route::post('{username}/recharge', 'RechargeController@saveRequest')->name('saveRequest');

Route::get('{username}/withdrawals', 'WithdrawalController@index')->name('viewWithdrawals');
Route::post('{username}/withdrawals', 'WithdrawalController@saveRequest');

Route::get('{username}/{title}/{id}', 'ServiceController@viewService')->name('viewService');
Route::get('{username}/{title}/{id}/edit', 'ServiceController@showUpdate')->name('showUpdate');
Route::post('{username}/{title}/{id}/edit', 'ServiceController@updateService')->name('updateService');
Route::post('{username}/{title}/{id}/edit/image', 'ServiceController@imageUpdate')->name('imageUpdate');
Route::get('{username}/{title}/{id}/edit/image', function (){ return abort(404);});
Route::post('{username}/{title}/{id}/edit/package/{number}', 'ServiceController@packageUpdate')->name('packageUpdate');
Route::get('{username}/{title}/{id}/edit/package/{number}', function (){ return abort(404);});
Route::get('{username}/{title}/{id}/delete','ServiceController@deleteService');
Route::get('{username}/settings', 'UserController@showSettings')->name('settings');
Route::post('{username}/settings', 'UserController@saveSettings')->name('SaveSettings');
Route::post('{username}/settings/image', 'UserController@uploadImage');
Route::get('{username}/settings/image', function (){ return abort(404);});
Route::post('{username}/settings/password', 'UserController@changePassword');
Route::get('{username}/settings/password', function (){ return abort(404);});
Route::get('{username}', 'UserController@index');
Route::get('{username}/conversation', 'MessageController@conversation');
Route::post('{username}/conversation', 'MessageController@saveMessage');





