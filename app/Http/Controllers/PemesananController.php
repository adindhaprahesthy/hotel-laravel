<?php

namespace App\Http\Controllers;
use App\Models\pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PemesananController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[                                                                                                                                                          
            'nomor_pemesanan' => 'required',
            'nama_pemesan'    => 'required',
            'email_pemesan'   => 'required',
            // 'tgl_pemesanan'   => 'required',
            'tgl_check_in'    => 'required',
            'durasi'        => 'required',
            // 'tgl_check_out'   => 'required',
            'nama_tamu'       => 'required',
            'jumlah_kamar'    => 'required',
            'id_tipe_kamar'   => 'required',
            // 'status_pemesanan'=> 'required',
            'id_user'         => 'nullable'
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }


        $durasi = $request->durasi;
        $checkin = new Carbon ($request->tgl_check_in);
        $checkout = $checkin -> addDays($durasi);
        $sekarang = Carbon::now();

        $save = pemesanan::create([
            'nomor_pemesanan'    => $request->nomor_pemesanan,
            'nama_pemesan'       => $request->nama_pemesan,
            'email_pemesan'      => $request->email_pemesan,
            'tgl_pemesanan'      => $sekarang,
            'tgl_check_in'       => $request->tgl_check_in,
            //'durasi'           => $request->$durasi,
            'tgl_check_out'      => $checkout,
            'nama_tamu'          => $request->nama_tamu,
            'jumlah_kamar'       => $request->jumlah_kamar,
            'id_tipe_kamar'      => $request->id_tipe_kamar,
            'status_pemesanan'   => 1,
    
            
        ]);
        if($save){
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }

     //show data
     public function show()
     {
         return pemesanan::all();
     }

    // public function show()
    //     {
    //         $data_pemesanan = pemesanan::join('user2', 'user2.id_user', 'pemesanan.id_user')->get();
    //         return Response()->json($data_pemesanan);
    //         //$data_detail_pemesanan = detail_pemesanan::join('pemesanan', 'pemesanan.id_pemesanan', 'detail_pemesanan.id_pemesanan')->get();
    //         //return Response()->json($data_pemesanan);
    //     }
        
    //  //show detail data
    //  public function detail($id)
    //  {
    //      if(pemesanan::where('id_pemesanan', $id)->exists()){
    //          $data_pemesanan= pemesanan::select('pemesanan.id_pemesanan', 'nomor_pemesanan', 'nama_pemesan', 'email_pemesan', 'tgl_pemesanan', 'tgl_check_in', 'tgl_check_out', 'nama_tamu', 'jumlah_kamar', 'id_tipe_kamar', 'status_pemesanan', 'email_pemesan', 'tgl_pemesanan')->where('id_tipe_kamar', '=', $id)->get();
    //          return Response()->json($data_tipe_kamar);
    //      }
    //      else{
    //          return Response()->json(['message' => 'Tidak ditemukan']);
    //      }
    //  }

    public function detail($id)
     {
             if(pemesanan::where('id_pemesanan', $id)->exists()){
                 $data_pemesanan = pemesanan::join('User', 'User.id_user', 'pemesanan.id_user') ->where('pemesanan.id_pemesanan', '=', $id)->get();
                 return Response()->json($data_pemesanan);
             }
             else{
                 return Response()->json(['message' => 'Tidak ditemukan']);
             }
         }

    public function update($id, Request $request) {         
        $validator=Validator::make($request->all(),         
        [   
            'nomor_pemesanan' => 'required',
            'nama_pemesan'    => 'required',
            'email_pemesan'   => 'required',
            'tgl_pemesanan'   => 'required',
            'tgl_check_in'    => 'required',
            //'durasi'        => 'required',
            'tgl_check_out'   => 'required',
            'nama_tamu'       => 'required',
            'jumlah_kamar'    => 'required',
            'id_tipe_kamar'   => 'required',
            'status_pemesanan'=> 'required',
            'id_user'         => 'required'
        ]); 

        if($validator->fails()) {             
            return Response()->json($validator->errors());         
        } 

        $ubah = pemesanan::where('id_pemesanan', $id)->update([             
            'nomor_pemesanan'    => $request->nomor_pemesanan,
            'nama_pemesan'       => $request->nama_pemesan,
            'email_pemesan'      => $request->email_pemesan,
            'tgl_pemesanan'      => $request->tgl_pemesanan,
            'tgl_check_in'       => $request->tgl_check_in,
            //'durasi'           => $request->$durasi,
            'tgl_check_out'      => $request->tgl_check_out,
            'nama_tamu'          => $request->nama_tamu,
            'jumlah_kamar'       => $request->jumlah_kamar,
            'id_tipe_kamar'      => $request->id_tipe_kamar,
            'status_pemesanan'   => $request->status_pemesanan,
            'id_user'            => $request->id_user
        ]); 

        if($ubah) {             
            return Response()->json(['status' => 1]);         
        }         
        else {             
            return Response()->json(['status' => 0]);         
        }     
    }

    public function delete($id)
    {
        $hapus = pemesanan::where('id_pemesanan', $id)->delete();

        if($hapus) {
            return Response()->json(['status' => 1]);
        }

        else {
            return Response()->json(['status' => 0]);
        }
    }
    
}
