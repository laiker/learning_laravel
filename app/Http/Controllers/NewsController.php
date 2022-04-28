<?php

namespace App\Http\Controllers;

use \App\News;
use \App\Tag;
use \App\Comment;

class NewsController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('can:update')->only(['edit', 'update', 'destroy']);
    }

    public function index(News $news)
    {
        $title = 'Главная';

        $news = \Cache::tags(['news'])->remember('news', 3600, function () {
            return \App\News::with('tags')->where('published', 1)->latest()->get();
        });

        return view('news', compact('news', 'title'));
    }

    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    public function create()
    {
        $title = 'Создать новость';
        return view('admin.news.create', compact('title'));
    }

    public function store()
    {
        $attributes = request()->validate([
            'code' => 'required|unique:App\News|regex:/^[A-z-_0-9]+$/',
            'title' => 'required|min:5|max:100',
            'preview_text' => 'required|max:255',
            'detail_text' => 'required',
        ]);

        $attributes['published'] = 1;

        flash('Новость успешно добавлена');

        $news = News::create($attributes);

        $originalTags = $news->tags->keyBy('name');
        $tags = collect(explode(',', request()->get('tags')))->keyBy(function ($item) { return $item; });
        $syncIDs = $originalTags->intersectByKeys($tags)->pluck('id')->toArray();

        $newTags = $tags->diffKeys($originalTags);

        foreach ($newTags as $tag){
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $syncIDs[] = $tag->id;
        }

        $news->tags()->sync($syncIDs);


        return redirect('/news');
    }

    public function adminIndex(News $news)
    {
        $title = 'Список новостей';
        $news = News::latest()->get();

        return view('admin.news.list', compact('news', 'title'));
    }

    public function storeComment(News $news)
    {
        $attributes = request()->validate([
            'text' => 'required|min:5',
        ]);


        $comment = new Comment;
        $comment->text = $attributes['text'];
        $comment->user_id = auth()->id();
        $news->comments()->save($comment);

        flash('Комментарий успешно добавлен');

        return redirect('/news/'.$news->code);
    }


}
