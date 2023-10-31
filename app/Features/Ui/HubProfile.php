<?php

namespace App\Features\Ui;

use App\Database\Models\User;

class HubProfile
{
    /**
     * Resolve the feature's initial value.
     */
    public function resolve(User $user): bool
    {
        return match (true) {
            !\is_null($user) => true, // TODO: Proper/better condition
            // ...
            default => false,
        };
    }
}
