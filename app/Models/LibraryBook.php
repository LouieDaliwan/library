<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class LibraryBook extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'library_books';

    protected $fillable = [
        'title',
        'author',
        'isbn',
        'price',
        'qty',
        'published_at'
    ];

    public function library(): BelongsTo
    {
        return $this->belongsTo(Library::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_book', 'library_book_id', 'user_id')->using(UserLibraryBook::class);
    }

    public function existUserBorrowBook(string $userId): bool
    {
        return $this->users()->where('user_id', $userId)->exists();
    }
}
