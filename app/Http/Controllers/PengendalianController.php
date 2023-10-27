<?php

namespace App\Http\Controllers;

use App\Models\Pengendalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengendalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengendalian = Pengendalian::all();
        return view('pengendalian', compact('pengendalian'));
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
            'file_rtm' => 'required|max:10240',
            'file_pel_rtm' => 'required|max:10240',
            'file_rtl' => 'required|max:10240',
            'file_pel_rtl' => 'required|max:10240',
        ]);
        $file_rtm = $request->file('file_rtm');
        $file_pel_rtm = $request->file('file_pel_rtm');
        $file_rtl = $request->file('file_rtl');
        $file_pel_rtl = $request->file('file_pel_rtl');

        $tidaklekangdenganwaktu = time();
        $filenamatrm = "BPM" . "_" . $tidaklekangdenganwaktu . "_" . $request->file('file_rtm')->getClientOriginalName();
        $filenamapeltrm = "BPM" . "_" . $tidaklekangdenganwaktu . "_" . $request->file('file_pel_rtm')->getClientOriginalName();
        $filenamatrl = "BPM" . "_" . $tidaklekangdenganwaktu . "_" . $request->file('file_rtl')->getClientOriginalName();
        $filenamapeltrl = "BPM" . "_" . $tidaklekangdenganwaktu . "_" . $request->file('file_pel_rtl')->getClientOriginalName();

        $alamat = 'public/upload/' . str_replace(' ', '_', "BPM");

        $namafilertm = str_replace(' ', '_', $filenamatrm);
        $namafilepelrtm = str_replace(' ', '_', $filenamapeltrm);
        $namafilertl = str_replace(' ', '_', $filenamatrl);
        $namafilepelrtl = str_replace(' ', '_', $filenamapeltrl);

        $file_rtm->storeAs($alamat, $namafilertm);
        $file_pel_rtm->storeAs($alamat, $namafilepelrtm);
        $file_rtl->storeAs($alamat, $namafilertl);
        $file_pel_rtl->storeAs($alamat, $namafilepelrtl);

        $pengendalian = new Pengendalian();
        $pengendalian->judul = $request->judul;
        $pengendalian->file_rtm =  $namafilertm;
        $pengendalian->file_pel_rtm = $namafilepelrtm;
        $pengendalian->file_rtl = $namafilertl;
        $pengendalian->file_pel_rtl = $namafilepelrtl;
        $pengendalian->save();
        return redirect()->route('pengendalian')
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
            'judul' => 'required'
        ]);

        $alamat = 'public/upload/' . str_replace(' ', '_', "BPM");
        $tidaklekangdenganwaktu = time();

        if ($request->hasFile('file_rtm') || $request->hasFile('file_pel_rtm') || $request->hasFile('file_rtl') || $request->hasFile('file_pel_rtl')) {

            if ($request->hasFile('file_rtm')) {
                $validated = $request->validate([
                    'file_rtm' => 'max:10240',
                ]);

                $file_rtm = $request->file('file_rtm');
                $filenamatrm = "BPM" . "_" . $tidaklekangdenganwaktu . "_" . $request->file('file_rtm')->getClientOriginalName();
                $namafilertm = str_replace(' ', '_', $filenamatrm);
                Storage::delete($alamat . "/" . $request->data_old_file_rtm);
                $file_rtm->storeAs($alamat, $namafilertm);
            } else {
                $namafilertm = $request->data_old_file_rtm;
            }


            if ($request->hasFile('file_pel_rtm')) {
                $validated = $request->validate([
                    'file_pel_rtm' => 'max:10240',
                ]);

                $file_pel_rtm = $request->file('file_pel_rtm');
                $filenamapeltrm = "BPM" . "_" . $tidaklekangdenganwaktu . "_" . $request->file('file_pel_rtm')->getClientOriginalName();
                $namafilepelrtm = str_replace(' ', '_', $filenamapeltrm);
                Storage::delete($alamat . "/" . $request->data_old_file_pel_rtm);
                $file_pel_rtm->storeAs($alamat, $namafilepelrtm);
            } else {
                $namafilepelrtm = $request->data_old_file_pel_rtm;
            }

            if ($request->hasFile('file_rtl')) {
                $validated = $request->validate([
                    'file_rtl' => 'max:10240',
                ]);
                $file_rtl = $request->file('file_rtl');
                $filenamatrl = "BPM" . "_" . $tidaklekangdenganwaktu . "_" . $request->file('file_rtl')->getClientOriginalName();
                $namafilertl = str_replace(' ', '_', $filenamatrl);
                Storage::delete($alamat . "/" . $request->data_old_file_rtl);
                $file_rtl->storeAs($alamat, $namafilertl);
            } else {
                $namafilertl = $request->data_old_file_rtl;
            }

            if ($request->hasFile('file_pel_rtl')) {
                $validated = $request->validate([
                    'file_pel_rtl' => 'max:10240',
                ]);
                $file_pel_rtl = $request->file('file_pel_rtl');
                $filenamapeltrl = "BPM" . "_" . $tidaklekangdenganwaktu . "_" . $request->file('file_pel_rtl')->getClientOriginalName();
                $namafilepelrtl = str_replace(' ', '_', $filenamapeltrl);
                Storage::delete($alamat . "/" . $request->data_old_file_pel_rtl);
                $file_pel_rtl->storeAs($alamat, $namafilepelrtl);
            } else {
                $namafilepelrtl = $request->data_old_file_pel_rtl;
            }

            $pengendalian = Pengendalian::findOrFail($id);
            $pengendalian->judul = $request->judul;
            $pengendalian->file_rtm =  $namafilertm;
            $pengendalian->file_pel_rtm = $namafilepelrtm;
            $pengendalian->file_rtl = $namafilertl;
            $pengendalian->file_pel_rtl = $namafilepelrtl;
            $pengendalian->save();
            return redirect()->route('pengendalian')
                ->with('success', 'Data berhasil dibuat!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
