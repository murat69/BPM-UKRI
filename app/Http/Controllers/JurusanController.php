<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\Fakultas;
use Illuminate\Support\Facades\Storage;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Prodi";
        $jurusan = Jurusan::with('fakultas')->get();
        $fakultas = Fakultas::all();
        return view('jurusan', compact('jurusan', 'fakultas', 'title'));
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
            'fakultas' => 'required',
            'jurusan' => 'required',
            'nama_file' => 'required|image|mimes:jpeg,JPEG,png,PNG,jpg,JPG,gif,GIF,SVG,svg|max:10240',
        ]);
        $file = $request->file('nama_file');
        $tidaklekangdenganwaktu = time();
        $filenama = $request->jurusan . "_" . $tidaklekangdenganwaktu . "_" . $request->file('nama_file')->getClientOriginalName();
        $alamat = 'public/upload/' . str_replace(' ', '_', $request->jurusan);
        $namafile = str_replace(' ', '_', $filenama);
        $file->storeAs($alamat, $namafile);

        $jurusan = new Jurusan();
        $jurusan->jurusan = $request->jurusan;
        $jurusan->fakultas_id = $request->fakultas;
        $jurusan->logo = $namafile;
        $jurusan->save();
        return redirect()->route('jurusan')
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
            'fakultas' => 'required|max:50',
            'jurusan' => 'required',
        ]);

        if ($request->hasFile('nama_file')) {
            $validated = $request->validate([
                'nama_file' => 'image|mimes:jpeg,JPEG,png,PNG,jpg,JPG,gif,GIF,SVG,svg|max:10240',
            ]);

            $file = $request->file('nama_file');
            $tidaklekangdenganwaktu = time();
            $filenama = $request->jurusan . "_" . $tidaklekangdenganwaktu . "_" . $request->file('nama_file')->getClientOriginalName();
            $alamat = 'public/upload/' . str_replace(' ', '_', $request->jurusan);
            $namafile = str_replace(' ', '_', $filenama);
            Storage::delete($alamat . "/" . $request->data_old_file);
            $file->storeAs($alamat, $namafile);
        }
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->jurusan = $request->jurusan;
        if ($request->hasFile('nama_file')) {
            $jurusan->logo = $namafile;
        }
        $jurusan->fakultas_id = $request->fakultas;
        $jurusan->save();
        return redirect()->route('jurusan')
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
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();
        return redirect()->route('jurusan')
            ->with('success', 'Data berhasil dihapus!');
    }
}
