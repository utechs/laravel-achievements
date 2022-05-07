<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Models\Badge;

class BadgesToAward
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\AchievementUnlocked  $event
     * @return void
     */
    public function handle(AchievementUnlocked $event)
    {
        $userBadges = $event->user->badges()->pluck('badge_id');
        $badges = Badge::whereNotIn('id', $userBadges)->get();
        $toUnlock = $badges
            ->filter(function ($badge) use ($event) {
                return $event->user->achievements()->count() >= $badge->points;
            })
            ->map->getKey();

        if (count($toUnlock) > 0) {
            $event->user->unlockBadges($toUnlock);
        }
    }
}
