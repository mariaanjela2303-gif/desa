<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\VillageProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = VillageProfile::firstOrCreate([], [
            'village_name' => 'Desa Tautpah',
            'district' => 'Biboki Selatan',
            'regency' => 'Timor Tengah Utara',
            'province' => 'Nusa Tenggara Timur',
        ]);

        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = VillageProfile::firstOrCreate([]);

        $validated = $request->validate([
            'village_name' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'regency' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'about' => ['nullable', 'string'],
            'history' => ['nullable', 'string'],
            'vision' => ['nullable', 'string'],
            'mission' => ['nullable', 'string'],
            'leader_name' => ['nullable', 'string', 'max:255'],
            'welcome_message' => ['nullable', 'string'],
            'leader_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        $photoPath = $profile->leader_photo;
        if ($request->hasFile('leader_photo')) {
            if ($profile->leader_photo && Storage::disk('public')->exists($profile->leader_photo)) {
                Storage::disk('public')->delete($profile->leader_photo);
            }
            $photoPath = $request->file('leader_photo')->store('profile', 'public');
        }

        $profile->update([
            'village_name' => $validated['village_name'],
            'district' => $validated['district'],
            'regency' => $validated['regency'],
            'province' => $validated['province'],
            'about' => $validated['about'],
            'history' => $validated['history'],
            'vision' => $validated['vision'],
            'mission' => $validated['mission'],
            'leader_name' => $validated['leader_name'],
            'welcome_message' => $validated['welcome_message'],
            'leader_photo' => $photoPath,
        ]);

        ActivityLog::record(
            'EDIT',
            'Profil Desa',
            'Memperbarui data profil, sejarah, visi misi, atau sambutan kepala desa.'
        );

        return back()->with('success', 'Profil Desa berhasil diperbarui.');
    }
}
