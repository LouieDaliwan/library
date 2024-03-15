<?php

namespace Tests\Feature;

use App\Models\Library;
use Database\Seeders\RolesPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LibraryUpdateControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    function test_can_update_libraries_details(): void
    {
        $this->superAdmin();

        $library = $this->createLibrary();

        $this->putJson("/api/libraries/$library->id", [
            'name' => 'Test Library',
            'type' => 'Test Type',
        ]);

        $this->assertNotEquals('Non Test Library', $library->fresh()->name);
    }

    function test_cannot_duplicate_library_names(): void
    {
        $this->superAdmin();

        $this->createLibrary();

        $library = Library::factory()->create([
            'name' => 'Test Library Two',
        ]);

        $this->putJson("/api/libraries/$library->id", [
            'name' => 'Test Library',
            'type' => 'Test Type',
        ])->assertJsonValidationErrors(['name']);
    }

    function test_unauthenticated_users_cannot_create_libraries(): void
    {
        $library = $this->createLibrary('Test Library Two');

        $this->putJson("/api/libraries/$library->id", [
            'name' => 'Test Library',
            'type' => 'Test Type',
        ])->assertUnauthorized();
    }
}
