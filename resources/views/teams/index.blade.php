@extends('layouts.main')

@section('content')
    <h1 class="mb-3">Teams</h1>

    <a href="{{ route('teams.create') }}" class="btn btn-primary mb-3">Add Team</a>

    <div class="row">
        @foreach ($teams as $team)
            <div class="col-md-4 mb-4">
                <div class="card team-card bg-light-subtle">
                    <div class="card-body team-card-body">
                        <div class="text-section">
                            <h5 class="card-title">{{ $team->name }}</h5>
                            <p class="card-text mb-1">
                                League: {{ $team->league }}<br>
                                Players: {{ $team->players->count() }}
                            </p>
                        </div>

                        <div class="cta-section">
                            <a href="{{ route('teams.show', $team) }}"
                               class="btn btn-view mb-2">
                                View
                            </a>

                            <form action="{{ route('teams.destroy', $team) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-delete">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
