<?php

use Faker\Generator as Faker;
use Bitfumes\Activity\Tests\Dummy\Model\Item;

$factory->define(Bitfumes\Activity\Models\Activity::class, function (Faker $faker) {
    return [
        'type'     => 'item_created',
        'user_id'  => 1,
        'model_id' => function () {
            return factory(Item::class)->create()->id;
        },
        'model_type' => function () {
            return get_class(Item);
        }
    ];
});
