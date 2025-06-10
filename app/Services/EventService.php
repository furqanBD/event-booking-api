<?php

namespace App\Services;
use App\Models\Event;

class EventService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    /**
     * Get all events.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllEvents()
    {
        return Event::all();
    }
    /**
     * Create a new event.
     *
     * @param array $data
     * @return Event
     */
    public function createEvent(array $data): Event
    {
        return Event::create($data);
    }
    /**
     * Find an event by ID.
     *
     * @param string $id
     * @return Event|null
     */
    public function findEventById(string $id): ?Event
    {
        return Event::find($id);
    }
    /**
     * Update an event.
     *
     * @param string $id
     * @param array $data
     * @return Event|null
     */
    public function updateEvent(string $id, array $data): ?Event
    {
        $event = $this->findEventById($id);
        if ($event) {
            $event->update($data);
            return $event;
        }
        return null;
    }
    /**
     * Delete an event.
     *
     * @param string $id
     * @return bool
     */
    public function deleteEvent(string $id): bool
    {
        $event = $this->findEventById($id);
        if ($event) {
            return $event->delete();
        }
        return false;
    }
    /**
     * Get the bookings for an event.
     *
     * @param string $id
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function getEventBookings(string $id)
    {
        $event = $this->findEventById($id);
        if ($event) {
            return $event->bookings;
        }
        return null;
    }
}
