<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Backend\Chef;
use App\Models\Backend\Event;
use App\Models\Backend\Product;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        $chefs = Chef::orderBy('id', 'desc')
            ->limit(4)
            ->get(['name', 'position', 'photo', 'insta_link', 'fb_link', 'linkedin_link']);

        // all event
        $events = Event::orderBy('id', 'desc')
            ->limit(8)
            ->get(['name', 'image']);

        return view('frontend.home', [
            'chefs'                 => $chefs,
            'events'                => $events,
            'event_bazar'           => $this->getEvent(3),
            'event_live_musik'      => $this->getEvent(4),
            'event_nonton_bareng'   => $this->getEvent(5),
            'event_game_night'      => $this->getEvent(6),
            'menu_coffee'           => $this->getMenu(7),
            'menu_mocktail'         => $this->getMenu(8),
            'menu_food'             => $this->getMenu(9),
        ]);
    }

    // show menu by category
    private function getMenu(string $id)
    {
        return Product::with('category:id,name')
            ->latest()
            ->where('status', 'available')
            ->where('category_id', $id)
            ->limit(8)
            ->get(['category_id', 'name', 'price', 'image', 'description']);
    }

    // show event by category
    private function getEvent(string $id)
    {
        return Event::with('category:id')
            ->latest()
            ->where('category_id', $id)
            ->limit(8)
            ->get(['category_id', 'name', 'image']);
    }
}
