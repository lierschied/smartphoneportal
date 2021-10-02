<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Currency;
use App\Models\Smartphone;
use App\Models\SmartphonePrice;
use Illuminate\Database\Eloquent\Factories\Factory;

class SmartphoneFactory extends Factory
{
    private const FILE = 'database/seeders/files/smartphones.csv';
    //csv array key mapping
    private const BRAND = 0;
    private const MODEL = 1;
    private const NETWORK_TECHNOLOGY = 2;
    private const NETWORK_2G_BANDS = 3;
    private const NETWORK_GPRS = 4;
    private const NETWORK_EDGE = 5;
    private const LAUNCH_ANNOUNCED = 6;
    private const LAUNCH_STATUS = 7;
    private const BODY_DIMENSIONS = 8;
    private const BODY_WEIGHT = 9;
    private const BODY_SIM = 10;
    private const DISPLAY_TYPE = 11;
    private const DISPLAY_SIZE = 12;
    private const DISPLAY_RESOLUTION = 13;
    private const DISPLAY = 14;
    private const MEMORY_CARD_SLOT = 15;
    private const MEMORY_PHONEBOOK = 16;
    private const MEMORY_CALL_RECORDS = 17;
    private const SOUND_LOUDSPEAKER = 18;
    private const SOUND_ALERT_TYPES = 19;
    private const SOUND_35MM_JACK = 20;
    private const COMMS_WLAN = 21;
    private const COMMS_BLUETOOTH = 22;
    private const COMMS_GPS = 23;
    private const COMMS_RADIO = 24;
    private const COMMS_USB = 25;
    private const FEATURES_SENSORS = 26;
    private const FEATURES_MESSAGING = 27;
    private const FEATURES_BROWSER = 28;
    private const FEATURES_CLOCK = 29;
    private const FEATURES_ALARM = 30;
    private const FEATURES_GAMES = 31;
    private const FEATURES_JAVA = 32;
    private const FEATURES = 33;
    private const MISC_COLORS = 34;
    private const NETWORK_3G_BANDS = 35;
    private const NETWORK_SPEED = 36;
    private const PLATFORM_OS = 37;
    private const PLATFORM_CHIPSET = 38;
    private const PLATFORM_CPU = 39;
    private const PLATFORM_GPU = 40;
    private const MEMORY_INTERNAL = 41;
    private const MAIN_CAMERA_SINGLE = 42;
    private const MAIN_CAMERA_VIDEO = 43;
    private const MISC_PRICE = 44;
    private const MAIN_CAMERA_FEATURES = 45;
    private const BODY = 46;
    private const NETWORK_4G_BANDS = 47;
    private const BODY_BUILD = 48;
    private const DISPLAY_PROTECTION = 49;
    private const MEMORY = 50;
    private const MAIN_CAMERA_DUAL = 51;
    private const SELFIE_CAMERA_DUAL = 52;
    private const SELFIE_CAMERA_FEATURES = 53;
    private const SELFIE_CAMERA_VIDEO = 54;
    private const COMMS_NFC = 55;
    private const BATTERY_CHARGING = 56;
    private const MISC_MODELS = 57;
    private const TESTS_PERFORMANCE = 58;
    private const TESTS_CAMERA = 59;
    private const TESTS_LOUDSPEAKER = 60;
    private const TESTS_AUDIO_QUALITY = 61;
    private const TESTS_BATTERY_LIFE = 62;
    private const TESTS_DISPLAY = 63;
    private const SELFIE_CAMERA_SINGLE = 64;
    private const COMMS_INFRARED_PORT = 65;
    private const NETWORK_5G_BANDS = 66;
    private const MAIN_CAMERA_QUAD = 67;
    private const MAIN_CAMERA_TRIPLE = 68;
    private const SOUND = 69;
    private const MISC_SAR_EU = 70;
    private const MAIN_CAMERA_FIVE = 71;
    private const FEATURES_LANGUAGES = 72;
    private const BODY_KEYBOARD = 73;
    private const MISC_SAR = 74;
    private const BATTERY = 75;
    private const MAIN_CAMERA_DUAL_OR_TRIPLE = 76;
    private const BATTERY_MUSIC_PLAY = 77;
    private const SELFIE_CAMERA_TRIPLE = 78;
    private const MAIN_CAMERA_V1 = 79;
    private const SELFIE_CAMERA = 80;
    private const CAMERA = 81;
    private const MAIN_CAMERA = 82;
    private const NETWORK = 83;
    private const BATTERY_TALK_TIME = 84;
    private const BATTERY_STANDBY = 85;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Smartphone::class;

    /**
     * mapping array for smartphones.csv
     * @var array|string[]
     */
    private array $smartphoneMapping = [
        self::BRAND => 'brand_id',
        self::MODEL => 'model',
        self::NETWORK_TECHNOLOGY => 'network_technology',
        //self::NETWORK_2G_BANDS => 'network_2_gbands',
        //self::NETWORK_GPRS => 'network_gprs',
        //self::NETWORK_EDGE => 'network_edge',
        //self::LAUNCH_ANNOUNCED => 'launch_announced',
        self::LAUNCH_STATUS => 'launch_status',
        self::BODY_DIMENSIONS => 'body_dimensions',
        self::BODY_WEIGHT => 'body_weight',
        //self::BODY_SIM => 'body_sim',
        self::DISPLAY_TYPE => 'display_type',
        self::DISPLAY_SIZE => 'display_size',
        self::DISPLAY_RESOLUTION => 'display_resolution',
        self::DISPLAY => 'display',
        //self::MEMORY_CARD_SLOT => 'memory_card_slot',
        //self::MEMORY_PHONEBOOK => 'memory_phonebook',
        //self::MEMORY_CALL_RECORDS => 'memory_call_records',
        //self::SOUND_LOUDSPEAKER => 'sound_loudspeaker',
        //self::SOUND_ALERT_TYPES => 'sound_alert_types',
        self::SOUND_35MM_JACK => 'sound_35_mm_jack',
        self::COMMS_WLAN => 'comms_wlan',
        self::COMMS_BLUETOOTH => 'comms_bluetooth',
        self::COMMS_GPS => 'comms_gps',
        //self::COMMS_RADIO => 'comms_radio',
        self::COMMS_USB => 'comms_usb',
        self::FEATURES_SENSORS => 'features_sensors',
        //self::FEATURES_MESSAGING => 'features_messaging',
        //self::FEATURES_BROWSER => 'features_browser',
        //self::FEATURES_CLOCK => 'features_clock',
        //self::FEATURES_ALARM => 'features_alarm',
        //self::FEATURES_GAMES => 'features_games',
        //self::FEATURES_JAVA => 'features_java',
        self::FEATURES => 'features',
        self::MISC_COLORS => 'misc_colors',
        //self::NETWORK_3G_BANDS => 'network_3_gbands',
        //self::NETWORK_SPEED => 'network_speed',
        self::PLATFORM_OS => 'platform_os',
        self::PLATFORM_CHIPSET => 'platform_chipset',
        self::PLATFORM_CPU => 'platform_cpu',
        self::PLATFORM_GPU => 'platform_gpu',
        self::MEMORY_INTERNAL => 'memory_internal',
        self::MAIN_CAMERA_SINGLE => 'main_camera_single',
        self::MAIN_CAMERA_VIDEO => 'main_camera_video',
        self::MISC_PRICE => 'miscPrice', //stored in smartphone_prices table
        //self::MAIN_CAMERA_FEATURES => 'main_camera_features',
        //self::BODY => 'body',
        //self::NETWORK_4G_BANDS => 'network_4_gbands',
        self::BODY_BUILD => 'body_build',
        //self::DISPLAY_PROTECTION => 'display_protection',
        //self::MEMORY => 'memory',
        //self::MAIN_CAMERA_DUAL => 'main_camera_dual',
        //self::SELFIE_CAMERA_DUAL => 'selfie_camera_dual',
        //self::SELFIE_CAMERA_FEATURES => 'selfie_camera_features',
        //self::SELFIE_CAMERA_VIDEO => 'selfie_camera_video',
        self::COMMS_NFC => 'comms_nfc',
        self::BATTERY_CHARGING => 'battery_charging',
        //self::MISC_MODELS => 'misc_models',
        //self::TESTS_PERFORMANCE => 'tests_performance',
        //self::TESTS_CAMERA => 'tests_camera',
        //self::TESTS_LOUDSPEAKER => 'tests_loudspeaker',
        //self::TESTS_AUDIO_QUALITY => 'tests_audio_quality',
        //self::TESTS_BATTERY_LIFE => 'tests_battery_life',
        //self::TESTS_DISPLAY => 'tests_display',
        //self::SELFIE_CAMERA_SINGLE => 'selfie_camera_single',
        //self::COMMS_INFRARED_PORT => 'comms_infrared_port',
        //self::NETWORK_5G_BANDS => 'network_5_gbands',
        //self::MAIN_CAMERA_QUAD => 'main_camera_quad',
        //self::MAIN_CAMERA_TRIPLE => 'main_camera_triple',
        //self::SOUND => 'sound',
        //self::MISC_SAR_EU => 'misc_sar_eu',
        //self::MAIN_CAMERA_FIVE => 'main_camera_five',
        //self::FEATURES_LANGUAGES => 'features_languages',
        //self::BODY_KEYBOARD => 'body_keyboard',
        //self::MISC_SAR => 'misc_sar',
        self::BATTERY => 'battery',
        //self::MAIN_CAMERA_DUAL_OR_TRIPLE => 'main_camera_dual_or_triple',
        //self::BATTERY_MUSIC_PLAY => 'battery_music_play',
        //self::SELFIE_CAMERA_TRIPLE => 'selfie_camera_triple',
        //self::MAIN_CAMERA_V1 => 'main_camera_v_1',
        //self::SELFIE_CAMERA => 'selfie_camera',
        //self::CAMERA => 'camera',
        //self::MAIN_CAMERA => 'main_camera',
        //self::NETWORK => 'network',
        self::BATTERY_TALK_TIME => 'battery_talk_time',
        self::BATTERY_STANDBY => 'battery_stand_by'
    ];

    private array $encodingRegex = [
        'EUR' => '<e2><82><ac>', //euro
        'USD' => '\$', //dollar
        'GBP' => '<c2><a3>', //pound
        'INR' => '<e2><82><b9>' //indian rupee
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

        ];
    }

    /**
     * creates new Smartphone Models based on the data provided by the csv
     */
    public function createFromCsv(): void
    {
//        $brands = Brand::all(['id', 'brand'])->toArray();
//        $currencies = Currency::all(['id', 'name']);
        //TODO: improve Seeder performance with less db queries | current seeding time ~2min
        $file = fopen(self::FILE, 'rb');
        fgetcsv($file); //skip first line
        while (($csvRow = fgetcsv($file)) !== false) {
            $smartphone = Smartphone::create();
            foreach ($this->smartphoneMapping as $key => $colName) {
                //prices get extracted and stored in `smartphone_prices` table
                if ($key === self::MISC_PRICE) {
                    $prices = $this->extractPrices($csvRow[$key]);
                    foreach($prices as $code => $price) {
                        $newPrice = SmartphonePrice::make();
                        $newPrice->setAttribute('price', $price);
                        $currencyId = Currency::where('code', $code)->firstOrFail(['id']);
                        $newPrice->setAttribute('smartphone_id', $smartphone->id);
                        $newPrice->setAttribute('currency_id', $currencyId->id);
                        $newPrice->save();
                    }
                    continue; //skip adding misc_price
                }
                //check if brand exists and use id as reference
                if ($key === self::BRAND) {
                    $brand = Brand::where('brand', $csvRow[$key])->firstOrCreate(['brand' => $csvRow[$key]]);
                    $csvRow[$key] = $brand->id;
                }
                //set actual smartphone column & value
                $smartphone->setAttribute($colName, $csvRow[$key]);
            }

            $smartphone->save();
        }
    }

    /**
     * returns found currencies ['EUR' => 123, 'USD' => 234]
     * @param string $string
     * @return array
     */
    private function extractPrices(string $string): array
    {
        $matches = [];
        //matches "About 999 CUR"
        if (str_contains($string, "About")) {
            foreach ($this->encodingRegex as $key => $value) {
                preg_match("/[\d.\s]+{$key}/", $string, $m);
                empty($m[0]) ?: $matches[$key] = trim(preg_replace("/[\D]+/", "", $m[0]));
            }
            return $matches;
        }

        //matches broken encoding "<e2><82><ac>"
        $string = str_replace(['<e2><80><89>', ','], '', $string); //replace whitespace, ','
        foreach ($this->encodingRegex as $key => $value) {
            preg_match("/{$value}[\d.]+/", $string, $m);
            empty($m[0]) ?: $matches[$key] = trim(preg_replace("/{$value}/", "", $m[0]));
        }

        return empty($matches) ? ['EUR' => 0] : $matches;
    }
}
