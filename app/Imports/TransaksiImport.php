<?php

namespace App\Imports;
use App\Models\DataPenjualan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TransaksiImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $barang = new DataPenjualan;
        $barang->bulan_id = $row['bulan'];
        $barang->tanggal_transaksi = $row['tanggal'];
        $barang->nama_barang = $row['namabarang'];
        $barang->qty = $row['qty'];
        $barang->satuan = $row['satuan'];
        $barang->total_harga = $row['totalharga'];
        $barang->save();
    }
}
