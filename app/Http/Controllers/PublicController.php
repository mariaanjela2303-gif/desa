<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\ContactSetting;
use App\Models\Gallery;
use App\Models\Official;
use App\Models\PageView;
use App\Models\VillageProfile;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        PageView::logHit('Beranda Desa Tautpah');

        $profile = VillageProfile::first() ?? new VillageProfile();
        $contact = ContactSetting::first() ?? new ContactSetting();

        $latestNews = Article::published()
            ->berita()
            ->with('category')
            ->latest('published_at')
            ->take(3)
            ->get();

        $latestAnnouncements = Article::published()
            ->pengumuman()
            ->with('category')
            ->latest('published_at')
            ->take(3)
            ->get();

        $officials = Official::where('status', 'active')
            ->orderBy('order')
            ->take(4)
            ->get();

        $photos = Gallery::where('type', 'foto')->latest()->take(6)->get();
        $videos = Gallery::where('type', 'video')->latest()->take(2)->get();

        $totalNews = Article::published()->berita()->count();
        $totalAnnouncements = Article::published()->pengumuman()->count();
        $totalGalleries = Gallery::count();
        $totalOfficials = Official::where('status', 'active')->count();

        return view('public.home', compact(
            'profile',
            'contact',
            'latestNews',
            'latestAnnouncements',
            'officials',
            'photos',
            'videos',
            'totalNews',
            'totalAnnouncements',
            'totalGalleries',
            'totalOfficials'
        ));
    }

    public function profile()
    {
        PageView::logHit('Profil Desa');
        $profile = VillageProfile::first() ?? new VillageProfile();
        return view('public.profile', compact('profile'));
    }

    public function officials()
    {
        PageView::logHit('Struktur Pemerintahan');
        $officials = Official::where('status', 'active')
            ->orderBy('order')
            ->get();
        return view('public.officials', compact('officials'));
    }

    public function articles(Request $request)
    {
        PageView::logHit('Berita & Pengumuman');

        $query = Article::published()->with(['category', 'user']);

        if ($request->filled('type') && in_array($request->type, ['berita', 'pengumuman'])) {
            $query->where('type', $request->type);
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%");
            });
        }

        $articles = $query->latest('published_at')->paginate(9)->withQueryString();
        $categories = Category::withCount(['articles' => function ($q) {
            $q->where('status', 'published');
        }])->get();

        $currentType = $request->type;
        $currentCategory = $request->category;
        $searchTerm = $request->search;

        return view('public.articles.index', compact('articles', 'categories', 'currentType', 'currentCategory', 'searchTerm'));
    }

    public function articleDetail(string $slug)
    {
        $article = Article::published()
            ->with(['category', 'user'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Increment hit
        $article->increment('views_count');
        PageView::logHit("Detail: {$article->title}");

        $relatedArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->where('type', $article->type)
            ->when($article->category_id, function ($q) use ($article) {
                $q->where('category_id', $article->category_id);
            })
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('public.articles.show', compact('article', 'relatedArticles'));
    }

    public function galleries()
    {
        PageView::logHit('Galeri Foto & Video');

        $photos = Gallery::where('type', 'foto')->latest()->paginate(12, ['*'], 'photos_page');
        $videos = Gallery::where('type', 'video')->latest()->paginate(6, ['*'], 'videos_page');

        return view('public.galleries', compact('photos', 'videos'));
    }

    public function contact()
    {
        PageView::logHit('Kontak & Pelayanan');
        $contact = ContactSetting::first() ?? new ContactSetting();
        return view('public.contact', compact('contact'));
    }
}
