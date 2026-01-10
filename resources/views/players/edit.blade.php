@extends('layouts.main')

@section('content')


@include('players._form', [
    'action' => "/players/{$player->id}",
    'method' => 'PUT',
    'buttonText' => 'Update Player',
    'player' => $player,
    'selectedLeague' => old('league', $player->team->league ?? ''),
])

@endsection
