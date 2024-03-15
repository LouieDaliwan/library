<?php

namespace Tests\Feature;

use App\Models\LibraryBook;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LibraryBooksDestroyControllerTest extends TestCase
{
    use RefreshDatabase;

    protected string $model = LibraryBook::class;

    function test_can_destroy_library_books(): void
    {
        $this->superAdmin();

        $book = $this->model::factory()->create([
            'title' => 'The LibraryBook 1',
        ]);

        $book->delete();

        $this->assertSoftDeleted('library_books', [
            'title' => 'The LibraryBook 1',
        ]);

        $withTrashed = $this->model::withTrashed()->first();

        $this->deleteJson("/api/libraries/{$withTrashed->library_id}/books/{$withTrashed->id}/destroy")
            ->assertStatus(200);

        $this->assertDatabaseEmpty('library_books');
    }

    function test_unauthorized_cannot_destroy_books(): void
    {
        $book = $this->model::factory()->create([
            'title' => 'The LibraryBook 1',
        ]);

        $book->delete();

        $withTrashed = $this->model::withTrashed()->first();

        $this->deleteJson("/api/libraries/{$withTrashed->library_id}/books/{$withTrashed->id}/destroy")
            ->assertUnauthorized();
    }
}
