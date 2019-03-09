<?php

namespace App\Http\Controllers\EflightAdmin;

use App\Http\Controllers\Controller;

class HandlersController extends Controller {
	public function index() {
		return view('EflightAdmin.handlers.handlers_list');
	}

	public function create() {
		return view('EflightAdmin.handlers.add_handlers');
	}
}
