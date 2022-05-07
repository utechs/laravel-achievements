<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAchievementRequest;
use App\Http\Requests\UpdateAchievementRequest;
use App\Models\Achievement;
use App\Models\User;
use Illuminate\Http\Request;

class AchievementsController extends Controller
{
    public function index(User $user)
    {
        $remaingToUnloack =
            ($user->getNextBadge()->points ?? 0) - $user->achievements->count();
        return response()->json([
            'unlocked_achievements' => $user->achievements->map->name ?? [],
            'next_available_achievements' => $user->nextAvailableAchievements(),
            'current_badge' => $user->getCurrentBadge()->name ?? '',
            'next_badge' => $user->getNextBadge()->name ?? '',
            'remaing_to_unlock_next_badge' =>
                $remaingToUnloack == 1
                    ? $remaingToUnloack . ' Achievement.'
                    : $remaingToUnloack . ' Achievements.',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAchievementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAchievementRequest $request)
    {
        $data = $request->validated();
        Achievement::create($data);
        return response()->json(
            [
                'created' => true,
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Achievements  $achievement
     * @return \Illuminate\Http\Response
     */
    public function show(Achievement $achievement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAchievementRequest  $request
     * @param  \App\Models\BadAchievementge  $achievement
     * @return \Illuminate\Http\Response
     */
    public function update(
        UpdateAchievementRequest $request,
        Achievement $achievement
    ) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Achievement  $achievement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Achievement $achievement)
    {
        //
    }
}
