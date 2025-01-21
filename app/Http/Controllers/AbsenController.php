<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ViewMemberAbsenList;

class AbsenController extends Controller
{
    function index(Request $request) {
        $search = $request->input('search');

        $absen = ViewMemberAbsenList::when($search, function($query) use ($search){
            return $query->where('nama_member', 'ILIKE', '%' . $search . '%');
        })->paginate(5)->withQueryString();

        return view('admin.absen', compact('absen', 'search'));
    }
}
