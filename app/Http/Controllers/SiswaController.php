<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\InputAspirasi;
use App\Models\Aspirasi;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function index()
    {
        $nis = Auth::guard('siswa')->user()->nis;
        $aspirasis = Aspirasi::whereHas('inputAspirasi', function($q) use ($nis) {
            $q->where('nis', $nis);
        })->with('inputAspirasi.kategori')->orderBy('created_at', 'desc')->get();

        $kategoris = Kategori::all();

        return view('siswa.dashboard', compact('aspirasis', 'kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required',
            'lokasi' => 'required|max:50',
            'ket' => 'required|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('aspirasi_foto', 'public');
        }

        $id_pelaporan = InputAspirasi::max('Id_pelaporan') + 1 ?: 1;

        $input = InputAspirasi::create([
            'Id_pelaporan' => $id_pelaporan,
            'nis' => Auth::guard('siswa')->user()->nis,
            'id_kategori' => $request->id_kategori,
            'lokasi' => $request->lokasi,
            'ket' => $request->ket,
            'foto' => $fotoPath,
        ]);

        $id_aspirasi = Aspirasi::max('id_aspirasi') + 1 ?: 1;

        Aspirasi::create([
            'id_aspirasi' => $id_aspirasi,
            'status' => 'Menunggu',
            'id_pelaporan' => $input->Id_pelaporan,
            'feedback' => null
        ]);

        return redirect()->route('siswa.dashboard')->with('success', 'Aspirasi berhasil dikirim!');
    }

    public function destroy($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);

        if ($aspirasi->status !== 'Menunggu') {
            return back()->withErrors(['error' => 'Aspirasi yang sudah Diproses atau Selesai tidak dapat dihapus.']);
        }

        $inputAspirasi = InputAspirasi::where('Id_pelaporan', $aspirasi->id_pelaporan)
            ->where('nis', Auth::guard('siswa')->user()->nis)
            ->firstOrFail();

        if ($inputAspirasi->foto && Storage::disk('public')->exists($inputAspirasi->foto)) {
            Storage::disk('public')->delete($inputAspirasi->foto);
        }

        $aspirasi->delete();
        $inputAspirasi->delete();

        return back()->with('success', 'Aspirasi kamu berhasil dihapus.');
    }
}
