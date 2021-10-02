<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Comment;
use App\Models\Currency;
use App\Models\Like;
use App\Models\Rating;
use App\Models\Smartphone;
use App\Models\User;
use Illuminate\Database\Seeder;

class SmartphoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Brand::factory()->createFromCsvData();
        Currency::factory()->createFromCsvData();
        Smartphone::factory()->createFromCsv();

        //lazy way to featured phones which have comments/ratings
        Smartphone::where('id', '>=', 378)->where('id', '<=', 403)->update(['featured' => true]);
    }
}
