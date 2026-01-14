<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\MatchPerformance;
use Illuminate\Http\Request;

class MatchPerformanceController extends Controller
{
    public function create(Player $player)
    {
        return view('performances.create', compact('player'));
    }

    public function store(Request $request, Player $player)
    {
        $validated = $request->validate([
            'opponent' => 'required|string|max:100',
            'match_date' => 'required|date',
            'minutes_played' => 'required|integer|min:0|max:130',
            'goals' => 'required|integer|min:0|max:20',
            'assists' => 'required|integer|min:0|max:20',
            'rating' => 'nullable|numeric|min:0|max:10',
        ]);

    $player->matchPerformances()->create($validated);

        return redirect("/players/{$player->id}")->with('success', 'Match performance added!');
    }

    public function edit(Player $player, MatchPerformance $performance)
    {
        abort_if($performance->player_id !== $player->id, 404);

        return view('performances.edit', compact('player', 'performance'));
    }

    public function update(Request $request, Player $player, MatchPerformance $performance)
    {
        abort_if($performance->player_id !== $player->id, 404);

        $validated = $request->validate([
            'opponent' => 'required|string|max:100',
            'match_date' => 'required|date',
            'minutes_played' => 'required|integer|min:0|max:130',
            'goals' => 'required|integer|min:0|max:20',
            'assists' => 'required|integer|min:0|max:20',
            'rating' => 'nullable|numeric|min:0|max:10',
        ]);

        $performance->update($validated);

        return redirect("/players/{$player->id}")->with('success', 'Match performance updated!');
    }

    public function destroy(Player $player, MatchPerformance $performance)
    {
        abort_if($performance->player_id !== $player->id, 404);

        $performance->delete();

        return redirect("/players/{$player->id}")->with('success', 'Match performance deleted!');
    }
}
