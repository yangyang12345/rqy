<?php

use Faker\Generator as Faker;

$factory->define(App\token::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('zh-CN');//设置faker，数据为中文
    return [
        'openid' => $faker->uuid,
        'nickname' => $faker->randomElement(['于诗洋','董梦宇','蔺成欣','苗文龙','章丽蓉']),
        'userimg' => $faker->imageUrl(),
        'useremail' => $faker->randomElement(['56789@163.com','12389@qq.com','13986670515@163.com','yushiyang@163.com']),
        'tel' => $faker->randomElement(['13986670515','123345666','131243534636','132435436564']),
        'mark' => '0',
    ];
});