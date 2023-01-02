<?php

use App\Models\Cave;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSqueezesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('squeezes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('pilsi');
            $table->foreignIdFor(Cave::class);
            $table->foreignIdFor(User::class);
            $table->string('description');
            $table->string('main_picture')->nullable();
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
        Schema::dropIfExists('squeezes');
    }
}
