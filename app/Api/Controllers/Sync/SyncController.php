<?php

namespace App\Api\Controllers\Sync;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\models\ContactFormModel;
use App\Jobs\ContactUsEmailJob;
use App\Events\Home\ContactUsEvent;
use App\Http\Requests\ContactRequest;
use Log;
use Response;

class SyncController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $bcc;
    public $cc;
    public $from;
    public $from_name;
    public $customer_id;

    public function __construct() {
        $this->bcc = env('BCC', "dev.eflight@pravahya.com");
        $this->cc = env('CC', "dev.eflight@pravahya.com");
        $this->from = env('FROM', "support@eflight.aero");
        $this->from_name = env('FROM_NAME', "EFLIGHT");
    }

    public function index(Request $request) {
        return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
                    . 'is absolutely forbidden for some reason'], 403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
                    . 'is absolutely forbidden for some reason'], 403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
                    . 'is absolutely forbidden for some reason'], 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
                    . 'is absolutely forbidden for some reason'], 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
                    . 'is absolutely forbidden for some reason'], 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
                    . 'is absolutely forbidden for some reason'], 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
                    . 'is absolutely forbidden for some reason'], 403);
    }

    public function fpl_sync_email(Request $request) {
        try {
            $current_date = date('ymd');
            $yesterday = date('ymd', strtotime("-1 days"));
            $tomorrow = date('ymd', strtotime("+1 days"));
            $sync_time = $request->sync_time;
            $result = 'Success!';
            if ($sync_time == 'mng') {
                $sync_data = \App\models\SyncIntegrationModel::where('is_active', 1)
                                ->where('date_of_sync', $yesterday)->first();
                $is_evening = ($sync_data) ? $sync_data->is_evening : 0;
                if (!$is_evening) {
                    $data = ['sync_date' => $yesterday,'next_date' =>$current_date, 'subject' =>"WEBSITE SYNC MISSED on "  . date('d-M-Y')];
                    dispatch(new \App\Jobs\FPLSyncEmailJob($data));
                    $result = 'Success email sent!';
                }
            } elseif ($sync_time == 'evening') {
                $sync_data = \App\models\SyncIntegrationModel::where('is_active', 1)
                                ->where('date_of_sync', $current_date)->first();
                $is_evening = ($sync_data) ? $sync_data->is_evening : 0;
                if (!$is_evening) {
                    $data = ['sync_date' => $current_date,'next_date' =>$tomorrow, 'subject' => "WEBSITE SYNC MISSED on "  . date('d-M-Y')];
                    dispatch(new \App\Jobs\FPLSyncEmailJob($data));
                    $result = 'Success email sent!';
                }
            }
            return $result;
        } catch (\Exception $ex) {
            Log::info('test_email: ' . $ex->getMessage());
        }
    }

}
