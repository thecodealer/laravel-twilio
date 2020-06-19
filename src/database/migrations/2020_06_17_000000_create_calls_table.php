<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use TheCodealer\LaravelTwilio\Traits\ConfigTrait as Config;

class CreateCallsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create(Config::getTablePrefix() . 'calls', function (Blueprint $table) {
            $table->id();
            $table->integer('call_request_id')->unsigned()->nullable()->index();
            $table->string('sid', 50)->unique();
            $table->integer('duration')->unsigned()->nullable()->index();
            $table->text('raw_response');
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop(Config::getTablePrefix() . 'calls');
    }
}