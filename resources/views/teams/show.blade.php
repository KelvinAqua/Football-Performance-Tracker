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
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

{{-- Back button positioned at the bottom --}}
<div class="mt-4">
    <a href="/teams" class="btn btn-secondary">← Back to Teams</a>
</div>

@endsection
