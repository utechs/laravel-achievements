<?php

namespace App\Providers;

use App\Events\LessonWatched;
use App\Events\CommentWritten;
use App\Listeners\AchievementsToAward;
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
        CommentWritten::class => [AchievementsToAward::class],
        LessonWatched::class => [AchievementsToAward::class],
    ];

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
