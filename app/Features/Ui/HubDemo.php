<?php

namespace App\Features\Ui;

use App\Database\Models\User;

class HubDemo
{
    /**
     * Resolve the feature's initial value.
     */
    public function resolve(User $user): bool
    {
        return match (true) {
            !$user->isDeveloper() && !$user->isAdmin() && !$user->isTenant() => true, // TODO: Proper/better condition
            // ...
            default => false,
        };
    }
}
