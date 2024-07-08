<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommandsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testIpAllowCommand(): void
    {
        $this->artisan('ip:allow 84.25.47.248')->assertExitCode(0);
    }

    public function testIpDisallowCommand()
    {
        $this->artisan('ip:disallow 84.25.47.248')->assertExitCode(0);
    }
}
