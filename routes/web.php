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

Route::get('/', 'HomeController@index')->name('home');

Route::post('/subscriber', 'SubscriberController@subscribe')->name('subscribe');

Route::get('/post/{slug}', 'PostController@index')->name('show.post');

Route::get('/posts', 'PostsController@index')->name('posts.index');

Route::get('/search', 'SearchController@index')->name('search');

Route::get('category/post/{slug}', 'PostController@postByCategory')->name('category.post');
Route::get('tag/post/{slug}', 'PostController@postBytag')->name('tag.post');

//		 User Profile
Route::get('profile/{user_name}', 'AuthorProfileController@profile')->name('author.profile');

Auth::routes();
Route::group(['middleware' => ['auth']], function (){
	Route::post('favorite/{id}/add', 'FavoriteController@add')->name('add.favorite');
	Route::post('/comment/{id}', 'CommentController@store')->name('comment.store');
});

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']],function(){

	Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
	Route::resource('tag', 'TagController');
	Route::resource('category', 'CategoryController');
	//      Post Route
	Route::resource('post', 'PostController');
	Route::get('/pendingpost', 'PostController@pending')->name('pending.post');
	Route::put('/post/{id}/approved', 'PostController@approved')->name('approved.post');
	//      Favorite post Route
	Route::get('/favorite', 'FavoriteController@index')->name('favorite.index');

	//      All Authors Controller
	Route::get('/authors', 'AuthorsController@index')->name('author.index');
	Route::delete('/authors/{id}', 'AuthorsController@destroy')->name('author.destroy');
	//      Subscribers Route
	Route::get('/subscriber', 'SubscriberController@index')->name('subscriber.index');
	Route::delete('/subscriber/{id}/distroy', 'SubscriberController@destroy')->name('subscriber.destroy');
	//     Settings Route
	Route::get('/setting', 'SettingController@index')->name('setting');
	Route::put('/update', 'SettingController@update')->name('profile.edit');
	Route::put('/changepassword', 'SettingController@changepassword')->name('change.password');
	//    Comment Route

	Route::get('/comment', 'CommmentController@index')->name('comment.index');
	Route::delete('/comment/{id}', 'CommmentController@destroy')->name('comment.destroy');
});

Route::group(['as' => 'author.', 'prefix' => 'author', 'namespace' => 'Author', 'middleware' => ['auth', 'author']],function(){
	
	Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
	Route::resource('post', 'PostController');
	//      Settings Route
	Route::get('/setting', 'SettingController@index')->name('setting');
	Route::put('/update', 'SettingController@update')->name('profile.edit');
	//      Favorite post Route
	Route::get('/favorite', 'FavoriteController@index')->name('favorite.index');
	//      Change password Route
	Route::put('/changepassword', 'SettingController@changepassword')->name('change.password');

	//    Comment Route

	Route::get('/comment', 'CommentController@index')->name('comment.index');
	Route::delete('/comment/{id}', 'CommentController@destroy')->name('comment.destroy');
});

View::composer('layouts.frontend.partial.footer', function ($view)
{
	$categorys = App\Category::all();
	$view->with('categorys', $categorys);
});


