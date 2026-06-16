@extends('layouts.public')

@section('content')
    <h1>Client-detailes</h1>

    <p>{{ $client->first_name }} {{ $client->last_name }}</p>
    <p>{{ $client->email }}</p>
    <p>{{ $client->phone }}</p>
@endsection
