<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Optional;

class NewsController extends Controller
{
    // Tampilkan semua berita
    public function index()
    {
        $news = News::published()->paginate(10);
        return view('news.index', compact('news'));
    }

    // Form create berita
    public function create()
    {
        $categories = ['Alumni', 'Acara', 'Prestasi', 'Beasiswa', 'Pengumuman', 'Lainnya'];
        return view('news.create', compact('categories'));
    }

    // Store berita baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:10',
            'category' => 'required|string|in:Alumni,Acara,Prestasi,Beasiswa,Pengumuman,Lainnya',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['author'] = auth()->user()->name ?? 'Anonymous';
        $validated['status'] = $request->has('publish') ? 'published' : 'draft';

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('news', 'public');
            $validated['featured_image'] = $path;
        }

        News::create($validated);

        return redirect()->route('news.index')
                       ->with('success', 'Berita berhasil dibuat!');
    }

    // Tampilkan detail berita
    public function show(News $news)
    {
        $news->incrementViews();
        
        $relatedNews = News::published()
                           ->byCategory($news->category)
                           ->where('id', '!=', $news->id)
                           ->limit(5)
                           ->get();

        return view('news.show', compact('news', 'relatedNews'));
    }

    // Form edit berita
    public function edit(News $news)
    {
        $categories = ['Alumni', 'Acara', 'Prestasi', 'Beasiswa', 'Pengumuman', 'Lainnya'];
        return view('news.edit', compact('news', 'categories'));
    }

    // Update berita
    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
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

        return redirect()->route('news.show', $news)
                       ->with('success', 'Berita berhasil diperbarui!');
    }

    // Hapus berita
    public function destroy(News $news)
    {
        if ($news->featured_image) {
            Storage::disk('public')->delete($news->featured_image);
        }

        $news->delete();

        return redirect()->route('news.index')
                       ->with('success', 'Berita berhasil dihapus!');
    }
}