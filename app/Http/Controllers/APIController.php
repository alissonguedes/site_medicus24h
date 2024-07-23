<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FileModel;
use Illuminate\Http\Request;

class APIController extends Controller {

	/**
	 * Display the specified resource.
	 */
	public function show_image_profile(Request $request, FileModel $file, string $categoria, int $file_id) {

		return $file->showFile($file_id, $categoria);

	}

}
