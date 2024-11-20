<?php

namespace App\Http\Services\Backend;

use App\Models\Backend\EventCategory;

class EventCategoryService
{
    public function select($column = null, $value = null)
    {
        if ($column) {
            return EventCategory::where($column, $value)->select('id', 'uuid', 'name', 'slug')->firstOrFail();
        }

        return EventCategory::latest()->get(['id', 'uuid', 'name', 'slug']);
    }
}
