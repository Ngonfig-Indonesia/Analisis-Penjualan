<?php

namespace App\Models;

use App\Models\DataPenjualan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bulan extends Model
{
    use HasFactory;
    protected $fillable = ['bulan'];

    public function penjualan()
    {
        return $this->hasMany(DataPenjualan::class, 'bulan_id');
    }
}
