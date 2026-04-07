<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'Id_kategori';
    public $incrementing = false;
    protected $fillable = ['Id_kategori', 'ket_kategori'];
}
