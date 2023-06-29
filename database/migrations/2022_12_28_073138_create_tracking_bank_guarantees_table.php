<?php

use App\Enums\TrackingStatus;
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
        Schema::create('tracking_bank_guarantees', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->nullable();
            $table->string('start_date')->nullable();
            $table->string('project_name')->nullable();
            $table->string('client_name')->nullable();
            $table->string('expiry_date')->nullable();
            $table->integer('status')->default(TrackingStatus::ACTIVE);
            $table->softDeletes();
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
        Schema::dropIfExists('tracking_bank_guarantees');
    }
};
