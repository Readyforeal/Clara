<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Team::factory(1)->create();
        $projects = \App\Models\Project::factory(2)->create();
        $categories = \App\Models\Category::factory(5)->create();
        $locations = \App\Models\Location::factory(5)->create();
        \App\Models\SelectionList::factory(2)->create();
        $selections = \App\Models\Selection::factory(10)->create();
        $items = \App\Models\Item::factory(20)->create();

        foreach($projects as $project) {
            foreach($categories as $category) {
                $project->categories()->attach($category->id);
            }
        }

        foreach($items as $item) {
            $item->categories()->attach(random_int(1, $categories->count()));
        }

        foreach($selections as $selection) {
            $selection->locations()->attach(random_int(1, $locations->count()));
            $selection->items()->attach(random_int(1, $items->count()));
        }

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
