<?php

namespace App\Http\Controllers;

use App\Models\File_prodi;
use App\Models\Akreditasi;
use App\Models\Berita;
use App\Models\Content;
use App\Models\SPMI;
use App\Helpers\Helper;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        $akreditasi = Akreditasi::with('jurusan')->get();
        $visi = Content::Section("VISI")->first();
        $misi = Content::Section("MISI")->first();
        $berita = Berita::latest()->limit(3)->get();
        // $id = 2;
        // echo Helper::enc($id);
        return view('welcome', compact('akreditasi', 'visi', 'misi', 'berita'));
    }

    public function spmi($kat = null)
    {
        if ($kat) {
            $spmi = SPMI::whereHas('kategori', function ($query) use ($kat) {
                $query->where('kategori', $kat);
            })->where('akses', 'Publik')->get();
            return view('pub_spmi', compact('spmi', 'kat'));
        }
        $tentang = Content::Section("Tentang SPMI")->first();
        $dokumen = Content::Section("Document SPMI")->first();
        $pelaksanaan = Content::Section("Pelaksanaan SPMI")->first();
        $laporan = Content::Section("Laporan SPMI")->first();
        $survey = Content::Section("Survey SPMI")->first();

        return view('spmipub', compact('tentang', 'dokumen', 'pelaksanaan', 'laporan', 'survey'));
    }


    public function akre()
    {
        $akreditasi = Akreditasi::with('jurusan.fakultas')->orderBy('akreditasi', 'asc')->get();
        return view('akre', compact('akreditasi'));
    }



    public function tentang()
    {
        $visi = Content::Section("VISI")->first();
        $misi = Content::Section("MISI")->first();
        $tugas = Content::Section("tugas")->first();
        $fungsi = Content::Section("fungsi")->first();

        return view('tentang', compact('tugas', 'fungsi', 'visi', 'misi'));
    }

    public function peraturan()
    {
        $uu = SPMI::whereHas(
            "kategori",
            function ($query) {
                $query->where('kategori', 'Undang-Undang');
            }
        )->where('akses', 'Publik')->get();

        $ppt = SPMI::whereHas('sub_kategori', function ($query) {
            $query->where('sub_kategori', 'Peraturan Pendidikan Tinggi');
        })->where('akses', 'Publik')->get();

        $su = SPMI::whereHas('sub_kategori', function ($query) {
            $query->where('sub_kategori', 'Statuta UKRI');
        })->where('akses', 'Publik')->get();


        $ptsu = SPMI::whereHas('sub_kategori', function ($query) {
            $query->where('sub_kategori', 'Peraturan Turunan Statuta UKRI');
        })->where('akses', 'Publik')->get();


        return view('peraturan', compact('uu', 'ppt', 'su', 'ptsu'));
    }



    public function baca($id)
    {

        $slug = explode("-", $id);
        $secure = denc($slug[0]);
        $replace = str_replace($slug[0] . '-', '', $id);
        $berita = Berita::with('img_berita')->where('id', $secure)->first();
        $related = Berita::whereNot('id', $secure)->inRandomOrder()->take(4)->get();
        if ($berita) {
            if ($berita->slug == $replace) {
                return view('news', compact('berita', 'related'));
            } else {
                echo "sebaik nya jangan gegabah";
            }
        } else {
            echo "sebaik nya jangan gegabah oraig";
        }
    }


    public function baca_full()
    {
        $data = Berita::paginate(5);
        return view('news_full', compact('data'));
    }


    public function loadMore(Request $request)
    {
        $page = $request->page;
        $perPage = 5;
        $data = Berita::skip($perPage)->paginate($perPage, ['*'], 'page', $page);
        foreach ($data as $item) {
            $slug[] = enc($item->id) . '-' . $item->slug;
        }

        $response = ['data' => $data, 'slug' => $slug];
        return response()->json($response);
    }

    public function dokumen($jurusan)
    {
        $file_prodi = File_prodi::whereHas('jurusan', function ($query) use ($jurusan) {
            $query->where('jurusan', $jurusan);
        })->get();
        return view('dokumen', compact('file_prodi'));
    }
}