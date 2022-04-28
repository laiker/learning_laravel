<?php

namespace App\Http\Controllers;

use App\Post; 
use App\Tag;
use App\Comment;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('can:update,post')->only(['edit', 'update', 'destroy']);
    }

    public function index(Post $posts)
    {
        $title = 'Главная';

        $posts = \Cache::tags(['posts'])->remember('posts', 3600, function(){
            return Post::with('tags')->where('published', 1)->latest()->get();
        });

        return view('index', compact('posts', 'title'));
    }

    public function show(Post $post)
    {
        $comments = $post->comments()->get();
        return view('posts.show', compact('post', 'comments'));
    }
    
    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'code' => 'required|unique:App\Post|regex:/^[A-z-_0-9]+$/',
            'title' => 'required|min:5|max:100',
            'preview_text' => 'required|max:255',
            'detail_text' => 'required',
        ]);

        $attributes['owner_id'] = auth()->id();

        flash('Статья успешно добавлена');

        Post::create($attributes);
        
        return redirect('/posts');
    }
    
    public function storeComment(Post $post)
    {
        $attributes = request()->validate([
            'text' => 'required|min:5',
        ]);
        
        
        $comment = new Comment;
        $comment->text = $attributes['text'];
        $comment->user_id = auth()->id();
        $post->comments()->save($comment);

        flash('Комментарий успешно добавлен');

        return redirect('/posts/'.$post->code);
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }
    
    public function update(Post $post)
    {
        $attributes = request()->validate([
            'code' => 'required|regex:/^[A-z-_0-9]+$/|unique:App\Post,code,'.$post->id,
            'title' => 'required|min:5|max:100',
            'preview_text' => 'required|max:255',
            'detail_text' => 'required',
        ]);

        $attributes['published'] = request()->get('published');
        
        $originalTags = $post->tags->keyBy('name');
        $tags = collect(explode(',', request()->get('tags')))->keyBy(function($item){return $item;});
        $syncIDs = $originalTags->intersectByKeys($tags)->pluck('id')->toArray();
        
        $newTags = $tags->diffKeys($originalTags);

        foreach($newTags as $tag){
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $syncIDs[] = $tag->id;
        }

        $post->tags()->sync($syncIDs);

        $post->update($attributes);
        flash('Задача успешно изменена', 'warning');
        return redirect('/posts');
    }

    public function adminIndex(Post $posts)
    {
        $title = 'Список статей';
        $posts = Post::with('tags')->latest()->get();

        return view('admin.posts.list', compact('posts', 'title'));
    }

    public function adminEdit(Post $post)
    {
        $title = 'Редактировать статью';
        return view('admin.posts.edit', compact('post', 'title'));
    }

}
