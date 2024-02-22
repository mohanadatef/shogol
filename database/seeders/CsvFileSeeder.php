<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\CoreData\Entities\City;
use Modules\CoreData\Entities\Country;
use Modules\CoreData\Entities\State;
use Modules\CoreData\Service\CityService;
use Modules\CoreData\Service\CountryService;
use Modules\CoreData\Service\StateService;

class CsvFileSeeder extends Seeder
{
    public function __construct(CountryService $countryService,CityService $cityService,StateService $stateService)
    {
        $this->countryService = $countryService;
        $this->cityService = $cityService;
        $this->stateService = $stateService;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        executionTime();
        $csvFile = fopen(base_path("database/seeders/country.csv"), "r");

        $counter = 0;

        $this->command->getOutput()->progressStart(5000);

        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            executionTime();
            $this->command->getOutput()->writeln("start " . $counter);
           $country= $this->countryService->findBy(new Request(['name'=>$data[0]]))->first();
           if(empty($country))
           {
               $country = Country::create(['order'=>$counter+1000]);
               foreach (language() as $lang) {
                   $country->translation()->create(['key' => 'name', 'value' => $data[0], 'language_id' => $lang->id]);
               }
           }
            $city= $this->cityService->findBy(new Request(['name'=>$data[1]]))->first();
            if(empty($city))
            {
                $city = City::create(['order'=>$counter+1000,'country_id'=>$country->id]);
                foreach (language() as $lang) {
                    $city->translation()->create(['key' => 'name', 'value' => $data[1], 'language_id' => $lang->id]);
                }
            }
            $state= $this->stateService->findBy(new Request(['name'=>$data[2]]))->first();
            if(empty($state))
            {
                $state = State::create(['order'=>$counter+1000,'country_id'=>$country->id,'city_id'=>$city->id]);
                foreach (language() as $lang) {
                    $state->translation()->create(['key' => 'name', 'value' => $data[2], 'language_id' => $lang->id]);
                }
            }
            $this->command->getOutput()->progressAdvance();
            $this->command->getOutput()->writeln("end " . $counter);
            $counter++;

        }

        fclose($csvFile);
    }

}
