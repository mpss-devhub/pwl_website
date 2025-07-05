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
            Schema::create('links', function (Blueprint $table) {
                $table->id();
                $table->string('user_id');
                $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
                $table->string('merchant_id');
                $table->string('link_invoiceNo')->unique();
                $table->string('link_name');
                $table->string('link_phone');
                $table->string('link_currency');
                $table->string('link_email')->nullable();
                $table->string('link_description')->nullable();
                $table->string('link_type');
                $table->string('link_url')->nullable();
                $table->decimal('link_amount', 15, 2);
                $table->string('link_status')->default('active');
                $table->string('link_click_status')->default('Unclicked');
                $table->timestamp('link_expired_at');
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
            Schema::table('link_click_logs', function (Blueprint $table) {
                $table->dropForeign(['link_id']);
            });

            Schema::table('tnx', function (Blueprint $table) {
                $table->dropForeign(['link_id']);
            });

            // Then drop the tables
            Schema::dropIfExists('link_click_logs');
            Schema::dropIfExists('tnx');
            Schema::dropIfExists('links');
        }
    };
