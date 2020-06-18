<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use TheCodealer\LaravelTwilio\Traits\ConfigTrait as Config;

class CreateCallEventsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create(Config::getTablePrefix() . 'call_events', function (Blueprint $table) {
            $table->id();
            $table->string('sid', 50)->index();
            $table->string('name', 20)->index();
            $table->json('raw_response')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop(Config::getTablePrefix() . 'call_events');
    }
}