<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
    //Return the teams index view
    function index()
    {
        $teams = Team::withCount('players')->orderBy('name')->get();
        return view('teams.index', compact('teams'));
    }

    //Return the teams create view
public function create()
{
    $leagues = [
        'Premier League',
        'Serie A',
        'Bundesliga',
        'La Liga',
        'Ligue 1',
    ];

    $teamsByLeague = [
        'Premier League' => [
            'Arsenal', 'Aston Villa', 'Bornemouth', 'Brentford', 'Brighton','Burnley','Chelsea','Crystal Palace','Everton','Fulham','Leeds United','Liverpool','Manchester City', 'Manchester United','Newcastle','Nottingham Forest','Sunderland','Tottenham Hotspur','West Ham','Wolverhampton Wanderers',
        ],
        'Serie A' => [
            'Atalanta','Bologna','Cagliari','Como','Cremonese','Fiorentina','Genoa','Inter','Juventus','Lazio','Lecce','Milan','Napoli','Parma','Pisa','Roma','Sassuolo','Torino', 'Udinese','Verona'
        ],
        'Bundesliga' => [
            'Augsburg','Bayern Munich','Borussia Dortmund','Borussia Monchengladbach','Frankfurt', 'Freiburg','Hamburger SV','Hertha BSC','Hoffenheim','Koln','Leipzig','Leverkusen','Mainz 05','Stuttgart','St. Pauli','Union Berlin','Werder Bremen','Wolfsburg'
        ],
        'La Liga' => [
            'Athletic Club','Atletico Madrid','Barcelona','Celta','Deportivo Alaves','Elche CF','Espanyol','Getafe CF','Girona FC','Levante UD','Mallorca','Real Betis','Rayo Vallecano', 'Real Madrid','Real Oviedo','Real Sociedad', 'Seville FC','Valencia','Villarreal CF'
        ],
        'Ligue 1' => [
            'Angers','Auxerre','Brest','Havre AC','Lens','Lille','Lorient','Lyon','Marseille','Metz','Monacco','Nantes','Nice','Paris FC','Paris Saint-Germain','Stade Rennais','Strasbourg','Toulouse'
        ],
    ];

    return view('teams.create', compact('leagues', 'teamsByLeague'));
}


    //Store a new team in the database
    function store(Request $request)
    {
        $data = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'league'    => ['required', 'string', 'max:255'],
        ]);

        Team::create($data);

        return redirect('/teams')->with('success', 'Team created successfully.');
    }

    //Return a single team view
    function show($id)
    {
        $team = Team::with('players')->findOrFail($id);
        return view('teams.show', compact('team'));
    }

    //Delete a team from the database
    function destroy($id)
    {
        $team = Team::findOrFail($id);
        $team->delete();

        return redirect('/teams')->with('success', 'Team deleted successfully.');
    }
}
