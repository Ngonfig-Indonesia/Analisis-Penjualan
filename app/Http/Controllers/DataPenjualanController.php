<?php

namespace App\Http\Controllers;

use App\Models\DataPenjualan;
use App\Models\Bulan;
use Illuminate\Http\Request;
use App\Imports\TransaksiImport;
use Maatwebsite\Excel\Facades\Excel;

class DataPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DataPenjualan::select('bulan_id','tanggal_transaksi','qty','total_harga',\DB::raw('MONTH(tanggal_transaksi) month'),\DB::raw('SUM(qty) qty'),\DB::raw('SUM(total_harga) total_harga'))->groupBy('month','bulan_id')->get();

        $chart = DataPenjualan::select('tanggal_transaksi','total_harga',\DB::raw('MONTH(tanggal_transaksi) month'),\DB::raw('SUM(total_harga) total_harga'))->groupBy('month','bulan_id')->get();

        $year = DataPenjualan::select('tanggal_transaksi', \DB::raw('YEAR(tanggal_transaksi) tahun'))->groupBy('tahun')->get();

        $count = DataPenjualan::select('nama_barang','qty', \DB::raw('SUM(qty) qty'))->orderBy('qty', 'desc')->groupBy('nama_barang')->limit(10)->get();
        $counts = DataPenjualan::select('nama_barang', \DB::raw('SUM(qty) qty'))->orderBy('qty', 'asc')->groupBy('nama_barang')->get();

        $bulan = DataPenjualan::select('bulan_id','tanggal_transaksi', \DB::raw('MONTH(tanggal_transaksi) month'))->groupBy('month','bulan_id')->get();
        $bulan1 = Bulan::with(['penjualan' => function ($q){
            $q->select('bulan_id','nama_barang','qty');
        }])->get();

        // dd($bulan1);
        return view('welcome', compact('data','count','year','chart','counts','bulan','bulan1'));
        
    }

    public function find($id)
    {
        $bulan = Bulan::with(['penjualan' => function ($q){
            $q->select('bulan_id','tanggal_transaksi','qty','total_harga', \DB::raw('SUM(qty) qty'),\DB::raw('SUM(total_harga) total_harga'))->orderBy('tanggal_transaksi')->groupBy('tanggal_transaksi');
        }])->findOrFail($id);

        $count = Bulan::with(['penjualan' => function ($q){
            $q->select('bulan_id','nama_barang','qty', \DB::raw('SUM(qty) qty'))->orderBy('qty','desc')->groupBy('nama_barang');
        }])->findOrFail($id);

        // dd($count);
        return view('show', compact('bulan','count'));
    }

    // public function search(Request $request)
    // {
    //     if($request->search){
    //         $x = $request->search;
    //         $data = DataPenjualan::select('tanggal_transaksi', \DB::raw('YEAR(tanggal_transaksi) tahun'), $x)->get();
    //     }else{
    //         $data = DataPenjualan::select('bulan_id','tanggal_transaksi','qty','total_harga',\DB::raw('MONTH(tanggal_transaksi) month'),\DB::raw('SUM(qty) qty'),\DB::raw('SUM(total_harga) total_harga'))->groupBy('month','bulan_id')->get();
    //     }
    //     return view('welcome', compact('data'));
    // }

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
        //
    }

    public function import(Request $request)
    {
        // $this->validate($request, [
		// 	'file' => 'required|mimes:csv,xls,xlsx'
		// ]);

        Excel::import(new TransaksiImport, $request->file('import'));
        return back()->with('success',' Data Berhasil Import');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataPenjualan  $dataPenjualan
     * @return \Illuminate\Http\Response
     */
    public function show(DataPenjualan $dataPenjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataPenjualan  $dataPenjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(DataPenjualan $dataPenjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataPenjualan  $dataPenjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataPenjualan $dataPenjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataPenjualan  $dataPenjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataPenjualan $dataPenjualan)
    {
        //
    }
}
