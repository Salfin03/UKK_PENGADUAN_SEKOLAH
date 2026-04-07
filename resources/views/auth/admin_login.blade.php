<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 min-h-screen text-slate-800 flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-white rounded-2xl shadow-sm border border-gray-100 p-8 sm:p-10">
        
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Login Portal Admin</h2>
            <p class="text-sm text-gray-500 mt-2">Sistem Informasi Pengaduan Sekolah</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 bg-red-50 text-red-600 border border-red-100 p-4 rounded-xl text-sm flex items-center shadow-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="/login/admin" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                <input type="text" name="Username" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors outline-none" placeholder="Ketik username Anda">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors outline-none" placeholder="">
            </div>

            <button type="submit" class="w-full py-3.5 bg-slate-800 hover:bg-slate-900 text-white rounded-xl font-semibold transition-colors shadow-sm mt-4">
                Masuk Sistem
            </button>
        </form>

        <div class="mt-8 text-center border-t border-gray-100 pt-6">
            <a href="/login/siswa" class="text-sm font-medium text-blue-600 hover:text-blue-700 transition">
                 Kembali ke Portal Siswa
            </a>
        </div>

    </div>

</body>
</html>
