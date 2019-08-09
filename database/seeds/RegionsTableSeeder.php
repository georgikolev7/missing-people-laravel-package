<?php

use Illuminate\Database\Seeder;
use Slavic\MissingPersons\Region;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regions')->delete();
        
        $json = File::get(MP_PATH . 'database/data/regions.js');
        $regions = json_decode($json);
        
        foreach ($regions as $region)
        {
            Region::create(array(
                'id' => $region->id,
                'place_id' => $region->place_id,
                'code' => $region->code,
                'ekatte' => $region->ekatte,
                'name' => $region->name,
                'lat' => $region->lat,
                'lng' => $region->lng,
                'people' => $region->people,
                'settlements' => $region->settlements,
                'type' => $region->type,
                'sort_order' => $region->sort_order,
            ));
        }
    }
}
