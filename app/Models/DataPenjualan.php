<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPenjualan extends Model
{
    use HasFactory;

    protected $fillable = ['bulan_id','tanggal_transaksi','nama_barang','qty','satuan','total_harga'];

    public function bulan()
    {
        return $this->belongsTo(Bulan::class, 'bulan_id');
    }
}
