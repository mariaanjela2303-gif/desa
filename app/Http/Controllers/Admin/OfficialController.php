<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Official;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfficialController extends Controller
{
    public function index()
    {
        $officials = Official::orderBy('order')->get();
        return view('admin.officials.index', compact('officials'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:active,inactive'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('officials', 'public');
        }

        $official = Official::create([
            'name' => $validated['name'],
            'position' => $validated['position'],
            'order' => $validated['order'] ?? 0,
            'status' => $validated['status'],
            'photo' => $photoPath,
        ]);

        ActivityLog::record(
            'TAMBAH',
            'Struktur Pemerintahan',
            "Menambahkan perangkat desa: '{$official->name}' ({$official->position})."
        );

        return redirect()->route('admin.officials.index')->with('success', 'Perangkat desa berhasil ditambahkan.');
    }

    public function update(Request $request, Official $official)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:active,inactive'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        $photoPath = $official->photo;
        if ($request->hasFile('photo')) {
            if ($official->photo && Storage::disk('public')->exists($official->photo)) {
                Storage::disk('public')->delete($official->photo);
            }
            $photoPath = $request->file('photo')->store('officials', 'public');
        }

        $official->update([
            'name' => $validated['name'],
            'position' => $validated['position'],
            'order' => $validated['order'] ?? 0,
            'status' => $validated['status'],
            'photo' => $photoPath,
        ]);

        ActivityLog::record(
            'EDIT',
            'Struktur Pemerintahan',
            "Memperbarui perangkat desa: '{$official->name}' ({$official->position})."
        );

        return redirect()->route('admin.officials.index')->with('success', 'Perangkat desa berhasil diperbarui.');
    }

    public function destroy(Official $official)
    {
        $name = $official->name;
        $position = $official->position;

        if ($official->photo && Storage::disk('public')->exists($official->photo)) {
            Storage::disk('public')->delete($official->photo);
        }

        $official->delete();

        ActivityLog::record(
            'HAPUS',
            'Struktur Pemerintahan',
            "Menghapus perangkat desa: '{$name}' ({$position})."
        );

        return redirect()->route('admin.officials.index')->with('success', 'Perangkat desa berhasil dihapus.');
    }
}
