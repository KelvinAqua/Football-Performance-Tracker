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

        {{-- Position (dropdown) --}}
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
            <input type="text" class="form-control item" name="nationality" placeholder="Nationality"
                   value="{{ old('nationality', $player->nationality ?? '') }}">
        </div>

        {{-- Shirt Number --}}
        <div class="form-group">
            <input type="number" class="form-control item" name="shirt_number" placeholder="Shirt Number"
                   value="{{ old('shirt_number', $player->shirt_number ?? '') }}">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-block create-account">
                {{ $buttonText ?? 'Save Player' }}
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const leagueSelect = document.getElementById('leagueSelect');
    const teamSelect = document.getElementById('teamSelect');

    const teams = @json($teams);

    function populateTeams(selectedLeague, selectedTeamId = null) {
        teamSelect.innerHTML = '<option value="" disabled selected>Select team</option>';

        const filtered = teams.filter(t => t.league === selectedLeague);

        filtered.forEach(t => {
            const opt = document.createElement('option');
            opt.value = t.id;
            opt.textContent = t.name;
            if (selectedTeamId && Number(selectedTeamId) === Number(t.id)) {
                opt.selected = true;
            }
            teamSelect.appendChild(opt);
        });

        teamSelect.disabled = filtered.length === 0;
    }

    leagueSelect.addEventListener('change', function () {
        populateTeams(this.value, null);
    });

    const initialLeague = leagueSelect.value;
    const initialTeamId = @json(old('team_id', $player->team_id ?? null));

    if (initialLeague) {
        populateTeams(initialLeague, initialTeamId);
    }
});
</script>
