<?php
namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Artist;
use App\Models\Type;
use App\Models\ArtistType;
use App\Models\Show;

class ArtistTypeShowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Empty the table first
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('artist_type_show')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        //Define data
        $artistTypeShows = [
            [
                'artist_firstname' => 'Daniel',
                'artist_lastname' => 'Marcelin',
                'type' => 'auteur',
                'show_slug' => 'ayiti',
            ],
            [
                'artist_firstname' => 'Philippe',
                'artist_lastname' => 'Laurent',
                'type' => 'auteur',
                'show_slug' => 'ayiti',
            ],
            [
                'artist_firstname' => 'Daniel',
                'artist_lastname' => 'Marcelin',
                'type' => 'scénographe',
                'show_slug' => 'ayiti',
            ],
            [
                'artist_firstname' => 'Philippe',
                'artist_lastname' => 'Laurent',
                'type' => 'scénographe',
                'show_slug' => 'ayiti',
            ],
            [
                'artist_firstname' => 'Daniel',
                'artist_lastname' => 'Marcelin',
                'type' => 'comédien',
                'show_slug' => 'ayiti',
            ],
            [
                'artist_firstname' => 'Marius',
                'artist_lastname' => 'Von Mayenburg',
                'type' => 'auteur',
                'show_slug' => 'cible-mouvante',
            ],
            [
                'artist_firstname' => 'Olivier',
                'artist_lastname' => 'Boudon',
                'type' => 'scénographe',
                'show_slug' => 'cible-mouvante',
            ],
            [
                'artist_firstname' => 'Anne Marie',
                'artist_lastname' => 'Loop',
                'type' => 'comédien',
                'show_slug' => 'cible-mouvante',
            ],
            [
                'artist_firstname' => 'Pietro',
                'artist_lastname' => 'Varasso',
                'type' => 'comédien',
                'show_slug' => 'cible-mouvante',
            ],
            [
                'artist_firstname' => 'Laurent',
                'artist_lastname' => 'Caron',
                'type' => 'comédien',
                'show_slug' => 'cible-mouvante',
            ],
            [
                'artist_firstname' => 'Élena',
                'artist_lastname' => 'Perez',
                'type' => 'comédien',
                'show_slug' => 'cible-mouvante',
            ],
            [
                'artist_firstname' => 'Guillaume',
                'artist_lastname' => 'Alexandre',
                'type' => 'comédien',
                'show_slug' => 'cible-mouvante',
            ],
            [
                'artist_firstname' => 'Claude',
                'artist_lastname' => 'Semal',
                'type' => 'auteur',
                'show_slug' => 'ceci-nest-pas-un-chanteur-belge',
            ],
            [
                'artist_firstname' => 'Laurence',
                'artist_lastname' => 'Warin',
                'type' => 'scénographe',
                'show_slug' => 'ceci-nest-pas-un-chanteur-belge',
            ],
            [
                'artist_firstname' => 'Claude',
                'artist_lastname' => 'Semal',
                'type' => 'comédien',
                'show_slug' => 'ceci-nest-pas-un-chanteur-belge',
            ],
            [
                'artist_firstname' => 'Pierre',
                'artist_lastname' => 'Wayburn',
                'type' => 'auteur',
                'show_slug' => 'manneke',
            ],
            [
                'artist_firstname' => 'Gwendoline',
                'artist_lastname' => 'Gauthier',
                'type' => 'auteur',
                'show_slug' => 'manneke',
            ],
            [
                'artist_firstname' => 'Philippe',
                'artist_lastname' => 'Laurent',
                'type' => 'scénographe',
                'show_slug' => 'manneke',
            ],
            [
                'artist_firstname' => 'Pierre',
                'artist_lastname' => 'Wayburn',
                'type' => 'comédien',
                'show_slug' => 'manneke',
            ],
            [
                'artist_firstname' => 'Gwendoline',
                'artist_lastname' => 'Gauthier',
                'type' => 'comédien',
                'show_slug' => 'manneke',
            ],
        ];

         // Collect only valid data
         $preparedData = [];

         foreach ($artistTypeShows as &$data) {
             //Search the artist for a given artist's firstname and lastname
             $artist = Artist::where([
                 ['firstname','=',$data['artist_firstname'] ],
                 ['lastname','=',$data['artist_lastname']]
             ])->first();

             // Vérifier si l'artiste est trouvé
             if (!$artist) {
                 echo "Artiste non trouvé pour: " . $data['artist_firstname'] . " " . $data['artist_lastname'] . "\n";
                 continue; // Skip this entry if the artist is not found
             }

             //Search the type for a given type
             $type = Type::firstWhere('type', $data['type']);

             // Vérifier si le type est trouvé
             if (!$type) {
                 echo "Type non trouvé pour: " . $data['type'] . "\n";
                 continue; // Skip this entry if the type is not found
             }

             //Search the artistType for the artist and type found
             $artistType = ArtistType::where([
                 ['artist_id','=',$artist->id ],
                 ['type_id','=',$type->id ]
             ])->first();

             // Vérifier si l'association artiste-type est trouvée
             if (!$artistType) {
                 echo "Association artiste-type non trouvée pour: " . $data['artist_firstname'] . " " . $data['artist_lastname'] . " - " . $data['type'] . "\n";
                 continue; // Skip this entry if the artist-type association is not found
             }

             //Search the show for a given show's slug
             $show = Show::firstWhere('slug', $data['show_slug']);

             // Vérifier si le spectacle est trouvé
             if (!$show) {
                 echo "Spectacle non trouvé pour: " . $data['show_slug'] . "\n";
                 continue; // Skip this entry if the show is not found
             }

             // Si toutes les données sont valides, préparez les données pour l'insertion
             $preparedData[] = [
                 'artist_type_id' => $artistType->id,
                 'show_id' => $show->id
             ];
         }

         unset($data);

         //Insert data in the table only if we have valid records
         if (!empty($preparedData)) {
             DB::table('artist_type_show')->insert($preparedData);
         }
     }
 }
