<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShortLinkController extends Controller
{
    // Menampilkan halaman admin (Daftar Link & QR Code)
    public function index()
    {
        $links = ShortLink::latest()->get();
        return view('short_links.index', compact('links'));
    }

    // Menampilkan form tambah link baru
    public function create()
    {
        return view('short_links.create');
    }

    // Menyimpan link baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'destination_url' => 'required|url',
            'short_code' => 'nullable|string|unique:short_links,short_code|max:50'
        ]);

        // Jika short_code kosong, buat string acak 6 karakter
        $shortCode = $request->short_code ? Str::slug($request->short_code) : Str::random(6);

        ShortLink::create([
            'title' => $request->title,
            'short_code' => $shortCode,
            'destination_url' => $request->destination_url,
        ]);

        return redirect()->route('short_links.index')->with('success', 'QR Code berhasil dibuat!');
    }

    // Menampilkan form edit (Hanya edit URL tujuan)
    public function edit(ShortLink $shortLink)
    {
        return view('short_links.edit', compact('shortLink'));
    }

    // Menyimpan perubahan URL tujuan
    public function update(Request $request, ShortLink $shortLink)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'destination_url' => 'required|url',
        ]);

        // PERHATIKAN: Kita TIDAK mengizinkan update 'short_code'. 
        // Inilah kunci mengapa QR Code fisik tetap berlaku selamanya.
        $shortLink->update([
            'title' => $request->title,
            'destination_url' => $request->destination_url,
        ]);

        return redirect()->route('short_links.index')->with('success', 'Link Tujuan diperbarui! QR Code fisik tidak perlu dicetak ulang.');
    }

    // Logika ketika QR Code dipindai oleh Google Lens / User
    public function redirectUrl($short_code)
    {
        $link = ShortLink::where('short_code', $short_code)->firstOrFail();

        // Tambah 1 pada statistik klik
        $link->increment('clicks');

        // Alihkan user ke URL asli
        return redirect()->away($link->destination_url);
    }
}
