<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Category;

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

    public function show(Post $post)
    {
        return view("blog.show", compact('post'));
    }

    public function category(Category $category)
    {
      $categoryName = $category->title;

      //\DB::enableQueryLog();
      //$posts = Post::with('author')->latestFirst()->published()->where('category_id', $id)->simplePaginate($this->limit);
      //return view("blog.index", compact('posts', 'categories'));
      $posts = $category->posts()->with('author')->latestFirst()->published()->simplePaginate($this->limit);
      return view("blog.index", compact('posts', 'categoryName'));
      //view("blog.index", compact('posts'))->render();
      //dd(\DB::getQueryLog());
    }
}
