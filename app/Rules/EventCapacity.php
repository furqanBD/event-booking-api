<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Booking;

class EventCapacity implements Rule
{
    protected int $max;
    protected string $seatsField;
    /**
     * Create a new rule instance.
     *
     * @param string $seatsField
     * @param int $max default maximum capacity is 100
     * @return void
     */
    public function __construct(string $seatsField, int $max = 100)
    {
        $this->seatsField = $seatsField;
        $this->max = $max;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $request = request();
        $eventId = $request->input($attribute);
        $newSeats = (int) $request->input($this->seatsField);

        $total = Booking::where('event_id', $eventId)
                        ->sum('booked_seats');

        return ($total + $newSeats) <= $this->max;
    }

    public function message(): string
    {
        return "Booking exceeds maximum capacity of {$this->max} seats.";
    }
}