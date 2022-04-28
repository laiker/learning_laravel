<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PostsController@index');

Route::get('/about', function(){return view('about', Array('title' => 'О нас'));}); 
Route::get('/test', function(){ 
    //\App\Jobs\CountEntity::dispatch(2);
    //event(new \App\Events\SomethingHappend('Тестовое сообщение'));
    
}); 

Route::resource('posts', 'PostsController');
Route::resource('news', 'NewsController');

Route::post('/posts/{post}/comment', 'PostsController@storeComment');
Route::post('/news/{news}/comment', 'NewsController@storeComment');



Route::get('/tag/{tag}', 'TagsController@index');

//feedback
Route::get('/contacts', 'TicketsController@create');
Route::post('/contacts', 'TicketsController@store');

//admin 
Route::get('/admin/', function(){
    $statistics['Общее количество статей'] = \DB::table('posts')->count();
    $statistics['Общее количество новостей'] = \DB::table('news')->count();
    //SELECT users.name FROM users INNER JOIN posts  ON users.id = posts.owner_id  GROUP BY users.id  ORDER BY COUNT(*) DESC LIMIT 1
    $statistics['Больше всего статей'] = \DB::table('users')->join('posts', 'posts.owner_id', '=', 'users.id')->select(DB::raw(' users.name as name, count(*) as postsCount'))->groupBy('users.id')->orderByDesc('postsCount')->limit(1)->value('name'); 
    $statistics['Самая длинная статья'] = \DB::table('posts')->select(DB::raw('title, code, CHAR_LENGTH(detail_text) as textLength'))->orderByDesc('textLength')->limit(1)->value('textLength');
    $statistics['Самая короткая статья'] = \DB::table('posts')->select(DB::raw('title, code, CHAR_LENGTH(detail_text) as textLength'))->orderBy('textLength', 'asc')->limit(1)->value('textLength');

    $statistics['Среднее количество статей у активных пользователей'] = \DB::table('users')->join('posts', 'posts.owner_id', '=', 'users.id')->select(DB::raw(' users.name as name, count(*) as postsCount'))->having('postsCount', '>', '1')->groupBy('users.id')->get()->avg('postsCount'); 
    $statistics['Самая непостоянная статья'] =  \DB::table('post_histories')->join('posts', 'post_histories.post_id', '=', 'posts.id')->select(DB::raw('title, code, count(*) as postsChanges'))->groupBy('posts.id')->orderByDesc('postsChanges')->limit(1)->value('title');
    $statistics['Самая комментируемая статья'] =  \DB::table('comments')->join('posts', 'comments.commentable_id', '=', 'posts.id')->select(DB::raw('posts.title, count(*) as commentsCount'))->groupBy('posts.id')->orderByDesc('commentsCount')->limit(1)->value('title');

    $title = 'Админ панель';

    return view('admin.index', compact('title', 'statistics'));

})->middleware('admin');

Route::get('/admin/feedback', 'TicketsController@index')->middleware('admin');
Route::get('/admin/posts', 'PostsController@adminIndex')->middleware('admin');
Route::get('/admin/posts/{post}/edit', 'PostsController@adminEdit')->middleware('admin');
Route::get('/admin/news', 'NewsController@adminIndex')->middleware('admin');
Route::get('/admin/news/create', 'NewsController@create')->middleware('admin');
Route::get('/admin/reports/final', 'ReportsController@final')->middleware('admin');
Route::post('/admin/reports/generateReport', 'ReportsController@generateReport')->middleware('admin');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//push service
Route::get('/service', 'PushServiceController@form');
Route::post('/service', 'PushServiceController@send');

Route::post('/chat', function(){
    broadcast(new \App\Events\ChatMessage(request('message'), auth()->user()))->toOthers();
})->middleware('auth');
