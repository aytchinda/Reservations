
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Supprimer les colonnes firstname et lastname
            $table->dropColumn(['firstname', 'lastname']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Réajouter les colonnes firstname et lastname
            $table->string('firstname', 255);
            $table->string('lastname', 255);
        });
    }
};
