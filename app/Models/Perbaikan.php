<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    use HasFactory;
    protected $table = 'perbaikan';
    protected $primaryKey = 'id_perbaikan';
    protected $fillable = ['id_user', 'nama_mobil', 'plat_mobil', 'tentang_kerusakan', 'id_mekanik', 'tanggal_mulai', 'status', 'tanggal_selesai', 'harga_total'];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'perbaikan_item', 'id_perbaikan', 'id_item');
    }

    public function jasa()
    {
        return $this->belongsToMany(Jasa::class, 'perbaikan_jasa', 'id_perbaikan', 'id_jasa');
    }
}
