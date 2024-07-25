<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index(){
        $kategori = Kategori::latest()->get();
        $response = [
            'seccess' => true,
            'message' => 'data Kategori',
            'data' => $kategori
        ];
        return response()->json($response,200);
    }
    public function store(Request $request)
    {
        // validast data
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|unique:kategoris',
        ], [
            'nama_kategori.required' => 'Masukan Kategori',
            'nama_kategori.unique' => 'Kategori Sudah digunakan!',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Silahkan isi dengan benar',
                'data' => $validator->errors(),
            ], 401);
        } else {
            $kategori = new Kategori;
            $kategori->nama_kategori = $request->nama_kategori;
            $kategori->save();
        }

        if ($kategori) {
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
        $kategori = Kategori::find($id);
        if($kategori){
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
        'nama_kategori' => 'required',
    ], [
        'nama_kategori.required' => 'Masukan Kategori',

    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Silahkan isi dengan benar',
            'data' => $validator->errors(),
        ], 401);
    } else {
        $kategori = Kategori::find($id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();
    }

    if ($kategori) {
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
    $kategori = Kategori::find($id);
    $kategori -> delete();
    return response()->json([
        'seccess' => true,
        'message' => 'data' . $kategori->nama_kategori . 'berhasil dihapus'
    ]);
}
}
