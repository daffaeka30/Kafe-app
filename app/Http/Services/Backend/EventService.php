<?php
namespace App\Http\Services\Backend;

use App\Models\Backend\Event;

class EventService
{
    public function select($paginate = null)
    {
        if ($paginate) {
            return Event::with('eventCategory:id,name')->latest()->select('id', 'uuid', 'name', 'event_category_id', 'price', 'image', 'status')->paginate($paginate);
        }

        return Event::latest()->get();
    }

    public function selectFirstBy($column, $value)
    {
        return Event::with('eventCategory:id,name')->where($column, $value)->firstOrFail();
    }
}
