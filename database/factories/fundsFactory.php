<?php

use Faker\Generator as Faker;

$factory->define(App\Demand::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('zh-CN');//设置faker，数据为中文
    return [
        'token_id' => $faker->randomElement(['1','2','3','4','5','6']),
        'type' => $faker->randomElement(['0','1','2']),
        'title' => $faker->randomElement(['美国银行寻找小微企业项目投资','上海银行寻找小微企业项目投资','中国银行','小微企业项目投资']),
        'asset_type' => $faker->randomElement(['0','1','2','3','4','5']),
        'fund_type' => $faker->randomElement(['0','1','2','3','4','5','6']),
        'fund_start' => $faker->randomElement(['20','30','10']),
        'fund_end' => $faker->randomElement(['40','50','60']),
        'company_address' => $faker->randomElement(['上海','北京','广州','深圳']),
        'des' => $faker->randomElement(['上海啦啦啦啦','北京哈哈哈哈','广州就打算东海岛','深圳大家伙的']),
        'credit' => $faker->randomElement(['0','1','2','3','4']),
        'contact_type' => $faker->randomElement(['0','1','2']),
        'contact' => $faker->randomElement(['1232312','13231231','4243432423']),
        'tag_id' => $faker->randomElement(['0','1','2']),
        'status' => $faker->randomElement(['0','1','2','3']),
        'reason' => $faker->randomElement(['0','1','2','3']),
    ];
});