<?php

namespace Database\Factories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Currency::class;

    /**
     * @var array
     */
    private array $currencies = [
        ['name' => 'Euro', 'symbol' => '€', 'code' => 'EUR'],
        ['name' => 'Dollar', 'symbol' => '$', 'code' => 'USD'],
        ['name' => 'Pound', 'symbol' => '£', 'code' => 'GBP'],
        ['name' => 'Indian rupee', 'symbol' => '₹', 'code' => 'INR'],
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        ];
    }

    /**
     * creates currencies extracted from database/seeders/files/smartphones.csv
     */
    public function createFromCsvData(): void
    {
        foreach ($this->currencies as $currency) {
            $newCurrency = new Currency();
            foreach($currency as $key => $value) {
                $newCurrency->setAttribute($key, $value);
            }
            $newCurrency->save();
        }
    }
}
