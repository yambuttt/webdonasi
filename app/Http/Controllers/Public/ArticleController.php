<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of published articles.
     */
    public function index()
    {
        $articles = Article::with('author')
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->paginate(6); // Paginate 6 per page for premium card layouts
            
        return view('articles.index', compact('articles'));
    }

    /**
     * Display the specified article details.
     */
    public function show($slug)
    {
        $article = Article::with('author')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Fetch other recent articles for the sidebar suggestion
        $recentArticles = Article::where('status', 'published')
            ->where('id', '!=', $article->id)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        return view('articles.show', compact('article', 'recentArticles'));
    }
}
