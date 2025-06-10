<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Services\EventService;
use Illuminate\Http\JsonResponse;

class EventController extends Controller
{
    private $eventService;
    /**
     * Create a new class instance.
     */
    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

   
    /**
     * Display a listing of the events.
     */
    public function index()
    {
        
            try{
                $events = $this->eventService->getAllEvents();
                return response()->json(['data' => $events], JsonResponse::HTTP_OK);
            }
            catch(\Exception $e){
                \Log::error('Error fetching events: ' . $e->getMessage());
                return response()->json(['message' => 'Unable to fetch events'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        
        try {
            $event = $this->eventService->createEvent($request->all());
            return response()->json(['message' => 'Event created successfully', 'data' => $event], JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            \Log::error('Error creating event: ' . $e->getMessage());
            return response()->json(['message' => 'Unable to create event'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try {
            $event = $this->eventService->findEventById($id);
            if (!$event) {
                return response()->json(['message' => 'Event not found'], JsonResponse::HTTP_NOT_FOUND);
            }
            return response()->json(['data' => $event], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            \Log::error('Error fetching event: ' . $e->getMessage());
            return response()->json(['message' => 'Unable to fetch event'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            $event = $this->eventService->updateEvent($id, $request->all());
            if (!$event) {
                return response()->json(['message' => 'Event not found'], JsonResponse::HTTP_NOT_FOUND);
            }
            return response()->json(['message' => 'Event updated successfully', 'data' => $event], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            \Log::error('Error updating event: ' . $e->getMessage());
            return response()->json(['message' => 'Unable to update event'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $deleted = $this->eventService->deleteEvent($id);
            if (!$deleted) {
                return response()->json(['message' => 'Event not found'], JsonResponse::HTTP_NOT_FOUND);
            }
            return response()->json(['message' => 'Event deleted successfully'], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            \Log::error('Error deleting event: ' . $e->getMessage());
            return response()->json(['message' => 'Unable to delete event'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
