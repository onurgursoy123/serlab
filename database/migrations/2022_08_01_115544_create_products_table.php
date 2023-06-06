<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->default('0');
            $table->integer('pages_id')->nullable();
            $table->string('title'); // baslik
            $table->decimal('price', 9, 2)->nullable();; // fiyat
            $table->string('priceLink'); // satis link
            $table->integer('stock')->nullable();; // stok-adet
            $table->text('description')->nullable();; // aciklama
            $table->string('video')->nullable();; // video
            $table->json('img_json')->nullable(); // fotograflar
            $table->json('files_json')->nullable(); // dosyalar
            $table->integer('sort')->default('0'); // siralama
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
