<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use TheCodealer\LaravelTwilio\Traits\ConfigTrait as Config;

class CreateCallRequestsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create(Config::getTablePrefix() . 'call_requests', function (Blueprint $table) {
            $table->id();
            $table->string('number', 16)->index();
            $table->string('caller_id', 16)->index();
            $table->string('status', 20)->index();
            $table->text('raw_request');
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
        Schema::drop(Config::getTablePrefix() . 'call_requests');
    }
}