<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Sub_kategori;
use Illuminate\Http\Request;

class Sub_kategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Sub Kategori";
        $sub_kategori = Sub_kategori::with('kategori')->get();
        $kategori = Kategori::all();
        return view('sub_kategori', compact('sub_kategori', 'kategori', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi
        $validated = $request->validate([
            'sub_kategori' => 'required',
            'kategori' => 'required',
        ]);

        $sub_kategori = new Sub_kategori();
        $sub_kategori->sub_kategori = $request->sub_kategori;
        $sub_kategori->kategori_id = $request->kategori;
        $sub_kategori->save();
        return redirect()->route('sub_kategori')
            ->with('success', 'Data berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'sub_kategori' => 'required',
            'kategori' => 'required'
        ]);

        $sub_kategori = Sub_kategori::findOrFail($id);
        $sub_kategori->sub_kategori = $request->sub_kategori;
        $sub_kategori->kategori_id = $request->kategori;
        $sub_kategori->save();
        return redirect()->route('sub_kategori')
            ->with('success', 'Data berhasil dibuat!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub_kategori = Sub_kategori::findOrFail($id);
        $sub_kategori->delete();
        return redirect()->route('sub_kategori')
            ->with('success', 'Data berhasil dihapus!');
    }
}
