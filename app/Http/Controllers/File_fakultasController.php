<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\File_fakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class File_fakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kategori, $kat_fak = null)
    {
        $title = "Dokumen Fakultas";
        $fakultas = Fakultas::get();



        if ($kategori == 'sk') {
            $where = 'sk';
            $page = "sk";
        } else if ($kategori == 'renstra') {
            $where = 'renstra';
            $page = "renstra";
        } else   if ($kategori == 'lain') {
            $where = 'lain-lain';
            $page = "lain";
        } else {
            abort(403, 'Unauthorized');
        }
        if (Auth::user()->role == 'admin') {
            if ($kat_fak) {
                $file = File_fakultas::where('kategori', $where)
                    ->whereHas('fakultas', function ($query) use ($kat_fak) {
                        $query->where('fakultas', $kat_fak);
                    })->get();
            } else {
                $file = File_fakultas::where('kategori', $where)->get();
            }
        } else {
            $file = File_fakultas::where('kategori', $where)
                ->where('fakultas_id', Auth::user()->fakultas_id)
                ->get();
        }

        return view('fakultas.' . $page, compact('title', 'file', 'fakultas'));
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
            'fakultas' => 'required',
        ]);

        $fakultas = Fakultas::findOrFail($request->fakultas);

        $file = $request->file('nama_file');

        $tidaklekangdenganwaktu = time();
        $filenama =    $tidaklekangdenganwaktu . "_" . $request->file('nama_file')->getClientOriginalName();
        $alamat = 'public/upload/fakultas/' . $fakultas->fakultas . '/' . $request->kategori . '/';

        $namafile = str_replace(' ', '_', $filenama);
        $file->storeAs($alamat, $namafile);

        $file = new File_fakultas();
        $file->file = '/fakultas/' . $fakultas->fakultas . '/' . $request->kategori . '/' . $namafile;
        $file->nama = $request->nama;
        $file->fakultas_id = $request->fakultas;
        $file->deskripsi = $request->deskripsi;
        $file->kategori = $request->kategori;
        $file->user_id = Auth::user()->id;
        $file->save();
        return redirect()->back()
            ->with('success', 'Data berhasil Di Buat!');
    }

    public function ajax_status(Request $request)
    {
        $univ = File_fakultas::findOrFail($request->id);
        $univ->status = $request->status;
        $univ->save();
        return response()->json(['message' =>  $request->all()]);
    }
    public function ajax_pesan(Request $request)
    {
        $univ = File_fakultas::findOrFail($request->id);
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
            'fakultas' => 'required',
        ]);

        if ($request->hasFile('nama_file')) {
            $fakultas = Fakultas::findOrFail($request->fakultas);
            $file = $request->file('nama_file');

            $tidaklekangdenganwaktu = time();
            $filenama =  $tidaklekangdenganwaktu . "_" . $request->file('nama_file')->getClientOriginalName();
            $alamat = 'public/upload/fakultas/' . $fakultas->fakultas . '/' . $request->kategori . '/';
            $namafile = str_replace(' ', '_', $filenama);

            Storage::delete('public/upload/' . "/" . $request->old_file);
            $file->storeAs($alamat, $namafile);
        }

        $file = File_fakultas::findOrFail($id);
        if ($request->hasFile('nama_file')) {
            $file->file = '/fakultas/' . $fakultas->fakultas . '/' . $request->kategori . '/' . $namafile;
        }
        $file->nama = $request->nama;
        $file->deskripsi = $request->deskripsi;
        $file->fakultas_id = $request->fakultas;
        $file->kategori = $request->kategori;
        $file->status = '';
        $file->user_id = Auth::user()->id;
        $file->save();
        return redirect()->back()
            ->with('success', 'Data berhasil Di Edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = File_fakultas::findOrFail($id);
        $kategori = $file->kategori;
        Storage::delete('public/upload/' . "/" . $file->file);
        $file->delete();
        return redirect()->back()
            ->with('success', 'Data berhasil Di Hapus!');
    }
}