<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InputAspirasi extends Model
{
    protected $table = 'input_aspirasi';
    protected $primaryKey = 'Id_pelaporan';
    public $incrementing = false;
    protected $fillable = ['Id_pelaporan', 'nis', 'id_kategori', 'lokasi', 'ket', 'foto'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'Id_kategori');
    }

    public function aspirasi()
    {
        return $this->hasOne(Aspirasi::class, 'id_pelaporan', 'Id_pelaporan');
    }
}
