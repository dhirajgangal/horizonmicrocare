<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('gallery_images') || Schema::hasColumn('gallery_images', 'description')) {
            return;
        }

        Schema::table('gallery_images', function (Blueprint $table) {
            $table->text('description')->nullable()->after('title');
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('gallery_images') || ! Schema::hasColumn('gallery_images', 'description')) {
            return;
        }

        Schema::table('gallery_images', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
};
