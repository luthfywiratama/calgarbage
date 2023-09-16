<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();

        return view('pages.admin.transaction.index',['transactions' => $transactions]);
    }

    public function update(Request $request,$id)
    {
        Transaction::where('id',$id)->update([
            'status' => 'diterima'
        ]);

        return back()->with('success','Berhasil Update');
    }
}
