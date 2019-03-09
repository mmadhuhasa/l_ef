@extends('emails.layout')
@section('container')
<table border="0" cellpadding="0" cellspacing="0" width="100%"  >
    <tr>
        <td>
            <table border="0" width="600" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="color:#333333 !important; font-size:20px; font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;" height="40">
                        <div align="center" style="font: 14px normal monospace;">

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
                                        <span style="color:white;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">Payment Success</span>                                        
                                    </h1>
                                    <div align="left" style="width: 95%;
                                         padding: 5px;
                                         /*border: 2px dashed #c2c2c2;*/
                                         background-color: white;
                                         border-radius: 5px;">
                                        <div style="font-size:15px ;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">
                                        <table style="width:100%;margin-bottom:10px;margin-top:10px;">
                                            <tr style="width:100%;">
                                                <td style="font-size:17px;padding-bottom: 9px">Greetings from <span style="color:#f1292b;font-weight:bold;">EFLIGHT</span>,</td>
                                            </tr><tr><td></td></tr>
                                        </table>
                                        <table style="width:100%;margin-bottom:10px;margin-top:5px;">
                                            <tr style="width:100%;">
                                                <td style="font-size:17px;line-height: 1.5;">Your corporate credit card <span>XXXX XXXX XXXX </span>
                                                    <span style="font-weight:bold;">1234 </span>has been charged <span style="color:#f1292b;font-weight:bold;">RS. {{$order_amount}} </span><span style=" color: #59595d;font-style: italic;">({{$words}}) </span>towards {{$type}} order <span style="font-weight:bold;color:#0040ff;">{{$typefirst}}-MAR10-10001-AVS </span>and details of the order can be found in the attachment.</td>
                                            </tr>
                                        </table>
                                        <table style="width:100%;margin-bottom:50px;margin-top:5px;">
                                            <tr style="width:100%;">
                                                <td style="font-size:17px;line-height: 1.5;">Thanks once again for giving us the opportunity to serve you. In case you need any further clarification, please do get in touch with <span style="font-weight:bold;">India's # 1 Trip Support company.</span></td>
                                            </tr>
                                        </table>
                                        <table style="width:100%;margin-bottom:20px;">
                                            <tr style="width:100%;">
                                                <td style="font-size:17px;">Thanks,</td>
                                            </tr>
                                        </table>
                                        <table style="width:100%;">
                                            <tr style="width:100%;">
                                                <td style="font-size:18px;font-weight:bold;">Team <span style="font-weight:bold;color:#f1292b;">EFLIGHT</span></td>
                                            </tr>
                                        </table>
                                        <table style="width:100%;margin-bottom:10px;">
                                            <tr style="width:100%;">
                                                <td style="font-size:18px;font-weight:bold;">(+91)9886454717</td>
                                            </tr>
                                        </table>
                                        <hr style="border-top: 2px dashed #8c8b8b;border-bottom:0px;">
                                        <table style="width:100%;margin-bottom:50px;">
                                            <tr style="width:100%;">
                                                <td align="left" style="font-size:18px;font-style:italic;color: #59595d;">Ordered from IP: <span>{{$ipaddress}}</span></td>
                                                <td align="right" style="font-size:18px;font-style:italic;color: #59595d;">By: <span>{{$user_name}}</span></td>
                                            </tr>
                                        </table>
                                        </div>
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
