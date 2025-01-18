<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ViewMemberList extends Model
{
    use HasFactory;

    protected $table = 'view_member_list';
    public $timestamps = false;
}
