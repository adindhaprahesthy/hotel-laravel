<?php

namespace App\Http\Controllers;
use App\Models\detail_pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DetailPemesananController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[                                                                                                                                                          
            'id_pemesanan'=>'required',
            'id_kamar'    =>'required',
            'tgl_akses'   =>'required',
            'harga'       =>'required'
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $save = detail_pemesanan::create([
            'id_pemesanan'    =>$request->id_pemesanan,
            'id_kamar'        =>$request->id_kamar,
            'tgl_akses'       =>$request->tgl_akses,
            'harga'           =>$request->harga
        ]);
        if($save){
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }

    public function show()
        {
            $data_detail_pemesanan = detail_pemesanan::join('pemesanan', 'pemesanan.id_pemesanan', 'detail_pemesanan.id_pemesanan')->get();
            return Response()->json($data_detail_pemesanan);
            //$data_detail_pemesanan = detail_pemesanan::join('pemesanan', 'pemesanan.id_pemesanan', 'detail_pemesanan.id_pemesanan')->get();
            //return Response()->json($data_pemesanan);
        }
        
    public function detail($id)
        {
            if(detail_pemesanan::where('id_detail_pemesanan', $id)->exists()){
                $data_detail_pemesanan = detail_pemesanan::join('pemesanan', 'pemesanan.id_pemesanan', 'detail_pemesanan.id_pemesanan') ->where('detail_pemesanan.id_detail_pemesanan', '=', $id)->get();
                return Response()->json($data_detail_pemesanan);
            }
            else{
                return Response()->json(['message' => 'Tidak ditemukan']);
            }
        }

    public function update($id, Request $request) {         
        $validator=Validator::make($request->all(),         
        [   
            'id_pemesanan'=>'required',
            'id_kamar'    =>'required',
            'tgl_akses'   =>'required',
            'harga'       =>'required'
        ]); 

        if($validator->fails()) {             
            return Response()->json($validator->errors());         
        } 

        $ubah = detail_pemesanan::where('id_detail_pemesanan', $id)->update([             
            'id_pemesanan'    =>$request->id_pemesanan,
            'id_kamar'        =>$request->id_kamar,
            'tgl_akses'       =>$request->tgl_akses,
            'harga'           =>$request->harga
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
        $hapus = detail_pemesanan::where('id_detail_pemesanan', $id)->delete();

        if($hapus) {
            return Response()->json(['status' => 1]);
        }

        else {
            return Response()->json(['status' => 0]);
        }
    }
    
}
