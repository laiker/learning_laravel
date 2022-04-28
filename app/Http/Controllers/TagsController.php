<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagsController extends Controller
{
    function index(Tag $tag)
    {
        $posts = $tag->posts()->with('tags')->get();
        $news = $tag->news()->with('tags')->get();
     
        $elements = collect(['name' => $tag->name, 'items' => $posts->concat($news)]);


        return view('byTag', compact('elements'));
    }
}
