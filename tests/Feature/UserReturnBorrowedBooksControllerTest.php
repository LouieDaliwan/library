<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserReturnBorrowedBooksControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    function test_user_can_return_the_borrowed_book(): void
    {
        $this->signMember();

        $library = $this->createLibrary();

        $book = $library->books()->create([
            'title' => 'The LibraryBook 1',
            'author' => 'The Author 1',
            'isbn' => '1234567890',
            'qty' => 1,
            'price' => 1000,
            'published_at' => now(),
        ]);

        $book->users()->attach(auth()->user()->id);

        $this->putJson("/api/libraries/{$library->id}/books/{$book->id}/return")
        ->assertStatus(201);

        $this->assertDatabaseMissing('user_book', [
            'user_id' => auth()->user()->id,
            'library_book_id' => $book->id,
        ]);

        $this->assertCount(0, $book->users);
    }
}
