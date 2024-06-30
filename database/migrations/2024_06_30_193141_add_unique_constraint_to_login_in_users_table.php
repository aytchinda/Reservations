<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddUniqueConstraintToLoginInUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Assurez-vous que toutes les valeurs de la colonne `login` sont uniques avant d'ajouter la contrainte unique
            $users = DB::table('users')->get();
            foreach ($users as $user) {
                if (empty($user->login)) {
                    DB::table('users')->where('id', $user->id)->update(['login' => 'user' . $user->id]);
                }
            }

            $table->unique('login', 'users_login_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_login_unique');
        });
    }
}
