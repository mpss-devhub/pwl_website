<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tnx', function (Blueprint $table) {
            $table->id();
            $table->foreignId('link_id')->constrained('links')->cascadeOnDelete();
            $table->string('paymentCode')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_expired_at')->nullable();
            $table->string('payment_created_at')->nullable();
            $table->string('tranref_no')->nullable();
            $table->string('bank_tranref_no')->nullable();
            $table->decimal('txn_amount', 15, 2)->nullable();
            $table->decimal('net_amount', 15, 2)->nullable();
            $table->timestamp('trans_date_time')->nullable();
            $table->string('created_by')->default('system');
            $table->string('deleted_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tnxes');
    }
};
