@extends('emails.layout')
@section('container')
<table border="0" cellpadding="0" cellspacing="0" width="100%"  >
    <tr>
        <td>
            <table border="0" width="700" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="color: #333333!important;font-size: 20px;font-family: 'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;border-top: 0;border: 11px solid #eee;border-top:0;" height="40">
                        <div align="center" style="font: 14px normal monospace; margin-bottom: 15px;">
                         
                                <div align="center">
                                    <h1 align="left" style="font-size: 16px;font-weight: normal;border: 11px solid #eee;background: linear-gradient(to bottom,#a6a6a6 0%,#555555 50%,#a6a6a6 100%);padding:5px;margin-top: 0;border-left: 0;border-right: 0;margin-bottom: 0;text-align: center;">
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
                                                    <th style="color:#000;border:1px solid #999; padding: 3px 5px;width:4%;">Sl</th>
                                                    <th style="color:#000;border:1px solid #999; padding: 3px 5px;width:20%;">Crew Name</th>
                                                    <th style="color:#000;border:1px solid #999; padding: 3px 5px;">License Name</th>
                                                    <th style="color:#000;border:1px solid #999; padding: 3px 5px;width:15%;">Date of expiry</th>
                                                    <th style="color:#000;border:1px solid #999; padding: 3px 5px;width:12%;">Days To Go</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <tr>
                                                    <td style="border:1px solid #999; padding: 3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">1</td>
                                                    <td style="border:1px solid #999; padding: 3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">SAICHARAN</td>
                                                    <td style="border:1px solid #999; padding: 3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">AIRLINE TRANSPORT PILOT LICENSE</td>
                                                    <td style="border:1px solid #999; padding: 3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">01-Apr-2018</td>
                                                    <td style="border:1px solid #999;font-weight:bold;padding:3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif; color:red;font-weight: bold;">-11</td>
                                                </tr>

                                                <tr>
                                                    <td style="border:1px solid #999; padding: 3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">1</td>
                                                    <td style="border:1px solid #999; padding: 3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">SAICHARAN</td>
                                                    <td style="border:1px solid #999; padding: 3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">AIRLINE TRANSPORT PILOT LICENSE</td>
                                                    <td style="border:1px solid #999; padding: 3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">01-Apr-2018</td>
                                                    <td style="border:1px solid #999;font-weight:bold;padding:3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif; color:red;font-weight: bold;">-11</td>
                                                </tr>

                                                <tr>
                                                    <td style="border:1px solid #999; padding: 3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">1</td>
                                                    <td style="border:1px solid #999; padding: 3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">SAICHARAN</td>
                                                    <td style="border:1px solid #999; padding: 3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">AIRLINE TRANSPORT PILOT LICENSE</td>
                                                    <td style="border:1px solid #999; padding: 3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">01-Apr-2018</td>
                                                    <td style="border:1px solid #999;font-weight:bold;padding:3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif; color:red;font-weight: bold;">-11</td>
                                                </tr>

                                                <tr>
                                                    <td style="border:1px solid #999; padding: 3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">1</td>
                                                    <td style="border:1px solid #999; padding: 3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">SAICHARAN</td>
                                                    <td style="border:1px solid #999; padding: 3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">AIRLINE TRANSPORT PILOT LICENSE</td>
                                                    <td style="border:1px solid #999; padding: 3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">01-Apr-2018</td>
                                                    <td style="border:1px solid #999;font-weight:bold;padding:3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif; color:red;font-weight: bold;">-11</td>
                                                </tr>

                                                <tr>
                                                    <td style="border:1px solid #999; padding: 3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">1</td>
                                                    <td style="border:1px solid #999; padding: 3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">SAICHARAN</td>
                                                    <td style="border:1px solid #999; padding: 3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">AIRLINE TRANSPORT PILOT LICENSE</td>
                                                    <td style="border:1px solid #999; padding: 3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">01-Apr-2018</td>
                                                    <td style="border:1px solid #999;font-weight:bold;padding:3px 5px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif; color:red;font-weight: bold;">-11</td>
                                                </tr>
                                                

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
