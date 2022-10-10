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
        Schema::create('produto_vendidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('venda_id');
            $table->unsignedBigInteger('produto_id');
            $table->string('name')->nullable(False);
            $table->string('value')->nullable(False);
            $table->timestamps();
        });

        Schema::table('produto_vendidos', function (Blueprint $table) {
            $table->foreign('venda_id')
            ->references('id')
            ->on('vendas');
        });

        Schema::table('produto_vendidos', function (Blueprint $table) {
            $table->foreign('user_id')
            ->references('id')
            ->on('users');
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produto_vendidos');
        Schema::table('produto_vendidos', function (Blueprint $table) {
            $table->dropForeign('venda_id');
        });

        Schema::table('produto_vendidos', function (Blueprint $table) {
            $table->dropForeign('user_id');
        });



    }
};
