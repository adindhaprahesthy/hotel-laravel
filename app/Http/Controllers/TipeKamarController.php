<?php

namespace App\Http\Controllers;
use App\Models\tipe_kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TipeKamarController extends Controller
{
    //create data
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_tipe_kamar'=>'required',
            'harga'=>'required',
            'deskripsi'=>'required',
            'foto'=>'required'
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $save =tipe_kamar::create([
            'nama_tipe_kamar'=>$request->nama_tipe_kamar,
            'harga'=>$request->harga,
            'deskripsi'=>$request->deskripsi,
            'foto'=>$request->foto
        ]);
        if($save){
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
    
    public function UploadFotoTipeKamar(Request $request, $id)
    {

    $validator=Validator::make($request->all(),
    [
    'foto' => 'required|file|mimes:jpeg,png,jpg|max:2048',
    ]
    );
    
    if($validator->fails()) {
        return Response()->json($validator->errors());
    }

    //define nama file yang akan di upload
    $imageName = time().'.'.$request->foto->extension();

    //proses upload
    $request->foto->move(public_path('images'), $imageName);

    $update = tipe_kamar::where('id_tipe_kamar', $id)->update([
            'image' => $imageName
            ]);
    
    $data = tipe_kamar::where('id_tipe_kamar', '=', $id) -> get();
    if($update)
    {
        return Response()->json([
            'status' => 1,
            'message' => 'success upload foto tipe kamar !'
    ]);

    }
    else
    {
        return Response()->json([
            'status' => 0,
            'message' => 'failed upload foto tipe kamar !'
    ]);
    }
    }

    //show data
    public function show()
    {
        return tipe_kamar::all();
    }

    //show detail data
    public function detail($id)
    {
        if(tipe_kamar::where('id_tipe_kamar', $id)->exists()){
            $data_tipe_kamar= tipe_kamar::select('tipe_kamar.id_tipe_kamar', 'nama_tipe_kamar', 'harga', 'deskripsi', 'foto')->where('id_tipe_kamar', '=', $id)->get();
            return Response()->json($data_tipe_kamar);
        }
        else{
            return Response()->json(['message' => 'Tidak ditemukan']);
        }
    }

    //show update data
    public function update($id, Request $request) {         
        $validator=Validator::make($request->all(),         
        [   
            'nama_tipe_kamar'=>'required',
            'harga'=>'required',
            'deskripsi'=>'required',
            'foto'=>'required'
        ]); 

        if($validator->fails()) {             
            return Response()->json($validator->errors());         
        } 

        $ubah = tipe_kamar::where('id_tipe_kamar', $id)->update([             
            'nama_tipe_kamar'=>$request->nama_tipe_kamar,
            'harga'=>$request->harga,
            'deskripsi'=>$request->deskripsi,
            'foto'=>$request->foto
              
        ]); 

        if($ubah) {             
            return Response()->json(['status' => 1]);         
        }         
        else {             
            return Response()->json(['status' => 0]);         
        }     
    }

    //delete data
    public function delete($id)
    {
        $hapus = tipe_kamar::where('id_tipe_kamar', $id)->delete();

        if($hapus) {
            return Response()->json(['status' => 1]);
        }

        else {
            return Response()->json(['status' => 0]);
        }
    }
}
