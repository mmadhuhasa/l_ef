@extends('emails.layout')
@section('container')
<table border="0" cellpadding="0" cellspacing="0" width="100%"  >
    <tr>
        <td>
            <table border="0" width="600" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="color:#333333 !important; font-size:20px; font-family: monospace; padding-left:10px;" height="40">
                        <div align="center" style="font: 15px normal monospace;">
                            <div align="left" style="width: 800px;
                                 margin: auto;
                                 background-color: #edf0f3;
                                 border-radius: 5px;
                                 padding: 5px;">
                                <div align="center">
                                    <h1 align="left" style="font-size: 18px;
                                        font-weight: normal;
                                        width: 95%;
                                        background-color:#f1292b;filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f1292b', endColorstr='#f37858');background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858)); /* for webkit browsers */
					background: -moz-linear-gradient(top, #f1292b, #f37858); color: #fff;
                                        border-radius: 5px;
                                        padding: 10px;">
                                        <span style="color:white;font-family: monospace;font-size:16px;">ATC FLIGHT PLAN DETAILS</span>                                        
                                    </h1>
                                    <div align="left" style="width: 95%;
                                         padding: 5px;
                                         /*border: 2px dashed #c2c2c2;*/
                                         background-color: white;
                                         border-radius: 5px;">
                                        <p style="font-size:15px ;font-family: monospace;color: black;">
                                            {!!strtoupper($fpl_info)!!}<br/><br/>
                                        <div class="text-center" style="font-family: monospace;"><b>SUPPLEMENTARY INFORMATION</b></div>
                                        <span style="color: #404040;font-family: monospace;">					 
                                            {!!strtoupper($supplementary_info)!!}
					    <br/><br/><br/>
                                        </span>
					<span  style="font-size:15px ;font-family: monospace;color: red;">
                                            <span style=color:#404040;font-weight:bold;>STATIONS ADDRESSED: </span>{!!$station_addresses_data!!}
					    <br/><br/><br/>
                                        </span> 
                                        <span style="color: black;font-family: monospace;">
					    <span style="font-weight:bold;color:#404040;">Filed By: </span>{!! $filed_by !!}
					    <span style="font-weight:bold;margin-left:18px;color:#404040;">Filed Date: </span>{!! $filed_date !!}
					    <span style="font-weight:bold;margin-left:18px;color:#404040;">Filed Time: </span>{!! $filed_time !!}
					    @if(isset($is_app) && $is_app !='')
						@if(isset($via))
						{!! $via !!}
						@endif
						@endif
					    <br/><br/><br/>
                                        </span>                                        

                                        <span style="font-size:13px ;font-family: monospace;color: black;">
                                            <b class="text-center">DISCLAIMER</b><br/><br/>
                                            1.   Information supplied by <span style="color: #f1292b;">EFLIGHT</span>  is purely advisory and not to be treated as actual briefing done at ARO.
                                            <br/><br/>                                          				                                      						
					    2.Flight Plan filed between <span style="color: #f1292b;">11pm to 6am</span> IST for departure timing falling before next day 6am IST will be better served by calling EFLIGHT Ops on
					     <span style="color: #f1292b;">(+91) 9449485515 </span>   
					</span>  
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
