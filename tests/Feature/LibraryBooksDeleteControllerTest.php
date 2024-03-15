<?php

namespace Tests\Feature;

use App\Models\LibraryBook;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LibraryBooksDeleteControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    function test_can_delete_library_books(): void
    {
        $this->superAdmin();

        $book = LibraryBook::factory()->create([
            'title' => 'The LibraryBook 1',
        ]);

        $this->deleteJson("/api/libraries/{$book->library_id}/books/{$book->id}/delete")
            ->assertStatus(200);

        $this->assertSoftDeleted('library_books', [
            'title' => 'The LibraryBook 1',
        ]);
    }

    function test_unauthorized_cannot_delete_books(): void
    {
        $book = LibraryBook::factory()->create([
            'title' => 'The LibraryBook 1',
        ]);

        $this->deleteJson("/api/libraries/{$book->library_id}/books/{$book->id}/delete")
            ->assertUnauthorized();
    }
}
