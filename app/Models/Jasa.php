<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    use HasFactory;
    protected $table = 'jasa';
    protected $primaryKey = 'id_jasa';
    protected $fillable = ['nama_jasa', 'id_mekanik', 'harga'];

    public function mekanik()
    {
        return $this->belongsTo(Mekanik::class, 'id_mekanik');
    }
}
