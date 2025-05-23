<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventTable;

class EventController extends Controller
{
    /**
     * Show events and event table solutions with filters.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function showEvents(Request $request)
    {
        // Get filter values from the request
        $search = $request->input('search');
        $topic = $request->input('topic');
        $eventType = $request->input('event_type');
        $location = $request->input('location');
        $date = $request->input('date');

        // Build the query for events
        $eventsQuery = Event::query();

        if ($search) {
            $eventsQuery->where('title1', 'like', '%' . $search . '%')
                        ->orWhere('title1_content', 'like', '%' . $search . '%');
        }

        // If you have other filters like topic, event type, etc., you can add more conditions here
        if ($topic) {
            $eventsQuery->where('topic', $topic);
        }

        if ($eventType) {
            $eventsQuery->where('event_type', $eventType);
        }

        if ($location) {
            $eventsQuery->where('location', 'like', '%' . $location . '%');
        }

        if ($date) {
            $eventsQuery->whereDate('date', $date);
        }

        // Fetch the filtered events
        $events = $eventsQuery->get();

        // Fetch eventTable records (optionally apply similar filters here as well)
        $eventTable = EventTable::all(); // You can apply filters to this if needed

        return view('events', compact('events', 'eventTable'));
    }


    
    public function show($id)
    {
        $event = 	eventTable::findOrFail($id);

        return view('events.show', compact('event'));
    }
}
