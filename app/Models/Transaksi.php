<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    public $timestamps = false;

    // relation with member
    public function member() {
        return $this->belongsTo(Member::class, 'id_member', 'id_member');
    }

    // relation with paket member
    public function paketMember() {
        return $this->belongsTo(PaketMember::class, 'id_paket', 'id_paket');
    }
}
