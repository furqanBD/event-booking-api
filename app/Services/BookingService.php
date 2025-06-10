<?php

namespace App\Services;
use App\Models\Booking;
use App\Models\Event;

class BookingService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Create a new booking.
     *
     * @param array $data
     * @param int $eventId
     * @return Booking
     */
    public function createBooking(array $data, int $eventId): Booking
    {
        return Booking::create([
            'event_id' => $eventId,
            'name' => $data['name'],
            'email' => $data['email'],
            'seats_reserved' => $data['seats_reserved'],
        ]);
    }
    /**
     * Check if the event capacity is exceeded.
     *
     * @param int $eventId
     * @param int $seatsReserved
     * @return bool
     */
    public function checkEventCapacity(Event| null $event, int $seatsReserved): bool
    {
        if ($event === null) {
            return false; // Event not found
        }

        // Calculate the total seats reserved for the event
        $totalReserved = $event->bookings()->sum('seats_reserved');

        // Check if the new reservation exceeds the event capacity
        return ($totalReserved + $seatsReserved) <= 100;
    }
}
