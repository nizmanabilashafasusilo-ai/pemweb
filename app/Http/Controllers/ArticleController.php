<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::whereNotNull('published_at')->orderByDesc('published_at')->paginate(10);
        return view('blog.index', compact('articles'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('blog.show', compact('article'));
    }
}
