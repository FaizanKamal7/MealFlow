<?php

namespace Modules\HRManagement\Http\Controllers\Events;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Modules\HRManagement\Interfaces\EventsInterface;
use Symfony\Component\HttpFoundation\Response;

class EventsController extends Controller
{
    // Meta Data
    private EventsInterface $eventsRepository;

    /**
     * @param EventsInterface $eventsRepository
     */
    public function __construct(EventsInterface $eventsRepository)
    {
        $this->eventsRepository = $eventsRepository;
    }

    // View
    /**
     * Display a listing of the resource.
     */
    public function viewEvents()
    {
        abort_if(Gate::denies('view_events'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $events = $this->eventsRepository->getEvents();

        return view('hrmanagement::events.events', ["events" => $events]);
    }

    // Add
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function storeEvent(Request $request)
    {
        abort_if(Gate::denies('add_events'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $eventTitle = $request->get("event_title");
            $description = $request->get("description");
            $venue = $request->get("venue");
            $color = $request->get("color");
            $start_date_time = $request->get("start_date_time");
            $end_date_time = $request->get("end_date_time");
            $type = $request->get("type");

            $this->eventsRepository->createEvent($eventTitle, $description, $venue, $color, $start_date_time, $end_date_time, $type);

            return redirect()->route("hr_events")->with("success", "Event added successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            error_log("Error : ".$exception);
            return redirect()->route("hr_events")->with("error", "Something went wrong! Contact support");
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     */
    public function showEvent($id)
    {
        return view('hrmanagement::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     */
    public function editEvent($id)
    {
        abort_if(Gate::denies('edit_events'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $event = $this->eventsRepository->getEvent($id);
            return response()->json(["event" => $event], 200);
        } catch (Exception $exception) {
            Log::error($exception);
            return response()->json(["event" => null], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     */
    public function updateEvent(Request $request)
    {
        abort_if(Gate::denies('update_events'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $title = $request->get("event_title");
//        dd($title);
            $description = $request->get("description");
            $venue = $request->get("venue");
            $color = $request->get("color");
            $start_date_time = $request->get("start_date_time");
            $end_date_time = $request->get("end_date_time");
            $type = $request->get("type");

            $this->eventsRepository->updateEvent($request->get('id'), $title, $description, $venue, $color, $start_date_time, $end_date_time, $type);
            return redirect()->route("hr_events")->with("success", "Events updated successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route("hr_events")->with("error", "Something went wrong! Contact support");
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroyEvent($id)
    {
        abort_if(Gate::denies('delete_events'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $this->eventsRepository->deleteEvent($id);
            return redirect()->route("hr_events")->with("success", "Event deleted successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route("hr_events")->with("error", "Something went wrong! Contact support");
        }
    }
}
