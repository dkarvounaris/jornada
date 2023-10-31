<?php

namespace App\Features\Ui;

use App\Database\Models\User;

class HubDeveloper
{
    /**
     * Resolve the feature's initial value.
     */
    public function resolve(User $user): bool
    {
        return match (true) {
            $user->isDeveloper() => true,
            // ...
            default => false,
        };
    }
}
