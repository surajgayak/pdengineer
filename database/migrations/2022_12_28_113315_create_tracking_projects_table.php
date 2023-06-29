<?php

use App\Enums\TrackingProjectStatus;
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
        Schema::create('tracking_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id')->restrictOnDelete();
            $table->string('start_date')->nullable(); //project start_date
            $table->string('project_name')->nullable();
            $table->string('client_name')->nullable();
            $table->string('user_deadline_accomplish_date')->nullable();
            $table->longText('job')->nullable();
            $table->string('deadline_date')->nullable(); //project end_date
            $table->integer('user_project_status')->default(TrackingProjectStatus::NOT_STARTED);
            $table->integer('teacking_project_status')->default(0);
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
        Schema::dropIfExists('tracking_projects');
    }
};
