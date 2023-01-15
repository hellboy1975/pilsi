<?php

use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(Region::class);
            $table->foreignIdFor(User::class)->comment('This user will be the one who creates the trip');
            $table->string('trip_leader')->nullable()->comment('Optional name of the Trip leader (if not an existing user)');
            $table->foreignId('trip_leader_id')->nullable();
            $table->text('notes')->nullable();
            $table->date('start_date')->comment('The date on which the trip starts');
            $table->date('end_date')->comment('The date on which the trip ends');
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
        Schema::dropIfExists('trips');
    }
}
