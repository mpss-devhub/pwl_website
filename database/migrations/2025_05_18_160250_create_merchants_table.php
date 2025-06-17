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
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->string('status')->default('inactive');
            $table->string('merchant_notification')->nullable();
            $table->string('merchant_name');
            $table->string('merchant_Cname');
            $table->string('merchant_Cemail');
            $table->string('merchant_Cphone');
            $table->string('merchant_notifyemail');
            $table->string('merchant_frontendURL');
            $table->string('merchant_backendURL');
            $table->string('merchant_logo')->nullable();
            $table->string('merchant_id')->nullable();
            $table->string('merchant_datakey')->nullable();
            $table->string('merchant_secretkey')->nullable();
            $table->string('merchant_registration')->nullable();
            $table->string('merchant_shareholder')->nullable();
            $table->string('merchant_dica')->nullable();
            $table->string('merchant_remark')->nullable();
            $table->string('merchant_address')->nullable();
            $table->string('created_by')->default('system');
            $table->string('deleted_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchants');
    }
};
