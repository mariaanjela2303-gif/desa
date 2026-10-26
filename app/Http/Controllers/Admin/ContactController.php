<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\ContactSetting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function edit()
    {
        $contact = ContactSetting::firstOrCreate([], [
            'address' => 'Kantor Desa Tautpah, Kec. Biboki Selatan, Kab. Timor Tengah Utara, NTT',
            'phone' => '0812-XXXX-XXXX',
            'email' => 'kantor@tautpah.desa.id',
            'service_hours' => 'Senin - Jumat, 08.00 - 15.00 WITA',
        ]);

        return view('admin.contact.edit', compact('contact'));
    }

    public function update(Request $request)
    {
        $contact = ContactSetting::firstOrCreate([]);

        $validated = $request->validate([
            'address' => ['required', 'string'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:100'],
            'service_hours' => ['nullable', 'string', 'max:255'],
            'maps_embed_url' => ['nullable', 'string'],
        ]);

        $contact->update($validated);

        ActivityLog::record(
            'EDIT',
            'Kontak & Layanan',
            'Memperbarui informasi alamat, kontak pelayanan, jam buka, atau peta lokasi kantor desa.'
        );

        return back()->with('success', 'Informasi kontak dan pelayanan berhasil disimpan.');
    }
}
