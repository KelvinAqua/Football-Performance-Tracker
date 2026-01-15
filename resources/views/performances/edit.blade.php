@extends('layouts.main')

@section('content')
<div class="d-flex justify-content-center">
    @include('performances._form', [
        'title' => 'Edit Match Performance',
        'action' => "/players/{$player->id}/performances",
        'method' => "PUT",
        'buttonText' => 'Save Performance',
        'player' => $player,
        'performance' => null
    ])
</div>
@endsection
