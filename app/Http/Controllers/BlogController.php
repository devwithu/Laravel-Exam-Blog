<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;

class BlogController extends Controller
{
  protected $limit = 3;

    public function index()
    {
      //\DB::enableQueryLog();
      $posts = Post::with('author')->latestFirst()->published()->simplePaginate($this->limit);
      return view("blog.index", compact('posts'));
      //view("blog.index", compact('posts'))->render();
      //dd(\DB::getQueryLog());
    }

    public function show($id)
    {
        $post = Post::published()->findOrFail($id);
        return view("blog.show", compact('post'));
    }
}
