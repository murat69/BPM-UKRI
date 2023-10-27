<?php

namespace App\Http\Controllers;

use App\Models\Universitas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UniversitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kategori)
    {
        $title = "Dokumen Universitas";

        if ($kategori == 'sk') {
            $univ = Universitas::where('kategori', 'sk')->get();
            $page = "sk";
        } else if ($kategori == 'pedoman') {
            $univ = Universitas::where('kategori', 'pedoman')->get();
            $page = "pedoman";
        } else   if ($kategori == 'lain-lain') {
            $univ = Universitas::where('kategori', 'lain-lain')->get();
            $page = "lain";
        } else {
            abort(403, 'Unauthorized');
        }

        return view('univ.sk', compact('title', 'univ'));
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
        $validated = $request->validate([
            'nama' => 'required',
            'nama_file' => 'required|max:10240',
            'deskripsi' => 'required',
            'kategori' => 'required',
        ]);


        $file = $request->file('nama_file');

        $tidaklekangdenganwaktu = time();
        $filenama =   $tidaklekangdenganwaktu . "_" . $request->file('nama_file')->getClientOriginalName();
        $alamat = 'public/upload/universitas/' . $request->kategori . '/';

        $namafile = str_replace(' ', '_', $filenama);
        $file->storeAs($alamat, $namafile);

        $file = new Universitas();
        $file->file = '/universitas/' . $request->kategori . '/' . $namafile;
        $file->nama = $request->nama;
        $file->deskripsi = $request->deskripsi;
        $file->kategori = $request->kategori;
        $file->user_id = Auth::user()->id;
        $file->save();
        return redirect()->route('universitas', $request->kategori)
            ->with('success', 'Data berhasil Di Buat!');
    }

    public function ajax_status(Request $request)
    {
        $univ = Universitas::findOrFail($request->id);
        $univ->status = $request->status;
        $univ->save();
        return response()->json(['message' =>  $request->all()]);
    }
    public function ajax_pesan(Request $request)
    {
        $univ = Universitas::findOrFail($request->id);
        $univ->pesan = $request->pesan;
        $univ->save();
        return response()->json(['message' =>  $request->all()]);
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
            'nama' => 'required',
            'nama_file' => 'max:10240',
            'deskripsi' => 'required',
            'kategori' => 'required',
        ]);

        if ($request->hasFile('nama_file')) {
            $file = $request->file('nama_file');

            $tidaklekangdenganwaktu = time();
            $filenama =  $tidaklekangdenganwaktu . "_" . $request->file('nama_file')->getClientOriginalName();
            $alamat = 'public/upload/universitas/' . $request->kategori . '/';
            $namafile = str_replace(' ', '_', $filenama);

            Storage::delete('public/upload/' . "/" . $request->old_file);
            $file->storeAs($alamat, $namafile);
        }

        $file = Universitas::findOrFail($id);
        if ($request->hasFile('nama_file')) {
            $file->file = '/universitas/' . $request->kategori . '/' . $namafile;
        }
        $file->nama = $request->nama;
        $file->deskripsi = $request->deskripsi;
        $file->kategori = $request->kategori;
        $file->status = '';
        $file->user_id = Auth::user()->id;
        $file->save();
        return redirect()->route('universitas', $request->kategori)
            ->with('success', 'Data berhasil Di Buat!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = Universitas::findOrFail($id);
        $kategori = $file->kategori;
        Storage::delete('public/upload/' . "/" . $file->file);
        $file->delete();
        return redirect()->route('universitas', $kategori)
            ->with('success', 'Data berhasil Di Buat!');
    }
}