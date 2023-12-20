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
        $approvalStages = \App\Models\ApprovalStage::factory(2)->create();
        $categories = \App\Models\Category::factory(5)->create();
        $locations = \App\Models\Location::factory()->count(8)->sequence(
            ['project_id' => 1, 'name' => 'Master Bath'],
            ['project_id' => 1, 'name' => 'Kitchen'],
            ['project_id' => 1, 'name' => 'Powder Bath'],
            ['project_id' => 1, 'name' => 'Living Room'],
            ['project_id' => 2, 'name' => 'Master Bedroom'],
            ['project_id' => 2, 'name' => 'Butlers Pantry'],
            ['project_id' => 2, 'name' => 'Hall Bath'],
            ['project_id' => 2, 'name' => 'Dining Room'],
        )->create();
        
        //Create selection lists
        $selectionLists = \App\Models\SelectionList::factory()->count(2)->sequence(
            ['project_id' => 1, 'name' => fake()->word(), 'description' => fake()->sentence()],
            ['project_id' => 2, 'name' => fake()->word(), 'description' => fake()->sentence()]
        )->create();

        //Create selections and assign to a random selection list
        $selections = \App\Models\Selection::factory(10)->create();

        //Create items
        $items = \App\Models\Item::factory(20)->create();

        //Attach categories to projects
        foreach($projects as $project) {
            foreach($categories as $category) {
                $project->categories()->attach($category->id);
            }
        }

        foreach($items as $item) {
            $item->categories()->attach(random_int(1, $categories->count()));
        }

        foreach($selections as $selection) {
            $project = $selection->selectionList->project;
            $locations = $project->locations;

            $selection->locations()->attach($locations->random()->id);
            $selection->items()->attach(random_int(1, $items->count()));
        }

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
