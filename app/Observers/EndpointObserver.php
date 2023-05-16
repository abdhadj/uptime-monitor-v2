<?php

namespace App\Observers;

use App\Models\Endpoint;

class EndpointObserver
{

    public function creating(Endpoint $endpoint)
    {
        $parsed = parse_url($endpoint->site->url() . '/' . $endpoint->location);

        $endpoint->location = '/' . trim(trim(Arr::get($parsed, 'path'), '/') . '?' . Arr::get($parsed, 'query'), '?');

        $endpoint->next_check = now()->addSeconds($endpoint->frequency);
    }
    
    /**
     * Handle the Endpoint "created" event.
     */
    public function created(Endpoint $endpoint): void
    {
        //
    }

    /**
     * Handle the Endpoint "updated" event.
     */
    public function updated(Endpoint $endpoint): void
    {
        //
    }

    /**
     * Handle the Endpoint "deleted" event.
     */
    public function deleted(Endpoint $endpoint): void
    {
        //
    }

    /**
     * Handle the Endpoint "restored" event.
     */
    public function restored(Endpoint $endpoint): void
    {
        //
    }

    /**
     * Handle the Endpoint "force deleted" event.
     */
    public function forceDeleted(Endpoint $endpoint): void
    {
        //
    }
}
