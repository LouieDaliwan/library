<?php

namespace Tests\Feature;

use App\Models\Library;
use Database\Seeders\RolesPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class LibraryDestroyControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function superAdmin(): void
    {
        $user = $this->signIn();

        $user->assignRole('Superadmin');
    }

    /**
     * A basic feature test example.
     */
    function test_can_destroy_the_library(): void
    {
        $this->superAdmin();

        $library = $this->createLibrary();

        $library->delete();

        $withTrashed = Library::withTrashed()->first();

        $this->deleteJson("/api/libraries/{$withTrashed->id}/destroy")
        ->assertStatus(202);

        $this->assertDatabaseEmpty('libraries');
        $this->assertDatabaseEmpty('library_books');
    }

    function test_unauthorized_cannot_destroy_library()
    {
        $this->signIn();

        $library = $this->createLibrary();

        $library->delete();

        $withTrashed = Library::withTrashed()->first();

        $this->deleteJson("/api/libraries/{$withTrashed->id}/destroy")
            ->assertUnauthorized();
    }
}
