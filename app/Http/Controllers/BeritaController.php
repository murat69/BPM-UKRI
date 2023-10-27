<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\img_berita;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;



class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Berita";
        $berita = Berita::with('img_berita')->get();
        return view('berita', compact('title', 'berita'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'isi' => 'required',
            'thumbnail' => 'required|max:10240|dimensions:min_width=300,min_height=200'
        ]);


        $file = $request->file('thumbnail');

        $tidaklekangdenganwaktu = time();
        $filenama = "berita" . "_" . $request->judul . "_"  . $tidaklekangdenganwaktu . $request->file('thumbnail')->getClientOriginalName();

        $alamat = 'public/upload/berita/thumbnail';
        $namafile = str_replace(' ', '_', $filenama);
        $file->storeAs($alamat, $namafile);
        $slug = Str::slug($request->judul, '-');

        $berita = new Berita();
        $berita->judul = $request->judul;
        $berita->thumbnail = $namafile;
        $berita->slug = $slug;
        $berita->isi = $request->isi;
        $berita->save();
        return redirect()->route('berita')
            ->with('success', 'Data berhasil Di Buat!');
    }


    public function image_store(Request $request, $id)
    {
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $tidaklekangdenganwaktu = time();
            foreach ($images as $image) {
                $alamat = 'public/upload/berita/gallery';
                $filenama = "berita" . "_" . $request->judul . "_" . $tidaklekangdenganwaktu . $image->getClientOriginalName();
                $namafile = str_replace(' ', '_', $filenama);
                $image->storeAs($alamat, $namafile);
                $image = new img_berita();
                $image->file = $namafile;
                $image->berita_id = $id;
                $image->save();
            }
            return redirect()->route('berita')
                ->with('success', 'Data berhasil Di Buat!');
        }
        return redirect()->route('berita')
            ->with('Failure', 'Data Kosong');
    }

    public function image_edit(Request $request)
    {


        $images = $request->file('file');
        $alamat = 'public/upload/berita/gallery';
        $tidaklekangdenganwaktu = time();
        $filenama = "berita" . "_" .  $request->judul . "_" . $tidaklekangdenganwaktu . "_" .  $images->getClientOriginalName();
        $namafile = str_replace(' ', '_', $filenama);
        Storage::delete($alamat . "/" . $request->old_file);
        $images->storeAs($alamat, $namafile);

        $img = img_berita::findOrFail($request->id_img);
        $img->file = $namafile;
        $img->save();

        // kirimkan response sukses
        return response()->json([
            'success' => true,
            'message' => 'File berhasil diupload',
            'foto' =>  $namafile,
            'id_img' => '.img_gallery_' . $request->id_img,
        ]);
    }


    public function image_destroy($id)
    {
        $file_img_berita = img_berita::where('id', '=', $id)->get();
        foreach ($file_img_berita as $img) {
            $alamat = 'public/upload/berita/gallery';
            Storage::delete($alamat . "/" . $img->file);
        }

        $file_img_berita = img_berita::where('id', '=', $id)->delete();
        return redirect()->route('berita')
            ->with('success', 'Data berhasil Di hapus!');
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
            'isi' => 'required',

        ]);

        if ($request->hasFile('thumbnail')) {
            $validated = $request->validate([
                'thumbnail' => 'required|max:10240'
            ]);

            $file = $request->file('thumbnail');

            $tidaklekangdenganwaktu = time();
            $filenama = "berita" . "_" . $request->judul . "_"  . $tidaklekangdenganwaktu . $request->file('thumbnail')->getClientOriginalName();

            $alamat = 'public/upload/berita/thumbnail';
            $namafile = str_replace(' ', '_', $filenama);
            Storage::delete($alamat . "/" . $request->data_lama);
            $file->storeAs($alamat, $namafile);
        }
        $slug = Str::slug($request->judul, '-');

        $berita = Berita::findOrFail($id);
        $berita->judul = $request->judul;
        if ($request->hasFile('thumbnail')) {
            $berita->thumbnail = $namafile;
        }
        $berita->slug = $slug;
        $berita->isi = $request->isi;
        $berita->save();
        return redirect()->route('berita')
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
        $file_berita = Berita::where('id', '=', $id)->get();
        $file_img_berita = img_berita::where('berita_id', '=', $id)->get();

        foreach ($file_berita as $data) {
            $alamat = 'public/upload/berita/thumbnail';
            Storage::delete($alamat . "/" . $data->thumbnail);
        }

        foreach ($file_img_berita as $img) {
            $alamat = 'public/upload/berita/gallery';
            Storage::delete($alamat . "/" . $img->file);
        }

        $file_img_berita = img_berita::where('berita_id', '=', $id)->delete();
        $file_prodi = Berita::findOrFail($id);
        $file_prodi->delete();
        return redirect()->route('berita')
            ->with('success', 'Data berhasil Di hapus!');
    }
}
