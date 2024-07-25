<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Actor;

class ActorController extends Controller
{
    public function index(){
        $actor = Actor::latest()->get();
        $response = [
            'seccess' => true,
            'message' => 'data actor',
            'data' => $actor
        ];
        return response()->json($response,200);
    }
    public function store(Request $request)
    {
        // validast data
        $validator = Validator::make($request->all(), [
            'nama_actor' => 'required|unique:actors',
            'biodata' => 'required|unique:actors',
        ], [
            'nama_actor.required' => 'Masukan Actor',
            'nama_actor.unique' => 'Actor Sudah digunakan!',
            'biodata.required' => 'Masukan biodata',
            'biodata.unique' => 'biodata Sudah digunakan!',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Silahkan isi dengan benar',
                'data' => $validator->errors(),
            ], 401);
        } else {
            $actor = new actor;
            $actor->nama_actor = $request->nama_actor;
            $actor->biodata = $request->biodata;
            $actor->save();
        }

        if ($actor) {
            return response()->json([
                'success' => true,
                'message' => 'data berhasil disimpan',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'data gagal disimpan',
            ], 400);
        }
    }
    public function show($id){
        $actor = Actor::find($id);
        if($actor){
            return response()-> json([
                'success' => true,
                'massage' => 'Detail Kategori',
                'data' => $kategori,
            ],200);
        }else{
            return response()-> json([
                  'success' => false,
                'massage' => 'Kategori Tidak Ditemukan',
                'data' => '',
            ],404);
    }
}
public function update(Request $request, $id)
{
    // validast data
    $validator = Validator::make($request->all(), [
        'nama_actor' => 'required',
        'biodata' => 'required',

    ], [
        'nama_actor.required' => 'Masukan Kategori',
        'biodata.required' => 'Masukan Biodata',

    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Silahkan isi dengan benar',
            'data' => $validator->errors(),
        ], 401);
    } else {
        $actor = Actor::find($id);
        $actor->nama_actor = $request->nama_actor;
        $actor->biodata = $request->biodata;
        $actor->save();
    }

    if ($actor) {
        return response()->json([
            'success' => true,
            'message' => 'data berhasil perbarui',
        ], 200);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'data gagal perbarui',
        ], 400);
    }
}

public function destroy($id){
    $actor = actor::find($id);
    $actor -> delete();
    return response()->json([
        'seccess' => true,
        'message' => 'data' . $actor->nama_actor . 'berhasil dihapus',
        'message' => 'data' . $actor->biodata . 'berhasil dihapus'
    ]);
}
}
