<?php

namespace App\Http\Controllers;

use App\Models\Tempat;
use App\Models\Barang;
use App\Models\Setting;
use Illuminate\Http\Request;
use Validator;
use DB;
use PDF;

class TempatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tempat.index');
    }

    public function data()
    {
        $tempat = Tempat::orderBy('id', 'desc')->get();

        return datatables()
            ->of($tempat)
            ->addIndexColumn()
            ->editColumn('nama', function($tempat){
                return '
                    <a href="'.route('tempat.pdf', $tempat->id).'">'.$tempat->nama.'</a>
                ';
            })
            ->addColumn('aksi', function($tempat){
                return 
                '
                    <button onclick="editData(`'.route('tempat.update', $tempat->id).'`)" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
                    <button onclick="deleteData(`'.route('tempat.destroy', $tempat->id).'`)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                ';
            })
            ->rawColumns(['aksi', 'nama'])
            ->make(true);
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
        $request->validate([
            'nama' => 'required',
        ]);

        $tempat = Tempat::create($request->all());
        return view('tempat.index')->with('sukses', 'Data berhasil disimapn');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tempat  $tempat
     * @return \Illuminate\Http\Response
     */
    public function show(Tempat $tempat)
    {
        return response()->json($tempat);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tempat  $tempat
     * @return \Illuminate\Http\Response
     */
    public function edit(Tempat $tempat, $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tempat  $tempat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tempat = Tempat::find($id);

        $tempat->nama = $request->nama;

        $tempat->save();
        
        return response()->json('Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tempat  $tempat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tempat $tempat)
    {
        $tempat->delete($tempat);
        return response()->json(204);
    }

    public function pdf($id)
    {
        $setting = Setting::first();
        $tempat = Tempat::find($id);
        $tempat_nama = $tempat->nama;
        $tempat_id = $tempat->id;

        // $barang = DB::table('barang')->where('tempat_id', $tempat_id)->paginate(5);
        $barang = Barang::with('kategori')->where('tempat_id', $tempat_id)->paginate(100);
        // $barang_category = $barang->category_id;
        // return $barang;
        $pdf = PDF::loadview('tempat.pdf', compact('barang', 'tempat_nama', 'setting'));
        return $pdf->stream('barang.pdf');
    }
}
