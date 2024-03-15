<?php

namespace Tests\Feature;

use App\Models\LibraryBook;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LibraryBooksRestoreControllerTest extends TestCase
{
    use RefreshDatabase;

    function test_can_restore_library_books(): void
    {
        $this->superAdmin();

        $book = LibraryBook::factory()->create([
            'title' => 'The LibraryBook 1',
        ]);

        $book->delete();

        $this->assertSoftDeleted('library_books', [
            'title' => 'The LibraryBook 1'
        ]);

        $this->putJson("/api/libraries/{$book->library_id}/books/{$book->id}/restore")
            ->assertStatus(202);

        $this->assertDatabaseHas('library_books', [
            'title' => 'The LibraryBook 1',
        ]);
    }

    function test_unauthorized_cannot_restore_books(): void
    {
        $book = LibraryBook::factory()->create([
            'title' => 'The LibraryBook 1',
        ]);

        $book->delete();

        $this->putJson("/api/libraries/{$book->library_id}/books/{$book->id}/restore")
            ->assertUnauthorized();
    }
}
