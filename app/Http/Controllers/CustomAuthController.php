<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;
use Auth;
use App\Http\Requests\AuthRequest;

class CustomAuthController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
	//
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
	//
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
	//
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
	//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
	//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
	//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
	//
    }

    public function authenticate_user(AuthRequest $request) {
	$credentials = ['mobile_number' => $request->mobile_number, 'password' => $request->password, 'is_active' => 1];
	
//	$attempt = Auth::attempt($credentials,TRUE);
        $attempt = Auth::attempt($credentials);
	if ($attempt) {
	    return response()->json(['error'=>0,'success' =>'1']);
	  //  return redirect::to('fpl/new_quick');
	} else {
	    return response()->json(['error'=>1,'success' =>'0']);
	}
    }
    
    public function signup(Request $request){
	return view('auth.sign-up');
    }
    

}
