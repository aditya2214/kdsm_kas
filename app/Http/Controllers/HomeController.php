<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DataTables;
use DB;
use Alert;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $kas = \App\Kas::first();
        return view('home',compact('kas'));
    }

    public function json(){
        $wargas = DB::table('wargas')->orderBy('created_at','DESC');
        return Datatables::of($wargas)
        ->editColumn('aksi', function ($wargas) {
            if(Auth::user()->role == 2 ){
                return "<button type='button' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#exampleModal2' onClick='reply_click(".$wargas->id.")'>Edit</button><br> <a class='btn btn-danger btn-sm' href='hapus-data-warga/".$wargas->id."'><i class='fas fa-trash-alt'></i></a>";
            }
        })
        ->escapeColumns([])
        ->make(true);
    }

    public function get($id){
        $war = \App\Warga::where('id',$id)->first();

        if(!$war){
            return [
                'success' => false,
                'data' => null
            ];
        }

        return [
            'success' => true,
            'data' => $war
        ];

    }


    public function penambahan_kas()
    {
        $kas = \App\Kas::first();
        return view('penambahan_kas',compact('kas'));
    }

    public function pengurangan_kas()
    {
        $kas = \App\Kas::first();
        return view('pengurangan_kas',compact('kas'));
    }

    public function lengkapi_profil()
    {
        $kas = \App\Kas::first();
        return view('pengurangan_kas',compact('kas'));
    }

    public function simpan_data_warga(Request $request)
    {
        try {
            //code...
            $warga = new \App\Warga;
            $warga->nama = $request->nama ;
            $warga->usia = $request->usia ;
            $warga->tanggal_lahir = $request->tanggal_lahir ;
            $warga->rt = $request->rt ;
            $warga->rw = $request->rw ;
            $warga->pekerjaan = $request->pekerjaan ;
            $warga->nomor_hp = $request->nomor_hp ;
            $warga->id_status = $request->id_status ;
            $warga->id_user = Auth::user()->id;
            $warga->save();
    
            Alert::success(' Success ', ' Berhasil Simpan');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            Alert::error(' Upps!!! ', ' Ada Masalah');
            return redirect()->back();
        }
       
    }

    public function tambah_kas(Request $request){
        try {
            //code...
            $pemasuka = new \App\Pemasukan;
            $pemasuka->nama = $request->nama;
            $pemasuka->nominal_pemasukan = $request->nominal_pemasukan;
            $pemasuka->status = 0;

            $pemasuka->save();
            Alert::success(' Success ', ' Berhasil Simpan');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            Alert::error(' Upps!!! ', ' Ada Masalah');
            return redirect()->back();
        }
    }

    public function pengeluaran_kas(Request $request){
       try {
           //code...
           $pemasuka = new \App\Pengeluaran;
           $pemasuka->id_user = Auth::user()->name;
           $pemasuka->for = $request->for;
           $pemasuka->nominal_pengeluaran = $request->nominal_pengeluaran;
           $pemasuka->status = 0;
           $pemasuka->save();
   
           Alert::success(' Success ', ' Berhasil Simpan');
           return redirect()->back();
       } catch (\Throwable $th) {
           //throw $th;
           Alert::error(' Upps!!! ', ' Ada Masalah');
           return redirect()->back();
       }
    }

    public function json_pemasukan(){
        if (Auth::user()->role == 3) {
            # code...
            $pemasukan = DB::table('pemasukans')->orderBy('created_at','DESC');
            return Datatables::of($pemasukan)
            ->editColumn('aksi', function ($pemasukan) {
                if ($pemasukan->status == 1) {
                    # code...
                }elseif ($pemasukan->status == 0) {
                    # code...
                    return "<a class='btn btn-warning btn-sm' href='saksi/".$pemasukan->id."'>Approve Wakil</a>";
                }
            })
            ->editColumn('status', function ($pemasukan) {
                if ($pemasukan->status == 2) {
                    # code...
                    return "<span class='badge badge-success'>Sudah Di Approved Ketua</span>";
                }
                if ($pemasukan->status == 1) {
                    # code...
                    return "<span class='badge badge-warning'>Sudah Di Approved Wakil</span>";
                }
                if ($pemasukan->status == 0) {
                    # code...
                    return "<span class='badge badge-danger'>Belum Di Approved</span>";
                }
            })
            ->escapeColumns([])
            ->make(true);
        }elseif (Auth::user()->role == 4) {
            # code...
            $pemasukan = DB::table('pemasukans')->orderBy('created_at','DESC')->where('status','>',0);
            return Datatables::of($pemasukan)
            ->editColumn('aksi', function ($pemasukan) {
                if ($pemasukan->status == 2) {

                }elseif($pemasukan->status == 1){
                        return "<a class='btn btn-success btn-sm' href='penerima/".$pemasukan->id."'>Approve Ketua</a>";
                    }
            })
            ->editColumn('status', function ($pemasukan) {
                if ($pemasukan->status == 2) {
                    # code...
                    return "<span class='badge badge-success'>Sudah Di Approved</span>";
                }
                if ($pemasukan->status == 1) {
                    # code...
                    return "<span class='badge badge-danger'>Belum Di Approved</span>";
                }
            })
            ->escapeColumns([])
            ->make(true);
        }elseif (Auth::user()->role == 1) {
            # code...
            $pemasukan = DB::table('pemasukans')->orderBy('created_at','DESC');
            return Datatables::of($pemasukan)
            ->editColumn('aksi', function ($pemasukan) {
                // if(Auth::user()->role == 3 ){
                //     return "<a class='btn btn-warning btn-sm' href=''>Approve Ketua</a>";
                // }
            })
            ->editColumn('status', function ($pemasukan) {
                if ($pemasukan->status == 2) {
                    # code...
                    return "<span class='badge badge-success'>Sudah Di Approved Ketua</span>";
                }
                if ($pemasukan->status == 1) {
                    # code...
                    return "<span class='badge badge-warning'>Sudah Di Approved Wakil</span>";
                }
                if ($pemasukan->status == 0) {
                    # code...
                    return "<span class='badge badge-danger'>Belum Di Approved</span>";
                }
            })
            ->escapeColumns([])
            ->make(true);
        }elseif (Auth::user()->role == 2) {
            # code...
            $pemasukan = DB::table('pemasukans')->orderBy('created_at','DESC');
            return Datatables::of($pemasukan)
            ->editColumn('aksi', function ($pemasukan) {
                // if(Auth::user()->role == 3 ){
                //     return "<a class='btn btn-warning btn-sm' href=''>Approve Ketua</a>";
                // }
            })
            ->editColumn('status', function ($pemasukan) {
                if ($pemasukan->status == 2) {
                    # code...
                    return "<span class='badge badge-success'>Sudah Di Approved Ketua</span>";
                }
                if ($pemasukan->status == 1) {
                    # code...
                    return "<span class='badge badge-warning'>Sudah Di Approved Wakil</span>";
                }
                if ($pemasukan->status == 0) {
                    # code...
                    return "<span class='badge badge-danger'>Belum Di Approved</span>";
                }
            })
            ->escapeColumns([])
            ->make(true);
        }
    }

    public function json_pengeluaran(){
        if (Auth::user()->role == 1) {
            # code...
            $pengeluaran = DB::table('pengeluarans')->orderBy('created_at','DESC');
            return Datatables::of($pengeluaran)
            ->editColumn('aksi', function ($pengeluaran) {
                // if(Auth::user()->role == 2 ){
                //     return "<a class='btn btn-warning btn-sm' href=''>Edit</a> <hr> <a class='btn btn-danger btn-sm' href=''>Hapus</a>";
                // }
            })
            ->editColumn('status', function ($pengluaran) {
                if ($pengluaran->status == 0) {
                    # code...
                    return "<span class='badge badge-danger'>Belum Di Approved</span>";
                }
                if ($pengluaran->status == 1) {
                    # code...
                    return "<span class='badge badge-warning'>Sudah Di Approved Wakil</span>";
                }
                if ($pengluaran->status == 2) {
                    # code...
                    return "<span class='badge badge-success'>Sudah Di Approve Ketua</span>";
                }
            })
            ->escapeColumns([])
            ->make(true);
        }elseif (Auth::user()->role == 2) {
            # code...
            $pengeluaran = DB::table('pengeluarans')->orderBy('created_at','DESC');
            return Datatables::of($pengeluaran)
                ->editColumn('aksi', function ($pengeluaran) {
                    // if(Auth::user()->role == 2 ){
                    //     return "<a class='btn btn-warning btn-sm' href=''>Edit</a> <hr> <a class='btn btn-danger btn-sm' href=''>Hapus</a>";
                    // }
                })
                ->editColumn('status', function ($pengluaran) {
                    if ($pengluaran->status == 0) {
                        # code...
                        return "<span class='badge badge-danger'>Belum Di Approved</span>";
                    }
                    if ($pengluaran->status == 1) {
                        # code...
                        return "<span class='badge badge-warning'>Sudah Di Approved Wakil</span>";
                    }
                    if ($pengluaran->status == 2) {
                        # code...
                        return "<span class='badge badge-success'>Sudah Di Approve Ketua</span>";
                    }
                })
            ->escapeColumns([])
            ->make(true);
        }elseif (Auth::user()->role == 3) {
            # code...
            $pengeluaran = DB::table('pengeluarans')->orderBy('created_at','DESC');
            return Datatables::of($pengeluaran)
                ->editColumn('aksi', function ($pengeluaran) {
                    if ($pengeluaran->status > 0) {
                        # code...
                    }else{

                        return "<a class='btn btn-warning btn-sm' href='saksi_pengeluaran/".$pengeluaran->id."'>Approve Wakil</a>";
                    }
                })
                ->editColumn('status', function ($pengluaran) {
                    if ($pengluaran->status == 0) {
                        # code...
                        return "<span class='badge badge-danger'>Belum Di Approved</span>";
                    }
                    if ($pengluaran->status == 1) {
                        # code...
                        return "<span class='badge badge-warning'>Sudah Di Approved Wakil</span>";
                    }
                    if ($pengluaran->status == 2) {
                        # code...
                        return "<span class='badge badge-success'>Sudah Di Approve Ketua</span>";
                    }
                })
            ->escapeColumns([])
            ->make(true);
        }elseif (Auth::user()->role == 4) {
            # code...
            $pengeluaran = DB::table('pengeluarans')->orderBy('created_at','DESC')->where('status','>',0);
            return Datatables::of($pengeluaran)
                ->editColumn('aksi', function ($pengeluaran) {
                    if ($pengeluaran->status > 1) {
                        # code...
                    }else{
                        return "<a class='btn btn-success btn-sm' href='pengesah/".$pengeluaran->id."'>Approve Ketua</a>";
                    }
                })
                ->editColumn('status', function ($pengeluaran) {
                    if ($pengeluaran->status == 2) {
                        # code...
                        return "<span class='badge badge-success'>Sudah Di Approved</span>";
                    }
                    if ($pengeluaran->status == 1) {
                        # code...
                        return "<span class='badge badge-danger'>Belum Di Approved</span>";
                    }
                })
            ->escapeColumns([])
            ->make(true);
        }
        
    }

    public function saksi($id){

       try {
           //code...
           $pemasukan = \App\Pemasukan::where('id',$id)->first();
           $penerimaan = new \App\Penerima;
           $penerimaan->id_donasi = $pemasukan->id;
           $penerimaan->approved = 1;
           $penerimaan->id_user = Auth::user()->id;
           $penerimaan->save();
           $pemasukan->status = 1;
           $pemasukan->save();
   
           Alert::success(' Success ', ' Berhasil Approved');
           return redirect()->back();
       } catch (\Throwable $th) {
           //throw $th;
           Alert::error(' Upps!!! ', ' Ada Masalah');
           return redirect()->back();
       }
    }

    public function penerima($id){
        try {
            //code...
            $pemasukan = \App\Pemasukan::where('id',$id)->first();
            $nominal_pemasukan = $pemasukan->nominal_pemasukan;
            $kas = \App\Kas::first();
            $kas_warga = $kas->nominal;
            $jumlah = $nominal_pemasukan + $kas_warga;
            $k = \App\Kas::where('id',1)->first();
            $k->nominal = $jumlah;
            $k->save();
            $penerimaan = new \App\Penerima;
            $penerimaan->id_donasi = $pemasukan->id;
            $penerimaan->approved = 2;
            $penerimaan->id_user = Auth::user()->id;
            $penerimaan->save();
            $pemasukan->status = 2;
            $pemasukan->save();

            Alert::success(' Success ', ' Berhasil Approved');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            Alert::error(' Upps!!! ', ' Ada Masalah');
            return redirect()->back();
        }
        

    }

    public function saksi_pengeluaran($id){
        
        try {
            //code...
            $pengeluaran = \App\Pengeluaran::where('id',$id)->first();
            $persetujuan = new \App\Persetujuan;
            $persetujuan->id_pengeluaran = $pengeluaran->id;
            $persetujuan->approved = 1;
            $persetujuan->id_user = Auth::user()->id;
            $persetujuan->save();
            $pengeluaran->status = 1;
            $pengeluaran->save();

            Alert::success(' Success ', ' Berhasil Approved');

            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            Alert::error(' Upps!!! ', ' Ada Masalah');
            return redirect()->back();
        }
    }

    public function pengesah($id){
       try {
           //code...
           $pengeluaran = \App\Pengeluaran::where('id',$id)->first();
           $nominal_p = $pengeluaran->nominal_pengeluaran;
           $kas = \App\Kas::first();
           $kas_warga = $kas->nominal;
           $jumlah = $kas_warga - $nominal_p;
   
           $k = \App\Kas::where('id',1)->first();
           $k->nominal = $jumlah;
           $k->save();
   
           $persetujuan = new \App\Persetujuan;
           $persetujuan->id_pengeluaran = $pengeluaran->id;
           $persetujuan->approved = 2;
           $persetujuan->id_user = Auth::user()->id;
           $persetujuan->save();
           $pengeluaran->status = 2;
           $pengeluaran->save();
   
           Alert::success(' Success ', ' Berhasil Approved');
          return redirect()->back();
       } catch (\Throwable $th) {
           //throw $th;
            Alert::error(' Upps!!! ', ' Ada Masalah');
            return redirect()->back();
       }
    }

    public function hapus_data_warga($id){
        try {
            //code...
            $hapus_data_warga = \App\Warga::where('id',$id)->delete();

            Alert::success('Success', 'Berhasil Hapus Data');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            Alert::error(' Upps!!! ', ' Ada Masalah');
            return redirect()->back();
        }
       
    }
}
