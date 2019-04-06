<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demand', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('token_id');  //用户id
            $table->integer('type');  //类型 0.找资金 1.找资产 2.其他合作
            $table->string('title');  //需求标题
            $table->integer('asset_type');  //资产类型 0.房抵，1.车低，2.供应链，3.场景分期，4.现金分期，5其他
            $table->integer('fund_type');  //资产类型 0.银行，1.消金，2.小贷，3.P2P，4.信托，5.保理 6.其他
            $table->integer('fund_start');  //资金成本要求
            $table->integer('fund_end');  //资金成本要求
            $table->string('company_address');  //公司地址
            $table->string('des');  //描述
            $table->integer('credit');  //征信方案 0.比例保证金，1.平台主体担保，2.保险或担保公司担保，3.实际控制人连带担保，4.其他
            $table->integer('contact_type');  //联系类型 0.手机号，1.邮箱，2.微信号
            $table->string('contact');  //联系方式
            $table->string('tag_id');  //标签id
            $table->integer('status');  //状态 0.以提交 1.正在审核,2.审核通过, 3.审核未通过
            $table->string('reason');  //审核未通过原因

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demand');
    }
}
