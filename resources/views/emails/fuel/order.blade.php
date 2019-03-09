@extends('emails.layout')
@section('container')
<style>
.wrapper{
    max-width:62%;
    margin: 0 auto;
}
@media only screen and (min-width : 320px) and (max-width : 767px) {
.wrapper{
    max-width:100%;
    margin: 0 auto;
}
}
</style>
<div class="wrapper" style="background:#edf0f3;padding: 5px 15px 5px 15px;">
<table border="0" cellpadding="0" cellspacing="0" width="100%"  >
    <tr>
        <td>
            <table border="0" width="600" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="color:#333333 !important; font-size:20px; font-family: 'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif; padding-left:2px;" height="40">
                        <div align="center" style="font: 14px normal 'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">
                            <?php $width = "732px"; ?>
                            <div align="left" style="width: <?php echo $width; ?>;
                                 margin: auto;
                                 background-color: #edf0f3;
                                 border-radius: 5px;
                                 padding: 5px;line-height: 24px">
                                <div align="center">
                                    <h1 align="left" style="font-size: 18px;
                                        font-weight: normal;
                                        width: 95%;
                                        background-color:#f1292b;filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f1292b', endColorstr='#f37858');background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858)); /* for webkit browsers */
                                        background: -moz-linear-gradient(top, #f1292b, #f37858); color: #fff;
                                        border-radius: 5px;
                                        padding: 10px;">
                                        <span style="color:white;font-family: 'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">FUEL ORDER</span>                                        
                                    </h1>
                                    <div align="left" style="width: 95%;
                                         padding: 5px;
                                         /*border: 2px dashed #c2c2c2;*/
                                         background-color: white;
                                         border-radius: 5px;">
                                        <p style="font-size:15px ;font-family: 'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;color: black;">
                                            Greetings from <span style="color: red;font-weight: bold">EFLIGHT</span>,<br/><br/>

                                            <span style="font-weight: bold">{{$fuel_required}} Litres of JET-A1 </span> fuel is required for <span style="font-weight: bold">{{$registration}} ({{$operator}})</span> at <span style="font-weight: bold">{{$departure_aerodrome}} ({{$city}})</span> for <span style="font-weight: bold">{{$dept}}</span> IST departure time on <span style="font-weight: bold">{{$date_of_flight}}</span>.
                                            <br/><br/>
                                            Kindly inform airport station manager to do the needful and bill it under <span style="color: red;font-weight: bold">EFLIGHT</span> account. 
                                        </p><br/>
                                        <p style="font-size:15px ;font-family: 'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif; color: black;">
                                            <span style="color: #404040;">			 			
                                                Thanks, <br/> <br/> 
                                                <span style="color: red;font-weight: bold"> TEAM EFLIGHT </span><br/> 
                                                <span style="font-weight: bold">(+91) 9886454717  </span>  <span style="color: red;font-weight: bold"> (Prem)</span><br/> 
                                                <span style="font-weight: bold">(+91) 9449485515  </span>  <span style="color: red;font-weight: bold"> (24 x 7 SUPPORT)</span><br/> 
                                            </span>                                           
                                        </p>
                                        <br/>
                                        <p style="font-size:15px ;font-family: 'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif; color: black;">
                                            <span style="color: #404040;">						
                                                <span style="font-weight: bold">Order by:</span> {!! $entered_by !!} <span style="font-weight: bold;padding-left: 15px;">Order date:</span>{!!$entered_date !!} <span style="font-weight: bold;padding-left: 15px;">Order time:</span>{!! $entered_time !!} 						
                                                <br/>					
                                            </span>                                           
                                        </p><br/>
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
</div>
@stop
