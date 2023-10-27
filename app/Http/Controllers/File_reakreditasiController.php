<?php

namespace App\Http\Controllers;

use App\Models\File_reakreditasi;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class File_reakreditasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kategori, $kat_fak = null)
    {
        $title = "Dokumen Rekareditasi";


        if ($kategori == 'sk') {
            $where = 'sk';
            $page = "sk";
        } else if ($kategori == 'led') {
            $where = 'led';
            $page = "led";
        } else   if ($kategori == 'lkps') {
            $where = 'lkps';
            $page = "lkps";
        } else   if ($kategori == 'penyusunan') {
            $where = 'penyusunan';
            $page = "penyusunan";
        } else {
            abort(403, 'Unauthorized');
        }

        if (Auth::user()->role == 'admin') {
            $jurusan = Jurusan::get();
            if ($kat_fak) {
                $reak = File_reakreditasi::where('kategori', $where)
                    ->whereHas('jurusan', function ($query) use ($kat_fak) {
                        $query->where('jurusan', $kat_fak);
                    })->get();
            } else {
                $reak = File_reakreditasi::where('kategori', $where)->where('kategori', $where)->get();
            }
        } else  if (Auth::user()->role == 'prodi') {
            $reak = File_reakreditasi::where('kategori', $where)->where('jurusan_id', Auth::user()->jurusan_id)->get();
            $jurusan = Jurusan::where('id', Auth::user()->jurusan_id)->first();
        } else if (Auth::user()->role == 'fakultas') {
            $reak = File_reakreditasi::where('kategori', $where)->whereHas('jurusan', function ($query) {
                $query->where('fakultas_id', Auth::user()->fakultas_id);
            })->get();

            $jurusan = Jurusan::whereHas('fakultas', function ($query) {
                $query->where('id', Auth::user()->fakultas_id);
            })->get();
        }

        return view('reakreditasi.' . $page, compact('title', 'reak', 'jurusan'));
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
            'jurusan' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'required',
        ]);


        $file = $request->file('nama_file');
        $jurusan = Jurusan::where('id', '=', $request->jurusan)->first();

        $tidaklekangdenganwaktu = time();
        $filenama =   $tidaklekangdenganwaktu . "_" . $request->file('nama_file')->getClientOriginalName();
        $alamat = 'public/upload/fakultas/' . $jurusan->fakultas->fakultas . '/' . $jurusan->jurusan . '/akreditasi/reakreditasi/' . $request->kategori . '/';

        $namafile = str_replace(' ', '_', $filenama);
        $file->storeAs($alamat, $namafile);

        $file = new File_reakreditasi();
        $file->file = '/fakultas/' . $jurusan->fakultas->fakultas . '/' . $jurusan->jurusan . '/akreditasi/reakreditasi/' . $request->kategori . '/' . $namafile;
        $file->nama = $request->nama;
        $file->jurusan_id = $request->jurusan;
        $file->deskripsi = $request->deskripsi;
        $file->kategori = $request->kategori;
        $file->user_id = Auth::user()->id;
        $file->save();
        return redirect()->back()
            ->with('success', 'Data berhasil Di Buat!');
    }

    public function ajax_status(Request $request)
    {
        $reak = File_reakreditasi::findOrFail($request->id);
        $reak->status = $request->status;
        $reak->save();
        return response()->json(['message' =>  $request->all()]);
    }
    public function ajax_pesan(Request $request)
    {
        $reak = File_reakreditasi::findOrFail($request->id);
        $reak->pesan = $request->pesan;
        $reak->save();
        return response()->json(['message' =>  $request->all()]);
    }
    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'nama_file' => 'required|max:10240',
            'jurusan' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'required',
        ]);

        if ($request->hasFile('nama_file')) {
            $file = $request->file('nama_file');
            $jurusan = Jurusan::where('id', '=', $request->jurusan)->first();

            $tidaklekangdenganwaktu = time();
            $filenama =   $tidaklekangdenganwaktu . "_" . $request->file('nama_file')->getClientOriginalName();
            $alamat = 'public/upload/fakultas/' . $jurusan->fakultas->fakultas . '/' . $jurusan->jurusan . '/akreditasi/reakreditasi/' . $request->kategori . '/';

            $namafile = str_replace(' ', '_', $filenama);

            Storage::delete('public/upload/' . "/" . $request->old_file);
            $file->storeAs($alamat, $namafile);
        }

        $file = File_reakreditasi::findOrFail($id);
        if ($request->hasFile('nama_file')) {
            $file->file = '/fakultas/' . $jurusan->fakultas->fakultas . '/' . $jurusan->jurusan . '/akreditasi/reakreditasi/' . $request->kategori . '/' . $namafile;
        }
        $file->nama = $request->nama;
        $file->deskripsi = $request->deskripsi;
        $file->kategori = $request->kategori;
        $file->status = '';
        $file->user_id = Auth::user()->id;
        $file->save();
        return redirect()->back()
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
        $file = File_reakreditasi::findOrFail($id);
        $kategori = $file->kategori;
        Storage::delete('public/upload/' . "/" . $file->file);
        $file->delete();
        return redirect()->back()
            ->with('success', 'Data berhasil Di Buat!');
    }
}