<?php

namespace App\Http\Controllers\KepalaDesa;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Article;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Official;
use App\Models\PageView;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function dashboard()
    {
        $totalNews = Article::berita()->count();
        $totalPublishedNews = Article::published()->berita()->count();
        $totalAnnouncements = Article::pengumuman()->count();
        $totalPublishedAnnouncements = Article::published()->pengumuman()->count();
        $totalPhotos = Gallery::where('type', 'foto')->count();
        $totalVideos = Gallery::where('type', 'video')->count();
        $totalPageViews = PageView::count();

        // Riwayat aktivitas admin terbaru
        $recentActivities = ActivityLog::latest()->take(10)->get();

        // Konten terbaru yang dipublikasikan
        $publishedArticles = Article::published()
            ->with(['category', 'user'])
            ->latest('published_at')
            ->take(8)
            ->get();

        return view('kepala_desa.dashboard', compact(
            'totalNews',
            'totalPublishedNews',
            'totalAnnouncements',
            'totalPublishedAnnouncements',
            'totalPhotos',
            'totalVideos',
            'totalPageViews',
            'recentActivities',
            'publishedArticles'
        ));
    }

    public function articles(Request $request)
    {
        $query = Article::published()->with(['category', 'user']);

        if ($request->filled('type')) {
            $query->where('type', $request->type);
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

        $articles = $query->latest('published_at')->paginate(12)->withQueryString();
        $categories = Category::all();

        return view('kepala_desa.articles', compact('articles', 'categories'));
    }

    public function showArticle(Article $article)
    {
        return view('kepala_desa.article_detail', compact('article'));
    }

    public function galleries(Request $request)
    {
        $query = Gallery::query();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $galleries = $query->latest()->paginate(12)->withQueryString();

        return view('kepala_desa.galleries', compact('galleries'));
    }

    public function activities(Request $request)
    {
        $query = ActivityLog::with('user');

        if ($request->filled('module')) {
            $query->where('module', $request->module);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhere('user_name', 'like', "%{$search}%");
            });
        }

        $logs = $query->latest()->paginate(20)->withQueryString();

        return view('kepala_desa.activities', compact('logs'));
    }

    public function pageViews()
    {
        $totalViews = PageView::count();
        $recentViews = PageView::latest('visited_at')->paginate(25);

        // Agregasi halaman terpopuler
        $popularPages = PageView::selectRaw('page_url, page_title, count(*) as total')
            ->groupBy('page_url', 'page_title')
            ->orderByDesc('total')
            ->take(10)
            ->get();

        return view('kepala_desa.page_views', compact('totalViews', 'recentViews', 'popularPages'));
    }
}
