<?php

namespace App\Features\Ui;

use App\Database\Models\User;

class HubSite
{
    /**
     * Resolve the feature's initial value.
     */
    public function resolve(User $user): bool
    {
        return match (true) {
            $user->isTenant() => true,
            // ...
            default => false,
        };
    }
}
