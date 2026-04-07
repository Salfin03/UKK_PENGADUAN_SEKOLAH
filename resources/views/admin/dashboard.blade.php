<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen font-sans">
    
    <!-- Navbar -->
    <header class="bg-indigo-900 shadow-md border-b border-indigo-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center text-white">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-indigo-500 rounded-full flex items-center justify-center font-bold text-lg shadow-inner">
                    A
                </div>
                <div>
                    <h2 class="font-bold text-lg leading-tight">Halo, Administrator!</h2>
                    <p class="text-xs text-indigo-200">Panel Kontrol Utama</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf 
                <button type="submit" class="px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white font-medium rounded-lg text-sm transition-colors flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar Sistem
                </button>
            </form>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
        
        <!-- Alerts -->
        @if(session('success'))
            <div class="bg-emerald-50 text-emerald-700 border border-emerald-200 p-4 rounded-xl flex items-center shadow-sm">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="bg-rose-50 text-rose-700 border border-rose-200 p-4 rounded-xl flex items-center shadow-sm">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Top Widgets -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <!-- Tambah Kategori Widget -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-bold text-slate-800 mb-1">Manajemen Kategori</h3>
                    <p class="text-xs text-slate-500 mb-4">Tambahkan kategori aduan baru</p>
                    <form action="{{ route('admin.kategori.store') }}" method="POST" class="flex gap-2">
                        @csrf 
                        <input type="text" name="ket_kategori" required placeholder="Nama Kategori..." class="flex-1 min-w-0 px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm outline-none">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition text-sm shadow-sm whitespace-nowrap">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>

            <!-- Total Users Widget -->
            <div class="bg-gradient-to-br from-indigo-500 to-purple-600 p-6 rounded-2xl shadow-sm flex items-center gap-6 text-white">
                <div class="p-4 bg-white/20 rounded-xl backdrop-blur-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <p class="text-indigo-100 text-sm font-medium mb-1">Total Siswa Terdaftar</p>
                    <h3 class="text-3xl font-bold">{{ $totalSiswa ?? 0 }} <span class="text-lg font-medium opacity-75 hidden sm:inline">Anggota</span></h3>
                </div>
            </div>
            
            <!-- Quick Filter Widget -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                <h3 class="text-lg font-bold text-slate-800 mb-1">Filter Laporan</h3>
                <p class="text-xs text-slate-500 mb-4">Cari berdasarkan rentang waktu</p>
                <form action="{{ route('admin.dashboard') }}" method="GET" class="space-y-3">
                    <div class="flex items-center gap-2">
                        <label class="text-xs font-semibold text-slate-600 w-12">Dari</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}" class="flex-1 px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div class="flex items-center gap-2">
                        <label class="text-xs font-semibold text-slate-600 w-12">Sampai</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}" class="flex-1 px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <button type="submit" class="w-full py-2 bg-slate-800 hover:bg-slate-900 text-white rounded-lg font-medium transition text-sm shadow-sm">
                        Terapkan Filter
                    </button>
                    @if(request('start_date') || request('end_date'))
                        <div class="mt-2 text-right text-xs">
                           <a href="{{ route('admin.dashboard') }}" class="text-rose-600 hover:underline">Hapus Filter</a>
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <!-- Tabel Histori Penuh -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h3 class="text-xl font-bold tracking-tight text-slate-800">Daftar Pengaduan Masuk</h3>
                    <p class="text-sm text-slate-500 mt-1">Review dan tindaklanjuti laporan dari siswa</p>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider">
                            <th class="px-6 py-4 font-semibold border-b border-slate-200 w-16 text-center">ID</th>
                            <th class="px-6 py-4 font-semibold border-b border-slate-200 w-48">Pengirim</th>
                            <th class="px-6 py-4 font-semibold border-b border-slate-200">Isi Laporan</th>
                            <th class="px-6 py-4 font-semibold border-b border-slate-200 w-64">Tindakan Admin</th>
                            <th class="px-6 py-4 font-semibold border-b border-slate-200 w-24 text-center">Hapus</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($aspirasis as $asp)
                        <tr class="hover:bg-slate-50/50 transition duration-150">
                            <td class="px-6 py-4 text-sm font-semibold text-slate-500 text-center">#{{ $asp->id_aspirasi }}</td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-bold text-slate-800">NIS: {{ $asp->inputAspirasi->nis }}</div>
                                <div class="text-[10px] text-slate-400 mt-1">{{ $asp->created_at->format('d M Y') }}<br>{{ $asp->created_at->format('H:i') }} WIB</div>
                                <div class="mt-3">
                                    @if($asp->status == 'Menunggu') 
                                        <span class="inline-flex px-2 py-0.5 rounded text-[10px] font-bold bg-amber-100 text-amber-700">Menunggu</span>
                                    @elseif($asp->status == 'Proses') 
                                        <span class="inline-flex px-2 py-0.5 rounded text-[10px] font-bold bg-blue-100 text-blue-700">Diproses</span>
                                    @else 
                                        <span class="inline-flex px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-700">Selesai</span> 
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-xs text-indigo-600 font-bold uppercase mb-1">{{ $asp->inputAspirasi->kategori->ket_kategori ?? 'Tanpa Kat' }}</div>
                                <div class="text-sm font-semibold text-slate-800">{{ $asp->inputAspirasi->lokasi }}</div>
                                <div class="text-sm text-slate-600 mt-1">"{{ $asp->inputAspirasi->ket }}"</div>
                                
                                @if($asp->inputAspirasi->foto)
                                    <a href="{{ asset('storage/' . $asp->inputAspirasi->foto) }}" target="_blank" class="inline-flex items-center gap-1.5 mt-3 text-xs font-semibold text-indigo-600 hover:text-indigo-800 bg-indigo-50 px-3 py-1.5 rounded-lg transition border border-indigo-100">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        Buka Lampiran Foto
                                    </a>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.aspirasi.update', $asp->id_aspirasi) }}" method="POST" class="space-y-3">
                                    @csrf 
                                    @method('PUT')
                                    <div class="flex gap-2">
                                        <select name="status" class="flex-1 px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs font-medium outline-none focus:ring-2 focus:ring-indigo-500">
                                            <option value="Menunggu" {{ $asp->status == 'Menunggu' ? 'selected' : '' }}>Set: Menunggu</option>
                                            <option value="Proses" {{ $asp->status == 'Proses' ? 'selected' : '' }}>Set: Proses</option>
                                            <option value="Selesai" {{ $asp->status == 'Selesai' ? 'selected' : '' }}>Set: Selesai</option>
                                        </select>
                                        <button type="submit" class="px-3 py-2 bg-slate-800 hover:bg-slate-900 text-white rounded-lg font-medium transition text-xs shadow-sm">
                                            Update
                                        </button>
                                    </div>
                                    <textarea name="feedback" rows="2" placeholder="Ketikan feedback (opsional)..." class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs outline-none focus:ring-2 focus:ring-indigo-500 resize-none">{{ $asp->feedback }}</textarea>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-center align-middle">
                                <form action="{{ route('admin.aspirasi.destroy', $asp->id_aspirasi) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus laporan ini? Tindakan tidak bisa dibatalkan.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="mx-auto flex p-2 bg-white border border-rose-200 text-rose-500 hover:bg-rose-50 hover:border-rose-300 rounded-lg transition-colors" title="Hapus Laporan">
                                        <svg class="w-5 h-5 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-sm text-slate-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                    Tidak ada data laporan ditemukan.
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination area placeholder (if needed) -->
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50">
                <p class="text-xs text-slate-500">Menampilkan seluruh data laporan tersimpan sesuai filter.</p>
            </div>
        </div>

    </main>

</body>
</html>
