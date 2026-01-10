@extends('layouts.main')

@section('content')


@include('players._form', [
    'action' => '/players',
    'method' => null,
    'buttonText' => 'Save Player',
    'player' => null,
    'selectedLeague' => old('league'),
])

@endsection
