<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Siswa - Login & Registrasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 min-h-screen text-slate-800 flex items-center justify-center p-4">

    <div class="max-w-4xl w-full">
        
        <!-- Flash Messages -->
        @if (session('success'))
            <div class="mb-6 bg-green-50 text-green-700 border border-green-200 p-4 rounded-xl flex items-center justify-center text-center font-medium shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid md:grid-cols-2 gap-8 md:gap-12">
            
            <!-- BAGIAN LOGIN -->
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
                <h2 class="text-2xl font-bold mb-2">Selamat Datang </h2>
                <p class="text-gray-500 mb-8">Masuk untuk melihat atau membuat laporan baru.</p>
                
                @if ($errors->has('nis') && !session('is_register'))
                    <div class="text-red-600 bg-red-50 border border-red-100 p-3 mb-6 rounded-lg text-sm">{{ $errors->first('nis') }}</div>
                @endif
                
                <form action="/login/siswa" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nomor Induk Siswa (NIS)</label>
                        <input type="text" name="nis" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors outline-none" placeholder="Masukkan NIS Anda">
                    </div>
                    <button type="submit" class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold transition-colors shadow-sm">Masuk Dashboard</button>
                </form>
            </div>

            <!-- BAGIAN REGISTER -->
            <div class="bg-slate-800 p-8 rounded-2xl shadow-sm border border-slate-700 text-white flex flex-col justify-center">
                <h2 class="text-2xl font-bold mb-2">Buat Akun Baru</h2>
                <p class="text-slate-400 mb-8">Belum punya akun? Daftar dengan NIS & Kelas.</p>
                
                @if ($errors->any() && session('is_register'))
                    <div class="text-red-400 bg-red-900/30 border border-red-800 p-3 mb-6 rounded-lg text-sm">{{ $errors->first() }}</div>
                @endif
                
                <form action="/register/siswa" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1.5">Nomor Induk Siswa (NIS)</label>
                        <input type="number" name="nis" required class="w-full px-4 py-3 bg-slate-900/50 border border-slate-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors outline-none text-white plaecholder-slate-500" placeholder="Ketik NIS">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1.5">Kelas (Maks 10 Huruf)</label>
                        <input type="text" name="kelas" required maxlength="10" placeholder="Misal: XII RPL 1" class="w-full px-4 py-3 bg-slate-900/50 border border-slate-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors outline-none text-white plaecholder-slate-500">
                    </div>

                    <button type="submit" class="w-full py-3.5 bg-indigo-500 hover:bg-indigo-600 text-white rounded-xl font-semibold transition-colors shadow-sm">Daftar Sekarang</button>
                </form>
            </div>

        </div>

        <div class="text-center mt-12">
            <a href="/login/admin" class="text-sm text-gray-400 hover:text-blue-600 transition-colors inline-block border-b border-dashed border-gray-300 hover:border-blue-600 pb-1">
                Karyawan/Admin? Masuk di sini
            </a>
        </div>
        
    </div>

</body>
</html>
