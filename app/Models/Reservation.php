<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $table = 'reservations'; // Make sure this matches your actual table name
    protected $fillable = [
        'name',
        'email',
        'phone',
        'guest',
        'date',
        'time',
        'message',
        'status',
    ];
}
