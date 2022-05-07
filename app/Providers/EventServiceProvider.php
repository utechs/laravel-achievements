<?php

namespace App\Providers;

use App\Events\AchievementUnlocked;
use App\Events\LessonWatched;
use App\Events\CommentWritten;
use App\Listeners\AchievementsToAward;
use App\Listeners\BadgesToAward;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        CommentWritten::class => [
            //
        ],
        LessonWatched::class => [
            //
        ],
        AchievementUnlocked::class => [BadgesToAward::class],
    ];

    protected $subscribe = [AchievementsToAward::class];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
