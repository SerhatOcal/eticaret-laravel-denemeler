<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urun', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('urun_adi', 150);
            $table->string('slug', 160);
            $table->text('aciklama');
            $table->decimal('fiyat', 10, 2);
            $table->timestamp('olusturulma_tarihi')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('guncelleme_tarihi')->default(\DB::raw('CURRENT_TIMESTAMP on UPDATE CURRENT_TIMESTAMP'));
            //$table->softDeletes();
            $table->timestamp('silinme_tarihi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('urun');
    }
}
