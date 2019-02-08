<?php

namespace App\Services\Tenants;

use App\Http\Requests\UpdateEvent;
use App\Models\Tenants\Event;
use Illuminate\Http\Request;

class EventService
{
    /**
     * This is used during the creation of a new event
     *
     * @param Request $request
     * @return Event
     */
    public function processNewEvent(Request $request)
    {
        $event = new Event();
        $event->title = $request->title;
        $event->description = $request->description;
        $event->start_date = $request->start_date;
        $event->start_time = $request->start_time;
        $event->end_date = $request->end_date;
        $event->end_time = $request->end_time;
        $event->banner_image_link = $request->banner_image_link;

        $event->save();

        return $event;
    }

    public function getAll()
    {
        return Event::all();
    }

    public function getBySlug($slug)
    {
        return Event::whereSlug($slug)->first();
    }

    public function updateEvent(UpdateEvent $request, $slug)
    {
        $event = $this->getBySlug($slug);

        $event->title = $request->title;
        $event->slug = null; // Emptied to null in order for a new slug to be generated by sluggable
        $event->description = $request->description;
        $event->start_date = $request->start_date;
        $event->start_time = $request->start_time;
        $event->end_date = $request->end_date;
        $event->end_time = $request->end_time;
        $event->banner_image_link = $request->banner_image_link;

        $event->save();

        return $event;
    }

    public function deleteEvent(Request $request, $slug)
    {
        $event = $this->getBySlug($slug);

        $event->delete();
    }
}