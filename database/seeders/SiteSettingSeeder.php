<?php

namespace Database\Seeders;

use App\Services\SiteSettings;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(SiteSettings $settings): void
    {
        $settings->setMany($settings->defaults());
    }
}
