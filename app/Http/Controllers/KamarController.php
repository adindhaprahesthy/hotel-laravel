<?php

namespace App\Http\Controllers;
use App\Models\kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class KamarController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[                                                                                                                                                          
            'nomor_kamar'=>'required',
            'id_tipe_kamar'=>'required'
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $save = kamar::create([
            'nomor_kamar'    =>$request->nomor_kamar,
            'id_tipe_kamar' =>$request->id_tipe_kamar
        ]);
        if($save){
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }

    public function show()
        {
            $data_kamar = kamar::join('tipe_kamar', 'tipe_kamar.id_tipe_kamar', 'kamar.id_tipe_kamar')->get();
            return Response()->json($data_kamar);
        }
        
    public function detail($id)
        {
            if(kamar::where('id_kamar', $id)->exists()){
                $data_kamar = kamar::join('tipe_kamar', 'tipe_kamar.id_tipe_kamar', 'kamar.id_tipe_kamar') ->where('kamar.id_kamar', '=', $id)->get();
                return Response()->json($data_kamar);
            }
            else{
                return Response()->json(['message' => 'Tidak ditemukan']);
            }
        }

    public function update($id, Request $request) {         
        $validator=Validator::make($request->all(),         
        [   
            'nomor_kamar'=>'required',
            'id_tipe_kamar'=>'required'
        ]); 

        if($validator->fails()) {             
            return Response()->json($validator->errors());         
        } 

        $ubah = kamar::where('id_kamar', $id)->update([             
            'nomor_kamar'    =>$request->nomor_kamar,
            'id_tipe_kamar' =>$request->id_tipe_kamar
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
        $hapus = kamar::where('id_kamar', $id)->delete();

        if($hapus) {
            return Response()->json(['status' => 1]);
        }

        else {
            return Response()->json(['status' => 0]);
        }
    }
    
}
