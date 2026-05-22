<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Dashboard
    public function dashboard()
    {
        $totalNews = News::count();
        $publishedNews = News::where('status', 'published')->count();
        $draftNews = News::where('status', 'draft')->count();
        $totalViews = News::sum('views');
        
        $recentNews = News::orderBy('created_at', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact('totalNews', 'publishedNews', 'draftNews', 'totalViews', 'recentNews'));
    }

    // List semua berita
    public function news(Request $request)
    {
        $query = News::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $news = $query->orderBy('created_at', 'desc')->paginate(10);
        $categories = ['Alumni', 'Acara', 'Prestasi', 'Beasiswa', 'Pengumuman', 'Lainnya'];

        return view('admin.news.index', compact('news', 'categories'));
    }

    // Form create berita
    public function createNews()
    {
        $categories = ['Alumni', 'Acara', 'Prestasi', 'Beasiswa', 'Pengumuman', 'Lainnya'];
        return view('admin.news.create', compact('categories'));
    }

    // Store berita
    public function storeNews(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:news',
            'content' => 'required|string|min:10',
            'category' => 'required|string|in:Alumni,Acara,Prestasi,Beasiswa,Pengumuman,Lainnya',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['author'] = auth()->user()->name;
        $validated['status'] = $request->has('publish') ? 'published' : 'draft';

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('news', 'public');
            $validated['featured_image'] = $path;
        }

        News::create($validated);

        return redirect()->route('admin.news.index')
                       ->with('success', 'Berita berhasil dibuat!');
    }

    // Form edit berita
    public function editNews(News $news)
    {
        $categories = ['Alumni', 'Acara', 'Prestasi', 'Beasiswa', 'Pengumuman', 'Lainnya'];
        return view('admin.news.edit', compact('news', 'categories'));
    }

    // Update berita
    public function updateNews(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:news,title,' . $news->id,
            'content' => 'required|string|min:10',
            'category' => 'required|string|in:Alumni,Acara,Prestasi,Beasiswa,Pengumuman,Lainnya',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published_at' => 'nullable|date',
        ]);

        if ($validated['title'] !== $news->title) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $validated['status'] = $request->has('publish') ? 'published' : 'draft';

        if ($request->hasFile('featured_image')) {
            if ($news->featured_image) {
                Storage::disk('public')->delete($news->featured_image);
            }
            $path = $request->file('featured_image')->store('news', 'public');
            $validated['featured_image'] = $path;
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')
                       ->with('success', 'Berita berhasil diperbarui!');
    }

    // Hapus berita
    public function destroyNews(News $news)
    {
        if ($news->featured_image) {
            Storage::disk('public')->delete($news->featured_image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')
                       ->with('success', 'Berita berhasil dihapus!');
    }

    // Publish berita
    public function publishNews(News $news)
    {
        $news->update(['status' => 'published']);
        return redirect()->back()->with('success', 'Berita berhasil dipublikasikan!');
    }

    // Unpublish berita
    public function unpublishNews(News $news)
    {
        $news->update(['status' => 'draft']);
        return redirect()->back()->with('success', 'Berita berhasil di-unpublish!');
    }
}