<?php

namespace Modules\HRManagement\Repositories;

use Modules\HRManagement\Entities\Events;
use Modules\HRManagement\Interfaces\EventsInterface;

class EventsRepository implements EventsInterface
{

    /**
     * @param $eventTitle
     * @param $description
     * @param $venue
     * @param $color
     * @param $startDateTime
     * @param $endDateTime
     * @param $type
     * @return mixed
     */
    public function createEvent($eventTitle, $description = null, $venue = null, $color = null, $startDateTime = null, $endDateTime = null, $type = null)
    {
        $event= new Events([
            "event_title"=>$eventTitle,
            "description"=>$description,
            "venue"=>$venue,
            "color"=>$color,
            "start_date_time"=>$startDateTime,
            "end_date_time"=>$endDateTime,
            "type"=>$type

        ]);

        return $event->save();
    }

    /**
     * @param $id
     * @param $eventTitle
     * @param $description
     * @param $venue
     * @param $color
     * @param $startDateTime
     * @param $endDateTime
     * @param $type
     * @return mixed
     */
    public function updateEvent($id, $eventTitle = null, $description = null, $venue = null, $color = null, $startDateTime = null, $endDateTime = null, $type = null)
    {
        $event = Events::find($id);
        $event->description = $description;
        if ($eventTitle){
            $event->event_title = $eventTitle;
        }
        if ($venue){
            $event->venue=$venue;
        }
        if ($color){
            $event->color=$color;
        }
        if ($startDateTime){
            $event->start_date_time=$startDateTime;
        }
        if ($endDateTime){
            $event->end_date_time = $endDateTime;
        }
        if ($type){
            $event->type=$type;
        }

        return $event->save();
    }

    /**
     * @return mixed
     */
    public function getEvents()
    {
        return Events::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getEvent($id)
    {
        return Events::find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteEvent($id)
    {
       return Events::where(["id"=>$id])->delete();
    }
}
