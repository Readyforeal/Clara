<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\Project;
use App\Models\ApprovalStage;
use App\Models\Category;
use App\Models\Location;
use App\Models\SelectionList;
use App\Models\Selection;
use App\Models\Item;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Create a team
        $team = Team::factory()->create();

        //Create a project in the team
        $project = Project::factory()->create();

        //Create approval stages for the project
        $approvalStages = ApprovalStage::factory(2)->create();

        //Create categories for the team
        $categories = Category::factory()->count(17)->sequence(
            ['team_id' => 1, 'name' => 'Footings and Foundations'],
            ['team_id' => 1, 'name' => 'Masonry'],
            ['team_id' => 1, 'name' => 'Retaining Walls and Pavers'],
            ['team_id' => 1, 'name' => 'Building Materials'],
            ['team_id' => 1, 'name' => 'Windows and Exterior Doors'],
            ['team_id' => 1, 'name' => 'Garage Doors'],
            ['team_id' => 1, 'name' => 'AV, Security, and Low Voltage'],
            ['team_id' => 1, 'name' => 'Electrical'],
            ['team_id' => 1, 'name' => 'Plumbing'],
            ['team_id' => 1, 'name' => 'Countertops'],
            ['team_id' => 1, 'name' => 'Cabinets'],
            ['team_id' => 1, 'name' => 'Appliances'],
            ['team_id' => 1, 'name' => 'Tile Material'],
            ['team_id' => 1, 'name' => 'Wood Flooring'],
            ['team_id' => 1, 'name' => 'Shower Door, Glass, and Mirrors'],
            ['team_id' => 1, 'name' => 'Carpet and Exercise Flooring'],
            ['team_id' => 1, 'name' => 'Hardware'],
        )->create();

        //Create locations for the project
        $locations = Location::factory()->count(8)->sequence(
            ['project_id' => 1, 'name' => 'Master Bath'],
            ['project_id' => 1, 'name' => 'Kitchen'],
            ['project_id' => 1, 'name' => 'Powder Bath'],
            ['project_id' => 1, 'name' => 'Living Room'],
            ['project_id' => 1, 'name' => 'Master Bedroom'],
            ['project_id' => 1, 'name' => 'Butlers Pantry'],
            ['project_id' => 1, 'name' => 'Hall Bath'],
            ['project_id' => 1, 'name' => 'Dining Room'],
        )->create();
        
        //Create selection lists
        $selectionList = SelectionList::factory()->create();

        //Create selections and assign to the selection list
        $selections = Selection::factory(10)->create();

        //Create items
        $items = Item::factory(20)->create();

        //Attach categories to projects
        foreach($team->categories as $category) {
            $project->categories()->attach($category->id);
        }

        foreach($items as $item) {
            $item->categories()->attach(random_int(1, $categories->count()));
        }

        foreach($selections as $selection) {
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
