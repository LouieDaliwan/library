<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LibraryRestoreControllerTest extends TestCase
{
    use RefreshDatabase;

    function test_can_restore_the_library(): void
    {
        $this->superAdmin();

        $library = $this->createLibrary();

        $library->delete();

        $this->assertSoftDeleted('libraries', [
            'id' => '1',
            'name' => 'Test Library',
            'type' => 'Test Type'
        ]);

        $this->putJson("/api/libraries/{$library->id}/restore");

        $this->assertDatabaseHas('libraries', [
            'id' => '1',
            'name' => 'Test Library',
            'type' => 'Test Type'
        ]);
    }

    function test_can_also_restore_the_books_of_the_library(): void
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

        $library->delete();

        $this->assertSoftDeleted('library_books', [
            'title' => 'The LibraryBook 1',
        ]);

        $this->putJson("/api/libraries/{$library->id}/restore");

        $this->assertDatabaseHas('library_books', [
            'title' => 'The LibraryBook 1',
        ]);
    }

    function test_unauthorized_cannot_restore_library()
    {
        $this->signIn();

        $library = $this->createLibrary();

        $library->delete();

        $this->putJson("/api/libraries/{$library->id}/restore")
            ->assertUnauthorized();
    }
}
