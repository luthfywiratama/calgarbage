<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GarbageType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GarbageTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $d['data'] = GarbageType::all();

        return view('pages.admin.garbage_type.index',$d);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => ['required'],
            'price' => ['required', 'numeric','min:1'],
            'photo' => ['required', 'image','max:2048'],
            'color' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->with('error-create', 'true');
        }


        if ($request->photo) {
            $file = $request->file('photo');
            $filename = $file->getClientOriginalName();
            $file->move("images/photo/", $filename);
            $path = "images/photo/" . $filename;
            $data['photo'] = $path;
        } else {
            $data['photo'] = null;
        }

        GarbageType::create($data);

        return back()->with('success','Berhasil Menambah Type');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except('_token', '_method', 'photo');
        $validator = Validator::make($data, [
            'name' => ['required'],
            'price' => ['required', 'numeric', 'min:1'],
            'photo' => ['image', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->with('error-edit', 'true');
        }


        if ($request->photo) {
            $file = $request->file('photo');
            $filename = $file->getClientOriginalName();
            $file->move("images/photo/", $filename);
            $path = "images/photo/" . $filename;
            $data['photo'] = $path;

        }

        GarbageType::where('id',$id)->update($data);

        return back()->with('success', 'Berhasil Edit Type');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        GarbageType::where('id', $id)->delete();

        return back()->with('success', 'Berhasil Delete Type');
    }
}
