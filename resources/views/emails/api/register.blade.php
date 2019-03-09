@extends('emails.layout')
@section('container')
<table border="0" cellpadding="0" cellspacing="0" width="100%"  >
    <tr>
        <td>
            <table border="0" width="600" cellpadding="0" cellspacing="0" style="font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">
                <tr>
                    <td style="color:#333333 !important; font-size:20px; font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif; padding-left:10px;" height="40">
                        <div align="left" style="font-size:14px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">
                            <div  style="width: 700px;                                
				  background-color: #eaeaea;
				  border-radius: 10px;
				  padding: 5px;">
                                <div align="left">
                                    <h1 align="left" style="font-size: 18px;
                                        font-weight: normal;
                                        width: 95%;
                                        background-color:#f1292b;filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f1292b', endColorstr='#f37858');background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858)); /* for webkit browsers */
                                        background: -moz-linear-gradient(top, #f1292b, #f37858); color: #fff;
                                        border-radius: 8px;
                                        padding: 10px;">
                                        <span style="color:white;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">New Sign Up Details</span>                                        
                                    </h1>
                                    <div align="left" style="width: 95%;
                                         padding: 9px;
                                         border: 2px dashed #c2c2c2;
                                         background-color: white;
                                         border-radius: 10px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">
					 <?php
					 $current_date = date('d-M-Y');
					 $current_time = date('H:i:s');
					 ?>
					
                                        <p style="font-size:15px ;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;color: black;">
					    Greetings!<br/>
                                        <p style="font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif; text-align: justify;">
					    We are happy that you have decided to join India’s # 1 Flight Planning & Trip Support Company that is used by over 40 Fixed Wing Aircraft & 25 Helicopters to file on an average of 110 Plans a Day!!! <br/>
					    Based on your Subscription plan, you will be able to use our Patented All-in-One Software for;
					    <br/><br/>
					    <strong>ONLINE FLIGHT PLAN with FIC-ADC via SMS </strong><br/>
					    <strong>NOTAMS & WEATHER Report </strong><br/>
                                            <strong>FDTL for Domestic & International Flights</strong> <i>(Fixed Wing-Helicopter-Cabin Crew)</i><br/>
                                            <strong>NAV LOG with precise Fuel Burn </strong><i>(CFP)</i><br/>
                                            <strong>LOAD TRIM</strong> <i>(as per DGCA approved format)</i>					     
					</p>
					<p style="font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif; text-align: justify;">
                                            <span style="font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif; text-align: justify;">Here's your account information that has been activated with us:</span><br/><br/>
					<a href="www.eflight.aero" style="color: red;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif; font-style: italic;">www.eflight.aero</a><br/>
                                        <span style="font-style:italic;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">Username: {{$mobile_number}}
					@if(isset($pass))
					@if($password)
					<br/> 
					Password: {!!$pass!!}
					 <br/>
					@endif
					@else
					<br/>
					@endif
					Email ID: {{$email}} <br/>
					Operator: {!!$operator!!}<br/> 
					@if(isset($user_callsigns))
					@if($user_callsigns)
					Aircraft: {!!$user_callsigns!!}
					@endif
					@endif
                                        </span>
					</p>
                                        <p style="font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif; text-align: justify; font-weight: bold;">
					    Our 24 x 7 Dispatch Support Team can be contacted for FPL assistance even by SMS or WhatsApp at;
					    +91 9449485515/ +91 8861660160 or ops@eflight.aero & support@eflight.aero <br/><br/>

                                            <span style="font-weight:normal;">Download iOS or Android APP for a FREE 30-Day Trial with No Obligation & Zero Cancellation Fee for;</span>
					    <br/><br/>
					    <strong>Fuel with HP & BP</strong><br/>
					    <strong>Ground Handling at any Indian Airport</strong><br/>
					    <strong>4 & 5 Star Hotel Rooms at Corporate Rate</strong><br/>
					    <strong>Landing, Parking & Navigation Bills</strong><br/>
					    <strong>Pre or Post Flight Medical Check at any Indian Airport</strong>				 
					</p>
					 
					<p style="font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">
					    Do feel free to contact us if you need any further assistance/ information.
					     <br/><br/><br/>

					    Happy Filing,<br/><br/>
					    Team <strong style="color: red">EFLIGHT</strong>
					</p>
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
