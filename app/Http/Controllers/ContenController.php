<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class ContenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Content";
        $conten = Content::get();
        return view('conten', compact('conten', 'title'));
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
            'conten' => ['required', 'string'],
            'section' => ['required', 'string', 'max:255'],
        ]);


        $conten = new Content();
        $conten->conten = $request->conten;
        $conten->section = $request->section;
        $conten->save();

        return redirect()->route('conten')
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
            'conten' => ['required', 'string'],
            'section' => ['required', 'string', 'max:255'],
        ]);

        $conten = Content::findOrFail($id);
        $conten->conten = $request->conten;
        $conten->section = $request->section;
        $conten->save();

        return redirect()->route('conten')
            ->with('success', 'Data berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $conten = Content::findOrFail($id);
        $conten->delete();
        return redirect()->route('conten')
            ->with('success', 'Data berhasil dihapus!');
    }
}