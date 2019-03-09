@extends('emails.layout')
@section('container')
<table border="0" cellpadding="0" cellspacing="0" width="100%"  >
    <tr>
        <td>
            <table border="0" width="600" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="color:#333333 !important; font-size:20px; font-family: monospace; padding-left:10px;" height="40">
                        <div align="center" style="font: 14px normal monospace;">
                            <div align="left" style="width: 738px;
                                 margin: auto;
                                 background-color: #eaeaea;
                                 border-radius: 10px;
                                 padding: 5px;float: left;">
                                <div align="center">
                                    <h1 align="left" style="font-size: 18px;
                                        font-weight: normal;
                                        width: 95%;
                                        background-color:#f1292b;filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f1292b', endColorstr='#f37858');background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858)); /* for webkit browsers */
                                        background: -moz-linear-gradient(top, #f1292b, #f37858); color: #fff;
                                        border-radius: 8px;
                                        padding: 10px;">
                                        <span style="color:white;font-family: monospace">{{$subject}}</span>                                        
                                    </h1>
                                    <div align="left" style="width: 95%;float:left;
                                         padding: 9px;
                                         border: 2px dashed #c2c2c2;
                                         background-color: white;
                                         border-radius: 10px;">
                                         <?php
                                         date_default_timezone_set('Asia/Kolkata');
                                         $current_date = date('d-M-Y');
                                         $current_time = date('H:i:s');
                                         ?>

                                        <table style="border:1px solid #000;border-collapse: collapse;width: 46%;float:left;">
                                            <tr>
                                                <td style="width:20%;border:1px solid #000;font-weight: bold;padding:3px">{{$get_day_count_fpl}}</td>
                                                <td style="width:80%;border:1px solid #000;font-weight: bold;padding:3px;white-space: nowrap;">TOTAL PLANS</td>
                                            </tr>
                                            <tr>
                                                <td style="width:20%;border:1px solid #000;font-weight: bold;padding:3px;">{{$get_day_count_fpl}}</td>
                                                <td style="width:80%;border:1px solid #000;font-weight: bold;padding:3px;white-space: nowrap;">PLANS FILED VIA WEBSITE</td>
                                            </tr>
                                            <tr>
                                                <td style="width:20%;border:1px solid #000;font-weight: bold;padding:3px">{{$get_fpl_count_by_app}}</td>
                                                <td style="width:80%;border:1px solid #000;font-weight: bold;padding:3px;white-space: nowrap;">PLANS FILED VIA APP</td>
                                            </tr>
                                            <tr>
                                                <td style="width:20%;border:1px solid #000;font-weight: bold;padding:3px">{{ $get_day_count_fpl - $get_cancel_fpl_count }}</td>
                                                <td style="width:80%;border:1px solid #000;font-weight: bold;padding:3px;white-space: nowrap;">ACTIVE PLANS</td>
                                            </tr>
                                            <tr>
                                                <td style="width:20%;border:1px solid #000;font-weight: bold;padding:3px">{{$get_cancel_fpl_count }}</td>
                                                <td style="width:80%;border:1px solid #000;font-weight: bold;padding:3px;white-space: nowrap;">CANCELLED PLANS</td>
                                            </tr>
                                        </table>

                                        <table style="border:1px solid #000;border-collapse: collapse;width: 46%;float:left;margin-left:8%;">
                                            <tr>
                                                <td style="width:20%;border:1px solid #000;font-weight: bold;padding:3px">{{$navlog_plans}}</td>
                                                <td style="width:80%;border:1px solid #000;font-weight: bold;padding:3px;white-space: nowrap;">NAV LOG PLANS</td>
                                            </tr>
                                            <tr>
                                                <td style="width:20%;border:1px solid #000;font-weight: bold;padding:3px;">{{$whether_plans}}</td>
                                                <td style="width:80%;border:1px solid #000;font-weight: bold;padding:3px;white-space: nowrap;">Wx NOTAMS PLANS</td>
                                            </tr>
                                            <tr>
                                                <td style="width:20%;border:1px solid #000;font-weight: bold;padding:3px">{{($get_day_count_fpl - $get_cancel_fpl_count) - $navlog_plans - $whether_plans}}</td>
                                                <td style="width:80%;border:1px solid #000;font-weight: bold;padding:3px;white-space: nowrap;">ADC PLANS</td>
                                            </tr>
                                            <tr>
                                                <td style="width:20%;border:1px solid #000;font-weight: bold;padding:3px">{{$adc_time_diff}}</td>
                                                <td style="width:80%;border:1px solid #000;font-weight: bold;padding:3px;white-space: nowrap;">ADC DELAYED PLANS</td>
                                            </tr>
                                            <tr>
                                                <td style="width:20%;border:1px solid #000;font-weight: bold;padding:3px">{{$changed_count}}</td>
                                                <td style="width:80%;border:1px solid #000;font-weight: bold;padding:3px;white-space: nowrap;">FPL REVISED PLANS</td>
                                            </tr>
                                        </table>

                                        <table style="border:1px solid #000;border-collapse: collapse;width: 46%;float:left;margin-top:30px;">
                                            <tr>
                                                <td style="width:20%;border:1px solid #000;font-weight: bold;padding:3px">{{$fixed_wing_total_plans}}</td>
                                                <td style="width:80%;border:1px solid #000;font-weight: bold;padding:3px;white-space: nowrap;">TOTAL FIXED WING PLANS</td>
                                            </tr>
                                            <tr>
                                                <td style="width:20%;border:1px solid #000;font-weight: bold;padding:3px;">{{$fixed_wing_plans}}</td>
                                                <td style="width:80%;border:1px solid #000;font-weight: bold;padding:3px;white-space: nowrap;">ACTIVE FIXED WING PLANS</td>
                                            </tr>
                                            <tr>
                                                <td style="width:20%;border:1px solid #000;font-weight: bold;padding:3px">{{$fixed_wing_cancelled_plans}}</td>
                                                <td style="width:80%;border:1px solid #000;font-weight: bold;padding:3px;white-space: nowrap;">CANCELLED FIXED WING PLANS</td>
                                            </tr>
                                        </table>

                                        <table style="border:1px solid #000;border-collapse: collapse;width: 46%;float:left;margin-left:8%;margin-top:30px;">
                                            <tr>
                                                <td style="width:20%;border:1px solid #000;font-weight: bold;padding:3px">{{$helicopter_total_plans}}</td>
                                                <td style="width:80%;border:1px solid #000;font-weight: bold;padding:3px;white-space: nowrap;">TOTAL HELICOPTER PLANS</td>
                                            </tr>
                                            <tr>
                                                <td style="width:20%;border:1px solid #000;font-weight: bold;padding:3px;">{{$helicopter_plans}}</td>
                                                <td style="width:80%;border:1px solid #000;font-weight: bold;padding:3px;white-space: nowrap;">ACTIVE HELICOPTER PLANS</td>
                                            </tr>
                                            <tr>
                                                <td style="width:20%;border:1px solid #000;font-weight: bold;padding:3px">{{$helicopter_cancelled_plans}}</td>
                                                <td style="width:80%;border:1px solid #000;font-weight: bold;padding:3px;white-space: nowrap;">CANCELLED HELICOPTER PLANS</td>
                                            </tr>                                            
                                        </table>
                                        <table><tr><td></td></tr></table>
                                        <h4 style="text-align: center;font-family: monospace">ADC DELAYED PLANS</h4>
                                        <table style="border:1px solid #000;border-collapse: collapse;width: 99%;margin-top:9px;">
                                            @foreach($adc_delay_text as $adc_delay_value)
                                            <tr>
                                                <td style="width:16%;border:1px solid #000;font-weight: bold;padding:3px">{!!$adc_delay_value!!}</td>
                                            </tr>         
                                            @endforeach              
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
