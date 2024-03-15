<?php

namespace App\Observers;

use App\Models\Library;

class LibraryObserver
{
    /**
     * Handle the Library "created" event.
     */
    public function created(Library $library): void
    {
        //
    }

    /**
     * Handle the Library "updated" event.
     */
    public function updated(Library $library): void
    {
        //
    }

    /**
     * Handle the Library "deleted" event.
     */
    public function deleted(Library $library): void
    {
        $library->books()->delete();
    }

    /**
     * Handle the Library "restored" event.
     */
    public function restored(Library $library): void
    {
        $library->books()->restore();
    }

    /**
     * Handle the Library "force deleted" event.
     */
    public function forceDeleted(Library $library): void
    {
        $library->books()->forceDelete();
    }
}
