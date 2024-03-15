<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LibraryIndexControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    function test_see_the_list_of_libraries(): void
    {
        $this->superAdmin();

        $this->createLibrary();

        $this->createLibrary('Test Library 2', 'Test Type 2');

        $this->getJson('/api/libraries')
        ->assertSee('Test Library')
        ->assertSee('Test Library 2');
    }

    function test_a_guest_cannot_see_the_list_of_libraries()
    {
        $this->getJson('/api/libraries')
            ->assertUnauthorized();
    }
}
