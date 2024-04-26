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

		Schema::create('medicus_site.tb_banner', function (Blueprint $table) {
			$table->id();
			$table->string('titulo');
			$table->string('titulo_slug');
			$table->string('descricao');
			$table->string('imagem');
			$table->string('imgname');
			$table->integer('imgsize');
			$table->string('autor');
			$table->integer('ordem');
			$table->string('tags');
			$table->integer('hits')->default(0);
			$table->string('url')->nullable();
			$table->dateTime('publicar_ini');
			$table->dateTime('publicar_fim');
			$table->dateTime('created_at');
			$table->dateTime('updated_at');
			$table->enum('status', ['0', '1']);
		});

	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('medicus_site.tb_banner');
	}
};
