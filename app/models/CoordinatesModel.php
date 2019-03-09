<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class CoordinatesModel extends Model {

    protected $table = 'notam_coordinates';
    protected $fillable = array('id', 'airport', 'fir', 'notam_number', 'revised_notam_number', 'recent_id', 'lattitude',
        'longtitude', 'lat_degs', 'lat_mins', 'lat_secs', 'lat_milli_secs', 'long_degs', 'long_mins', 'long_secs',
        'long_milli_secs', 'status', 'created_at', 'updated_at');

    public static function getAll() {
        $result = CoordinatesModel::get(array('id', 'airport', 'fir', 'notam_number', 'revised_notam_number', 'recent_id', 'lattitude',
                    'longtitude', 'lat_degs', 'lat_mins', 'lat_secs', 'lat_milli_secs', 'long_degs', 'long_mins', 'long_secs',
                    'long_milli_secs', 'status', 'created_at', 'updated_at'));
        return $result;
    }

    public static function delete_coordinates($post) {
        $airport = $post['airport'];
        $notam_number = $post['notam_number'];
        $recent_id = $post['recent_id'];
        $result = CoordinatesModel::where('airport', $airport)
                ->where('notam_number', $notam_number)
                ->where('recent_id', '<', $recent_id)
                ->orWhere(function ($query) {
                    $query->where('lattitude', '=', '0')
                    ->orWhere('longtitude', '=', '0');
                })
                ->delete();
    }

    public static function get_coordinates($post = '', $recent_id = '') {
        if ($post != '') {
            $fir = $post['fir'];
            $notam_number = $post['notam_number'];
            $where_fir_notam = '';
            $where_fir = '';
            if ($fir != '' && $notam_number != '') {
                $result = CoordinatesModel::where('fir', $fir)
                                ->whereOr('airport', $fir)
                                ->where('notam_number', $notam_number)
                                ->where('status', '1')->get();
            } else {
                $result = CoordinatesModel::where('fir', $fir)
                                ->whereOr('airport', $fir)
                                ->where('status', '1')->get();
            }
        } else if ($recent_id != '') {
            $result = CoordinatesModel::where('recent_id', $recent_id)
                            ->where('status', '1')->get();
        } else {
            $result = CoordinatesModel::where('status', '1')->get();
        }
        return $result;
    }

    //get coordinates details
    public function get_coordinates_maps($post) {
        $fir = $post['fir'];
        $notam_number = $post['notam_number'];
        $id = $post['id'];
        if ($id != 0 || $id != '') {
            $result = CoordinatesModel::select(DB::raw('lat_degs as latHr,lat_mins as latMin,lat_secs as latSec,long_degs as longHr,
                    long_mins as longMin,long_secs as longSec'))
                            ->where('id', $id)
                            ->where('status', '1')->get();
        } else if ($fir != '' && $notam_number != '') {
            $result = CoordinatesModel::select(DB::raw('lat_degs as latHr,lat_mins as latMin,lat_secs as latSec,long_degs as longHr,
                    long_mins as longMin,long_secs as longSec'))
                            ->where('fir', $fir)
                            ->whereOr('airport', $fir)
                            ->where('notam_number', $notam_number)
                            ->where('status', '1')->get();
        }
    }

}
