<?php

use App\Company;
use App\Person;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Company::class, 10)->create()->each(function ($company) {
            $company->people()->save(factory(Person::class)->make(), ['role' => 'founder']);
            $company->people()->attach(factory(Person::class, rand(1, 3))->create(), ['role' => 'owner']);
        });
    }
}
