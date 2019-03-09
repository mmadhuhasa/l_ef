<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class SupportMailsModel extends Model {

    protected $table = 'support_mails';
    protected $fillable = ['mail_ids', 'is_active'];

    public static function get_support_mails() {
	$result = SupportMailsModel::where('is_active', '1')->where('is_cc_active', '1')->first();
	return ($result) ? $result->cc_mail_ids : '';
    }

    public static function get_bcc_mails() {
	$result = SupportMailsModel::where('is_active', '1')->where('is_bcc_active', '1')->first();
	return ($result) ? $result->bcc_mail_ids : '';
    }
    
    public static function get_local_mails() {
	$result = SupportMailsModel::where('is_active', '1')->first();
	return ($result) ? $result->local_mail_ids : '';
    }

}
