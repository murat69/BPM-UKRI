<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\SPMI;
use App\Models\Sub_kategori;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SPMIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spmi = SPMI::with(['kategori', 'sub_kategori'])->get();
        $sub_kategori = Sub_kategori::with('kategori')->get();
        $kategori = Kategori::all();
        $title = "SPMI";
        return view('SPMI', compact('sub_kategori', 'kategori', 'spmi', 'title'));
    }

    public function kategori($kategori)
    {
        $title = $kategori;
        $spmi = SPMI::with(['kategori', 'sub_kategori'])->Kategori($kategori)->get();
        $sub_kategori = Sub_kategori::with('kategori')->get();
        $kategori = Kategori::all();
        return view('SPMI', compact('sub_kategori', 'kategori', 'spmi', 'title'));
    }

    public function Sub_kategori($Sub_kategori)
    {
        $title = $Sub_kategori;
        $spmi = SPMI::with(['kategori', 'sub_kategori'])->Sub_kategori($Sub_kategori)->get();
        $sub_kategori = Sub_kategori::with('kategori')->get();
        $kategori = Kategori::all();
        return view('SPMI', compact('sub_kategori', 'kategori', 'spmi', 'title'));
    }


    public function getData($id)
    {
        $data = DB::table('sub_kategori')->where('kategori_id', $id)->get();
        return response()->json($data);
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
            'judul' => 'required',
            'nama_file' => 'required|max:10240',
            'kategori' => 'required',
            'akses' => 'required',
        ]);
        $tidaklekangdenganwaktu = time();
        $file = $request->file('nama_file');


        $filenama = "BPM" . "_" . $tidaklekangdenganwaktu . "_" . $request->file('nama_file')->getClientOriginalName();


        $alamat = 'public/upload/BPM/';
        $namafile = str_replace(' ', '_', $filenama);
        $file->storeAs($alamat, $namafile);



        $spmi = new SPMI();
        $spmi->judul = $request->judul;
        $spmi->nama_file =  '/BPM/' . $namafile;
        $spmi->kategori_id = $request->kategori;
        $spmi->sub_kategori_id = $request->sub_kategori;
        $spmi->akses = $request->akses;
        $spmi->save();
        return redirect()->route('SPMI')
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
            'judul' => 'required',
            'kategori' => 'required',
            'akses' => 'required',
        ]);
        if ($request->hasFile('nama_file')) {
            $validated = $request->validate([
                'nama_file' => 'max:10240',
            ]);
            $tidaklekangdenganwaktu = time();
            $file = $request->file('nama_file');


            $filenama = "BPM" . "_"  . $tidaklekangdenganwaktu . "_" . $request->file('nama_file')->getClientOriginalName();

            $alamat = 'public/upload/BPM/';
            $namafile = str_replace(' ', '_', $filenama);
            Storage::delete('public/upload' . "/" . $request->data_old_file);
            $file->storeAs($alamat, $namafile);
        } else {
            $namafile = $request->data_old_file;
        }


        $spmi = SPMI::findOrFail($id);
        $spmi->judul = $request->judul;
        $spmi->nama_file =  '/BPM/' . $namafile;
        $spmi->kategori_id = $request->kategori;
        $spmi->sub_kategori_id = $request->sub_kategori;
        $spmi->akses = $request->akses;
        $spmi->save();
        return redirect()->route('SPMI')
            ->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $spmis = SPMI::findOrFail($id);
        Storage::delete('public/upload' . "/" . $spmis->nama_file);
        $spmis->delete();
        return redirect()->route('SPMI')
            ->with('success', 'Data berhasil Di hapus!');
    }
}