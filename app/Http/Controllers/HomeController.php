<?php

namespace App\Http\Controllers;

use App\Models\GarbageType;
use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $transactions = Transaction::latest()->get();
        $types = GarbageType::all();

        $stats = GarbageType::withSum('transactions','weight')->get();

        $label = $stats->pluck('name');
        $count = $stats->pluck('transactions_sum_weight');
        $color = $stats->pluck('color');



        return view('pages.home',[
            'transactions' => $transactions,
            'types' => $types,
            'label' => $label,
            'count' => $count,
            'color' => $color,
        ]);
    }
}
