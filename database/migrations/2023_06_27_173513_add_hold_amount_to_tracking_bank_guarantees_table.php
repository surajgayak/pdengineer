<?php

use App\Http\Livewire\TrackingBankGuarantee\TrackingBankGuaranteeCreate;
// use App\Models\TrackingBankGuaranteeCreate;
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
        Schema::table('tracking_bank_guarantees', function (Blueprint $table) {
            $table->double('hold_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tracking_bank_guarantees', function (Blueprint $table) {
            $table->dropColumn('hold_table');
        });
    }
};
