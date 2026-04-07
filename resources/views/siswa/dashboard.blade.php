<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen font-sans">
    
    <!-- Navbar -->
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-bold text-lg">
                    S
                </div>
                <div>
                    <h2 class="font-bold text-lg leading-tight text-slate-800">Halo, {{ auth()->guard('siswa')->user()->nis }}!</h2>
                    <p class="text-xs text-slate-500">Siswa Area</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf 
                <button type="submit" class="px-4 py-2 bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-700 font-medium rounded-lg text-sm transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar Sistem
                </button>
            </form>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Alerts -->
        @if(session('success'))
            <div class="mb-6 bg-emerald-50 text-emerald-700 border border-emerald-200 p-4 rounded-xl flex items-center shadow-sm">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="mb-6 bg-rose-50 text-rose-700 border border-rose-200 p-4 rounded-xl flex items-center shadow-sm">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                {{ $errors->first() }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <!-- BAGIAN KIRI: Form Input -->
            <div class="lg:col-span-1 bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                <div class="mb-6">
                    <h3 class="text-xl font-bold tracking-tight text-slate-800">Kirim Aspirasi</h3>
                    <p class="text-sm text-slate-500 mt-1">Sampaikan keluhan/pesanmu di sini</p>
                </div>
                
                <form action="{{ route('siswa.aspirasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Kategori</label>
                        <select name="id_kategori" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm transition-colors outline-none h-11">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat->Id_kategori }}">{{ $kat->ket_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Ruang / Lokasi</label>
                        <input type="text" name="lokasi" required maxlength="50" placeholder="Misal: Lab Komputer" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm transition-colors outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Deskripsi Lengkap</label>
                        <textarea name="ket" required rows="3" maxlength="50" placeholder="Jelaskan aspirasi Anda..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm transition-colors outline-none resize-none"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Membawa Foto? (Opsional)</label>
                        <input type="file" name="foto" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">
                    </div>

                    <button type="submit" class="w-full py-3 mt-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold transition shadow-sm text-sm flex justify-center items-center gap-2">
                        Kirim Laporan
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                    </button>
                </form>
            </div>

            <!-- BAGIAN KANAN: Histori -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-xl font-bold tracking-tight text-slate-800">Riwayat Pengaduanmu</h3>
                    <p class="text-sm text-slate-500 mt-1">Pantau respons admin atas laporan yang kamu buat</p>
                </div>
                
                <div class="overflow-x-auto p-0">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider">
                                <th class="px-6 py-4 font-semibold border-b border-slate-200">ID</th>
                                <th class="px-6 py-4 font-semibold border-b border-slate-200 w-1/3">Detail Isi Laporan</th>
                                <th class="px-6 py-4 font-semibold border-b border-slate-200 text-center">Status</th>
                                <th class="px-6 py-4 font-semibold border-b border-slate-200">Tanggapan Admin</th>
                                <th class="px-6 py-4 font-semibold border-b border-slate-200 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($aspirasis as $asp)
                            <tr class="hover:bg-slate-50/50 transition duration-150">
                                <td class="px-6 py-4 text-sm font-semibold text-slate-500 text-center">#{{ $asp->id_aspirasi }}</td>
                                <td class="px-6 py-4">
                                    <div class="text-xs text-blue-600 font-bold uppercase mb-1">{{ $asp->inputAspirasi->kategori->ket_kategori ?? 'Tanpa Kat' }}</div>
                                    <div class="text-xs text-slate-500 mb-1">Pengirim: <span class="font-bold text-slate-700">{{ $asp->inputAspirasi->nis }}</span></div>
                                    <div class="text-sm font-medium text-slate-800">{{ $asp->inputAspirasi->lokasi }}</div>
                                    <div class="text-sm text-slate-500 mt-1 line-clamp-2">"{{ $asp->inputAspirasi->ket }}"</div>
                                    
                                    @if($asp->inputAspirasi->foto)
                                        <a href="{{ asset('storage/' . $asp->inputAspirasi->foto) }}" target="_blank" class="inline-flex items-center gap-1 mt-2 text-xs font-semibold text-blue-600 hover:text-blue-800 bg-blue-50 px-2 py-1 rounded-md transition">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                            Lihat Bukti Foto
                                        </a>
                                    @endif
                                    <div class="text-[10px] text-slate-400 mt-3">{{ $asp->created_at->format('d M Y, H:i') }} WIB</div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($asp->status == 'Menunggu') 
                                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-600 border border-amber-200">Menunggu</span>
                                    @elseif($asp->status == 'Proses') 
                                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-600 border border-blue-200">Diproses</span>
                                    @else 
                                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-600 border border-emerald-200">Selesai</span> 
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($asp->feedback)
                                        <span class="text-sm text-slate-600 italic">"{{ $asp->feedback }}"</span>
                                    @else
                                        <span class="text-xs text-slate-400">- Belum dibalas -</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($asp->status == 'Menunggu')
                                        <form action="{{ route('siswa.aspirasi.destroy', $asp->id_aspirasi) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus permanen?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 bg-white border border-rose-200 text-rose-500 hover:bg-rose-50 hover:border-rose-300 rounded-lg transition-colors" title="Hapus Laporan">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    @else
                                        <span class="inline-flex px-2 py-1 bg-slate-100 text-slate-400 rounded-md text-[10px] font-semibold tracking-wide" title="Tidak bisa dihapus karena sudah direspon Admin">TERKUNCI</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-sm text-slate-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                        Kamu belum pernah membuat satupun pengaduan.
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

</body>
</html>
