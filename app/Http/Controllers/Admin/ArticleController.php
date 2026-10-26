<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with(['category', 'user']);

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%");
            });
        }

        $articles = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('admin.articles.index', compact('articles', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:berita,pengumuman'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'summary' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'status' => ['required', 'in:draft,published'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ], [
            'title.required' => 'Judul wajib diisi.',
            'content.required' => 'Konten/isi artikel wajib diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        $slug = Str::slug($validated['title']);
        $count = Article::where('slug', 'LIKE', "{$slug}%")->count();
        $finalSlug = $count ? "{$slug}-" . Str::random(4) : $slug;

        $article = Article::create([
            'user_id' => auth()->id(),
            'category_id' => $validated['category_id'],
            'type' => $validated['type'],
            'title' => $validated['title'],
            'slug' => $finalSlug,
            'summary' => $validated['summary'] ?? Str::limit(strip_tags($validated['content']), 150),
            'content' => $validated['content'],
            'image' => $imagePath,
            'status' => $validated['status'],
            'published_at' => $validated['status'] === 'published' ? now() : null,
        ]);

        ActivityLog::record(
            'TAMBAH',
            ucfirst($article->type),
            "Menambahkan {$article->type} baru: '{$article->title}'."
        );

        return redirect()->route('admin.articles.index')->with('success', ucfirst($article->type) . ' berhasil ditambahkan.');
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:berita,pengumuman'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'summary' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'status' => ['required', 'in:draft,published'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        $imagePath = $article->image;
        if ($request->hasFile('image')) {
            if ($article->image && Storage::disk('public')->exists($article->image)) {
                Storage::disk('public')->delete($article->image);
            }
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        $publishedAt = $article->published_at;
        if ($validated['status'] === 'published' && !$article->published_at) {
            $publishedAt = now();
        }

        $article->update([
            'category_id' => $validated['category_id'],
            'type' => $validated['type'],
            'title' => $validated['title'],
            'summary' => $validated['summary'] ?? Str::limit(strip_tags($validated['content']), 150),
            'content' => $validated['content'],
            'image' => $imagePath,
            'status' => $validated['status'],
            'published_at' => $publishedAt,
        ]);

        ActivityLog::record(
            'EDIT',
            ucfirst($article->type),
            "Memperbarui {$article->type}: '{$article->title}'."
        );

        return redirect()->route('admin.articles.index')->with('success', ucfirst($article->type) . ' berhasil diperbarui.');
    }

    public function destroy(Article $article)
    {
        $title = $article->title;
        $type = $article->type;

        if ($article->image && Storage::disk('public')->exists($article->image)) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        ActivityLog::record(
            'HAPUS',
            ucfirst($type),
            "Menghapus {$type}: '{$title}'."
        );

        return redirect()->route('admin.articles.index')->with('success', ucfirst($type) . ' berhasil dihapus.');
    }
}
