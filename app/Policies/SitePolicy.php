<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Site;


class SitePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function destroyNotificationChannels(User $user, Site $site){
        return $user->id === $site->user_id;
    }

    public function storeNotificationChannels(User $user, Site $site)
    {
        return $user->id === $site->user_id;
    }

    public function storeEndpoint(User $user, Site $site)
    {
        return $user->id === $site->user_id;
    }

    public function destroy(User $user, Site $site)
    {
        return $user->id === $site->user_id;
    }  
}
