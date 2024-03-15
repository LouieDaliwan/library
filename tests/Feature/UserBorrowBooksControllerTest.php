<?php

namespace Tests\Feature;

use App\Models\Library;
use App\Models\LibraryBook;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserBorrowBooksControllerTest extends TestCase
{
    use RefreshDatabase;

    function test_user_can_borrow_books(): void
    {
        $this->signMember();

        $library = $this->createLibrary();

        $book = $library->books()->create([
            'title' => 'The LibraryBook 1',
            'author' => 'The Author 1',
            'isbn' => '1234567890',
            'qty' => 2,
            'price' => 1000,
            'published_at' => now(),
        ]);

        $this->postJson("/api/libraries/{$library->id}/books/{$book->id}/borrow")
            ->assertStatus(201);

        $this->assertDatabaseHas('user_book', [
            'user_id' => auth()->user()->id,
            'library_book_id' => $book->id,
        ]);
    }

    function test_user_cannot_borrow_books_if_not_logged_in(): void
    {
        $library = $this->createLibrary();

        $book = $library->books()->create([
            'title' => 'The LibraryBook 1',
            'author' => 'The Author 1',
            'isbn' => '1234567890',
            'qty' => 2,
            'price' => 1000,
            'published_at' => now(),
        ]);

        $this->postJson("/api/libraries/{$library->id}/books/{$book->id}/borrow")
            ->assertStatus(401);
    }

    function test_user_cannot_borrow_books_if_qty_is_zero(): void
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

        $this->postJson("/api/libraries/{$library->id}/books/{$book->id}/borrow");

        $this->signMember();

        $this->postJson("/api/libraries/{$library->id}/books/{$book->id}/borrow")
            ->assertStatus(422);
    }

    function test_user_cannot_borrow_books_if_already_borrowed(): void
    {
        $this->signMember();

        $library = $this->createLibrary();

        $book = $library->books()->create([
            'title' => 'The LibraryBook 1',
            'author' => 'The Author 1',
            'isbn' => '1234567890',
            'qty' => 10,
            'price' => 1000,
            'published_at' => now(),
        ]);

        $book->users()->attach(auth()->id());

        $this->postJson("/api/libraries/{$library->id}/books/{$book->id}/borrow")
            ->assertStatus(422);
    }

    function test_user_can_borrow_books_in_two_different_libraries()
    {
        $this->signMember();

        $library1 = $this->createLibrary();

        $book1 = $library1->books()->create([
            'library_id' => $library1->id,
            'title' => 'The LibraryBook 1',
            'author' => 'The Author 1',
            'isbn' => '12345678901',
            'qty' => 10,
            'price' => 1000,
            'published_at' => now(),
        ]);

        $this->postJson("/api/libraries/{$library1->id}/books/{$book1->id}/borrow")
            ->assertStatus(201);

        $library2 = $this->createLibrary('Library 2');

        $book2 = $library2->books()->create([
            'library_id' => $library2->id,
            'title' => 'The LibraryBook 2',
            'author' => 'The Author 2',
            'isbn' => '1234567890',
            'qty' => 10,
            'price' => 1000,
            'published_at' => now(),
        ]);

        $this->postJson("/api/libraries/{$library2->id}/books/{$book2->id}/borrow")
            ->assertStatus(201);

        $this->assertDatabaseHas('user_book', [
            'user_id' => auth()->user()->id,
            'library_book_id' => $book1->id,
        ]);

        $this->assertDatabaseHas('user_book', [
            'user_id' => auth()->user()->id,
            'library_book_id' => $book2->id,
        ]);

        $this->assertEquals(2, auth()->user()->books()->count());
    }

    function test_it_checks_if_this_book_is_under_of_library_before_to_borrow_it()
    {
        $this->signMember();

        $library = $this->createLibrary();

        $book1 = LibraryBook::factory()->create([
            'title' => 'The LibraryBook 1',
            'author' => 'The Author 1',
            'isbn' => '12345678901',
            'qty' => 10,
            'price' => 1000,
            'published_at' => now(),
        ]);

        $this->postJson("/api/libraries/{$library->id}/books/{$book1->id}/borrow")
            ->assertStatus(404);

    }
}
