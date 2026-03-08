<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcel_updates', function (Blueprint $table) {
            $table->id();
            // $table->string('tracking_num')->nullable();      //if later nak letak tracknum
            $table->string('name');
            $table->string('email');
            $table->string('parcel_status');
            $table->timestamps();
            // $table->timestamp('created_at')->now();
            // $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parcel_updates');
    }
}
