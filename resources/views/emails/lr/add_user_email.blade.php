@extends('emails.layout')
@section('container')
<table border="0" cellpadding="0" cellspacing="0" width="100%"  >
    <tr>
        <td>
            <table border="0" width="600" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="color:#333333 !important; font-size:20px; font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;padding-left:10px;" height="40">
                        <div align="center" style="font-size:15px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">
                            <div align="left" style="width: 710px;
                                 margin: auto;
                                 background-color: #e9e9e9;
                                 border-radius: 10px;
                                 padding: 1px;">
                                <div align="center">
                                    <h1 align="left" style="font-size: 16px;letter-spacing: -1px;word-spacing: -1px;
                                        font-weight: normal;
                                        width: 95%;
                                        font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;
                                        background:linear-gradient(to bottom,#a6a6a6 0%,#555555 50%,#a6a6a6 100%); color: #fff;
                                        border-radius: 8px;
                                        padding: 10px;height: 15px;line-height: 0.8;margin:8px;">
                                        <?php 
                                        $subject = str_replace(" ", "&nbsp;&nbsp;&nbsp;", $subject);
                                        ?>
                                        <span style="color:white;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;text-transform: uppercase;">{{$subject}}</span>                                        
                                    </h1>
                                    <div align="left" style="width: 95%;
                                         padding: 9px;
                                         background-color: white;
                                         border-radius: 10px;">
                                        <p style="font-size:15px ;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;color: black;margin:0;">
                                            Dear {{$user_name}},<br><br>
                                            EFLIGHT is India’s # 1 Trip Support Company and our Value Added Software for License Reminder is now available to You with below credentials.
                                            Dedicated to Business & General Aviation Pilots, EFLIGHT as even launched the License Reminder service on iOS & Android APP. <br/><br/>
                                            For any further queries on Your Account, contact Your Admin or feel free to get in touch with us thru email or Phone
                                            <br><br>
                                            <a href="https://www.eflight.aero">www.eflight.aero</a>
                                            Username:{{$mobile_number}}<br>
                                            Password:{{$password}}<br><br>

                                            Note; For Security Reasons, the above Password will be active only for 1st 
                                            time login and it is advisable to change Password to Your choice.
                                            <br>
                                        </p>
                                        <p style="font-size:15px ;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;color: black;">
                                            <span style="color: #404040;">						
                                                {!!$entered_by2!!} {!!$entered_date2!!} {!!$entered_time2!!} 						
                                                <br/><br>					
                                            </span>                                           
                                        </p>
                                        <p style="font-size:15px ;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;color: black;">
                                            <span style="color: #404040;">						
                                                Thanks & Regards, <br/> <br/> 
                                                <span style="color: red"> TEAM EFLIGHT </span><br/> 
                                                (+91) 9449485515<br/> 
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
