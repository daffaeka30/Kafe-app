<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Backend\EventCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EventCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EventCategory::insert([
            [
                'uuid' => Str::uuid(),
                'name' => 'Bazar',
                'slug' => Str::slug('bazar'),
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Live Music',
                'slug' => Str::slug('Live Music'),
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Nonton Bareng',
                'slug' => Str::slug('nonton-bareng'),
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Game Night',
                'slug' => Str::slug('game-night'),
            ],
        ]);

    }
}
