<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class BillingPaymentsModel extends Model {

    protected $table = "billing_payments";
    protected $fillable = ['id', 'f_callsign', 'f_airport', 'f_fuel_agency', 'f_quantity', 'f_eflight_price',
        'f_operator', 'f_flight_date', 'f_dept_time', 'a_callsign', 'a_airport', 'a_arrival_date', 'a_dept_date',
        'a_eflight_price', 'a_handling_agency', 'a_arrival_time', 'a_dept_time', 'a_remarks', 'h_hotel_name',
        'h_check_in', 'h_check_out', 'h_eflight_price', 'h_guest_name', 'h_in_time', 'h_out_time', 'c_company_name',
        'c_eflight_price', 'c_remarks', 'm_service_desc', 'm_eflight_price', 'm_remarks', 'total_amount',
        'order_number', 'is_active', 'is_delete', 'created_at', 'updated_at'];

}
