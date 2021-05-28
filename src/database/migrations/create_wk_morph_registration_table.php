<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateWkMorphRegistrationTable extends Migration
{
    public function up()
    {
        Schema::create(config('wk-core.table.morph-registration.registrations'), function (Blueprint $table) {
            $table->uuid('id');
            $table->uuidMorphs('morph');
            $table->uuid('user_id');
            $table->string('signup_note')->nullable();
            $table->string('signup_code')->nullable();
            $table->string('signup_rule_version')->nullable();
            $table->string('signup_policy_version')->nullable();
            $table->unsignedTinyInteger('state')->default(0);
            $table->text('state_info')->nullable();
            $table->string('rule_version')->nullable();
            $table->string('policy_version')->nullable();

            $table->timestampsTz();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')
                  ->on(config('wk-core.table.user'))
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->primary('id');
            $table->index('signup_code');
            $table->index('state');
            $table->index('rule_version');
            $table->index('policy_version');
        });
    }

    public function down() {
        Schema::dropIfExists(config('wk-core.table.morph-registration.registrations'));
    }
}
