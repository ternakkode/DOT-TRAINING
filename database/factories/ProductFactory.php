<?php 

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Domain\Product\Entities\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
| 
*/
$factory->define(\App\Domain\Product\Entities\Product::class, function (Faker $faker) {
    $sell_price = $faker->numberBetween(10000, 200000);
    return [
        'product_name'  => $faker->realText(20),
        'sell_price'    => $sell_price,
        'buy_price'     => $sell_price + 20000
    ];
});