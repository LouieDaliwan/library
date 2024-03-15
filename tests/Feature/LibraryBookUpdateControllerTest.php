<?php

namespace Tests\Feature;

use App\Models\LibraryBook;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LibraryBookUpdateControllerTest extends TestCase
{
    use RefreshDatabase;

    function test_a_authorized_user_can_update_the_existing_book_details(): void
    {
        $this->superAdmin();

        $book = LibraryBook::factory()->create([
            'title' => 'The LibraryBook 1',
        ]);

        $this->putJson("/api/libraries/{$book->library_id}/books/{$book->id}", [
            'title' => 'The LibraryBook 2',
            'author' => 'The Author',
            'isbn' => '1234567890',
            'price' => 1000,
            'qty' => 10,
            'published_at' => '2021-01-01',
        ])->assertStatus(200);

        $this->assertDatabaseMissing('library_books', [
            'title' => 'The LibraryBook 1',
        ]);

        $this->assertDatabaseHas('library_books', [
            'title' => 'The LibraryBook 2',
        ]);
    }

    function test_can_not_update_the_book_details_without_title(): void
    {
        $this->superAdmin();

        $book = LibraryBook::factory()->create([
            'title' => 'The LibraryBook 1',
        ]);

        $this->putJson("/api/libraries/{$book->library_id}/books/{$book->id}", [
            'title' => '',
            'author' => 'The Author',
            'isbn' => '1234567890',
            'price' => 1000,
            'qty' => 10,
            'published_at' => '2021-01-01',
        ])->assertStatus(422);
    }

    function test_unauthenticated_users_cannot_update_books(): void
    {
        $this->signIn();

        $book = LibraryBook::factory()->create([
            'title' => 'The LibraryBook 1',
        ]);

        $this->putJson("/api/libraries/{$book->library_id}/books/{$book->id}", [
            'title' => '',
            'author' => 'The Author',
            'isbn' => '1234567890',
            'price' => 1000,
            'qty' => 10,
            'published_at' => '2021-01-01',
        ])->assertUnauthorized();
    }
}
