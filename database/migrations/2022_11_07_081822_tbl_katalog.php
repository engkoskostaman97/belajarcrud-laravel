<?php

use GuzzleHttp\Promise\Create;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblKatalog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::Create('tbl_katalog', function (Blueprint $table){
          $table -> increments ('id');
          $table -> string('nama_produk');
          $table -> string ('berat');
          $table ->float('harga');
          $table ->string('gambar');
          $table ->string('keterangan');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
