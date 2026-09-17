<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('cms_pages')) {
            return;
        }

        DB::table('cms_pages')
            ->where('slug', 'about')
            ->orWhere('type', 'about')
            ->delete();
    }
};
