@extends('layouts.main')

@section('content')
<div class="d-flex justify-content-center">
    <div class="registration-form registration-form-wide">

        <div class="form-icon">
            <span><i class="icon icon-user"></i></span>
        </div>

        <h3 class="text-center mb-4">Add Team</h3>

        <form method="POST" action="/teams">
            @csrf

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
                <select name="name" id="teamNameSelect" class="item">
                    <option value="">Select team</option>
                </select>
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-block create-account">
                    Save Team
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const leagueSelect    = document.getElementById('leagueSelect');
    const teamNameSelect  = document.getElementById('teamNameSelect');

    const teamsByLeague = @json($teamsByLeague);

    // Turn the plain <select> into a Choices dropdown
    const teamChoices = new Choices(teamNameSelect, {
        searchPlaceholderValue: 'Search team...',
        shouldSort: false,
        itemSelectText: '',
    });

    function populateTeamNames(league, selectedName = null) {

        teamChoices.clearStore();
        teamChoices.clearChoices();

        teamChoices.setChoices([{ value: '', label: 'Select team', disabled: true, selected: !selectedName }]);

        if (!league || !teamsByLeague[league]) {
            teamNameSelect.disabled = true;
            return;
        }

        const choices = teamsByLeague[league].map(name => ({
            value: name,
            label: name,
            selected: selectedName === name,
        }));

        teamChoices.setChoices(choices);
        teamNameSelect.disabled = false;
    }

    leagueSelect.addEventListener('change', function () {
        populateTeamNames(this.value);
    });

    const oldLeague = "{{ old('league') }}";
    const oldName   = "{{ old('name') }}";

    if (oldLeague) {
        leagueSelect.value = oldLeague;
        populateTeamNames(oldLeague, oldName);
    }
});
</script>

@endsection
