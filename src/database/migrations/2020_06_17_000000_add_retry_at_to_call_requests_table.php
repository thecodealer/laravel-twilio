<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use TheCodealer\LaravelTwilio\Traits\ConfigTrait as Config;

class AddRetryAtToCallRequestsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table(Config::getTablePrefix() . 'call_requests', function (Blueprint $table) {
            $table->dateTime('retry_at')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table(Config::getTablePrefix() . 'call_requests', function (Blueprint $table) {
            $table->dropColumn('retry_at');
        });
    }
}