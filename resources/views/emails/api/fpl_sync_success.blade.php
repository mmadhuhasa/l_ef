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
                                        <span style="color:white;font-family: monospace; text-transform: uppercase"><span  style="text-transform: capitalize;">{!!$subject!!}</span>                                        
                                    </h1>
                                    <div align="left" style="width: 97.5%;
                                         padding-top: 10px;
                                         border-radius: 5px;">
                                         <?php
                                         date_default_timezone_set('Asia/Kolkata');
                                         $current_date = date('d-M-Y');
                                         $current_time = date('H:i:s');
                                         $current_date2 = strtotime(date('d-M-Y'));
                                         ?>
                                        <p style="font-size:15px ;font-family: monospace;color: black;">
                                            EFLIGHT.CO.IN website updated on 
                                            {{date('d-M-Y')}}.
                                        </p>
                                                                  
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
