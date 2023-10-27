<?php

namespace App\Http\Controllers;

use App\Models\Akreditasi;
use App\Models\File_fakultas;
use App\Models\File_prodi;
use App\Models\File_reakreditasi;
use App\Models\SPMI;
use App\Models\Universitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::user()->role == 'admin') {
            $spmi = SPMI::get();
            $tot_spmi =
                [
                    'jumlah' => count($spmi),
                    'status' => 'fa-check'
                ];

            $akreditasi = Akreditasi::get();
            $akre =
                [
                    'jumlah' => count($akreditasi),
                    'status' => 'fa-check'
                ];

            $file_fakultas = File_fakultas::where('status', null)->orWhere('status', 'Data Tidak Memenuhi')->orWhere('status', 'Data Sedang Di Cek')->get();
            if (count($file_fakultas) > 0) {
                $file_fak = [
                    'jumlah' => count($file_fakultas),
                    'status' => 'fa-exclamation'
                ];
            } else {
                $file_fakultas = File_fakultas::get();
                $file_fak = [
                    'jumlah' => count($file_fakultas),
                    'status' => 'fa-check'
                ];
            }

            $file_prodi = File_prodi::where('status', null)->orWhere('status', 'Data Tidak Memenuhi')->orWhere('status', 'Data Sedang Di Cek')->get();
            if (count($file_prodi) > 0) {
                $file_prod =
                    [
                        'jumlah' => count($file_prodi),
                        'status' => 'fa-exclamation'
                    ];
            } else {
                $file_prodi = File_prodi::get();
                $file_prod =
                    [
                        'jumlah' => count($file_prodi),
                        'status' => 'fa-check'
                    ];
            }

            $file_reakreditasi = File_reakreditasi::where('status', null)->orWhere('status', 'Data Tidak Memenuhi')->orWhere('status', 'Data Sedang Di Cek')->get();
            if (count($file_reakreditasi) > 0) {
                $file_reak =
                    [
                        'jumlah' => count($file_reakreditasi),
                        'status' => 'fa-exclamation'
                    ];
            } else {
                $file_reakreditasi = File_reakreditasi::get();
                $file_reak =
                    [
                        'jumlah' => count($file_reakreditasi),
                        'status' => 'fa-check'
                    ];
            }

            $file_universitas = Universitas::where('status', null)->orWhere('status', 'Data Tidak Memenuhi')->orWhere('status', 'Data Sedang Di Cek')->get();
            if (count($file_universitas) > 0) {
                $file_univ =
                    [
                        'jumlah' => count($file_universitas),
                        'status' => 'fa-exclamation'
                    ];
            } else {
                $file_universitas = Universitas::get();
                $file_univ =
                    [
                        'jumlah' => count($file_universitas),
                        'status' => 'fa-check'
                    ];
            }

            $total = [
                'SPMI' => $tot_spmi,
                'Akreditasi' => $akre,
                'Fakultas' => $file_fak,
                'Prodi' => $file_prod,
                'Reakreditasi' => $file_reak,
                'Universitas' => $file_univ,
            ];
        } else  if (Auth::user()->role == 'prodi') {
            //File Prodi
            $file_kinerja = File_prodi::where('kategori', 'kinerja')->where('jurusan_id', Auth::user()->jurusan_id)->where('status', null)->orWhere('status', 'Data Tidak Memenuhi')->orWhere('status', 'Data Sedang Di Cek')->get();
            if (count($file_kinerja) > 0) {
                $tot_sk =
                    [
                        'jumlah' => count($file_kinerja),
                        'status' => 'fa-exclamation'
                    ];
            } else {
                $file_kinerja = File_prodi::where('kategori', 'kinerja')->where('jurusan_id', Auth::user()->jurusan_id)->get();
                $tot_sk =
                    [
                        'jumlah' => count($file_kinerja),
                        'status' => 'fa-check'
                    ];
            }

            $file_evaluasi = File_prodi::where('kategori', 'evaluasi')->where('jurusan_id', Auth::user()->jurusan_id)->where('status', null)->orWhere('status', 'Data Tidak Memenuhi')->orWhere('status', 'Data Sedang Di Cek')->get();
            if (count($file_evaluasi) > 0) {
                $tot_evaluasi =
                    [
                        'jumlah' => count($file_evaluasi),
                        'status' => 'fa-exclamation'
                    ];
            } else {
                $file_evaluasi = File_prodi::where('kategori', 'evaluasi')->where('jurusan_id', Auth::user()->jurusan_id)->get();
                $tot_evaluasi =
                    [
                        'jumlah' => count($file_evaluasi),
                        'status' => 'fa-check'
                    ];
            }

            $file_lain = File_prodi::where('kategori', 'lain-lain')->where('jurusan_id', Auth::user()->jurusan_id)->where('status', null)->orWhere('status', 'Data Tidak Memenuhi')->orWhere('status', 'Data Sedang Di Cek')->get();
            if (count($file_lain) > 0) {
                $tot_lain =
                    [
                        'jumlah' => count($file_lain),
                        'status' => 'fa-exclamation'
                    ];
            } else {
                $file_lain = File_prodi::where('kategori', 'lain-lain')->where('jurusan_id', Auth::user()->jurusan_id)->get();
                $tot_lain =
                    [
                        'jumlah' => count($file_lain),
                        'status' => 'fa-check'
                    ];
            }

            //Reakreditasi
            $file_sk_reak =
                File_reakreditasi::where('kategori', 'sk')
                ->where('jurusan_id', Auth::user()->jurusan_id)
                ->where(function ($query) {
                    $query->where('status', null)
                        ->orWhere('status', 'Data Tidak Memenuhi')
                        ->orWhere('status', 'Data Sedang Di Cek');
                })
                ->get();
            if (count($file_sk_reak) > 0) {
                $tot_sk_reak =
                    [
                        'jumlah' => count($file_sk_reak),
                        'status' => 'fa-exclamation'
                    ];
            } else {
                $file_sk_reak =
                    File_reakreditasi::where('kategori', 'sk')->where('jurusan_id', Auth::user()->jurusan_id)->get();
                $tot_sk_reak =
                    [
                        'jumlah' => count($file_sk_reak),
                        'status' => 'fa-check'
                    ];
            }

            $file_led_reak =
                File_reakreditasi::where('kategori', 'led')
                ->where('jurusan_id', Auth::user()->jurusan_id)
                ->where(function ($query) {
                    $query->where('status', null)
                        ->orWhere('status', 'Data Tidak Memenuhi')
                        ->orWhere('status', 'Data Sedang Di Cek');
                })
                ->get();
            if (count($file_led_reak) > 0) {
                $tot_led_reak =
                    [
                        'jumlah' => count($file_led_reak),
                        'status' => 'fa-exclamation'
                    ];
            } else {
                $file_led_reak =
                    File_reakreditasi::where('kategori', 'led')->where('jurusan_id', Auth::user()->jurusan_id)->get();
                $tot_led_reak =
                    [
                        'jumlah' => count($file_led_reak),
                        'status' => 'fa-check'
                    ];
            }

            $file_lkps_reak =
                File_reakreditasi::where('kategori', 'lkps')
                ->where('jurusan_id', Auth::user()->jurusan_id)
                ->where(function ($query) {
                    $query->where('status', null)
                        ->orWhere('status', 'Data Tidak Memenuhi')
                        ->orWhere('status', 'Data Sedang Di Cek');
                })
                ->get();
            if (count($file_lkps_reak) > 0) {
                $tot_lkps_reak =
                    [
                        'jumlah' => count($file_lkps_reak),
                        'status' => 'fa-exclamation'
                    ];
            } else {
                $file_lkps_reak =
                    File_reakreditasi::where('kategori', 'lkps')->where('jurusan_id', Auth::user()->jurusan_id)->get();
                $tot_lkps_reak =
                    [
                        'jumlah' => count($file_lkps_reak),
                        'status' => 'fa-check'
                    ];
            }

            $file_penyusunan_reak =
                File_reakreditasi::where('kategori', 'penyusunan')
                ->where('jurusan_id', Auth::user()->jurusan_id)
                ->where(function ($query) {
                    $query->where('status', null)
                        ->orWhere('status', 'Data Tidak Memenuhi')
                        ->orWhere('status', 'Data Sedang Di Cek');
                })
                ->get();
            if (count($file_penyusunan_reak) > 0) {
                $tot_penyusunan_reak =
                    [
                        'jumlah' => count($file_penyusunan_reak),
                        'status' => 'fa-exclamation'
                    ];
            } else {
                $file_penyusunan_reak =
                    File_reakreditasi::where('kategori', 'penyusunan')->where('jurusan_id', Auth::user()->jurusan_id)->get();
                $tot_penyusunan_reak =
                    [
                        'jumlah' => count($file_penyusunan_reak),
                        'status' => 'fa-check'
                    ];
            }


            // dd($file_sk_reak);

            $total = [
                'Kinerja' => $tot_sk,
                'Evaluasi' => $tot_evaluasi,
                'Lain-Lain' => $tot_lain,
                'SK-Reakreditasi' => $tot_sk_reak,
                'LED-Reakreditasi' => $tot_led_reak,
                'LKPS-Reakreditasi' => $tot_lkps_reak,
                'Penyusunan-Reakreditasi' => $tot_penyusunan_reak,
            ];
        } else  if (Auth::user()->role == 'wr1' || Auth::user()->role == 'wr2' || Auth::user()->role == 'wr3') {

            $file_sk = Universitas::where('kategori', 'sk')->whereNot('status', 'Data Sudah Valid')->get();
            if (count($file_sk) > 0) {
                $tot_sk =
                    [
                        'jumlah' => count($file_sk),
                        'status' => 'fa-exclamation'
                    ];
            } else {
                $file_sk = Universitas::where('kategori', 'sk')->get();
                $tot_sk =
                    [
                        'jumlah' => count($file_sk),
                        'status' => 'fa-check'
                    ];
            }

            $file_pedoman = Universitas::where('kategori', 'pedoman')->whereNot('status', 'Data Sudah Valid')->get();

            if (count($file_pedoman) > 0) {
                $tot_pedoman =
                    [
                        'jumlah' => count($file_pedoman),
                        'status' => 'fa-exclamation'
                    ];
            } else {
                $file_pedoman = Universitas::where('kategori', 'pedoman')->get();
                $tot_pedoman =
                    [
                        'jumlah' => count($file_pedoman),
                        'status' => 'fa-check'
                    ];
            }

            $file_lain = Universitas::where('kategori', 'lain-lain')->whereNot('status', 'Data Sudah Valid')->get();
            if (count($file_lain) > 0) {
                $tot_lain =
                    [
                        'jumlah' => count($file_lain),
                        'status' => 'fa-exclamation'
                    ];
            } else {
                $file_lain = Universitas::where('kategori', 'pedoman')->get();
                $tot_lain =
                    [
                        'jumlah' => count($file_lain),
                        'status' => 'fa-check'
                    ];
            }

            $total = [
                'SK' => $tot_sk,
                'Pedoman' => $tot_pedoman,
                'Lain-Lain' => $tot_lain,
            ];
        } else if (Auth::user()->role == 'fakultas') {
            //File Prodi
            $file_sk = file_fakultas::where('kategori', 'sk')->where('fakultas_id', Auth::user()->fakultas_id)->whereNot('status', 'Data Sudah Valid')->get();
            if (count($file_sk) > 0) {
                $tot_sk =
                    [
                        'jumlah' => count($file_sk),
                        'status' => 'fa-exclamation'
                    ];
            } else {
                $file_sk = file_fakultas::where('kategori', 'sk')->where('fakultas_id', Auth::user()->fakultas_id)->get();
                $tot_sk =
                    [
                        'jumlah' => count($file_sk),
                        'status' => 'fa-check'
                    ];
            }

            $file_renstra = file_fakultas::where('kategori', 'renstra')->where('fakultas_id', Auth::user()->fakultas_id)->whereNot('status', 'Data Sudah Valid')->get();
            if (count($file_renstra) > 0) {
                $tot_renstra =
                    [
                        'jumlah' => count($file_renstra),
                        'status' => 'fa-exclamation'
                    ];
            } else {
                $file_renstra = file_fakultas::where('kategori', 'renstra')->where('fakultas_id', Auth::user()->fakultas_id)->get();
                $tot_renstra =
                    [
                        'jumlah' => count($file_renstra),
                        'status' => 'fa-check'
                    ];
            }

            $file_lain = file_fakultas::where('kategori', 'lain-lain')->where('fakultas_id', Auth::user()->fakultas_id)->whereNot('status', 'Data Sudah Valid')->get();
            if (count($file_lain) > 0) {
                $tot_lain =
                    [
                        'jumlah' => count($file_lain),
                        'status' => 'fa-exclamation'
                    ];
            } else {
                $file_lain = file_fakultas::where('kategori', 'lain-lain')->where('fakultas_id', Auth::user()->fakultas_id)->get();
                $tot_lain =
                    [
                        'jumlah' => count($file_lain),
                        'status' => 'fa-check'
                    ];
            }

            //Reakreditasi
            $file_sk_reak =
                File_reakreditasi::where('kategori', 'sk')
                ->whereHas('jurusan', function ($query) {
                    $query->where('fakultas_id', Auth::user()->fakultas_id);
                })
                ->whereNot('status', 'Data Sudah Valid')
                ->get();
            if (count($file_sk_reak) > 0) {
                $tot_sk_reak =
                    [
                        'jumlah' => count($file_sk_reak),
                        'status' => 'fa-exclamation'
                    ];
            } else {
                $file_sk_reak =
                    File_reakreditasi::where('kategori', 'sk')
                    ->whereHas('jurusan', function ($query) {
                        $query->where('fakultas_id', Auth::user()->fakultas_id);
                    })
                    ->get();
                $tot_sk_reak =
                    [
                        'jumlah' => count($file_sk_reak),
                        'status' => 'fa-check'
                    ];
            }

            $file_led_reak =
                File_reakreditasi::where('kategori', 'led')
                ->whereHas('jurusan', function ($query) {
                    $query->where('fakultas_id', Auth::user()->fakultas_id);
                })
                ->whereNot('status', 'Data Sudah Valid')
                ->get();
            if (count($file_led_reak) > 0) {
                $tot_led_reak =
                    [
                        'jumlah' => count($file_led_reak),
                        'status' => 'fa-exclamation'
                    ];
            } else {
                $file_led_reak =
                    File_reakreditasi::where('kategori', 'led')
                    ->whereHas('jurusan', function ($query) {
                        $query->where('fakultas_id', Auth::user()->fakultas_id);
                    })
                    ->get();
                $tot_led_reak =
                    [
                        'jumlah' => count($file_led_reak),
                        'status' => 'fa-check'
                    ];
            }

            $file_lkps_reak =
                File_reakreditasi::where('kategori', 'lkps')
                ->whereHas('jurusan', function ($query) {
                    $query->where('fakultas_id', Auth::user()->fakultas_id);
                })
                ->whereNot('status', 'Data Sudah Valid')
                ->get();
            if (count($file_lkps_reak) > 0) {
                $tot_lkps_reak =
                    [
                        'jumlah' => count($file_lkps_reak),
                        'status' => 'fa-exclamation'
                    ];
            } else {
                $file_lkps_reak =
                    File_reakreditasi::where('kategori', 'lkps')
                    ->whereHas('jurusan', function ($query) {
                        $query->where('fakultas_id', Auth::user()->fakultas_id);
                    })
                    ->get();
                $tot_lkps_reak =
                    [
                        'jumlah' => count($file_lkps_reak),
                        'status' => 'fa-check'
                    ];
            }

            $file_penyusunan_reak =
                File_reakreditasi::where('kategori', 'penyusunan')
                ->whereHas('jurusan', function ($query) {
                    $query->where('fakultas_id', Auth::user()->fakultas_id);
                })
                ->whereNot('status', 'Data Sudah Valid')
                ->get();
            if (count($file_penyusunan_reak) > 0) {
                $tot_penyusunan_reak =
                    [
                        'jumlah' => count($file_penyusunan_reak),
                        'status' => 'fa-exclamation'
                    ];
            } else {
                $file_penyusunan_reak =
                    File_reakreditasi::where('kategori', 'penyusunan')
                    ->whereHas('jurusan', function ($query) {
                        $query->where('fakultas_id', Auth::user()->fakultas_id);
                    })
                    ->get();
                $tot_penyusunan_reak =
                    [
                        'jumlah' => count($file_penyusunan_reak),
                        'status' => 'fa-check'
                    ];
            }


            // dd($file_sk_reak);

            $total = [
                'SK' => $tot_sk,
                'Renstra' => $tot_renstra,
                'Lain-Lain' => $tot_lain,
                'SK-Reakreditasi' => $tot_sk_reak,
                'LED-Reakreditasi' => $tot_led_reak,
                'LKPS-Reakreditasi' => $tot_lkps_reak,
                'Penyusunan-Reakreditasi' => $tot_penyusunan_reak,
            ];
        }
        // dd($total);
        return view('admin.admin', compact('total'));
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
        //
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
        //
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