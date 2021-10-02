<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Brand::class;

    /**
     * @var array|string[]
     */
    private array $brands = [
        'Benefon',
        'Garmin-Asus',
        'Gigabyte',
        'Google',
        'Haier',
        'Honor',
        'HP',
        'HTC',
        'Huawei',
        'i-mate',
        'i-mobile',
        'Icemobile',
        'Infinix',
        'Innostream',
        'Kyocera',
        'Lava',
        'Lenovo',
        'LG',
        'Maxon',
        'Meizu',
        'Micromax',
        'Mitac',
        'Mitsubishi',
        'Motorola',
        'NEC',
        'Neonode',
        'Nokia',
        'O2',
        'OnePlus',
        'Oppo',
        'Orange',
        'Palm',
        'Panasonic',
        'Pantech',
        'Philips',
        'Plum',
        'Qtek',
        'Realme',
        'Sagem',
        'Samsung',
        'Sendo',
        'Sewon',
        'Sharp',
        'Siemens',
        'Sony',
        'SonyEricsson',
        'Spice',
        'T-Mobile',
        'TCL',
        'TECNO',
        'Tel.Me.',
        'Telit',
        'Ulefone',
        'Unnecto',
        'Vertu',
        'vivo',
        'VKMobile',
        'Vodafone',
        'Wiko',
        'Xiaomi',
        'Yezz',
        'ZTE',
        'alcatel',
        'Allview',
        'Amazon',
        'Amoi',
        'Apple',
        'Asus',
        'BenQ',
        'Bird',
        'BlackBerry',
        'BLU',
        'Bosch',
        'Cat',
        'Chea',
        'Coolpad',
        'Energizer',
        'Ericsson',
        'Eten',
        'Acer',
        'Archos',
        'AT&T',
        'BenQ-Siemens',
        'Blackview',
        'BQ',
        'Casio',
        'Celkon',
        'Dell',
        'Emporia',
        'FujitsuSiemens',
        'Gionee',
        'iNQ',
        'Intex',
        'Jolla',
        'Karbonn',
        'LeEco',
        'Maxwest',
        'Microsoft',
        'Modu',
        'MWg',
        'NIU',
        'Nvidia',
        'Parla',
        'Posh',
        'Prestigio',
        'QMobile',
        'Razer',
        'Sonim',
        'Thuraya',
        'Toshiba',
        'verykool',
        'WND',
        'XCute',
        'XOLO',
        'Yota',
        'YU',
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
     * creates brands extracted from database/seeders/files/smartphones.csv
     */
    public function createFromCsvData(): void
    {
        foreach ($this->brands as $brand) {
            Brand::create(
                [
                    'brand' => $brand
                ]
            );
        }
    }
}
