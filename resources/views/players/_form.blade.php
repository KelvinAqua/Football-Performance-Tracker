<div class="registration-form">
    <form method="POST" action="{{ $action }}">
        @csrf
        @if(!empty($method))
            @method($method)
        @endif

        <div class="form-icon">
            <span><i class="icon icon-user"></i></span>
        </div>

        {{-- League --}}
        <div class="form-group">
            <select name="league" id="leagueSelect" class="form-control item">
                <option value="" disabled {{ old('league', $selectedLeague ?? '') == '' ? 'selected' : '' }}>
                    Select league
                </option>
                @foreach ($leagues as $league)
                    <option value="{{ $league }}"
                        {{ old('league', $selectedLeague ?? '') == $league ? 'selected' : '' }}>
                        {{ $league }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Team --}}
        <div class="form-group">
            <select name="team_id" id="teamSelect" class="form-control item" disabled>
                <option value="" disabled selected>Select team</option>
            </select>
            <input type="hidden" id="teamsData" value='@json($teams)'>
            <input type="hidden" id="initialTeamId" value="{{ old('team_id', $player->team_id ?? '') }}">
        </div>

        {{-- First Name --}}
        <div class="form-group">
            <input type="text" class="form-control item" name="first_name" placeholder="First Name"
                   value="{{ old('first_name', $player->first_name ?? '') }}">
        </div>

        {{-- Last Name --}}
        <div class="form-group">
            <input type="text" class="form-control item" name="last_name" placeholder="Last Name"
                   value="{{ old('last_name', $player->last_name ?? '') }}">
        </div>

        {{-- Position --}}
        <div class="form-group">
            <select name="position" class="form-control item">
                <option value="" disabled {{ old('position', $player->position ?? '') == '' ? 'selected' : '' }}>
                    Select position
                </option>
                @foreach (['GK','DF','MF','FW'] as $pos)
                    <option value="{{ $pos }}" {{ old('position', $player->position ?? '') == $pos ? 'selected' : '' }}>
                        {{ $pos }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Nationality --}}
        <div class="form-group">
            <select name="nationality" id="nationalitySelect" class="form-control item">
                <option value="">Select nationality</option>
            </select>
            <input type="hidden" id="selectedNationality"
                value="{{ old('nationality', $player->nationality ?? '') }}">
        </div>

        {{-- Shirt Number --}}
        <div class="form-group">
            <input type="number" class="form-control item" name="shirt_number" placeholder="Shirt Number"
                   value="{{ old('shirt_number', $player->shirt_number ?? '') }}">
        </div>

        <div class="form-group d-flex justify-content-between align-items-center">
            <a href="/players" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>

            <button type="submit" class="btn btn-primary">
                {{ $buttonText ?? 'Save Player' }}
            </button>
        </div>

    </form>
</div>
