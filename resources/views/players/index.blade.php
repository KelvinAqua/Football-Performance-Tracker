@extends('layouts.main')

@section('content')
<h1 class="mb-3">Players</h1>

<a href="/players/create" class="btn btn-primary mb-3">Add Player</a>

<form method="GET" class="row g-2 mb-3">
    <div class="col-md-4">
        <select name="team_id" class="form-select">
            <option value="">All teams</option>
            @foreach ($teams as $team)
                <option value="{{ $team->id }}" @selected(request('team_id') == $team->id)>
                    {{ $team->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <select name="position" class="form-select">
            <option value="">All positions</option>
            @foreach (['GK','DF','MF','FW'] as $pos)
                <option value="{{ $pos }}" @selected(request('position') == $pos)>
                    {{ $pos }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <button class="btn btn-secondary w-100">Filter</button>
    </div>
</form>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Player</th>
            <th>Team</th>
            <th>Position</th>
            <th>Nationality</th>
            <th>Shirt #</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($players as $player)
        <tr>
            <td><a href="/players/{{ $player->id }}">
                {{ $player->first_name }} {{ $player->last_name }}
            </a></td>
            <td>{{ $player->team->name }}</td>
            <td>{{ $player->position }}</td>
            <td>{{ $player->nationality }}</td>
            <td>{{ $player->shirt_number }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
