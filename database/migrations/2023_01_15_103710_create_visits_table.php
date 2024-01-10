<?php

use App\Models\Cave;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Trip::class);
            $table->foreignIdFor(User::class)->comment('This user will be the one who creates the visit');
            $table->foreignIdFor(Cave::class);
            $table->text('notes')->nullable();
            $table->dateTime('start_date')->comment('The date/time on which the visit starts')->nullable();
            $table->dateTime('end_date')->comment('The date/time on which the visit ends')->nullable();
            $table->float('duration', 8, 2)->comment('The length of the trip.  Can be set by selecting a start/end time')->nullable();
            $table->string('party_leader')->nullable()->comment('Optional name of the Party leader (if not an existing user)');
            $table->foreignId('party_leader_id')->nullable();
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
        Schema::dropIfExists('visits');
    }
}
