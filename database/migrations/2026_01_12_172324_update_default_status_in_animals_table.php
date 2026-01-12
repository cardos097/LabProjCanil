<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update existing records
        DB::table('animals')->where('status', 'available')->update(['status' => 'Disponível']);
        DB::table('animals')->where('status', 'adopted')->update(['status' => 'Adotado']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('animals')->where('status', 'Disponível')->update(['status' => 'available']);
        DB::table('animals')->where('status', 'Adotado')->update(['status' => 'adopted']);
    }
};
