<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    public $timestamps = false;

    // relation with member
    public function member() {
        return $this->hashMany(Member::class, 'id_admin', 'id_admin');
    }

    // relation with paket member
    public function paketMember() {
        return $this->hashMany(PaketMember::class, 'id_admin', 'id_admin');
    }
}
