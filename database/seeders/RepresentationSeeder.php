<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Representation;
use App\Models\Location;
use App\Models\Show;

class RepresentationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Use DELETE instead of TRUNCATE
        DB::table('representations')->delete();

        // Reset auto-increment value (optional)
        DB::statement('ALTER TABLE representations AUTO_INCREMENT = 1;');

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Define data
        $representations = [
            [
                'location_slug' => 'espace-delvaux-la-venerie',
                'show_slug' => 'ayiti',
                'when' => '2012-10-12 13:30',
            ],
            [
                'location_slug' => 'dexia-art-center',
                'show_slug' => 'ayiti',
                'when' => '2012-10-12 20:30',
            ],
            [
                'location_slug' => null,
                'show_slug' => 'cible-mouvante',
                'when' => '2012-10-02 20:30',
            ],
            [
                'location_slug' => null,
                'show_slug' => 'ceci-nest-pas-un-chanteur-belge',
                'when' => '2012-10-16 20:30',
            ],
        ];

        // Prepare the data
        foreach ($representations as &$data) {
            // Search the location for a given location's slug
            $location = Location::firstWhere('slug', $data['location_slug']);
            unset($data['location_slug']);

            // Search the show for a given show's slug
            $show = Show::firstWhere('slug', $data['show_slug']);
            unset($data['show_slug']);

            $data['location_id'] = $location->id ?? null;
            $data['show_id'] = $show->id;
        }
        unset($data);

        // Insert data in the table
        DB::table('representations')->insert($representations);
    }
}
