<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\AdminActivity;

class AdminArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('published_at','desc')->paginate(15);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'body' => 'required|string',
            'published_at' => 'nullable|date',
        ]);

        $article = Article::create($data);
        AdminActivity::create(['user_id' => auth()->id(), 'action' => 'create_article', 'details' => 'Created article '.$article->id, 'ip' => request()->ip()]);

        return redirect()->route('admin.articles.index')->with('status', 'Article created');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'body' => 'required|string',
            'published_at' => 'nullable|date',
        ]);

        $article->update($data);
        AdminActivity::create(['user_id' => auth()->id(), 'action' => 'update_article', 'details' => 'Updated article '.$article->id, 'ip' => request()->ip()]);

        return redirect()->route('admin.articles.index')->with('status', 'Article updated');
    }

    public function destroy(Article $article)
    {
        $id = $article->id;
        $article->delete();
        AdminActivity::create(['user_id' => auth()->id(), 'action' => 'delete_article', 'details' => 'Deleted article '.$id, 'ip' => request()->ip()]);
        return redirect()->route('admin.articles.index')->with('status', 'Article deleted');
    }
}
