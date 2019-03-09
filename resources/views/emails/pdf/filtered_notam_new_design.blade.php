

<style type="text/css">
.footer{
    position: absolute;
    width: 100%;
    height: 10px;
    background: #fff;
    color: #000;
    bottom: 10px;
}
.footer:after {
    counter-increment: page;
    content:"Pagese " counter(page);
    left: 0; 
    top: 100%;
    white-space: nowrap; 
    z-index: 20px;
    -moz-border-radius: 5px; 
    -moz-box-shadow: 0px 0px 4px #222;  
    background-image: -moz-linear-gradient(top, #eeeeee, #cccccc);  
    background-image: -moz-linear-gradient(top, #eeeeee, #cccccc);  
  }
    .notam-no{
        font-family: monospace !important;
        display: inline-block;
        width: 30%;
    }
    .category{
        font-family: monospace !important;
        width: 68%;
        display: inline-block;
        text-align: right;
    }
    .desc{
        font-family: monospace !important;
        width: 100%;
        white-space: pre-line;
        font-weight: normal;
        font-size: 13px;
        color: #000;
        padding-top: 20px;

    }
    .notam-strip{
        font-family: monospace !important;
        width: 100%;
        border-bottom:1px dotted #000;
        border-radius: 0px;
        font-size: 13px;
        padding: 5px;
        margin: 2px 0px;
        color: #000;
    }
    .wheather_sec{
        font-family: monospace !important;
        font-weight: normal;

        /*border:1px solid #d5d5d5;*/
    }
    .aerodrome_name {
        padding: 4px;
        background: #eee;
        /*border-radius: 5px 5px 1px 1px;*/
        clear: both;
        color: #000;
        font-weight: bold;
        font-size: 13px;
    }
    .to-date{
        font-family: monospace !important;
        margin: 2px 0;
        text-transform: uppercase;
    }
    .date-section{
        margin-top: 5px !important;
        margin-bottom: 0px !important;
    }
    .pdf-heading{
        font-weight: bold;
        text-align: center;
        border:2px solid #000;
        border-bottom:0px solid #000;
        background: #f1f1f1;
    }
    .pdf-field-row{

        border-left:2px solid #000;
        border-right:2px solid #000;
        /*border-bottom:2px solid #000;*/
    }
    .callsign{
        width: 25%;
        display: inline-block;
        padding-left: 5px;
        border-top:2px solid #000;
        border-right:2px solid #000;
        border-bottom:0px;
        margin-right: -10px;
    }
    .aerodrome{
        width: 15%;
        display: inline-block;
        padding-left: 5px;
        border-top:2px solid #000;
        border-right:2px solid #000;
        border-bottom:0px;
        margin-right: -10px;
    }
    .altn2{
        width: 31% !important;
        display: inline-block;
        padding-left: 5px;
        border-top:2px solid #000;
        border-right:2px solid #000;
        border-bottom:0px;
        margin-right: -10px;
    }
    .dateofflight{
        width: 41.8%;
        display: inline-block;
        padding-left: 5px;
        border-top:2px solid #000;
        border-right:0px solid #000;
        border-bottom:0px;
    }
    .fir{
        width: 41.5%;
        display: inline-block;
        padding-left: 5px;
        border-top:2px solid #000;
        border-right:0px solid #000;
        border-bottom:0px;
    }
    .pdf-value{
        font-weight: bold;
        text-transform: uppercase;
    }

    .pdf-information{
        font-size: 14px;
        border:2px solid #000;
        text-align: center;
        padding:1px 0px; 
    }
    .pdf-information2{
        font-size: 14px;
        border:2px solid #000;
        border-top:0px solid #000;
        text-align: center;
        padding:1px 0px; 
    }
    .margin-b-15{
        margin-bottom: 15px;
    }
    .heading-label{
        margin-top:5px !important; 
        margin-bottom:0px !important; 
    }
    .to-label{
        text-transform: lowercase;
    }
    body{
        margin: 0px !important;
    }
</style>


<div class="page">
    <main>

        <section class="bg-1 welcome infopage" style="background: #fff !important;">
            <div class="container container-notam">

                <div class="row">
                    <div class="wheather_sec " > 
                        @if($type=='package')           
                        <div class="pdf-heading">
                            <p class="heading-label"> AIRPORT AUTHORITY OF INDIA </p>
                            <p class="heading-label"> PRE-FLIGHT INFORMATION BULLETIN </p>
                        </div>
                        <div class="pdf-field-row">
                            <div class="callsign">
                                CALLSIGN: <span class="pdf-value">{!! $callsign !!}</span>
                            </div>
                            <div class="aerodrome">
                                FROM: <span class="pdf-value">{!! $airportCodesArr[0] !!}</span>
                            </div>
                            <div class="aerodrome">
                                TO: <span class="pdf-value">{!! $airportCodesArr[1] !!}</span>
                            </div>
                            <div class="dateofflight">
                                DATE OF FLIGHT: <span class="pdf-value">{!! $dof !!}</span>
                            </div>
                        </div>

                        <div class="pdf-field-row">
                            <div class="callsign">
                                ALTN 1: <span class="pdf-value">@if(isset($airportCodesArr[2]) && $airportCodesArr[2][3]!="F") {!! $airportCodesArr[2] !!} @endif</span>
                            </div>
                            <div class="altn2">
                                ALTN 2: <span class="pdf-value">@if(isset($airportCodesArr[3]) && $airportCodesArr[3][3]!="F"){!! $airportCodesArr[3] !!}@endif</span>
                            </div>
                            <div class="fir">
                                FIR:  <span class="pdf-value">@if(!empty($airportCodesArr[4]))@if(isset($airportCodesArr[2]) && $airportCodesArr[2][3]=="F"){!! $airportCodesArr[2] !!},@endif @if(isset($airportCodesArr[3]) && $airportCodesArr[3][3]=="F"){!! $airportCodesArr[3] !!},@endif {!! $airportCodesArr[4] !!}@if(!empty($airportCodesArr[5])),{!! $airportCodesArr[5] !!} @endif  @elseif(isset($airportCodesArr[3]) && $airportCodesArr[3][3]=="F")@if(isset($airportCodesArr[2]) && $airportCodesArr[2][3]=="F"){!! $airportCodesArr[2] !!},@endif{!! $airportCodesArr[3] !!}@endif</span>
                            </div>
                        </div>
                        <div class="pdf-information">
                            <i>Bulletin contents: General purpose/OPSIG/Immediate attention, AD, NAV Warnings
                            </i>
                        </div>
                        <div class="pdf-information2 margin-b-15">
                            <i>En-Route, [ALL NAV-WARNINGS INCLUDED], [ALL MISCELLANEOUS INCLUDED]</i>
                        </div>
                        @endif
                        @foreach ($notams_array as $key) 
                        <div class="p-l-15  aerodrome_name p-t-10 " >
                            <span style="font-weight:bold !important;"> {{strtoupper($key['airport'])}} </span> - <span class="p-l-25" style="font-weight:bold !important;">{{count($key['result'])}} NOTAMS  </span> </span>
                        </div>

                        @foreach ($key['result'] as $val)
                        <div class="notam-strip" >
                            <div>
                                <div class="notam-no">
                                    {!! $val['notam_no'] !!} 
                                </div>
                                <div class="category">
                                    CATEGORY: {!! $val['decoded_qline'] !!} 
                                </div>
                            </div>

                            <div class="date-section">
                                <span class="to-date p-lr-0">  {!! $val['e_start_date_formatted'] !!}</span> 
                                @if($val['e_end_date_formatted']=='31-Dec-9999')
                                <span class="to-date p-lr-0"><span class="to-label">to</span> PERMANENT </span>
                                @else
                                <span class="to-date p-lr-0"><span class="to-label">to</span> {!! $val['e_end_date_formatted'] !!}</span>
                                @endif
                            </div>
                            @if( ($val['is_daily']  || $val['is_weekly']  || $val['is_date_specific'] ))
                            <div class=" col-sm-12  p-l-0 margin-0 margin-b-5 time-strip formatted-time" > 
                                @foreach($val['formatted_time'] as $time_val)
                                <div style="white-space: pre-line;display: inline-block;vertical-align: top;"> 
                                    {!! $time_val['time'] !!}
                                </div>
                                @endforeach
                            </div> 
                            @endif 
                            {{--@if($val['formatted_time'])<div class=" col-sm-12  p-l-0 margin-0 margin-b-5 time-strip" style="line-height: 1.3;">  {!! $val['formatted_time'] !!}  </div> @else <div class=" col-sm-12  p-l-0 margin-0 margin-b-5 time-strip" style="line-height: 1.3;"> TIME: {!! $val['time'] !!}  </div> @endif--}}
                            <div class=" margin-0 margin-b-5 height-strip">
                                @if($val['height'])
                                <div> HEIGHT: {!! $val['height'] !!} ALTITUDE: {!! $val['level'] !!}</div>  
                                @endif  
                            </div>
                            <div class="desc">
                                {!! $val['description'] !!} 
                            </div>
                        </div>
                      
                        @endforeach

                        @endforeach
 <!--  <div class="footer">
                            
                        </div> -->

                    </div>      
                </div>
            </div>

            </div>


        </section>
    </main>   


</div>
