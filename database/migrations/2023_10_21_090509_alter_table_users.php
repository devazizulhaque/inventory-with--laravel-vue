<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->string('photo')->nullable();
            $table->string('salary')->nullable()->default(0)->comment('Salary of the user');
            $table->string('phone')->nullable()->comment('Phone number of the user');
            $table->string('address')->nullable()->comment('Address of the user');
            $table->string('position')->nullable();
            $table->tinyInteger('role_type')->comment('1 => Admin; 2 => Employee; 3 => Customer')->default(3);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
