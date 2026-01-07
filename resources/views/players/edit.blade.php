@extends('layouts.main')

@section('content')

<div class="registration-form" style="max-width: 700px;">

    <div class="form-icon">
        <span><i class="icon icon-user"></i></span>
    </div>

    <h3 class="text-center mb-4">Edit Player</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/players/{{ $player->id }}">
        @csrf
        @method('PUT')

        {{-- Team --}}
        <div class="form-group">
            <select name="team_id" class="form-control item">
                <option value="">Select team</option>
                @foreach ($teams as $team)
                    <option value="{{ $team->id }}"
                        {{ old('team_id', $player->team_id) == $team->id ? 'selected' : '' }}>
                        {{ $team->name }} ({{ $team->league }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <input type="text" name="first_name" class="form-control item"
                   placeholder="First Name" value="{{ old('first_name', $player->first_name) }}">
        </div>

        <div class="form-group">
            <input type="text" name="last_name" class="form-control item"
                   placeholder="Last Name" value="{{ old('last_name', $player->last_name) }}">
        </div>

        {{-- Position dropdown --}}
        <div class="form-group">
            <select name="position" class="form-control item">
                <option value="">Select position</option>
                @foreach (['GK','DF','MF','FW'] as $pos)
                    <option value="{{ $pos }}"
                        {{ old('position', $player->position) == $pos ? 'selected' : '' }}>
                        {{ $pos }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <input type="text" name="nationality" class="form-control item"
                   placeholder="Nationality" value="{{ old('nationality', $player->nationality) }}">
        </div>

        <div class="form-group">
            <input type="number" name="shirt_number" class="form-control item"
                   placeholder="Shirt Number" value="{{ old('shirt_number', $player->shirt_number) }}">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-block create-account">
                Update Player
            </button>
        </div>

    </form>

</div>

@endsection
