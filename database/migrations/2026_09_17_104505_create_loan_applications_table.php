<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loan_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_product_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('requested_amount', 12, 2);
            $table->string('purpose');
            $table->string('full_name');
            $table->string('mobile');
            $table->string('email');
            $table->string('gender');
            $table->date('date_of_birth');
            $table->string('state');
            $table->string('district');
            $table->string('pincode');
            $table->text('address');
            $table->string('occupation');
            $table->string('monthly_income')->nullable();
            $table->string('marital_status')->nullable();
            $table->boolean('consent');
            $table->string('status')->default('new');
            $table->text('internal_notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loan_applications');
    }
};
