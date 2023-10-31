<?php

namespace App\Features\Ui;

use App\Database\Models\User;

class HubAdmin
{
    /**
     * Resolve the feature's initial value.
     */
    public function resolve(User $user): bool
    {
        return match (true) {
            $user->isAdmin() => true,
            // ...
            default => false,
        };
    }
}
