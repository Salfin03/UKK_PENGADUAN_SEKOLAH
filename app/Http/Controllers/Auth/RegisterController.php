<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;

class RegisterController extends Controller
{
    public function indexSiswa()
    {
        if (Auth::guard("siswa")->check()) {
            return redirect("/siswa/dashboard");
        }
        return redirect("/login/siswa");
    }

    public function storeSiswa(Request $request)
    {
        try {
            $request->validate([
                "nis" => "required|numeric|unique:siswa,nis",
                "kelas" => "required|string|max:10"
            ]);

            $dataSiswaBaru = [
                "nis" => $request->nis,
                "kelas" => $request->kelas
            ];

            Siswa::create($dataSiswaBaru);

            return redirect("/login/siswa")->with("success", "Registrasi siswa berhasil! Silakan gunakan NIS Anda untuk Login di panel sebelahnya.");
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect("/login/siswa")->withErrors($e->errors())->with("is_register", true);
        } catch (\Exception $e) {
            return redirect("/login/siswa")->withErrors(["nis" => "Gagal mendaftar. Format NIS tidak valid/Sudah terdaftar."])->with("is_register", true);
        }
    }
}