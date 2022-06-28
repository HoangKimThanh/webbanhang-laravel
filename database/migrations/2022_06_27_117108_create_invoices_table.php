<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id');
            $table->string('receiver_name', 100);
            $table->string('receiver_phone', 10);
            $table->string('receiver_email', 200);
            $table->integer('receiver_province');
            $table->integer('receiver_district');
            $table->integer('receiver_ward');
            $table->string('receiver_address');
            $table->integer('total');
            $table->string('payment', 100);
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('invoices');
    }
}
