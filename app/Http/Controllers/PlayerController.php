<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Team;

class PlayerController extends Controller
{
    public function index(Request $request)
        {
            $teams = Team::orderBy('name')->get();


            $allowedSorts = ['last_name', 'team', 'position', 'nationality', 'shirt_number'];

            $sort = $request->get('sort', 'last_name');
            $dir  = $request->get('dir', 'asc');

            if (!in_array($sort, $allowedSorts, true)) {
                $sort = 'last_name';
            }

            $dir = strtolower($dir) === 'desc' ? 'desc' : 'asc';

            $players = Player::query()
                ->with('team')
                ->when($request->team_id, function ($query, $teamId) {
                    $query->where('team_id', $teamId);
                })
                ->when($request->position, function ($query, $position) {
                    $query->where('position', $position);
                })
                ->when($sort === 'team', function ($query) use ($dir) {
                    $query->leftJoin('teams', 'players.team_id', '=', 'teams.id')
                        ->orderBy('teams.name', $dir)
                        ->select('players.*'); 
                }, function ($query) use ($sort, $dir) {
                    $query->orderBy($sort, $dir);
                })
                ->get();

            return view('players.index', compact('teams', 'players', 'sort', 'dir'));
        }


    //Return the players create view
    function create()
    {
        // Fixed list of leagues
        $leagues = [
            'Premier League',
            'Serie A',
            'Bundesliga',
            'La Liga',
            'Ligue 1',
        ];

        // Get all teams that belong to those leagues
        $teams = Team::whereIn('league', $leagues)
                    ->orderBy('league')
                    ->orderBy('name')
                    ->get();

        return view('players.create', compact('leagues', 'teams'));
    }

    //Store a new player in the database
    function store(Request $request)
    {
        $data = $request->validate([
            'team_id'      => ['required', 'exists:teams,id'],
            'first_name'   => ['required', 'string', 'max:255'],
            'last_name'    => ['required', 'string', 'max:255'],
            'position'     => ['required', 'in:GK,DF,MF,FW'],
            'nationality'  => ['required', 'string', 'max:255'],
            'shirt_number' => ['required', 'integer', 'between:1,99'],
        ]);

        Player::create($data);

        return redirect('/players')->with('success', 'Player created successfully.');
    }


    public function show($id, Request $request)
    {
        $player = Player::with('team')->findOrFail($id);

        $dateDir = strtolower($request->get('date_dir', 'desc')) === 'asc' ? 'asc' : 'desc';

        $performances = $player->matchPerformances()
            ->orderBy('match_date', $dateDir)
            ->get();

        $stats = [
            'games'      => $performances->count(),
            'minutes'    => $performances->sum('minutes_played'),
            'goals'      => $performances->sum('goals'),
            'assists'    => $performances->sum('assists'),
            'avg_rating' => round($performances->avg('rating'), 1),
        ];

        return view('players.show', compact('player', 'stats', 'performances', 'dateDir'));
    }


    public function edit($id)
    {
        $player = Player::findOrFail($id);

        // if you need teams/leagues in the edit dropdowns:
        $leagues = ['Premier League','Serie A','Bundesliga','La Liga','Ligue 1'];
        $teams = Team::orderBy('name')->get();

        return view('players.edit', compact('player', 'leagues', 'teams'));
    }

    public function update(Request $request, $id)
    {
        $player = Player::findOrFail($id);

        $validated = $request->validate([
            'team_id' => 'required|exists:teams,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'position' => 'required|in:GK,DF,MF,FW',
            'nationality' => 'required|string|max:255',
            'shirt_number' => 'required|integer|min:0|max:99',
        ]);

        $player->update($validated);

        return redirect("/players/{$player->id}")->with('success', 'Player updated successfully.');
    }

    public function destroy($id)
    {
        $player = \App\Models\Player::findOrFail($id);
        $player->delete();

        return redirect('/players')->with('success', 'Player deleted successfully.');
    }
}