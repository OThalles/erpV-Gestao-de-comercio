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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(False);
            $table->unsignedbigInteger('identification_number')->unique();
            $table->string('name')->nullable(False);
            $table->string('price', 100)->nullable(False);
            $table->integer('quantity')->nullable(False);
            $table->unsignedBigInteger('qt_vendas')->nullable(False);
            $table->timestamps();
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
