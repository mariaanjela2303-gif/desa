<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Gallery::query();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $galleries = $query->latest()->paginate(12)->withQueryString();

        return view('admin.galleries.index', compact('galleries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:foto,video'],
            'file_path' => ['nullable', 'required_if:type,foto', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'video_url' => ['nullable', 'required_if:type,video', 'url', 'max:255'],
            'caption' => ['nullable', 'string', 'max:500'],
        ], [
            'title.required' => 'Judul galeri wajib diisi.',
            'file_path.required_if' => 'File foto wajib diunggah untuk tipe Foto.',
            'video_url.required_if' => 'Tautan video wajib diisi untuk tipe Video.',
            'video_url.url' => 'Format URL tautan video tidak valid.',
        ]);

        $path = null;
        if ($request->hasFile('file_path')) {
            $path = $request->file('file_path')->store('galleries', 'public');
        }

        $gallery = Gallery::create([
            'title' => $validated['title'],
            'type' => $validated['type'],
            'file_path' => $path,
            'video_url' => $validated['video_url'] ?? null,
            'caption' => $validated['caption'],
        ]);

        ActivityLog::record(
            'TAMBAH',
            'Galeri',
            "Menambahkan galeri {$gallery->type}: '{$gallery->title}'."
        );

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:foto,video'],
            'file_path' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'video_url' => ['nullable', 'required_if:type,video', 'url', 'max:255'],
            'caption' => ['nullable', 'string', 'max:500'],
        ]);

        $path = $gallery->file_path;
        if ($request->hasFile('file_path')) {
            if ($gallery->file_path && Storage::disk('public')->exists($gallery->file_path)) {
                Storage::disk('public')->delete($gallery->file_path);
            }
            $path = $request->file('file_path')->store('galleries', 'public');
        }

        $gallery->update([
            'title' => $validated['title'],
            'type' => $validated['type'],
            'file_path' => $path,
            'video_url' => $validated['type'] === 'video' ? $validated['video_url'] : null,
            'caption' => $validated['caption'],
        ]);

        ActivityLog::record(
            'EDIT',
            'Galeri',
            "Memperbarui galeri {$gallery->type}: '{$gallery->title}'."
        );

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        $title = $gallery->title;
        $type = $gallery->type;

        if ($gallery->file_path && Storage::disk('public')->exists($gallery->file_path)) {
            Storage::disk('public')->delete($gallery->file_path);
        }

        $gallery->delete();

        ActivityLog::record(
            'HAPUS',
            'Galeri',
            "Menghapus galeri {$type}: '{$title}'."
        );

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil dihapus.');
    }
}
