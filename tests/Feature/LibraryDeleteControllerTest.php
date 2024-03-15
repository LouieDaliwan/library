<?php

namespace Tests\Feature;

use App\Models\Library;
use Database\Seeders\RolesPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LibraryDeleteControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    function test_can_delete_the_library(): void
    {
        $this->superAdmin();

        $library = $this->createLibrary();

        $this->deleteJson("/api/libraries/{$library->id}/delete");

        $this->assertSoftDeleted('libraries', [
            'id' => '1',
            'name' => 'Test Library',
            'type' => 'Test Type'
        ]);
    }

    function test_unauthorized_cannot_delete_library()
    {
        $this->signIn();

        $library = $this->createLibrary();

        $this->deleteJson("/api/libraries/{$library->id}/delete")
            ->assertUnauthorized();
    }

    function test_a_library_books_can_be_also_deleted()
    {
        $this->superAdmin();

        $library = $this->createLibrary();

        $library->books()->create([
            'title' => 'The LibraryBook 1',
            'author' => 'The Author 1',
            'isbn' => '1234567890',
            'qty' => 10,
            'price' => 1000,
            'published_at' => now(),
        ]);

        $this->deleteJson("/api/libraries/{$library->id}/delete");

        $this->assertSoftDeleted('library_books', [
            'title' => 'The LibraryBook 1',
        ]);
    }
}
