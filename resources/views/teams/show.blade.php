@extends('layouts.main')

@section('content')
<h1 class="mb-3">{{ $team->name }}</h1>

<p>
    <strong>League:</strong> {{ $team->league }}<br>
    <strong>Total Players:</strong> {{ $team->players->count() }}
</p>

<h3 class="mt-4">Players</h3>

@if ($team->players->isEmpty())
    <p>No players yet.</p>
@else
    <table class="table table-striped mb-5">
        <thead>
            <tr>
                <th>Player</th>
                <th>Position</th>
                <th>Shirt #</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($team->players as $player)
            <tr>
                <td>
                    <a href="/players/{{ $player->id }}">
                        {{ $player->first_name }} {{ $player->last_name }}
                    </a>
                </td>
                <td>{{ $player->position }}</td>
                <td>{{ $player->shirt_number }}</td>
                <td>
                <form action="/players/{{ $player->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this player?');" title="Delete player">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
                <a href="/players/{{ $player->id }}/edit" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

<div class="mt-4">
    <a href="/teams" class="btn btn-secondary">← Back to Teams</a>
</div>

@endsection
