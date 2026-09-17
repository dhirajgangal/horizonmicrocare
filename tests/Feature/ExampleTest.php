<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesAdminData;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use CreatesAdminData, RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        $this->siteSettings();

        $this->get('/')->assertOk();
    }
}
