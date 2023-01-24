<?php
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

// Route::get('/', [HomeController::class, 'home'])->name('home.index');

Route::resource('news',NewsController::class)->only('index','show','create', 'store', 'edit', 'update');

// Route::get('/recent-news/{daysAgo}', function($daysAgo){
//     return $daysAgo;
// })->name('home.news.recent');

Route::resource('comment',CommentsController::class)->only('store', 'edit', 'update', 'destroy');

Route::resource('profile',ProfileController::class);

Route::get('/news', function(){
    return redirect('/');
});
Route::get('/comment/{id}', function($id){
    return redirect('/');
});
Route::get('/home', function(){
    return redirect('/');
});
Route::get('/request-topic', function(){
    if(!(Auth::check())) {
        return view('Auth.login');
    }
    elseif (Auth::user()->role == 'user'){
        return view('home.create.request');
    }
    else{
        session()->flash('status', 'خیر سرت ادمینی');
        return view('Profile.notification.index');
    }
});
// Route::resource('image', ImageController::class);

Route::resource('user', UserController::class);
Route::resource('notification', NotificationController::class)->only('index', 'show', 'store');


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'home'])->name('home.index');


// Route::post('/token', [
//     'uses' => 'AccessTokenController@issueToken',
//     'as' => 'token',
//     'middleware' => 'throttle',
// ]);
// Route::get('/authorize', [
//     'uses' => 'AuthorizationController@authorize',
//     'as' => 'authorizations.authorize',
//     'middleware' => 'web',
// ]);

// Route::middleware(['web', 'auth'])->group(function () {
// $guard = config('passport.guard', null);

// Route::middleware(['web', $guard ? 'auth:'.$guard : 'auth'])->group(function () {
//     Route::post('/token/refresh', [
//         'uses' => 'TransientTokenController@refresh',
//         'as' => 'token.refresh',
//     ]);
//     Route::post('/authorize', [
//         'uses' => 'ApproveAuthorizationController@approve',
//         'as' => 'authorizations.approve',
//     ]);
//     Route::delete('/authorize', [
//         'uses' => 'DenyAuthorizationController@deny',
//         'as' => 'authorizations.deny',
//     ]);
//     Route::get('/tokens', [
//         'uses' => 'AuthorizedAccessTokenController@forUser',
//         'as' => 'tokens.index',
//     ]);
//     Route::delete('/tokens/{token_id}', [
//         'uses' => 'AuthorizedAccessTokenController@destroy',
//         'as' => 'tokens.destroy',
//     ]);
//     Route::get('/clients', [
//         'uses' => 'ClientController@forUser',
//         'as' => 'clients.index',
//     ]);
//     Route::post('/clients', [
//         'uses' => 'ClientController@store',
//         'as' => 'clients.store',
//     ]);
//     Route::put('/clients/{client_id}', [
//         'uses' => 'ClientController@update',
//         'as' => 'clients.update',
//     ]);
//     Route::delete('/clients/{client_id}', [
//         'uses' => 'ClientController@destroy',
//         'as' => 'clients.destroy',
//     ]);
//     Route::get('/scopes', [
//         'uses' => 'ScopeController@all',
//         'as' => 'scopes.index',
//     ]);
//     Route::get('/personal-access-tokens', [
//         'uses' => 'PersonalAccessTokenController@forUser',
//         'as' => 'personal.tokens.index',
//     ]);
//     Route::post('/personal-access-tokens', [
//         'uses' => 'PersonalAccessTokenController@store',
//         'as' => 'personal.tokens.store',
//     ]);
//     Route::delete('/personal-access-tokens/{token_id}', [
//         'uses' => 'PersonalAccessTokenController@destroy',
//         'as' => 'personal.tokens.destroy',
//     ]);
// });
// });