<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Tempat;
use App\Models\Kategori;
use App\Models\Setting;
use Illuminate\Http\Request;
use PDF;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bulan = date('m');
        $tahun = date('Y');
        // $full = $bulan.'/'.$tahun;

        $max_id = Barang::max('id')+1;
        $category = Kategori::all();
        $tempat = Tempat::all();
        return view('barang.index', compact('tempat', 'max_id', 'category', 'bulan', 'tahun'));
    }

    public function data()
    {
        $barang = Barang::orderBy('id', 'desc')->get();

        return datatables()
            ->of($barang)
            ->addIndexColumn()
            ->addColumn('select_all', function($barang){
                return '
                <input type="checkbox" name="id[]" value="'. $barang->id .'">
                ';
            })
            ->editColumn('tempat_id', function($barang){
                return !empty($barang->tempat->nama) ? $barang->tempat->nama : '';
            })
            ->addColumn('aksi', function($barang){
                return 
                '
                <button type="button" onclick="editData(`'.route('barang.update', $barang->id).'`)" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
                <button type="button" onclick="deleteData(`'.route('barang.destroy', $barang->id).'`)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                <a href="'.route('barang.pdf', $barang->id).'" class="btn btn-sm btn-success"><i class="fa fa-file-pdf"></i></a>
                ';
            })
            ->rawColumns(['aksi', 'select_all'])
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
            'kode' => 'required',
            'tempat_id' => 'required',
            'kategori_id' => 'required',
            'stok' => 'required',
            'ket' => 'required',
        ]);

        $barang = Barang::create($request->all());
        // dd($barang);
        return redirect('barang')->with('sukses', 'Data berhasil disimapn');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        return response()->json($barang);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::find($id);
        $barang->delete();
        return response()->json(204);
    }

    public function cetakBarcode(Request $request){
        $databarang = array();
        foreach ($request->id as $id) {
            $barang = Barang::find($id);
            $databarang[] = $barang;
        }

        $no = 1;

        $pdf = PDF::loadview('barang.barcode', compact('databarang', 'no'));
        $pdf->setPaper([0, 0, 289.13385827, 360], 'landscape' );
        return $pdf->stream('barang.pdf');
    }

    public function pdf($id){
        $setting = Setting::first();
        $barang = Barang::find($id);
        $pdf = PDF::loadview('barang.barcodeSingle', compact('barang', 'setting'));
        $pdf->setPaper([0, 0, 289.13385827, 360], 'landscape' );
        return $pdf->stream('barang.pdf');
    }
}
