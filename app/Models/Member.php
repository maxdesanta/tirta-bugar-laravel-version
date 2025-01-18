<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;

    protected $table = 'member';
    protected $primaryKey = 'id_member';
    public $timestamps = false;

    // Relasi ke tabel transaksi
    public function transaksi() {
        return $this->hashMany(Transaksi::class, 'id_member', 'id_member');
    }

    // Relasi ke tabel paket_member
    public function paketMember() {
        return $this->belongsTo(PaketMember::class, 'id_paket', 'id_paket');
    }

    // Relasi ke tabel admin
    public function admin() {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }

    // Relasi ke tabel transaksi
    public function absenHarian() {
        return $this->hashMany(Transaksi::class, 'id_member', 'id_member');
    }
}
