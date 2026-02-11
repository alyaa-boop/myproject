<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('keahlian', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ic_number', 20);
            $table->string('email');
            $table->string('phone', 20);
            $table->text('address');
            $table->string('postcode', 10);
            $table->string('city');
            $table->string('state');
            $table->string('occupation');
            $table->string('employer');
            $table->string('previous_membership_number')->nullable();
            $table->string('previous_membership_year')->nullable();
            $table->boolean('physical_card')->default(false);
            $table->string('document_path')->nullable();
            $table->string('status')->default('menunggu'); // menunggu, disahkan, tolak
            $table->string('no_ahli')->nullable(); // No. Ahli selepas disahkan (e.g. A12345)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('keahlian');
    }
};
