<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_penjualans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bulan_id');
            $table->date('tanggal_transaksi');
            $table->string('nama_barang');
            $table->string('qty');
            $table->string('satuan');
            $table->string('total_harga');
            $table->timestamps();

            $table->foreign('bulan_id')->references('id')->on('bulans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_penjualans');
    }
}
