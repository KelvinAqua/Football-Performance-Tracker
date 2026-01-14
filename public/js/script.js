$(document).ready(function(){
  $('#birth-date').mask('00/00/0000');
  $('#phone-number').mask('0000-0000');
 })

 document.addEventListener('DOMContentLoaded', async function () {
    const select = document.getElementById('nationalitySelect');
    if (!select) return;

    const selectedNationality =
        document.getElementById('selectedNationality')?.value ?? '';

    try {
        const response = await fetch('/api/countries');
        const countries = await response.json();

        countries.forEach(country => {
            const option = document.createElement('option');
            option.value = country;
            option.textContent = country;

            if (country === selectedNationality) {
                option.selected = true;
            }

            select.appendChild(option);
        });
    } catch (error) {
        console.error('Error loading countries:', error);
    }
});

document.addEventListener('DOMContentLoaded', function () {



    const leagueSelect = document.getElementById('leagueSelect');
    const teamSelect = document.getElementById('teamSelect');
    const teamsInput = document.getElementById('teamsData');
    const initialTeamInput = document.getElementById('initialTeamId');

    if (leagueSelect && teamSelect && teamsInput) {
        const teams = JSON.parse(teamsInput.value || '[]');
        const initialTeamId = initialTeamInput?.value || null;

        function populateTeams(selectedLeague, selectedTeamId = null) {
            teamSelect.innerHTML = '<option value="" disabled>Select team</option>';

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

        // Change league
        leagueSelect.addEventListener('change', function () {
            populateTeams(this.value, null);
        });

        // Initial load (edit / validation error)
        if (leagueSelect.value) {
            populateTeams(leagueSelect.value, initialTeamId);
        }
    }

    const nationalitySelect = document.getElementById('nationalitySelect');
    const selectedNationalityInput = document.getElementById('selectedNationality');

    if (nationalitySelect) {
        const selectedNationality = selectedNationalityInput?.value || '';

        fetch('/api/countries')
            .then(res => res.json())
            .then(countries => {
                countries.forEach(country => {
                    const option = document.createElement('option');
                    option.value = country;
                    option.textContent = country;

                    if (country === selectedNationality) {
                        option.selected = true;
                    }

                    nationalitySelect.appendChild(option);
                });
            })
            .catch(err => console.error('Failed to load countries', err));
    }
});

document.addEventListener('DOMContentLoaded', function () {


    const leagueSelect = document.getElementById('leagueSelect');
    const teamNameSelect = document.getElementById('teamNameSelect');
    const teamsByLeagueInput = document.getElementById('teamsByLeagueData');

    if (leagueSelect && teamNameSelect && teamsByLeagueInput) {
        const teamsByLeague = JSON.parse(teamsByLeagueInput.value || '{}');

        const oldLeague = document.getElementById('oldLeague')?.value || '';
        const oldTeamName = document.getElementById('oldTeamName')?.value || '';

        const teamChoices = new Choices(teamNameSelect, {
            searchPlaceholderValue: 'Search team...',
            shouldSort: false,
            itemSelectText: '',
        });

        function populateTeamNames(league, selectedName = null) {
            teamChoices.clearStore();
            teamChoices.clearChoices();

            teamChoices.setChoices([
                {
                    value: '',
                    label: 'Select team',
                    disabled: true,
                    selected: !selectedName
                }
            ]);

            if (!league || !teamsByLeague[league]) {
                teamNameSelect.disabled = true;
                return;
            }

            const choices = teamsByLeague[league].map(name => ({
                value: name,
                label: name,
                selected: selectedName === name
            }));

            teamChoices.setChoices(choices);
            teamNameSelect.disabled = false;
        }

        leagueSelect.addEventListener('change', function () {
            populateTeamNames(this.value);
        });

        if (oldLeague) {
            leagueSelect.value = oldLeague;
            populateTeamNames(oldLeague, oldTeamName);
        } else {
            teamNameSelect.disabled = true;
        }
    }
});



