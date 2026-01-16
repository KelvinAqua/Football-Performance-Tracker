@extends('layouts.main')

@section('content')

<div class="d-flex justify-content-center">
    <div class="registration-form registration-form-wide">

        <div class="form-icon">
            <span><i class="icon icon-user"></i></span>
        </div>

        <h3 class="text-center mb-4">{{ $player->first_name }} {{ $player->last_name }}</h3>

        <div class="mb-4">
            <p><strong>Team:</strong> {{ optional($player->team)->name ?? '-' }}</p>
            <p><strong>Position:</strong> {{ $player->position }}</p>
            <p><strong>Nationality:</strong> {{ $player->nationality }}</p>
            <p><strong>Shirt Number:</strong> {{ $player->shirt_number }}</p>
        </div>
        


        <h4 class="text-center mt-4">Match Performances</h4>

            @if ($performances->isEmpty())
                <p class="text-center">No performances recorded yet.</p>
            @else
            <div class="table-responsive mt-3">
            @php
                $totalGames   = $performances->count();
                $totalMinutes = $performances->sum('minutes_played');
                $totalGoals   = $performances->sum('goals');
                $totalAssists = $performances->sum('assists');
                $avgRating    = $totalGames ? round($performances->avg('rating'), 1) : 0;
            @endphp

                <table class="table table-bordered text-center align-middle">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Opponent</th>
                            <th>Minutes</th>
                            <th>Goals</th>
                            <th>Assists</th>
                            <th>Rating</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($performances as $performance)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($performance->match_date)->format('d/m/Y') }}</td>
                                <td>{{ $performance->opponent }}</td>
                                <td>{{ $performance->minutes_played }}</td>
                                <td>{{ $performance->goals }}</td>
                                <td>{{ $performance->assists }}</td>
                                <td>{{ number_format($performance->rating, 1) }}</td>
                                <td class="text-center align-middle" style="white-space:nowrap;">
                                    <div class="d-inline-flex gap-2">
                                        <a href="/players/{{ $player->id }}/performances/{{ $performance->id }}/edit"
                                        class="btn btn-warning btn-sm d-flex align-items-center justify-content-center"
                                        style="width:34px;height:34px;"
                                        title="Edit match performance">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="/players/{{ $player->id }}/performances/{{ $performance->id }}"
                                            method="POST"
                                            style="display:inline; margin:0; padding:0; background:transparent; border:0; box-shadow:none;"
                                            class="m-0 p-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-danger btn-sm d-flex align-items-center justify-content-center"
                                                    style="width:34px;height:34px;"
                                                    onclick="return confirm('Are you sure you want to delete this match performance?');"
                                                    title="Delete match performance">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @empty
                        @endforelse

                        @if($totalGames > 0)
                            <tr class="fw-bold">
                                <td colspan="2">Totals ({{ $totalGames }} games)</td>
                                <td>{{ $totalMinutes }}</td>
                                <td>{{ $totalGoals }}</td>
                                <td>{{ $totalAssists }}</td>
                                <td>{{ number_format($avgRating, 1) }}</td>
                                <td></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        @endif

        <br><br>

        <a href="/players" class="btn btn-secondary mb-3"><i class="bi bi-arrow-left"></i> Back</a>

        <a href="/players/{{ $player->id }}/performances/create" class="btn btn-primary mb-3">Add Match Performance </a>
    </div>
</div>

@endsection