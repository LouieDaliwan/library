<?php

namespace Database\Factories;

use App\Models\Library;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LibraryBook>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'library_id' => Library::factory()->create()->id,
            'title' => 'Test LibraryBook',
            'author' => 'Test Author',
            'isbn' => '1234567890',
            'price' => 100,
            'qty' => 10,
            'published_at' => '2021-01-01'
        ];
    }
}
