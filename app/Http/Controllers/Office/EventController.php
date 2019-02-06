<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEvent;
use App\Http\Requests\UpdateEvent;
use App\Services\Tenants\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $eventService = new EventService();
        $events = $eventService->getAll();

        return view('tenants.office.events.index')
            ->with('events', $events);
    }

    public function create()
    {
        return view('tenants.office.events.create');
    }

    public function store(StoreEvent $request, EventService $eventService)
    {
        $event = $eventService->processNewEvent($request);

        return redirect()->route('tenants.office.events.show', $event);
    }

    public function show($slug)
    {
        $eventService = new EventService();
        $event = $eventService->getBySlug($slug);
        return view('tenants.office.events.show')
            ->with('event', $event);
    }

    public function edit($slug)
    {
        $eventService = new EventService();
        $event = $eventService->getBySlug($slug);
        return view('tenants.office.events.edit')
            ->with('event', $event);
    }

    public function update(UpdateEvent $request, EventService $eventService, $slug)
    {
        $event = $eventService->updateEvent($request, $slug);

        return redirect()->route('tenants.office.events.show', $event);
    }

    public function destroy(Request $request, EventService $eventService, $slug)
    {
        $eventService->deleteEvent($request, $slug);

        return redirect()->route('tenants.office.events.index');
    }
}
