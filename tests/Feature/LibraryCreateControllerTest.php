<?php

namespace Tests\Feature;

use Database\Seeders\RolesPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LibraryCreateControllerTest extends TestCase
{
    use RefreshDatabase;

    function test_a_authority_can_create_libraries(): void
    {
        $this->superAdmin();

        $this->postJson('/api/libraries', [
            'name' => 'Test Library',
            'type' => 'Test Type',
        ])->assertStatus(201);

        $this->assertDatabaseHas('libraries', [
            'name' => 'Test Library',
            'type' => 'Test Type',
        ]);
    }

    function test_validates_the_field(): void
    {
        $this->superAdmin();

        $this->postJson('/api/libraries', [
            'name' => '',
            'type' => ''
        ])->assertJsonValidationErrors(['name', 'type']);
    }

    function test_unauthenticated_users_cannot_create_libraries(): void
    {
        $this->postJson('/api/libraries', [
            'name' => 'Test Library',
            'type' => 'Test Type',
        ])->assertUnauthorized();
    }
}
