<?php

namespace Database\Factories;

use App\Models\Library;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LibraryBook>
 */
class LibraryBookFactory extends Factory
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
            'title' => 'The Book 1',
            'author' => 'The Author 1',
            'isbn' => '1234567890',
            'qty' => 2,
            'price' => 1000,
            'published_at' => now(),
        ];
    }
}
