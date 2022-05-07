<?php

namespace App\Listeners;

use App\Events\LessonWatched;
use App\Events\CommentWritten;
use App\Models\Achievement;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AchievementsToAward
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
     * @param  \App\Events\LessonWatched  $event
     * @return void
     */
    public function handleLessonWatched($event)
    {
        $userAchievements = $event->user
            ->achievements()
            ->where('type', 'lesson')
            ->pluck('achievement_id');

        $achievements = Achievement::where('type', 'lesson')
            ->whereNotIn('id', $userAchievements)
            ->get();
        $toUnlock = $achievements
            ->filter(function ($achievement) use ($event) {
                return $event->user->watched()->count() >= $achievement->points;
            })
            ->map->getKey();
        if (count($toUnlock) > 0) {
            $event->user->unlockAchievements($toUnlock);
        }
    }
    /**
     * Handle the event.
     *
     * @param  \App\Events\CommentWritten  $event
     * @return void
     */
    public function handleCommentWritten($event)
    {
        $userAchievements = $event->comment->user
            ->achievements()
            ->where('type', 'comment')
            ->pluck('achievement_id');

        $achievements = Achievement::where('type', 'comment')
            ->whereNotIn('id', $userAchievements)
            ->get();
        $toUnlock = $achievements
            ->filter(function ($achievement) use ($event) {
                return $event->comment->user->comments()->count() >=
                    $achievement->points;
            })
            ->map->getKey();
        if (count($toUnlock) > 0) {
            $event->comment->user->unlockAchievements($toUnlock);
        }
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return void
     */
    public function subscribe($events)
    {
        $events->listen(LessonWatched::class, [
            AchievementsToAward::class,
            'handleLessonWatched',
        ]);
        $events->listen(CommentWritten::class, [
            AchievementsToAward::class,
            'handleCommentWritten',
        ]);
    }
}
