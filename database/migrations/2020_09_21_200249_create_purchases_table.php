<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            
			$table->id();
			$table->string('no_contract');
			$table->string('customer');
			$table->string('end_customer');
			$table->string('project_name');
			$table->string('project_year', 4)->nullable();
			$table->string('type_contract')->nullable();
			$table->date('start_contract')->nullable();
			$table->date('end_contract')->nullable();
			$table->integer('total_contract_value')->default(0);
            $table->integer('status_contract')->default(0);
            
			$table->integer('balance')->default(0);

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
        Schema::dropIfExists('contracts');
    }
}
