<div class="registration-form registration-form-wide">
    <div class="form-icon">
        <span><i class="icon icon-user"></i></span>
    </div>

    <h4 class="text-center mt-4">Add Match Performance</h4>

        <form method="POST" action="/players/{{ $player->id }}/performances">
            @csrf

            <div class="form-group">
                <input
                    type="text"
                    name="opponent"
                    class="form-control item"
                    placeholder="Opponent"
                    value="{{ old('opponent') }}"
                >
            </div>

            <div class="form-group">
                <input
                    type="date"
                    name="match_date"
                    class="form-control item"
                    placeholder="Match Date"
                    value="{{ old('match_date') }}"
                >
            </div>

            <div class="form-group">
                <input
                    type="number"
                    name="minutes_played"
                    class="form-control item"
                    placeholder="Minutes Played"
                    value="{{ old('minutes_played') }}"
                >
            </div>

            <div class="form-group">
                <input
                    type="number"
                    name="goals"
                    class="form-control item"
                    placeholder="Goals"
                    value="{{ old('goals') }}"
                >
            </div>

            <div class="form-group">
                <input
                    type="number"
                    name="assists"
                    class="form-control item"
                    placeholder="Assists"
                    value="{{ old('assists') }}"
                >
            </div>

            <div class="form-group">
                <input
                    type="number"
                    step="0.1"
                    name="rating"
                    class="form-control item"
                    placeholder="Rating (0–10)"
                    value="{{ old('rating') }}"
                >
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-block create-account">
                    Add Performance
                </button>
            </div>

        </form>
</div>
