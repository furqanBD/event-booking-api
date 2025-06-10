<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Booking;

class Event extends Model
{
    //
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
    ];
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /**
     * Get the bookings for the event.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings():hasMany
    {
        return $this->hasMany(Booking::class);
    }
}
