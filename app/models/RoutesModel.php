<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class RoutesModel extends Model {

    protected $table = 'notam_routes';
    protected $fillable = array('id', 'recent_id', 'updated_by', 'recent_added_number',
        'notam_number', 'revised_notam_number', 'fir', 'route_name', 'airport', 'status', 'created_at', 'updated_at');

    public static function getAll() {
        $result = RoutesModel::get(array('id', 'recent_id', 'updated_by', 'recent_added_number',
                    'notam_number', 'revised_notam_number', 'fir', 'route_name', 'airport', 'status', 'created_at', 'updated_at'));
        return $result;
    }

    public static function update_notam_routes($post) {
        $notam_number = $post['notam_number'];
        $recent_added_number = $post['recent_added_number'];
        $revised_notam_number = $post['revised_notam_number'];
        $result = RoutesModel::where('notam_number', $notam_number)
                ->where('airport', $airport)
                ->update(['recent_added_number' => $recent_added_number]);
        return $result;
    }

    public static function get_routes($recent_id, $new_routes = '') {       
        if ($recent_id && !$new_routes) {
            $result = RoutesModel::where('recent_id', $recent_id)->get();
        } else {
            $result = RoutesModel::where('recent_id', $recent_id)->where('recent_added_number', '!=', '')->get();
        }
        return $result;
    }

    //get all distinct airports
    public static function get_distinct_routes() {
        $result = RoutesModel::select(raw("DISTINCT(route_name) from `notam_routes` where  recent_added_number !=''"))
                ->where('recent_added_number', '!=', '')
                ->get();
        if ($result) {
            foreach ($result as $routes) {
                $pieces[] = $routes['route_name'];
            }
        }
        return $pieces;
    }

    public static function update_old_routes_to_null() {
        $result = RoutesModel::where('status','1')->update(['recent_added_number' => '']);
        return $result;
    }

    public static function delete_route($id) {
        $result = RoutesModel::where('id', $id)->delete();
        return $result;
    }

    public static function delete_previous_routes($post) {
        $airport = $post['airport'];
        $notam_number = $post['notam_number'];
        $recent_id = $post['recent_id'] - 1;
        $result = RoutesModel::where('airport', $airport)
                ->where('notam_number', $notam_number)
                ->where('recent_id', '<=', $recent_id)
                ->delete();
        return $result;
    }

    public static function check_route_exist($post) {
        $airport = $post['airport'];
        $notam_number = $post['notam_number'];
        $recent_id = $post['recent_id'] - 1;
        $route_name = $post['route_name'];

        $result = RoutesModel::where('airport', $airport)->where('notam_number', $notam_number)
                        ->where('route_name', $route_name)->first();
        return $result;
    }

}
