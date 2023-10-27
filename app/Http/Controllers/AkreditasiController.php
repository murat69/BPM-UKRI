<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akreditasi;
use App\Models\Jurusan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class AkreditasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::user()->role == 'admin') {
            $jurusan = Jurusan::get();
            $akreditasi = Akreditasi::get();
        } else  if (Auth::user()->role == 'prodi') {
            $akreditasi = Akreditasi::where('jurusan_id', Auth::user()->jurusan_id)->get();
            $jurusan = Jurusan::where('id', Auth::user()->jurusan_id)->first();
        } else if (Auth::user()->role == 'fakultas') {
            $akreditasi = Akreditasi::whereHas('jurusan', function ($query) {
                $query->where('fakultas_id', Auth::user()->fakultas_id);
            })->get();

            $jurusan = Jurusan::whereHas('fakultas', function ($query) {
                $query->where('id', Auth::user()->fakultas_id);
            })->get();
        }
        return view('akreditasi.akreditasi', compact('akreditasi', 'jurusan'));
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
    { //validasi

        $validated = $request->validate(
            [
                'jurusan' => 'required|unique:akreditasi,jurusan_id',
                'nama_file' => 'required|image|mimes:jpeg,JPEG,png,PNG,jpg,JPG,gif,GIF,SVG,svg|max:10240',
                'srata' => 'required',
                'akreditasi' => 'required',
                'sk' => 'required',
                'tanggal_m' => 'required',
                'tanggal_h' => 'required',
            ],
            [
                'jurusan.unique' => 'Data sudah ada'
            ]
        );





        $file = $request->file('nama_file');

        $jurusan = Jurusan::where('id', '=', $request->jurusan)->first();
        $tidaklekangdenganwaktu = time();

        $filenama = "Akreditasi_File_" . $tidaklekangdenganwaktu . "_" . $request->file('nama_file')->getClientOriginalName();

        $alamat = 'public/upload/fakultas/' . $jurusan->fakultas->fakultas . '/' . $jurusan->jurusan . '/akreditasi/';
        $namafile = str_replace(' ', '_', $filenama);
        $file->storeAs($alamat, $namafile);



        $akreditasi = new Akreditasi();
        $akreditasi->jurusan_id = $request->jurusan;
        $akreditasi->nama_file = '/fakultas/' . $jurusan->fakultas->fakultas . '/' . $jurusan->jurusan . '/akreditasi/' . $namafile;
        $akreditasi->srata = $request->srata;
        $akreditasi->akreditasi = $request->akreditasi;
        $akreditasi->sk = $request->sk;
        $akreditasi->tanggal_m = $request->tanggal_m;
        $akreditasi->tanggal_h = $request->tanggal_h;
        $akreditasi->save();
        return redirect()->route('akreditasi')
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
        //validasi

        $validated = $request->validate([
            'jurusan' => 'required',
            'srata' => 'required',
            'akreditasi' => 'required',
            'sk' => 'required',
            'tanggal_m' => 'required',
            'tanggal_h' => 'required',
        ]);

        if ($request->hasFile('nama_file')) {
            $validated = $request->validate([
                'nama_file' => 'image|mimes:jpeg,JPEG,png,PNG,jpg,JPG,gif,GIF,SVG,svg|max:10240',
            ]);


            $file = $request->file('nama_file');
            $jurusan = Jurusan::where('id', '=', $request->jurusan)->first();
            $tidaklekangdenganwaktu = time();

            $filenama = "Akreditasi_File_" . $tidaklekangdenganwaktu . "_" . $request->file('nama_file')->getClientOriginalName();

            $alamat = 'public/upload/fakultas/' . $jurusan->fakultas->fakultas . '/' . $jurusan->jurusan . '/akreditasi/';
            $namafile = str_replace(' ', '_', $filenama);
            Storage::delete('public/upload'  . $request->data_old_file);
            $file->storeAs($alamat, $namafile);
        }
        $akreditasi = Akreditasi::findOrFail($id);
        $akreditasi->jurusan_id = $request->jurusan;
        if ($request->hasFile('nama_file')) {
            $akreditasi->nama_file = '/fakultas/' . $jurusan->fakultas->fakultas . '/' . $jurusan->jurusan . '/akreditasi/' . $namafile;
        }
        $akreditasi->srata = $request->srata;
        $akreditasi->akreditasi = $request->akreditasi;
        $akreditasi->sk = $request->sk;
        $akreditasi->tanggal_m = $request->tanggal_m;
        $akreditasi->tanggal_h = $request->tanggal_h;
        $akreditasi->save();
        return redirect()->route('akreditasi')
            ->with('success', 'Data berhasil Di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $akreditasi = Akreditasi::findOrFail($id);
        Storage::delete('public/upload'  . $akreditasi->nama_file);
        $akreditasi->delete();
        return redirect()->route('akreditasi')
            ->with('success', 'Data berhasil Di hapus!');
    }
}
