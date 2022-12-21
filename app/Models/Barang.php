<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tempat;
use App\Models\Kategori;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $guarded = [];

    public function tempat(){
        return $this->belongsTo(Tempat::class);
    }

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }
}
