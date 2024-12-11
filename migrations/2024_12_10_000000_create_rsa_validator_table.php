<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRSAValidatorTable extends Migration
{
    public function up()
    {
        Schema::create('rsa_validator', function (Blueprint $table) {
            $table->id();
            $table->string('client_id');
            $table->text('public_key');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rsa_validator');
    }
}
