<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ViewMemberTransactionList;

class TransactionController extends Controller
{
    function index(){
        $transaction = ViewMemberTransactionList::all();
        return view('admin.transaksi', compact('transaction'));
    }
}
