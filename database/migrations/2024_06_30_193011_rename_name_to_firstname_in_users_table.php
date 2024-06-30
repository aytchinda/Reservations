<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class RenameNameToFirstnameInUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'name')) {
                $table->renameColumn('name', 'firstname');
            }
        });

        // Modifier le type de colonne dans une migration distincte
        DB::statement('ALTER TABLE users MODIFY COLUMN firstname VARCHAR(60)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('firstname', 'name');
        });
    }
}
