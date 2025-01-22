<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    public $timestamps = false;
    protected $guard = 'admin';

    protected $fillable = [
        'username',
        'email',
        'password',
        'verify_token'
    ];

    protected $hidden = [
        'password',
        'verify_token',
    ];
    
    // relation with member
    public function member() {
        return $this->hasMany(Member::class, 'id_admin', 'id_admin');
    }

    // relation with paket member
    public function paketMember() {
        return $this->hasMany(PaketMember::class, 'id_admin', 'id_admin');
    }
}
