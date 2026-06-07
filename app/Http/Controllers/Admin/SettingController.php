<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    /**
     * Display the payment settings management panel.
     */
    public function index()
    {
        $settings = [
            'qris_image' => Setting::get('qris_image', '/images/qris.png'),
            'bank_name' => Setting::get('bank_name', 'NOBU BANK'),
            'bank_account_number' => Setting::get('bank_account_number', '1031-0988-1234'),
            'bank_account_name' => Setting::get('bank_account_name', 'Yayasan Pedulia'),
            'whatsapp_number' => Setting::get('whatsapp_number', '6281234567890'),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update payment settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'qris_image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'bank_name' => 'required|string|max:100',
            'bank_account_number' => 'required|string|max:100',
            'bank_account_name' => 'required|string|max:150',
            'whatsapp_number' => 'required|string|max:30',
        ], [
            'qris_image.image' => 'File QRIS harus berupa gambar.',
            'qris_image.mimes' => 'Format gambar QRIS wajib jpeg, png, jpg, atau svg.',
            'qris_image.max' => 'Ukuran gambar QRIS tidak boleh melebihi 2MB.',
            'bank_name.required' => 'Nama bank wajib diisi.',
            'bank_account_number.required' => 'Nomor rekening wajib diisi.',
            'bank_account_name.required' => 'Nama pemilik rekening wajib diisi.',
            'whatsapp_number.required' => 'Nomor WhatsApp konfirmasi wajib diisi.',
        ]);

        // Process QRIS Image upload if present
        if ($request->hasFile('qris_image')) {
            $file = $request->file('qris_image');
            $filename = 'qris_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            Setting::set('qris_image', '/images/' . $filename);
        }

        // Save other configurations
        Setting::set('bank_name', $request->input('bank_name'));
        Setting::set('bank_account_number', $request->input('bank_account_number'));
        Setting::set('bank_account_name', $request->input('bank_account_name'));
        
        // Clean whatsapp number (remove plus sign, spaces, dashes)
        $wa = preg_replace('/[^0-9]/', '', $request->input('whatsapp_number'));
        Setting::set('whatsapp_number', $wa);

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan sistem pembayaran manual berhasil diperbarui.');
    }
}
