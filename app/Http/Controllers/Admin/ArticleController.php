<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with('author')->orderBy('created_at', 'desc')->get();
        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'content' => 'required|string',
            'status' => 'required|string|in:draft,published',
        ], [
            'title.required' => 'Judul artikel wajib diisi.',
            'content.required' => 'Konten artikel wajib diisi.',
            'thumbnail.image' => 'File harus berupa gambar.',
            'thumbnail.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'thumbnail.max' => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        $data = $request->only(['title', 'content', 'status']);
        $data['user_id'] = auth()->id();

        // Generate unique slug
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;
        while (Article::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        $data['slug'] = $slug;

        // Process Thumbnail Upload
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            
            // Ensure target directory exists
            $targetDir = public_path('uploads/articles');
            if (!File::exists($targetDir)) {
                File::makeDirectory($targetDir, 0755, true);
            }

            $file->move($targetDir, $filename);
            $data['thumbnail'] = '/uploads/articles/' . $filename;
        }

        Article::create($data);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diterbitkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'content' => 'required|string',
            'status' => 'required|string|in:draft,published',
        ], [
            'title.required' => 'Judul artikel wajib diisi.',
            'content.required' => 'Konten artikel wajib diisi.',
            'thumbnail.image' => 'File harus berupa gambar.',
            'thumbnail.max' => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        $data = $request->only(['title', 'content', 'status']);

        // Update slug if title changed
        if ($article->title !== $request->title) {
            $slug = Str::slug($request->title);
            $originalSlug = $slug;
            $count = 1;
            while (Article::where('slug', $slug)->where('id', '!=', $article->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            $data['slug'] = $slug;
        }

        // Process Thumbnail Upload
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            
            $targetDir = public_path('uploads/articles');
            if (!File::exists($targetDir)) {
                File::makeDirectory($targetDir, 0755, true);
            }

            $file->move($targetDir, $filename);
            $data['thumbnail'] = '/uploads/articles/' . $filename;

            // Delete old thumbnail file if exists
            if ($article->thumbnail && File::exists(public_path($article->thumbnail)) && !Str::contains($article->thumbnail, 'images/')) {
                File::delete(public_path($article->thumbnail));
            }
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        // Delete thumbnail file
        if ($article->thumbnail && File::exists(public_path($article->thumbnail)) && !Str::contains($article->thumbnail, 'images/')) {
            File::delete(public_path($article->thumbnail));
        }

        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus!');
    }
}
