<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\File_prodi;
use App\Models\Jurusan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kategori, $kat_fak = null)
    {
        $title = "Dokumen Prodi";
        $prodi = Jurusan::get();



        if ($kategori == 'kinerja') {
            $where = 'kinerja';
            $page = "kinerja";
        } else if ($kategori == 'evaluasi') {
            $where = 'evaluasi';
            $page = "evaluasi";
        } else   if ($kategori == 'lain') {
            $where = 'lain-lain';
            $page = "prodi";
        } else {
            abort(403, 'Unauthorized');
        }

        if (Auth::user()->role == 'admin') {
            if ($kat_fak) {
                $file = File_prodi::where('kategori', $where)
                    ->whereHas('jurusan', function ($query) use ($kat_fak) {
                        $query->where('jurusan', $kat_fak);
                    })->get();
            } else {
                $file = File_prodi::where('kategori', $where)->get();
            }
        } else {
            $file = File_prodi::where('kategori', $where)
                ->where('jurusan_id', Auth::user()->jurusan_id)
                ->get();
        }

        return view('prodi.' . $page, compact('title', 'file', 'prodi'));
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
            'jurusan' => 'required',
            'nama_file' => 'required|max:10240',
            'deskripsi' => 'required',
            'kategori' => 'required',
        ]);


        $file = $request->file('nama_file');
        $jurusan = Jurusan::where('id', '=', $request->jurusan)->first();
        $fakultas = Fakultas::findOrFail($jurusan->fakultas_id);

        $tidaklekangdenganwaktu = time();
        $filenama =   $tidaklekangdenganwaktu .  "_" . $request->file('nama_file')->getClientOriginalName();

        $alamat = 'public/upload/fakultas/' . $fakultas->fakultas . '/' . $jurusan->jurusan . '/' . $request->kategori . '/';
        $namafile = str_replace(' ', '_', $filenama);
        $file->storeAs($alamat, $namafile);

        $file_prodi = new File_prodi();
        $file_prodi->jurusan_id = $request->jurusan;
        $file_prodi->nama_file = '/fakultas/' . $fakultas->fakultas . '/' . $jurusan->jurusan . '/' . $request->kategori . '/' . $namafile;
        $file_prodi->judul = $request->judul;
        $file_prodi->kategori = $request->kategori;
        $file_prodi->deskripsi = $request->deskripsi;
        $file_prodi->user_id = Auth::user()->id;
        $file_prodi->save();
        return redirect()->back()
            ->with('success', 'Data berhasil Di Buat!');
    }



    public function ajax_status(Request $request)
    {
        $univ = File_prodi::findOrFail($request->id);
        $univ->status = $request->status;
        $univ->save();
        return response()->json(['message' =>  $request->all()]);
    }
    public function ajax_pesan(Request $request)
    {
        $univ = File_prodi::findOrFail($request->id);
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
            'judul' => 'required',
            'jurusan' => 'required',
            'nama_file' => 'max:10240',
            'deskripsi' => 'required',
            'kategori' => 'required',
        ]);

        if ($request->hasFile('nama_file')) {
            $jurusan = Jurusan::where('id', '=', $request->jurusan)->first();
            $fakultas = Fakultas::findOrFail($jurusan->fakultas_id);

            $file = $request->file('nama_file');

            $tidaklekangdenganwaktu = time();

            $filenama =  $tidaklekangdenganwaktu .  "_" . $request->file('nama_file')->getClientOriginalName();

            $alamat = 'public/upload/fakultas/' . $fakultas->fakultas . '/' . $jurusan->jurusan . '/' . $request->kategori . '/';
            $namafile = str_replace(' ', '_', $filenama);

            Storage::delete('public/upload/' . "/" . $request->old_file);
            $file->storeAs($alamat, $namafile);
        }

        $file_prodi = File_prodi::findOrFail($id);
        $file_prodi->jurusan_id = $request->jurusan;
        if ($request->hasFile('nama_file')) {
            $file_prodi->nama_file = '/fakultas/' . $fakultas->fakultas . '/' . $jurusan->jurusan . '/' . $request->kategori . '/' . $namafile;
        }
        $file_prodi->judul = $request->judul;
        $file_prodi->kategori = $request->kategori;
        $file_prodi->deskripsi = $request->deskripsi;
        $file_prodi->save();
        return redirect()->back()
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
        $file_prodi = File_prodi::findOrFail($id);
        Storage::delete('public/upload/' . "/" . $file_prodi->nama_file);
        $file_prodi->delete();
        return redirect()->back()
            ->with('success', 'Data berhasil Di hapus!');
    }
}