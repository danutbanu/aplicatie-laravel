@extends('layouts.public')

@section('content')
    <h1>Edit client</h1>

    <form action="{{ route('clients.update', $client) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="first_name">First name</label>
            <input id="first_name" type="text" name="first_name" value="{{ old('first_name', $client->first_name) }}">
            <x-input-error :messages="$errors->get('first_name')" />
        </div>

        <div>
            <label for="last_name">Last name</label>
            <input id="last_name" type="text" name="last_name" value="{{ old('last_name', $client->last_name) }}">
            <x-input-error :messages="$errors->get('last_name')" />
        </div>

        <div>
            <label for="cnp">CNP</label>
            <input id="cnp" type="text" name="cnp" value="{{ old('cnp', $client->cnp) }}">
            <x-input-error :messages="$errors->get('cnp')" />
        </div>

        <div>
            <label for="email">Email address</label>
            <input id="email" type="email" name="email" value="{{ old('email', $client->email) }}">
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div>
            <label for="phone">Phone number</label>
            <input id="phone" type="text" name="phone" value="{{ old('phone', $client->phone) }}">
            <x-input-error :messages="$errors->get('phone')" />
        </div>

        <div>
            <label for="birth_date">Birth date</label>
            <input id="birth_date" type="date" name="birth_date" value="{{ old('birth_date', $client->birth_date) }}">
            <x-input-error :messages="$errors->get('birth_date')" />
        </div>

        <div>
            <label for="identity_series">ID series</label>
            <input id="identity_series" type="text" name="identity_series"
                value="{{ old('identity_series', $client->identity_series) }}">
            <x-input-error :messages="$errors->get('identity_series')" />
        </div>

        <div>
            <label for="identity_number">ID number</label>
            <input id="identity_number" type="text" name="identity_number"
                value="{{ old('identity_number', $client->identity_number) }}">
            <x-input-error :messages="$errors->get('identity_number')" />
        </div>

        <div>
            <label for="street">Street</label>
            <input id="street" type="text" name="street" value="{{ old('street', $client->street) }}">
            <x-input-error :messages="$errors->get('street')" />
        </div>

        <div>
            <label for="city">City</label>
            <input id="city" type="text" name="city" value="{{ old('city', $client->city) }}">
            <x-input-error :messages="$errors->get('city')" />
        </div>

        <div>
            <label for="county">County</label>
            <input id="county" type="text" name="county" value="{{ old('county', $client->county) }}">
            <x-input-error :messages="$errors->get('county')" />
        </div>

        <div>
            <label for="identity_front_photo">ID front photo</label>

            @if ($client->identity_front_photo)
                <img src="{{ asset('storage/' . $client->identity_front_photo) }}" width="150">
            @endif

            <input id="identity_front_photo" type="file" name="identity_front_photo">
            <x-input-error :messages="$errors->get('identity_front_photo')" />
        </div>

        <div>
            <label for="identity_back_photo">ID back photo</label>

            @if ($client->identity_back_photo)
                <img src="{{ asset('storage/' . $client->identity_back_photo) }}" width="150">
            @endif

            <input id="identity_back_photo" type="file" name="identity_back_photo">
            <x-input-error :messages="$errors->get('identity_back_photo')" />
        </div>

        <div>
            <label for="notes">Notes</label>
            <textarea id="notes" name="notes">{{ old('notes', $client->notes) }}</textarea>
            <x-input-error :messages="$errors->get('notes')" />
        </div>

        <button type="submit">Update client</button>
    </form>
@endsection
