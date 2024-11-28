<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Backend\Chef;
use App\Models\Backend\Product;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        $chefs = Chef::orderBy('id', 'desc')
            ->limit(4)
            ->get(['name', 'position', 'photo', 'insta_link', 'fb_link', 'linkedin_link']);

        return view('frontend.home', [
            'chefs'         => $chefs,
            'menu_coffee'   => $this->getMenu(7),
            'menu_mocktail' => $this->getMenu(8),
            'menu_food'     => $this->getMenu(9),
        ]);
    }

    private function getMenu(string $id)
    {
        return Product::with('category:id,name')
            ->latest()
            ->where('status', 'available')
            ->where('category_id', $id)
            ->limit(8)
            ->get(['category_id', 'name', 'price', 'image', 'description']);
    }
}
