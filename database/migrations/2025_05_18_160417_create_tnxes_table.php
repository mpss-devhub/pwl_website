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
        Schema::create('tnxes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('link_id')->constrained('links')->cascadeOnDelete();
            $table->string('paymentCode')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_expired_at')->nullable();
            $table->string('payment_created_at')->nullable();
            $table->integer('tnx_phonenumber')->nullable();
            $table->integer('cardNumber')->nullable();
            $table->integer('expiryMonth')->nullable();
            $table->integer('expiryYear')->nullable();
            $table->integer('secuirtyNumber')->nullable();
            $table->string('tranref_no')->nullable(); //invoniceNo
            $table->string('tnx_tranref_no')->nullable();
            $table->string('bank_tranref_no')->nullable();
            $table->string('payment_logo')->nullable();
            $table->string('payment_user_name')->nullable();
            $table->string('currencyCode')->nullable();
            $table->decimal('req_amount', 15, 2)->nullable();
            $table->decimal('txn_amount', 15, 2)->nullable();
            $table->decimal('net_amount', 15, 2)->nullable();
            $table->string('trans_date_time')->nullable();
            $table->string('created_by')->nullable();
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
