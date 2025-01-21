<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ViewMemberTransactionList;

class TransactionController extends Controller
{
    function index(Request $request){
        $transaction = ViewMemberTransactionList::query();

        $filter = $request->input('filter');

        if($filter === 'today') {
            $transaction->where('tanggal_transaksi', date('Y-m-d'));
        } elseif ($filter === 'week') {
            $transaction->whereBetween('tanggal_transaksi', [date('Y-m-d', strtotime('-1 week')), date('Y-m-d')]);
        } elseif ($filter === 'month') {
            $transaction->where('tanggal_transaksi', '>=', date('Y-m-01'));
        }

        $transaction = $transaction->paginate(5);
        return view('admin.transaksi', compact('transaction'));
    }
}
