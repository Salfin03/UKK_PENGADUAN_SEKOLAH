<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    protected $table = 'aspirasi';
    protected $primaryKey = 'id_aspirasi';
    public $incrementing = false;
    protected $fillable = ['id_aspirasi', 'status', 'id_pelaporan', 'feedback'];

    public function inputAspirasi()
    {
        return $this->belongsTo(InputAspirasi::class, 'id_pelaporan', 'Id_pelaporan');
    }
}
