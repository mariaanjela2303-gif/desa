<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Article;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Official;
use App\Models\PageView;

class DashboardController extends Controller
{
    public function index()
    {
        $totalNews = Article::berita()->count();
        $totalAnnouncements = Article::pengumuman()->count();
        $totalCategories = Category::count();
        $totalPhotos = Gallery::where('type', 'foto')->count();
        $totalVideos = Gallery::where('type', 'video')->count();
        $totalOfficials = Official::count();
        $totalPageViews = PageView::count();

        $recentActivities = ActivityLog::latest()->take(8)->get();
        $recentArticles = Article::with('category')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalNews',
            'totalAnnouncements',
            'totalCategories',
            'totalPhotos',
            'totalVideos',
            'totalOfficials',
            'totalPageViews',
            'recentActivities',
            'recentArticles'
        ));
    }
}
