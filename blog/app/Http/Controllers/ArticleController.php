<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    public function index() {
        $articles = Article::all();
        return view('article.index', ['articles' => $articles]);
    }

    public function create(){
        return view('article.create');
    }

    public function store(Request $request) {
        $article = new Article;
        $article->title = $request->title;
        $article->body = $request->body;
        $article->save();

        return view('article.store');
    }

    public function edit(Request $request, $id) {
        $article = Article::find($id);
        return view('article.edit', ['article' => $article]);
    }

    public function update(Request $request) {
        $article = Article::find($request->id);
        $article->title = $request->title;
        $article->body = $request->body;
        $article->save();

        return view('article.update');
    }
}
