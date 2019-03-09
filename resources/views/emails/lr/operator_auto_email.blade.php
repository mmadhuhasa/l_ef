@extends('emails.layout')
@section('container')
<table border="0" cellpadding="0" cellspacing="0" width="100%"  >
    <tr>
        <td>
            <table border="0" width="700" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="color: #333333!important;font-size: 20px;font-family: 'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;border-top: 0;border: 11px solid #f9f9f9;border-top:0;" height="40">
                        <div align="center" style="font: 14px normal monospace; margin-bottom: 15px;">
                         
                                <div align="center">
                                    <h1 align="left" style="font-size: 16px;font-weight: normal;border: 11px solid #f9f9f9;background: linear-gradient(to bottom,#a6a6a6 0%,#555555 50%,#a6a6a6 100%);padding:5px;margin-top: 0;border-left: 0;border-right: 0;margin-bottom: 0;text-align: center;">
                                        <span style="color:white;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;text-transform: uppercase"><span  style="text-transform: capitalize;">{!!$subject!!}</span>                                        
                                    </h1>
                                    <div align="left" style="background-color: white;border-radius: 5px;font-family: 'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif">
                                         <?php
                                         date_default_timezone_set('Asia/Kolkata');
                                         $current_date = date('d-M-Y');
                                         $current_time = date('H:i:s');
                                         $current_date2 = strtotime(date('d-M-Y'));
                                         ?>
                                        <table style="width:100%;float:left; border:1px solid #999;border-collapse: collapse;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif; text-align: left;font-size: 12px;">
                                            <thead>
                                                <tr>
                                                    <th style="color:#000;border:1px solid #999; padding: 3px 5px;width:4%;">SL</th>
                                                    <th style="color:#000;border:1px solid #999; padding: 3px 5px;width:20%;">CREW NAME</th>
                                                    <th style="color:#000;border:1px solid #999; padding: 3px 5px;">LICENSE NAME</th>
                                                    <th style="color:#000;border:1px solid #999; padding: 3px 5px;width:15%;">EXPIRY DATE</th>
                                                    <th style="color:#000;border:1px solid #999; padding: 3px 5px;width:14%;">DAYS TO GO</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $j = 1; ?>
                                                @foreach ($due_result as $due_result_value) 
                                                <?php
                                                $user_id = $due_result_value->user_id;
                                                $user_details = App\User::where('id',$user_id)->first(['name']);
                                                $user_name  = ($user_details) ? $user_details->name : '';
                                                $license_name = $due_result_value->license_name;
                                                $license_type = $due_result_value->license_type;
                                                $number = $due_result_value->number;
                                                
                                                if(strtoupper($license_name)  == 'OTHERS'){
                                                    $license_name = $number;
                                                }else if(strtoupper($license_name) == 'VISA'){
                                                     $license_name = "VISA ".$number;
                                                }
                                                
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
                                                if($valid_days < 0){
                                                    $valid_days_color = 'red';
                                                }else{
                                                    $valid_days_color = 'green';
                                                }
                                                ?>
                                                <tr>
                                                    <td style="border:1px solid #999; padding: 3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">{{$j}}</td>
                                                    <td style="border:1px solid #999; padding: 3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">{{$user_name}}</td>
                                                    <td style="border:1px solid #999; padding: 3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">{{substr($license_name,0,40)}}</td>
                                                    <td style="border:1px solid #999; padding: 3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">{{$expire_date}}</td>
                                                    <td style="border:1px solid #999;font-weight:bold;padding:3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif; color:{{$valid_days_color}};font-weight: bold;">{{$valid_days}}</td>
                                                </tr>
                                               <?php $j++; ?>
                                                @endforeach
                                            </tbody>
                                        </table>                                        
                                    </div>
                                    <br/>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
</table>
@stop
