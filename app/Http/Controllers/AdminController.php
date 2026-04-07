<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Models\InputAspirasi;
use App\Models\Siswa;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * PROSEDUR / FUNGSI: Mengambil statistik aspirasi dengan query efisien dan array
     */
    private function getStatistikAspirasi(): array
    {
        // QUERY EFISIEN: Menghitung semua status dalam 1 kali query (bukan 4 query terpisah)
        $statusCounts = Aspirasi::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray(); // PENGGUNAAN ARRAY

        // Array hasil statistik
        return [
            'totalAspirasi' => array_sum($statusCounts),
            'menunggu' => $statusCounts['Menunggu'] ?? 0,
            'proses' => $statusCounts['Proses'] ?? 0,
            'selesai' => $statusCounts['Selesai'] ?? 0,
        ];
    }

    /**
     * PROSEDUR / FUNGSI: Mendapatkan data aspirasi yang difilter dengan eager loading
     */
    private function getDataAspirasiFiltered(Request $request)
    {
        // QUERY EFISIEN: Menggunakan Eager Loading (with) untuk menghindari N+1 queries issue
        $query = Aspirasi::with(['inputAspirasi.siswa', 'inputAspirasi.kategori']);

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }
        if ($request->filled('bulan')) {
            $query->whereMonth('created_at', str_pad($request->bulan, 2, '0', STR_PAD_LEFT));
        }
        if ($request->filled('nis')) {
            $query->whereHas('inputAspirasi', function($q) use ($request) {
                $q->where('nis', $request->nis);
            });
        }
        if ($request->filled('id_kategori')) {
            $query->whereHas('inputAspirasi', function($q) use ($request) {
                $q->where('id_kategori', $request->id_kategori);
            });
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function index(Request $request)
    {
        // Panggilan Fungsi/Prosedur
        $statistik = $this->getStatistikAspirasi();
        $aspirasis = $this->getDataAspirasiFiltered($request);
        $kategoris = Kategori::all();
        
        $totalSiswa = Siswa::count();

        // PENGGUNAAN ARRAY: Menggabungkan data statistik dan data collection ke view
        $viewData = array_merge($statistik, [
            'aspirasis' => $aspirasis,
            'kategoris' => $kategoris,
            'totalSiswa' => $totalSiswa
        ]);

        return view('admin.dashboard', $viewData);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Proses,Selesai',
            'feedback' => 'nullable|string'
        ]);
        
        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->update([
            'status' => $request->status,
            'feedback' => $request->feedback
        ]);

        return back()->with('success', 'Status dan umpan balik berhasil diubah.'); 
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:Menunggu,Proses,Selesai']);
        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->update(['status' => $request->status]);

        return back()->with('success', 'Status penyelesaian berhasil diubah.');
    }
    public function storeKategori(Request $request)
    {
        $request->validate([
            'ket_kategori' => 'required|max:30|unique:kategori,ket_kategori'
        ]);

        $id_kategori = Kategori::max('Id_kategori') + 1 ?: 1;

        Kategori::create([
            'Id_kategori' => $id_kategori,
            'ket_kategori' => $request->ket_kategori
        ]);

        return back()->with('success', 'Kategori baru berhasil ditambahkan.');
    }
    public function updateFeedback(Request $request, $id)
    {
        $request->validate(['feedback' => 'required']);
        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->update(['feedback' => $request->feedback]);

        return back()->with('success', 'Umpan balik berhasil dikirim.');
    }

    public function destroy($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);
        $inputAspirasi = InputAspirasi::where('Id_pelaporan', $aspirasi->id_pelaporan)->first();

        if ($inputAspirasi) {
            if ($inputAspirasi->foto && Storage::disk('public')->exists($inputAspirasi->foto)) {
                Storage::disk('public')->delete($inputAspirasi->foto);
            }
        }
        
        $aspirasi->delete();
        if ($inputAspirasi) {
            $inputAspirasi->delete();
        }

        return back()->with('success', 'Aspirasi berhasil dihapus secara permanen.');
    }


}

