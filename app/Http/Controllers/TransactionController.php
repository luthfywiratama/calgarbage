<?php

namespace App\Http\Controllers;

use App\Models\GarbageType;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function transaction(Request $request)
    {
        $data = $request->except('type');
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'weight' => ['required', 'numeric', 'min:1'],
            'type' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $type = GarbageType::find($request->type);

        $data['garbage_type_id'] = $type->id;
        $data['total_payment']  = $request->weight * $type->price;
        $data['status']  = 'pending';

        Transaction::create($data);

        return back()->with('success','Berhasil Setor Sampah');
    }
}
