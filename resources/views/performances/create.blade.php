@extends('layouts.main')

@section('content')
<div class="d-flex justify-content-center">
    @include('performances._form', [
        'title' => 'Add Match Performance',
        'action' => "/players/{$player->id}/performances",
        'method' => null,
        'buttonText' => 'Add Performance',
        'player' => $player,
        'performance' => null
    ])
</div>
@endsection
