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
		Schema::create('medicus_laravel.cache', function (Blueprint $table) {
			$table->string('key')->primary();
			$table->mediumText('value');
			$table->integer('expiration');
		});

		Schema::create('medicus_laravel.cache_locks', function (Blueprint $table) {
			$table->string('key')->primary();
			$table->string('owner');
			$table->integer('expiration');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('medicus_laravel.cache');
		Schema::dropIfExists('medicus_laravel.cache_locks');
	}
};
