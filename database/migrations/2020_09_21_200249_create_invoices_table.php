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
            
			$table->id();
			$table->string('no_invoice')->unique();
			$table->unsignedBigInteger('contract_id');

			$table->date   ('date_invoice');
			$table->string ('periode_invoice')->nullable();

			$table->integer('total_invoice')->nullable();
			$table->integer('total_bayar')->default(0);
			$table->integer('total_sisa')->default(0);
			$table->text('keterangan');
			$table->string('status');

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
