<?php

namespace App\Http\Controllers\test;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Redirect as Redirect;
use \App\models\TestModel as TestModel;
use Log;
use App\Exceptions\customException;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('test.validation');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $page = $request->page;
        switch ($page) {
            case $page:
                return view('test.vue.'.$page);
                break;
            default:
                return view('test.vue.helloworld');
                break;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            $data = $request->all();
//            $data['comments'] = $comments;
//            $model = \App\User::find(1);
//            $model->email;
            TestModel::create($data);
//            return response()->json(array('success' => 'kii'));
            return Redirect::to('test/test')->with('success', 'hello');
        } catch (\Exception $ex) {
            Log::info('kkswgvw');
            throw new customException($ex->getMessage());
        }
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

    public function check(Request $request) {
        $credentials = ['email' => $request->email, 'password' => $request->password];
        $attempt = Auth::attempt($credentials);
        return auth()->user()->email;
    }

    public function elevation(Request $request) {
        $lattitude = $request->lattitude;
        $longitude = $request->longitude;
        $elevation = $request->elevation;

        $elevation = explode(' ', $elevation);
        $data['lattitude'] = $lattitude;
        $data['longitude'] = $longitude;

        foreach ($elevation as $elevation_value) {
            $data['elevation'] = $elevation_value;
            $result = \App\models\LatLongElevation::create($data);
            $lattitude = $lattitude + 0.016667;
            $longitude = $longitude + 0.016667;
            $data['lattitude'] = $lattitude;
            $data['longitude'] = $longitude;
        }
    }

}
