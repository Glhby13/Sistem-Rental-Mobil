<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MobilController extends Controller
{
    public function search_trash(Request $request)
    {
        $get_nama = $request->nama_mobil;
        $datas = DB::table('mobil')->where('deleted_at', '<>', '' )->where('nama_mobil', 'LIKE', '%'.$get_nama.'%')->get();
        return view('mobil.trash')
        ->with('datas', $datas);
    }
    public function restore($id)
    {
        DB::update('UPDATE mobil SET deleted_at=null WHERE id_mobil = :id_mobil', ['id_mobil' => $id]);
        return redirect()->route('mobil.trash');
    }
    public function trash()
    {
        $datas = DB::select('select * from mobil where deleted_at is not null');
        return view('mobil.trash')
            ->with('datas', $datas);
    }
    public function hide($id)
    {
        DB::update('UPDATE mobil SET deleted_at=current_timestamp() WHERE id_mobil = :id_mobil', ['id_mobil' => $id]);
        return redirect()->route('mobil.index')->with('success', 'Data Mobil berhasil dihapus');
    }
    public function search(Request $request)
    {
        $get_nama = $request->nama_mobil;
        $datas = DB::table('mobil')->where('deleted_at', NULL )->where('nama_mobil', 'LIKE', '%'.$get_nama.'%')->get();
        return view('mobil.index')->with('datas', $datas);
    }
    public function delete($id)
    {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM mobil WHERE id_mobil = :id_mobil', ['id_mobil' => $id]);
        return redirect()->route('mobil.trash');
    }
    public function edit($id)
    {
        $data = DB::table('mobil')->where('id_mobil', $id)->first();
        return view('mobil.edit')->with('data', $data);
    }
    public function update($id, Request $request)
    {
        $request->validate([
            'id_mobil' => 'required',
            'nama_mobil' => 'required',
            'tipe_mobil' => 'required',
        ]);
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update(
            'UPDATE mobil SET id_mobil = :id_mobil, nama_mobil = :nama_mobil, tipe_mobil = :tipe_mobil WHERE id_mobil = :id',
            [
                'id' => $id,
                'id_mobil' => $request->id_mobil,
                'nama_mobil' => $request->nama_mobil,
                'tipe_mobil' => $request->tipe_mobil,
            ]
        );
        return redirect()->route('mobil.index')->with('success', 'Data Mobil berhasil diubah');
    }
    public function index()
    {
        $datas = DB::select('select * from mobil where deleted_at is null');
        return view('mobil.index')
            ->with('datas', $datas);
    }
    public function create()
    {
        return view('mobil.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_mobil' => 'required',
            'nama_mobil' => 'required',
            'tipe_mobil' => 'required',
        ]);
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert(
            'INSERT INTO mobil(id_mobil, nama_mobil, tipe_mobil) VALUES (:id_mobil, :nama_mobil, :tipe_mobil)',
            [
                'id_mobil' => $request->id_mobil,
                'nama_mobil' => $request->nama_mobil,
                'tipe_mobil' => $request->tipe_mobil,
            ]
        );
        return redirect()->route('mobil.index')->with('success', 'Data mobil berhasil disimpan');
    }
}