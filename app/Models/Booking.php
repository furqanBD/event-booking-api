<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Event;

class Booking extends Model
{
    //
    protected $fillable = [
        'event_id',
        'name',
        'email',
        'seats_reserved',
    ];

    protected $casts = [
        'seats_reserved' => 'integer',
    ];

    /**
     * Get the event that the booking belongs to.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event():BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
