<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisingCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertising_campaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('advert_name');
            $table->date('advert_date_from');
            $table->date('advert_date_to');
            $table->float('daily_advert_budget', 10, 2);
            $table->float('total_advert_budget', 10, 2);
            $table->string('advert_creatives_path')->nullable();
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
        Schema::dropIfExists('advertising_campaigns');
    }
}
