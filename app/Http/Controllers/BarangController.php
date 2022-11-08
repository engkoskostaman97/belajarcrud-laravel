<?php

namespace App\Http\Controllers;

use App\Models\tbl_katalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function getData()
    {
        $data = DB::table('tbl_katalog')->get();
        if (count($data) > 0) {
            $res['message'] = "succes";
            $res['value'] = $data;
            return response($res);
        } else {
            $res['message'] = "Empty!";
            return response($res);
        }
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'file' => 'requires|max:2048'
            ]
        );

        $file = $request->file('file');
        $name_file = time() . "-" . $file->getClientOriginalName();

        $tujuan_upload = 'data_file';
        if ($file->move($tujuan_upload, $name_file)) {
            $data = tbl_katalog::create(
                [
                    'nama_produk' => $request->nama_produk,
                    'berat' => $request->berat,
                    'harga' => $request->harga,
                    'gambar' => $name_file,
                    'keterangan' => $request->keterangan,
                ]
            );
            $res['message'] = "succes";
            $res['values'] = $data;
            return response($res);

        }
    }
    public function update(Request $request)
    {
        if (!empty($request->file)) {
            $this->validate(
                $request,
                [
                    'file' => 'required|max:2048'
                ]
            );
            $file = $request->file('file');

            $nama_file = time() . "_" . $file->getClientOriginalName();

            $tujuan_upload = 'data_file';
            $file->move($tujuan_upload, $nama_file);
            $data = DB::table('tbl_katalog')->where('id', $request->id)->get();
            foreach ($data as $katalog) {
                @unlink(public_path('data_file/' . $katalog->gambar));
                $ket = DB::table('tbl_katalog')->where('id', $request->id)->update(
                    [
                        'nama_produk' => $request->nama_produk,
                        'berat' => $request->berat,
                        'harga' => $request->harga,
                        'gambar' => $nama_file,
                        'keterangan' => $request->keterangan,
                    ]
                );
                $res['message'] = "succes";
                $res['values'] = $ket;
                return response($res);
            }
        } else {
            $data = DB::table('tbl_katalog')->where('id', $request->id)->get();
            foreach ($data as $katalog) {
                $ket = DB::table('tbl_katalog')->where('id', $request->id)->update(
                    [
                        'nama_produk' => $request->nama_produk,
                        'berat' => $request->berat,
                        'harga' => $request->harga,
                        'keterangan' => $request->keterangan,
                    ]
                );
                $res['message'] = "succes";
                $res['values'] = $ket;
                return response($res);
            }
        }
    }
}