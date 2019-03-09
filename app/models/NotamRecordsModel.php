<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class NotamRecordsModel extends Model {

    protected $table = 'notam_records';
    protected $fillable = array('id', 'recent_id', 'updated_by', 'recent_added_number', 'notam_number', 'dupe_notam_number',
        'revised_notam_number', 'fir', 'airport', 'from_date', 'from_time', 'to_date', 'to_time', 'valid_timing', 'notam_text',
        'q_code', 'f_text', 'g_text', 'from_date_format', 'from_time_format', 'from_time_IST', 'to_date_format', 'to_time_format',
        'to_time_IST', 'status', 'created_at', 'updated_at');

    public static function getAll() {
        NotamRecordsModel::get(array('id', 'recent_id', 'updated_by', 'recent_added_number', 'notam_number', 'dupe_notam_number',
            'revised_notam_number', 'fir', 'airport', 'from_date', 'from_time', 'to_date', 'to_time', 'valid_timing', 'notam_text',
            'q_code', 'f_text', 'g_text', 'from_date_format', 'from_time_format', 'from_time_IST', 'to_date_format', 'to_time_format',
            'to_time_IST', 'status', 'is_active', 'created_at', 'updated_at'));
    }

    public function get_notam($id) {
        $result = NotamRecordsModel::where('id', $id)->first();
        return $result;
    }

    public static function get_all_notams($user_airports = '', $airport = '', $recent_id = '', $new_notam = '', $dupes = '', $from_date = '', $to_date = '') {
        if ($user_airports != '') {
            $result = NotamRecordsModel::whereIN('airport', $user_airports)->get();
        } elseif ($airport != '') {
            $result = NotamRecordsModel::where('airport', $airport)->get();
        } elseif ($recent_id != '') {
            $result = NotamRecordsModel::where('recent_id', $recent_id)->get();
        } elseif ($new_notam != '') {
            $result = NotamRecordsModel::where('recent_added_number', '!=', '')->where('recent_id',$recent_id)->get();
        } elseif ($dupes != '') {
            $result = NotamRecordsModel::where('dupe_notam_number', '!=', '')->get();
        } else {
            $result = NotamRecordsModel::where('recent_id', $recent_id)->get();
        }

        return $result;
    }

    public static function update_notams($data) {
        $airport = $data['airport'];
        $notam_number = $data['notam_number'];
        NotamRecordsModel::where('airport', $airport)->where('notam_number', $notam_number)->update(['recent_added_number' => '']);
    }

    public static function get_distinct_airports() {
        
    }

    public static function update_old_notams_to_null() {
        $result = NotamRecordsModel::where('status',1)->update(array('recent_added_number' => ''));
        return $result;
    }

    public static function delete_invalid_notams() {
        $current_date = date('ymd');
        $result = NotamRecordsModel::where('to_date', $current_date)->where('to_date', '!=', 'PERM')->delete();
        return $result;
    }

    public function delete_notam($id) {
        $result = NotamRecordsModel::where('id', $id)->delete();
        return $result;
    }

    public static function delete_dupe_notams($post) {
        $airport = $post['airport'];
        $notam_number = $post['notam_number'];
        $recent_id = $post['recent_id'] - 1;

        $result = NotamRecordsModel::where('airport', $airport)
                ->where('notam_number', $notam_number)
                ->where('recent_id', '<=', $recent_id)
                ->delete();

        return $result;
    }

    public static function notam_number_exist($post) {
        $notam_number = $post['notam_number'];
        $result = NotamRecordsModel::where('notam_number', $notam_number)->where('status', 1)->first();
        return $result;
    }

    public static function recent_notam_number_exist($post) {
        $airport = $post['airport'];
        $notam_number = $post['notam_number'];
        $recent_id = $post['recent_id'];

        $result = NotamRecordsModel::where('notam_number', $notam_number)
                        ->where('airport', $airport)->where('recent_id', $recent_id)->where('status', 1)->first();
        return $result;
    }

}
