<?php

namespace Modules\HRManagement\Interfaces;

interface EventsInterface
{
public function createEvent($eventTitle,$description=null,$venue=null,$color=null,$startDateTime=null,$endDateTime=null,$type=null);
public function updateEvent($id,$eventTitle=null,$description=null,$venue=null,$color=null,$startDateTime=null,$endDateTime=null,$type=null);

public function getEvents();
public function getEvent($id);
public function deleteEvent($id);

}
