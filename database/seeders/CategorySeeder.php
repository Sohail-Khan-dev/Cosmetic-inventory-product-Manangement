<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = collect([
            [
                'id'    => 1,
                'name'  => 'Beauty',
                'slug'  => 'beauty',
                'user_id' => 1,
            ],
            [
                'id'    => 2,
                'name'  => 'Medical',
                'slug'  => 'medical',
                'user_id' => 1,
            ],
            [
                'id'    => 3,
                'name'  => 'Masks',
                'slug'  => 'masks',
                'user_id' => 1,
            ],
            [
                'id'    => 4,
                'name'  => 'Lotions',
                'slug'  => 'lotions',
                'user_id' => 1,
            ],
            [
                'id'    => 5,
                'name'  => 'Soaf',
                'slug'  => 'soaf',
                'user_id' => 1,
            ]
        ]);

        $categories->each(function ($category) {
            Category::insert($category);
        });
    }
}
