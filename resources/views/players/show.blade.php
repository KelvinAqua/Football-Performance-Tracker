@extends('layouts.main')

@section('content')

<div class="d-flex justify-content-center">
    <div class="registration-form registration-form-wide">

        <div class="form-icon">
            <span><i class="icon icon-user"></i></span>
        </div>

        <h3 class="text-center mb-4">{{ $player->first_name }} {{ $player->last_name }}</h3>

        <div class="mb-4">
            <p><strong>Team:</strong> {{ $player->team->name }}</p>
            <p><strong>Position:</strong> {{ $player->position }}</p>
            <p><strong>Nationality:</strong> {{ $player->nationality }}</p>
            <p><strong>Shirt Number:</strong> {{ $player->shirt_number }}</p>
        </div>
        


        <h4 class="text-center mt-4">Match Performances</h4>

        @if ($player->matchPerformances->isEmpty())
            <p class="text-center">No performances recorded yet.</p>
        @else
            <table class="table table-bordered bg-white text-center">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Opponent</th>
                        <th>Minutes</th>
                        <th>Goals</th>
                        <th>Assists</th>
                        <th>Rating</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($player->matchPerformances as $perf)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($perf->match_date)->format('d/m/Y') }}</td>
                            <td>{{ $perf->opponent }}</td>
                            <td>{{ $perf->minutes_played }}</td>
                            <td>{{ $perf->goals }}</td>
                            <td>{{ $perf->assists }}</td>
                            <td>{{ $perf->rating }}</td>
                        </tr>
                    @endforeach
                    @if ($stats['games'] > 0)
                        <tr class="fw-bold">
                            <td>Totals ({{ $stats['games'] }} games)</td>
                            <td>-</td>
                            <td>{{ $stats['minutes'] }}</td>
                            <td>{{ $stats['goals'] }}</td>
                            <td>{{ $stats['assists'] }}</td>
                            <td>{{ $stats['avg_rating'] }}</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        @endif

        <br><br>

        <a href="/players" class="btn btn-secondary mb-3"><i class="bi bi-arrow-left"></i> Back</a>

        <a href="/players/{{ $player->id }}/performances/create" class="btn btn-primary mb-3">Add Match Performance </a>
    </div>
</div>

@endsection
