<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Services\BookingService;
use Illuminate\Http\JsonResponse;
use App\Models\Event;

class BookingController extends Controller
{
    private BookingService $bookingService;
    /**
     * Create a new class instance.
     * @param BookingService $bookingService
     */
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }
    /**
     * Store a newly created resource in storage.
     * $@param StoreBookingRequest $request
     * @param int $eventId
     * @return JsonResponse
     */
    public function store(StoreBookingRequest $request, int $eventId): JsonResponse
    {
        //
        try {
            $event = Event::find($eventId);
            // Check if the event exists
            if (Event::find($eventId) === null) {
                return response()->json(['message' => 'Event not found'], JsonResponse::HTTP_NOT_FOUND);
            }

            // Check if the requested seats exceed the event capacity
           if ($this->bookingService->checkEventCapacity($event, $request->seats_reserved) === false) {
                return response()->json(['message' => 'Event capacity exceeded'], JsonResponse::HTTP_BAD_REQUEST); 
           }
        
            $booking = $this->bookingService->createBooking($request->validated(), $event->id);
            return response()->json(['message' => 'Booking created successfully', 'data' => $booking], JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            \Log::error('Error creating booking: ' . $e->getMessage());

            return response()->json(['message' => 'unhanfle '], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
