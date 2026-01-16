<div class="registration-form registration-form-wide">
        <form method="POST" action="/players/{{ $player->id }}/performances">
            @csrf
            <div class="form-icon">
                 <span><i class="icon icon-user"></i></span>
            </div>
            <div class="form-group">
                <input
                    type="text"
                    name="opponent"
                    class="form-control item"
                    placeholder="Opponent"
                    value="{{ old('opponent', $performance->opponent  ?? '') }}">
            </div>

            <div class="form-group">
                <input
                    type="date"
                    name="match_date"
                    class="form-control item"
                    placeholder="Match Date"
                    value="{{ old('match_date', $performance->match_date ?? '') }}">
            </div>

            <div class="form-group">
                <input
                    type="number"
                    name="minutes_played"
                    class="form-control item"
                    placeholder="Minutes Played"
                    value="{{ old('minutes_played', $performance->minutes_played ?? '') }}">
            </div>

            <div class="form-group">
                <input
                    type="number"
                    name="goals"
                    class="form-control item"
                    placeholder="Goals"
                    value="{{ old('goals', $performance->goals ?? 0) }}">
            </div>

            <div class="form-group">
                <input
                    type="number"
                    name="assists"
                    class="form-control item"
                    placeholder="Assists"
                value="{{ old('assists', $performance->assists ?? 0) }}">
            </div>

            <div class="form-group">
                <input
                    type="number"
                    step="0.1"
                    name="rating"
                    class="form-control item"
                    placeholder="Rating (0–10)"
                    value="{{ old('rating', $performance->rating ?? '') }}">
            </div>

        <div class="form-group d-flex justify-content-between align-items-center">
            <a href="/players/{{ $player->id }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>

            <button type="submit" class="btn btn-primary">
                {{ $buttonText ?? 'Save Performance' }}
            </button>
        </div>


        </form>
</div>
