<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AbsenHarian extends Model
{
    use HasFactory;

    protected $table = 'absen_harian';
    protected $primaryKey = 'id_pertemuan';
    public $timestamps = false;

    // relation with member
    public function member() {
        return $this->belongsTo(Member::class, 'id_member', 'id_member');
    }
}
