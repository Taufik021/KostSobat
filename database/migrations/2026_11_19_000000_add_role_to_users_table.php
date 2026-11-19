<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['penghuni', 'pemilik'])->default('penghuni')->after('name');
            $table->string('phone')->nullable()->after('role');
            $table->string('institution')->nullable()->after('phone'); // kampus/instansi (penghuni)
            $table->string('kos_name')->nullable()->after('institution');   // nama kos (pemilik)
            $table->text('kos_address')->nullable()->after('kos_name');     // alamat kos (pemilik)
            $table->integer('kos_rooms')->nullable()->after('kos_address'); // jumlah kamar (pemilik)
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'phone', 'institution', 'kos_name', 'kos_address', 'kos_rooms']);
        });
    }
};
