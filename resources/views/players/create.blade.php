@extends('layouts.main')

@section('content')
<div class="registration-form">

    <form method="POST" action="/players">
        @csrf

        <div class="form-icon">
            <span><i class="icon icon-user"></i></span>
        </div>

        <div class="form-group">
            <select name="league" id="leagueSelect" class="form-control item">
                <option value="">Select league</option>
                @foreach ($leagues as $league)
                    <option value="{{ $league }}" {{ old('league') == $league ? 'selected' : '' }}>
                        {{ $league }}
                    </option>
                @endforeach
            </select>
        </div>


        <div class="form-group">
            <select name="team_id" id="teamSelect" class="form-control item" disabled>
                <option value="">Select team</option>
            </select>
        </div>

        <div class="form-group">
            <input type="text" name="first_name" class="form-control item"
                   placeholder="First Name" value="{{ old('first_name') }}">
        </div>

        <div class="form-group">
            <input type="text" name="last_name" class="form-control item"
                   placeholder="Last Name" value="{{ old('last_name') }}">
        </div>

        <div class="form-group">
            <select name="position" class="form-control item">
                <option value="" disabled {{ old('position') ? '' : 'selected' }}>Select position</option>

                <option value="GK" {{ old('position') == 'GK' ? 'selected' : '' }}>GK</option>
                <option value="DF" {{ old('position') == 'DF' ? 'selected' : '' }}>DF</option>
                <option value="MF" {{ old('position') == 'MF' ? 'selected' : '' }}>MF</option>
                <option value="FW" {{ old('position') == 'FW' ? 'selected' : '' }}>FW</option>
            </select>
        </div>


        <div class="form-group">
            <input type="text" name="nationality" class="form-control item"
                   placeholder="Nationality" value="{{ old('nationality') }}">
        </div>

        <div class="form-group">
            <input type="number" name="shirt_number" class="form-control item"
                   placeholder="Shirt Number" value="{{ old('shirt_number') }}">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-block create-account">
                Save Player
            </button>
        </div>
    </form>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    const leagueSelect = document.getElementById('leagueSelect');
    const teamSelect   = document.getElementById('teamSelect');

    // All teams from the controller (id, name, league)
    const teams = @json($teams);

    function populateTeams(league, selectedId = null) {
        teamSelect.innerHTML = '<option value="">Select team</option>';

        if (!league) {
            teamSelect.disabled = true;
            return;
        }

        const filtered = teams.filter(t => t.league === league);

        filtered.forEach(t => {
            const opt = document.createElement('option');
            opt.value = t.id;
            opt.textContent = t.name;
            if (selectedId && Number(selectedId) === t.id) {
                opt.selected = true;
            }
            teamSelect.appendChild(opt);
        });

        teamSelect.disabled = filtered.length === 0;
    }

    leagueSelect.addEventListener('change', function () {
        populateTeams(this.value);
    });

    // Restore old values after validation error
    const oldLeague = "{{ old('league') }}";
    const oldTeamId = "{{ old('team_id') }}";

    if (oldLeague) {
        leagueSelect.value = oldLeague;
        populateTeams(oldLeague, oldTeamId);
    }
});
</script>



</div>
@endsection
