<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            [
                'uuid' => Str::uuid(),
                'name' => 'Bahan Baku Nabati',
                'slug' => Str::slug('bahan-baku-nabati'),
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Bahan Baku Hewani',
                'slug' => Str::slug('bahan-baku-hewani'),
            ]
        ]);
    }
}
