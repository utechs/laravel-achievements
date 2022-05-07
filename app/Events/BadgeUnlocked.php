<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BadgeUnlocked
{
    use Dispatchable, SerializesModels;

    public $user;
    public $badge_name;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $badge_name, User $user)
    {
        $this->user = $user;
        $this->badge_name = $badge_name;
    }
}
