<?php

namespace Tests\Feature;

use App\Models\LibraryBook;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LibraryBooksIndexControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    function test_see_the_list_of_library_book(): void
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

        $this->getJson("/api/libraries/{$library->id}/books")
            ->assertSee('The LibraryBook 1')
            ->assertSee('The Author 1')
            ->assertSee('1234567890');
    }

    function test_a_guest_cannot_see_the_list_of_library_books()
    {
        $library = $this->createLibrary();

        $this->getJson("/api/libraries/{$library->id}/books")
            ->assertUnauthorized();
    }

    function test_can_see_how_many_users_borrowed_the_book()
    {
        $this->superAdmin();

        $user = User::factory()->create();

        $book = LibraryBook::factory()->create([
            'title' => 'The LibraryBook 1',
            'author' => 'The Author 1',
            'isbn' => '1234567890',
            'qty' => 2,
            'price' => 1000,
            'published_at' => now(),
        ]);

        $book->users()->attach($user->id);

        $this->getJson("/api/libraries/{$book->library_id}/books")
            ->assertSee('The LibraryBook 1')
            ->assertSee('The Author 1')
            ->assertSee('1234567890')
            ->assertSee('borrowed_users_count');
    }
}
