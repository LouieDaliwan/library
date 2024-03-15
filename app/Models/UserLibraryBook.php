<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserLibraryBook extends Pivot
{
    protected $table = 'user_book';
}
