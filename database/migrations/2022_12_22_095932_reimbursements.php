<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Reimbursements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reimbursements', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('description');
            $table->string('user_id');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });

        Schema::create('reimbursement_images', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->string('absolute_path');
            $table->string('reimbursement_id');
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
