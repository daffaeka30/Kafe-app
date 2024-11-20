<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Backend\Event;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\EventRequest;
use App\Http\Services\Backend\EventService;
use App\Http\Services\Backend\EventCategoryService;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function __construct(
        private EventService $eventService,
        private EventCategoryService $eventcategoryService
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.event.index', [
            'events' => $this->eventService->select(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.event.create', [
            'eventCategories' => $this->eventcategoryService->select()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        try {
            Event::create($data);

            return redirect()->route('panel.event.index')->with('success', 'Event berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        return view('backend.event.edit', [
            'events' => $this->eventService->selectFirstBy('uuid', $uuid),
            'eventCategories' => $this->eventcategoryService->select()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, string $uuid)
    {
        $data = $request->validated();

        try {
            $events = $this->eventService->selectFirstBy('uuid', $uuid);

            if ($request->hasFile('image')) {
                if ($events->image) {
                    Storage::disk('public')->delete($events->image);
                }
                $data['image'] = $request->file('image')->store('events', 'public');
            }

            $events->update($data);

            return redirect()->route('panel.event.index')->with('success', 'Event Berhasil Diubah');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        $events = $this->eventService->selectFirstBy('uuid', $uuid);

        if ($events->image) {
            Storage::disk('public')->delete($events->image);
        }

        $events->delete();

        return response()->json([
            'message' => 'Event Berhasil Dihapus'
        ]);
    }
}

