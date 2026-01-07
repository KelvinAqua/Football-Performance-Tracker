<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MatchPerformance;
use App\Models\Player;

class MatchPerformanceController extends Controller
{
    //Store a new match performance for a player
    function store(Request $request, $id)
    {
        $player = Player::findOrFail($id);

        $data = $request->validate([
            'opponent'       => ['required', 'string', 'max:255'],
            'match_date'     => ['required', 'date'],
            'minutes_played' => ['required', 'integer', 'min:0', 'max:130'],
            'goals'          => ['required', 'integer', 'min:0', 'max:10'],
            'assists'        => ['required', 'integer', 'min:0', 'max:10'],
            'rating'         => ['nullable', 'numeric', 'between:0,10'],
        ]);

        $data['player_id'] = $player->id;

        MatchPerformance::create($data);

        return back()->with('success', 'Match performance added.');
    }
}
