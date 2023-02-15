<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->bigInteger('tracking_number')->unique();
            $table->integer('code_number');
            $table->integer('tacking_status_id');
            $table->integer('track_method_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->datetime('tracking_date')->nullable();
            $table->integer('type_tracking_id')->nullable();
            $table->integer('cartons_number')->nullable();
            $table->integer('pieces_number')->nullable();
            $table->decimal('invoice_value')->nullable();
            $table->datetime('arrival_time')->nullable();
            $table->timestamps();
            $table->SoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trackings');
    }
}
