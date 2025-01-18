<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaketMember extends Model
{
    use HasFactory;

    protected $table = 'paket_member';
    protected $primaryKey = 'id_paket';
    public $timestamps = false;

    // Relasi ke tabel transaksi
    public function transaksi() {
        return $this->hashMany(Transaksi::class, 'id_paket', 'id_paket');
    }
    
    // relation with member
    public function member() {
        return $this->hashMany(Member::class, 'id_paket', 'id_paket');
    }

    // Relasi ke tabel admin
    public function admin(){
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
}
