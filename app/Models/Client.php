<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'cnp',
        'email',
        'phone',
        'birth_date',
        'identity_series',
        'identity_number',
        'street',
        'city',
        'county',
        'identity_front_photo',
        'identity_back_photo',
        'notes',
    ];
}
