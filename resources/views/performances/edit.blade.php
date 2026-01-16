@extends('layouts.main')

@section('content')
<div class="d-flex justify-content-center">
    <div class="registration-form registration-form-wide">
        <form method="POST" action="/players/{{ $player->id }}/performances/{{ $performance->id }}">
            @csrf
            @method('PUT')

            @include('performances._form', ['performance' => $performance])
        </form>
    </div>
</div>
@endsection
