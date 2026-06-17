@extends('layouts.public')

@section('content')
    <h1 class="page-title">Edit client</h1>

    <form action="{{ route('clients.update', $client) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="first_name" class="form-label">First name</label>
            <input id="first_name" type="text" name="first_name" value="{{ old('first_name', $client->first_name) }}"
                class="form-input">
            <x-input-error :messages="$errors->get('first_name')" />
        </div>

        <div class="form-group">
            <label for="last_name" class="form-label">Last name</label>
            <input id="last_name" type="text" name="last_name" value="{{ old('last_name', $client->last_name) }}"
                class="form-input">
            <x-input-error :messages="$errors->get('last_name')" />
        </div>

        <div class="form-group">
            <label for="cnp" class="form-label">CNP</label>
            <input id="cnp" type="text" name="cnp" value="{{ old('cnp', $client->cnp) }}" class="form-input">
            <x-input-error :messages="$errors->get('cnp')" />
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email address</label>
            <input id="email" type="email" name="email" value="{{ old('email', $client->email) }}"
                class="form-input">
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="form-group">
            <label for="phone" class="form-label">Phone number</label>
            <input id="phone" type="text" name="phone" value="{{ old('phone', $client->phone) }}"
                class="form-input">
            <x-input-error :messages="$errors->get('phone')" />
        </div>

        <div class="form-group">
            <label for="birth_date" class="form-label">Birth date</label>
            <input id="birth_date" type="date" name="birth_date"
                value="{{ old('birth_date', $client->birth_date?->format('Y-m-d')) }}" class="form-input">
            <x-input-error :messages="$errors->get('birth_date')" />
        </div>

        <div class="form-group">
            <label for="identity_series" class="form-label">ID series</label>
            <input id="identity_series" type="text" name="identity_series"
                value="{{ old('identity_series', $client->identity_series) }}" class="form-input">
            <x-input-error :messages="$errors->get('identity_series')" />
        </div>

        <div class="form-group">
            <label for="identity_number" class="form-label">ID number</label>
            <input id="identity_number" type="text" name="identity_number"
                value="{{ old('identity_number', $client->identity_number) }}" class="form-input">
            <x-input-error :messages="$errors->get('identity_number')" />
        </div>

        <div class="form-group">
            <label for="street" class="form-label">Street</label>
            <input id="street" type="text" name="street" value="{{ old('street', $client->street) }}"
                class="form-input">
            <x-input-error :messages="$errors->get('street')" />
        </div>

        <div class="form-group">
            <label for="city" class="form-label">City</label>
            <input id="city" type="text" name="city" value="{{ old('city', $client->city) }}"
                class="form-input">
            <x-input-error :messages="$errors->get('city')" />
        </div>

        <div class="form-group">
            <label for="county" class="form-label">County</label>

            <select id="county" name="county" class="form-select">
                <option value="">Select county</option>

                @foreach ($counties as $county)
                    <option value="{{ $county }}" @selected(old('county', $client->county) === $county)>
                        {{ $county }}
                    </option>
                @endforeach
            </select>

            <x-input-error :messages="$errors->get('county')" />
        </div>

        <div class="form-group">
            <label for="identity_front_photo" class="form-label">ID front photo</label>

            @if ($client->identity_front_photo)
                <img src="{{ asset('storage/' . $client->identity_front_photo) }}" alt="ID front photo"
                    class="preview-image">
            @endif

            <input id="identity_front_photo" type="file" name="identity_front_photo" class="form-input">
            <x-input-error :messages="$errors->get('identity_front_photo')" />
        </div>

        <div class="form-group">
            <label for="identity_back_photo" class="form-label">ID back photo</label>

            @if ($client->identity_back_photo)
                <img src="{{ asset('storage/' . $client->identity_back_photo) }}" alt="ID back photo"
                    class="preview-image">
            @endif

            <input id="identity_back_photo" type="file" name="identity_back_photo" class="form-input">
            <x-input-error :messages="$errors->get('identity_back_photo')" />
        </div>

        <div class="form-group">
            <label for="notes" class="form-label">Notes</label>
            <textarea id="notes" name="notes" class="form-textarea">{{ old('notes', $client->notes) }}</textarea>
            <x-input-error :messages="$errors->get('notes')" />
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-primary">Update client</button>
            <a href="{{ route('clients.show', $client) }}" class="btn btn-secondary">Back to client</a>
        </div>
    </form>
@endsection
