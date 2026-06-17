@extends('layouts.public')

@section('content')
    <h1 class="page-title">Add client</h1>

    <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="first_name" class="form-label">First name</label>
            <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" class="form-input">
            <x-input-error :messages="$errors->get('first_name')" />
        </div>

        <div class="form-group">
            <label for="last_name" class="form-label">Last name</label>
            <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" class="form-input">
            <x-input-error :messages="$errors->get('last_name')" />
        </div>

        <div class="form-group">
            <label for="cnp" class="form-label">CNP</label>
            <input id="cnp" type="text" name="cnp" value="{{ old('cnp') }}" class="form-input">
            <x-input-error :messages="$errors->get('cnp')" />
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-input">
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="form-group">
            <label for="phone" class="form-label">Phone number</label>
            <input id="phone" type="text" name="phone" value="{{ old('phone') }}" class="form-input">
            <x-input-error :messages="$errors->get('phone')" />
        </div>

        <div class="form-group">
            <label for="birth_date" class="form-label">Birth date</label>
            <input id="birth_date" type="date" name="birth_date" value="{{ old('birth_date') }}" class="form-input">
            <x-input-error :messages="$errors->get('birth_date')" />
        </div>

        <div class="form-group">
            <label for="identity_series" class="form-label">ID series</label>
            <input id="identity_series" type="text" name="identity_series" value="{{ old('identity_series') }}"
                class="form-input">
            <x-input-error :messages="$errors->get('identity_series')" />
        </div>

        <div class="form-group">
            <label for="identity_number" class="form-label">ID number</label>
            <input id="identity_number" type="text" name="identity_number" value="{{ old('identity_number') }}"
                class="form-input">
            <x-input-error :messages="$errors->get('identity_number')" />
        </div>

        <div class="form-group">
            <label for="street" class="form-label">Street</label>
            <input id="street" type="text" name="street" value="{{ old('street') }}" class="form-input">
            <x-input-error :messages="$errors->get('street')" />
        </div>

        <div class="form-group">
            <label for="city" class="form-label">City</label>
            <input id="city" type="text" name="city" value="{{ old('city') }}" class="form-input">
            <x-input-error :messages="$errors->get('city')" />
        </div>

        <div class="form-group">
            <label for="county" class="form-label">County</label>

            <select id="county" name="county" class="form-select">
                <option value="">Select county</option>

                @foreach ($counties as $county)
                    <option value="{{ $county }}" @selected(old('county') === $county)>
                        {{ $county }}
                    </option>
                @endforeach
            </select>

            <x-input-error :messages="$errors->get('county')" />
        </div>

        <div class="form-group">
            <label for="identity_front_photo" class="form-label">ID front photo</label>
            <input id="identity_front_photo" type="file" name="identity_front_photo" class="form-input">
            <x-input-error :messages="$errors->get('identity_front_photo')" />
        </div>

        <div class="form-group">
            <label for="identity_back_photo" class="form-label">ID back photo</label>
            <input id="identity_back_photo" type="file" name="identity_back_photo" class="form-input">
            <x-input-error :messages="$errors->get('identity_back_photo')" />
        </div>

        <div class="form-group">
            <label for="notes" class="form-label">Notes</label>
            <textarea id="notes" name="notes" class="form-textarea">{{ old('notes') }}</textarea>
            <x-input-error :messages="$errors->get('notes')" />
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-primary">Save client</button>
            <a href="{{ route('clients.index') }}" class="btn btn-secondary">Back to clients</a>
        </div>
    </form>
@endsection
