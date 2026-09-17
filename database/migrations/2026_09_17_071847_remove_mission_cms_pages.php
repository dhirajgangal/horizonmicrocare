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
            ->whereIn('slug', ['mission', 'vision', 'values'])
            ->orWhereIn('type', ['mission', 'vision', 'values'])
            ->delete();
    }
};
