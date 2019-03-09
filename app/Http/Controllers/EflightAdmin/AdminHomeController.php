<?php

namespace App\Http\Controllers\EflightAdmin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminHomeController extends Controller
{
    public function index(Request $request){
	return view('EflightAdmin.index');
    }
}
