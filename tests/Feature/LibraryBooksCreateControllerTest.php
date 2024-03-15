<?php

namespace Tests\Feature;

use Database\Seeders\RolesPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LibraryBooksCreateControllerTest extends TestCase
{
    use RefreshDatabase;

    function test_a_authorized_user_can_create_a_library_book(): void
    {
        $this->superAdmin();

        $library = $this->createLibrary();

        $param = [
            'title' => 'Test LibraryBook',
            'author' => 'Test Author',
            'isbn' => 'Test ISBN',
            'price' => 100,
            'qty' => 10,
            'published_at' => '2021-01-01'
        ];

        $this->postJson("api/libraries/{$library->id}/books", $param)->assertStatus(201);

        $this->assertDatabaseHas('library_books', $param);
    }

    function test_not_allowed_to_have_duplicate_title_and_isbn(): void
    {
        $this->superAdmin();

        $library = $this->createLibrary();

        $param = [
            'title' => 'Test LibraryBook',
            'author' => 'Test Author',
            'isbn' => 'Test ISBN',
            'price' => 100,
            'qty' => 10,
            'published_at' => '2021-01-01'
        ];

        $this->postJson("api/libraries/{$library->id}/books", $param)->assertStatus(201);

        $this->assertDatabaseHas('library_books', $param);

        $this->postJson("api/libraries/{$library->id}/books", $param)->assertStatus(422);
    }

    function test_validates_fields(): void
    {
        $this->superAdmin();

        $library = $this->createLibrary();

        $param = [
            'title' => '',
            'author' => '',
            'isbn' => '',
            'price' => '',
            'qty' => '',
            'published_at' => ''
        ];

        $this->postJson("/api/libraries/{$library->id}/books", $param)
            ->assertJsonValidationErrors(['title', 'author', 'isbn', 'price', 'qty', 'published_at']);
    }


    function test_unauthorized_user_cannot_create_book_in_a_library()
    {
            $library = $this->createLibrary();

            $this->postJson("/api/libraries/{$library->id}/books", [])->assertUnauthorized();
    }
}
