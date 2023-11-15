<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\SPMI;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Folder";
        $folder = Folder::all();
        return view('folder', compact('folder', 'title',));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Tambah Folder";
        $spmi = SPMI::all();
        return view('folder_tambah', compact('spmi', 'title'));
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
            'dokumen' => 'required',
            'nama' => 'required',
        ]);
        $selectedItems = $request->dokumen;

        // Mengonversi data ke format JSON
        $jsonData = json_encode($selectedItems);
        $folder = new Folder();
        $folder->nama = $request->nama;
        $folder->dokumen = $jsonData;
        $folder->save();

        return redirect()->route('folder')
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
        $title = "Folder";
        $slug = explode("-", $id);
        $secure = denc($slug[0]);
        $replace = str_replace($slug[0] . '-', '', $id);
        $folder = Folder::where('id', $secure)->first();
        $spmi = SPMI::all();
        return view('detail_folder', compact('folder', 'title', 'spmi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Edit Folder";
        $folder = Folder::where('id', $id)->first();
        $spmi = SPMI::all();
        return view('folder_tambah', compact('folder', 'title', 'spmi', 'folder'));
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
            'dokumen' => 'required',
            'nama' => 'required',
        ]);
        $selectedItems = $request->dokumen;

        // Mengonversi data ke format JSON
        $jsonData = json_encode($selectedItems);
        $folder =  Folder::findOrFail($id);
        $folder->nama = $request->nama;
        $folder->dokumen = $jsonData;
        $folder->save();

        return redirect()->route('folder')
            ->with('success', 'Data berhasil Di Ubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $folder =  Folder::findOrFail($id);
        $folder->delete();
        return redirect()->route('folder')
            ->with('success', 'Data berhasil Di Hapus!');
    }
}
