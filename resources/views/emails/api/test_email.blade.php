@extends('emails.layout')
@section('container')
<table border="0" cellpadding="0" cellspacing="0" width="100%"  >
    <tr>
        <td>
            <table border="0" width="600" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="color:#333333 !important; font-size:20px; font-family: monospace; padding-left:10px;" height="40">
                        <div align="center" style="font: 14px normal monospace; margin-bottom: 15px;">
                            <div align="left" style="width: 738px;
                                 margin: auto;
                                 background-color: #f5f5f5;
                                 border-radius: 10px;
                                 padding: 1px;">
                                <div align="center">
                                    <h1 align="left" style="font-size: 18px;
                                        font-weight: normal;
                                        width: 95%;
                                        background:linear-gradient(to bottom,#a6a6a6 0%,#555555 50%,#a6a6a6 100%); color: #fff;
                                        border-radius: 5px;
                                        padding: 10px;height: 15px;line-height: 0.8;margin:8px;">
                                        <span style="color:white;font-family: monospace; text-transform: uppercase"><span  style="text-transform: capitalize;">{!!$user_name!!}</span>                                        
                                    </h1>
                                    <div align="left" style="width: 97.5%;height: 80px;
                                         padding-top: 10px;
                                         border-radius: 5px;">
                                         <?php
                                         date_default_timezone_set('Asia/Kolkata');
                                         $current_date = date('d-M-Y');
                                         $current_time = date('H:i:s');
                                         $current_date2 = strtotime(date('d-M-Y'));
                                         ?>
                                        <table style="float: left; width: 100%;float:left; border:2px solid #999;border-collapse: collapse;font-family:verdana,sans-serif; text-align: left;">
                                            <thead>
                                                <tr>
                                                    <th style="color:#000;border:1px solid #999; padding: 3px 5px;">SL</th>
                                                    <th style="color:#000;border:1px solid #999; padding: 3px 5px; width: 45%;">License Name</th>
                                                    <th style="color:#000;border:1px solid #999; padding: 3px 5px;">License Type</th>
                                                    <th style="color:#000;border:1px solid #999; padding: 3px 5px;">Date of expiry</th>
                                                    <th style="color:#000;border:1px solid #999; padding: 3px 5px;">Days To Go</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $j = 1; ?>
                                                @foreach ($due_result as $due_result_value) 
                                                <?php
                                                $user_name = $due_result_value->user_name;
                                                $license_name = $due_result_value->license_name;
                                                $license_type = $due_result_value->license_type;
                                                $expire_date = date('d-M-Y', strtotime('20' . $due_result_value->to_date));
                                                $expire_date2 = strtotime($expire_date); //echo floor($datediff / (60 * 60 * 24));
                                                $valid_days = ceil(($expire_date2 - $current_date2) / 86400);
                                                $data = [
                                                    'user_name' => $user_name,
                                                    'license_name' => $license_name,
                                                    'expire_date' => $expire_date,
                                                    'valid_days' => $valid_days
                                                ];
                                                $data['subject'] = "$license_name of $user_name is Due to Expire on $expire_date ($valid_days Days)";
                                                ?>

                                                <tr>
                                                    <td style="border:1px solid #999; padding: 3px 5px;font-family: verdana,sans-serif;">{{$j}}</td>
                                                    <td style="border:1px solid #999; padding: 3px 5px;font-family: verdana,sans-serif;">{{substr($license_name,0,40)}}</td>
                                                    <td style="border:1px solid #999; padding: 3px 5px;font-family: verdana,sans-serif;">{{$license_type}}</td>
                                                    <td style="border:1px solid #999; padding: 3px 5px;font-family: verdana,sans-serif;">{{$expire_date}}</td>
                                                    <td style="border:1px solid #999;color:red;font-weight:bold; padding: 3px 5px;font-family: verdana,sans-serif;">{{$valid_days}}</td>
                                                </tr>
                                                <?php $j++; ?>
                                                @endforeach
                                            </tbody>
                                        </table>                                        
                                    </div>
                                    <br/>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
@stop
