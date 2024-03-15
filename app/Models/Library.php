<?php

namespace App\Models;

use App\Observers\LibraryObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([LibraryObserver::class])]
class Library extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'libraries';

    protected $fillable = ['name', 'type'];

    public function books(): HasMany
    {
        return $this->hasMany(LibraryBook::class);
    }
}
