# Smartphoneportal

<img width="400" src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" style="margin: auto;">

<p style="text-align: center;"><strong>Laravel as backend</strong></p>

<img src="https://raw.githubusercontent.com/inertiajs/inertia/master/.github/LOGO.png" alt="Inertia.js" width="500" style="margin: auto;">

<p style="text-align: center;"><strong>Inertia as Laravel-Vue.js adapter</strong></p>

<img width="150" style="margin: auto;" src="https://camo.githubusercontent.com/c8f91d18976e27123643a926a2588b8d931a0292fd0b6532c3155379e8591629/68747470733a2f2f7675656a732e6f72672f696d616765732f6c6f676f2e706e67">

<p style="text-align: center;"><strong>Vue.js as frontend</strong></p>

<img width="150" style="argin: auto;" src="https://cdn.quasar.dev/logo-v2/svg/logo.svg">

<p style="text-align: center;"><strong>Quasar.js for Vue.js</strong> <small>(component library & basic styling)</small></p>

# Core Concept

Laravel serves as the backend. It is mainly responsible for:

* Routing
* User authentication & session handling
* Database queries

Inertia serves as an adapter for Laravel and Vue. It is mainly responsible for:

* Passing data as JSON to update Vue components/switching them out
* making Laravel routes accessible the frontend
* making basic form requests to the backend

Vue.js together is for building the main user interface. It is used for:

* highly interactive user interfaces

* seamless **S**ingle **P**age **A**pplication experience

Quasar can be used as a complete frontend framework build on Vue.js or just a component library.

* Wide range of components such as buttons, img, card, etc. ...
* page layouting
* basic styling with grid and flexbox pattern

# Project structure

A brief overview of the most relevant files and folders.

```
|-- smartphoneportal_jannis
    |-- app
    |   |-- Http
    |   |   |-- Controllers
    |   |   |-- Middleware
    |   |   |-- Models      
    |   |-- database
    |   |-- factories
    |   |-- migrations      
    |   |-- seeders
    |-- resources
    |   |-- css
    |   |-- js
    |   |   |-- Components
    |   |   |-- Pages
    |   |   |-- Layouts
    |   |-- views
    |-- routes
```

| /app              | holds the core code of laravel                               |
| ----------------- | ------------------------------------------------------------ |
| /Http/Controllers | holds request handlers, mostly for the laravel models *User => UserController* |
| /Http/Middleware  | holds classes for request filtering                          |
| /Http/Models      | holds classes based on eloquent ORM models, wich reflect each a database table |

| /database   |                                                              |
| ----------- | ------------------------------------------------------------ |
| /factories  | holds factory classes for the models                         |
| /migrations | holds the database schemas for each table                    |
| /seeders    | holds files wich can be used to apply some sort of initial data to the database |

| /resources     |                                                              |
| -------------- | ------------------------------------------------------------ |
| /css           | sass and css styles                                          |
| /js            | main Vue.js installation                                     |
| /js/Components | all universal Vue.js components such as "ProductCart"        |
| /js/Pages      | main pages                                                   |
| /js/Layouts    | layout files for the pages                                   |
| /views         | holds the app.blade.php wich is sort of the source file of all views |

# Database Structure

[View online](https://drawsql.app/lierschied/diagrams/smartphoneportal)

![smartphoneportal_erd](/Users/janniswichmann/Library/Mobile Documents/com~apple~CloudDocs/Berufsschule/WebDev/smartphoneportal_erd.png)

## Tables overview

| Tablename         | Purpose                                                      | Notes                                              |
| ----------------- | ------------------------------------------------------------ | -------------------------------------------------- |
| smartphones       | Contains the most important information about a smartphone model |                                                    |
| smartphone_prices | contains the price information about smartphones             | at registered least one per smartphone: default 0€ |
| smartphone_images | contains all images available for a smartphone               |                                                    |
| brands            | contains information about all smartphone brands             |                                                    |
| currencies        | contains all available currencies                            |                                                    |
| ratings           | for the rating of smartphones by users with the 5-star rating system |                                                    |
| users             | basic information about registered users                     |                                                    |
| comments          | stores comments either for smartphones or for themselves     | a polymorphic relationship                         |
| likes             | stores comment ratings based on Like/Dislike per user        | user can only 'Like' OR 'Dislike' the same comment |

# How it's working

## The Backend

### Models

```
|-- smartphoneportal_jannis
    |-- app
    |   |-- Http
    |   |   |-- Models
```

By default, all Laravel Models inherit the database columns as a public attribute. To now set the intended relationships
for the models, they need to be specified here so eloquent can automatically build the join queries for you.

```php
class Smartphone extends Model
{
    ...
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
    ...
}
```

To complete the relation, the counterpart should also be defined within the `Brand::class`.

```php
class Brand extends Model 
{
    public function smartphones(): HasMany
    {
        return $this->hasMany(Smartphone::class);
    }
}
```

Now, all that needs to be done to retrieve all related smartphones for one brand is to call this function like an
attribute on a single brand model instance. The rest will be handled for you. The relation will not get loaded by
default!

```php
class SomeController extends Controller
{
    public function getRelatedSmartphones(): Smartphone[]|Collection
    {
        return Brand::first()->smartphones;
    }
}
```

### Controllers

```
|-- smartphoneportal_jannis
    |-- app
    |   |-- Http
    |   |   |-- Controllers
    |-- routes
```

The Controller is not explicitly bound to a Laravel model and is generally just a request handler. But for grouping
several actions associated with a model you typically would create a _**Model**Controller_.

To specify which controller and function should be handling a request, you need to define this to your web routes.

```php
Route::get('/', [SmartphoneController::class, 'index']);
```

Now every get request to the base URL `smartphoneportal.com` would be handeld by Controller and the index function.

In the example below the controller returns an Inertia response, meaning either the `resources/views/app.blade.php`
where the initial Inertia-Vue.js app is included or if the app is already instantiated at the client, a JSON response to
update the Vue components and props. Here it would return a paginate JSON object of 16 `smartphones` that are **not**
Discontinued or Cancelled, with the related data of brand, prices, and the price currency (a nested relationship).
Additionally the avg value of the related rating values and the total rating count of each model.

```php
public function index(): Response
{
    $smartphones = Smartphone::where('launch_status', '!=', 'Discontinued')
        ->where('launch_status', '!=', 'Cancelled')
        ->with(['brand', 'smartphonePrices', 'smartphonePrices.currency'])
        ->orderBy('featured', 'DESC')
        ->paginate(16);
    
    $smartphones->loadAvg('ratings', 'stars');
    $smartphones->loadCount('ratings');

    return Inertia::render('Shop/Index', ['smartphones' => $smartphones]);
}
```

### Middlewares

Once a middleware is defined globally, for a group within `app/Http/Kernel.php` or a route, they will filter the
incoming request.

The example for the post route `smartphoneportal.test/smartphone/99/rating/update` within `routes/web.php`. To prevent
non-users and non-verified users to be able to rate smartphones, the middlewares `auth` and `verified` are applied to
that route, passed as an array to the `Route::middleware()`.

```php
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/smartphone/{smartphone}/rating/update', [RatingController::class, 'update'])
        ->name('smartphone.rating.update');
}
```

### Seeders

The seeders are for filling the database with initial and/or required data. They manually insert some small chunk of
data (eg. the main test user) or outsource the actual work to the factories to create easily large amounts of dummy
data. The `DatabaseSeeder` is sort of the "main" seeding class, which is automatically called with the artisan command
when setting up a fresh database with `php artisan migrate:fresh --seed`. Within a seeder, you can additionally call
other seeder classes.

```php
public function run(): void
{
    User::factory()->createOne(['name' => 'test', 'email' => 'test@mail.de']);
    
    $this->call([
        SmartphoneSeeder::class,
        UserSeeder::class
]);
}
```

### Factories

In general, they are a great way to create dummy data together, especially combined with the database seeders.

The smartphone factory is mainly responsible for importing smartphone data via the
provided `database/seeders/files/smartphones.csv` file. The `$this->smartphoneMapping` contains the mapping of for the
csv collumns to model attributes (database collumns) `[csv index => model attribute]`.

```php
public function createFromCsv(): void
{
    while (($csvRow = fgetcsv($file)) !== false) {
        $smartphone = Smartphone::create(); //creates a new empty smartphone model
        foreach ($this->smartphoneMapping as $key => $colName) {
             ...
            $smartphone->setAttribute($colName, $csvRow[$key]);
        }
    }
}
```

### Views

The only view file `resources/views/app.blade.php`  is reposible for the inital response to deliver everything
necessary, such as css stylesheet, fonts, csrf token, the routes for Ziggy.js (for using larval routes within js
frontend) and the inertia app together with vue.

```php+HTML
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title inertia>{{ config('app.name', 'smartphoneportal') }}</title>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="page-font">
        @inertia

        @env ('local')
            <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
        @endenv
    </body>
</html>
```

### Routes

The `routes/web.php` is for assigning actions to web routes. You can directly handle the route or point to one of your
Controller classes. Here you can also name the routes and assign middlewares to them.

```php
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
```

```php
Route::get('/', [SmartphoneController::class, 'index'])->name('index');
```

Thanks to the Ziggy.js library the named routes can also be used within the frontend. Here shown within the
inertia `Link` component.

```js
<Link :href = "route('phone.show', smartphone.id)" label = "dummy" />
```

## The Frontend

The frontend is based on Vue.js but within its configuration `resources/js/app.js` it is wrapped into inertia which
contains the main Vue app. Inertia is for intercepting the request and responses and therefore updates the component
props or re-renders components, based on the `Inertia::render()` specific response from the backend.

# ....

The smartphone table originates from this `'database/seeders/files/smartphones.csv'` file if found
online [here](https://www.kaggle.com/msainani/gsmarena-mobile-devices). It contains scraped data from the website
GSMArena, which holds reviews and phone information. The .csv holds about 10.105 unique smartphones. The data within the
misc_prices column has some wrong encoded UTF-8 hex characters such as  `<e2><82><ac>` for the €
sign. `SmartphoneFactory::createFromCsv()` is responsible for seeding the data from the `smartphones.csv` file.


