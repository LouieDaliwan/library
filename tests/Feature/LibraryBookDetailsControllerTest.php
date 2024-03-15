<?php

namespace Tests\Feature;

use App\Models\LibraryBook;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LibraryBookDetailsControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_can_see_the_names_of_users_who_borrowed_the_book(): void
    {
        $this->signMember();

        $book1 = LibraryBook::factory()->create([
            'title' => 'The LibraryBook 1',
            'author' => 'The Author 1',
            'isbn' => '12345678901',
            'qty' => 10,
            'price' => 1000,
            'published_at' => now(),
        ]);

        $this->get("/api/libraries/{$book1->library_id}/books/{$book1->id}")
            ->assertSee('The LibraryBook 1')
            ->assertSee('The Author 1')
            ->assertSee('12345678901')
            ->assertSee('borrowed_users_count')
            ->assertSee('borrowed_users_name')
            ->assertSee(auth()->user()->name);
    }
}
