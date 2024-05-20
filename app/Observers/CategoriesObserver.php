<?php

namespace App\Observers;

use App\Models\Categories;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CategoriesObserver
{
    /**
     * Handle the Categories "created" event.
     */
    public function created(Categories $categories): void
    {
        //
    }

    /**
     * Handle the Categories "updated" event.
     */
    public function updated(Categories $categories): void
    {
        //
    }

    /**
     * Handle the Categories "deleted" event.
     */
    public function deleted(Categories $categories): void
    {
        //
    }

    /**
     * Handle the Categories "restored" event.
     */
    public function restored(Categories $categories): void
    {
        //
    }

    /**
     * Handle the Categories "force deleted" event.
     */
    public function forceDeleted(Categories $categories): void
    {
        //
    }

    
}
