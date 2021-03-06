<?php

use Faker\Generator as Faker;

$factory->define(App\Charge::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('zh-CN');//设置faker，数据为中文
    return [
        'openid' => $faker->uuid,
        'nickname' => $faker->randomElement(['john','Doe','小明','王星','王明永']),
        'userimg' => $faker->imageUrl(),
        'useremail' => $faker->randomElement(['56789@163.com','12389@qq.com','13986670515@163.com','yushiyang@163.com']),
        'tel' => $faker->randomElement(['13986670515','123345666','131243534636','132435436564']),
        'mark' => '0',
    ];
});