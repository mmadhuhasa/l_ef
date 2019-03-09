@extends('emails.layout')
@section('container')
<table border="0" cellpadding="0" cellspacing="0" width="100%"  >
    <tr>
        <td>
            <table border="0" width="600" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="color:#333333 !important; font-size:20px; font-family: monospace; padding-left:2px;" height="40">
                        <div align="center" style="font: 14px normal monospace;">
                           @if(isset($is_app))
			    <?php $width = "800px;"; ?>
			    @else
			    <?php $width = "800px;"; ?>
			    @endif
                            <div align="left" style="width: <?php echo $width; ?>;
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
                                        <span style="color:white;font-family: monospace">Revised Time</span>                                        
                                    </h1>
                                    <div align="left" style="width: 95%;
                                         padding: 5px;
                                         /*border: 2px dashed #c2c2c2;*/
                                         background-color: white;
                                         border-radius: 5px;">
                                        <p style="font-size:15px ;font-family: monospace;color: black;font-weight: bold;">
                                            {!!$revice_time_heading!!}<br/>
					</p>
					<p style="font-size:15px ;font-family: monospace;color: black;">
					    <span style="color: #404040;">					
						{!!$revised_by!!} {!!$revised_date!!} {!!$revised_time!!}
						@if(isset($is_app))
						@if(isset($via))
						{!! $via !!}
						@endif
						@endif
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
