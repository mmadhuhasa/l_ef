

<style type="text/css">
    @font-face {
        font-family: 'pt_sansregular';
        src: url('https://www.eflight.aero/app/fonts/pts55f-webfont.eot');
        src: url('https://www.eflight.aero/app/fonts/pts55f-webfont.eot?#iefix') format('embedded-opentype'),
            url('https://www.eflight.aero/app/fonts/pts55f-webfont.woff2') format('woff2'),
            url('https://www.eflight.aero/app/fonts/pts55f-webfont.woff') format('woff'),
            url('https://www.eflight.aero/app/fonts/pts55f-webfont.ttf') format('truetype'),
            url('https://www.eflight.aero/app/fonts/pts55f-webfont.svg#pt_sansregular') format('svg');
        font-weight: normal;
        font-style: normal;

    }
    .notam-no{
        font-family: monospace !important;

        display: inline-block;
        width: 30%;
    }
    .category{
        font-family: monospace !important;

        width: 69%;
        display: inline-block;
        text-align: right;
    }
    .desc{
        font-family: monospace !important;

        width: 100%;
        white-space: pre-line;
        font-weight: bold;
        font-size: 13px;
        margin: 2px 0;
        color: #000;


    }
    .notam-strip{
        font-family: monospace !important;

        width: 100%;
        border:1px solid #d5d5d5;
        border-radius: 5px;
        font-size: 12px;
        padding: 5px;
        margin: 2px 0px;
        color: #333;
    }
    .wheather_sec{
        font-family: monospace !important;
        font-weight: normal;

        /*border:1px solid #d5d5d5;*/
    }
    .aerodrome_name {
        padding: 4px;
        background: #333;
        border-radius: 5px 5px 1px 1px;
        clear: both;
        color: #fff;
        font-weight: bold;
        font-size: 14px;
    }
    .to-date{
        font-family: monospace !important;
        margin: 2px 0;
        text-transform: uppercase;
    }
    .date-section{
        margin-top: 15px !important;

    }
</style>


<div class="page">
    <main>

        <section class="bg-1 welcome infopage" style="background: #fff !important;">
            <div class="container container-notam">

                <div class="row">
                    <div class="wheather_sec " >            

                        <?php
                        $i = 0;
                        ?>

                        @foreach ($data['result'] as $val) 
                        @if($val['print_aerodrome']=='true')
                        <div class="p-l-15  aerodrome_name p-t-10 " >
                            <span style="font-weight:bold !important;"> {!! $val['aerodrome'] !!}  ({!! $val['aerodrome_name'] !!}) {!! $val['aerodrome_notam_count_email'] !!} Notams  </span>
                        </div>
                        @endif
                        <div class="notam-strip" >
                            <div>
                                <div class="notam-no">
                                    {!! $val['notam_no'] !!} 
                                </div>
                                <div class="category">
                                    CATEGORY: {!! $val['decoded_qline'] !!} 
                                </div>
                            </div>
                            <div class="desc">
                                {!! $val['description'] !!} 
                            </div>
                            <div class="date-section">
                                <span class="to-date p-lr-0"> FROM: {!! $val['e_start_date_formatted'] !!}</span> 
                                @if($val['e_end_date_formatted']=='31-Dec-9999')
                                <span class="to-date p-lr-0">  TO: PERMANENT </span>
                                @else
                                <span class="to-date p-lr-0">  TO: {!! $val['e_end_date_formatted'] !!}</span>
                                @endif
                            </div>
                            @if( ($val['is_daily']  || $val['is_weekly']  || $val['is_date_specific'] ))
                            <div class=" col-sm-12  p-l-0 margin-0 margin-b-5 time-strip formatted-time" > TIME:
                                @foreach($val['formatted_time'] as $time_val)
                                <div style="white-space: pre-line;
        display: inline-block;
        vertical-align: top;"> 
                                    {!! $time_val['time'] !!}
                                </div>
                                @endforeach
                            </div> 
                            @endif 
                            {{--@if($val['formatted_time'])<div class=" col-sm-12  p-l-0 margin-0 margin-b-5 time-strip" style="line-height: 1.3;"> TIME: {!! $val['formatted_time'] !!}  </div> @else <div class=" col-sm-12  p-l-0 margin-0 margin-b-5 time-strip" style="line-height: 1.3;"> TIME: {!! $val['time'] !!}  </div> @endif--}}
                            <div class=" margin-0 margin-b-5 height-strip">
                                @if($val['height'])
                                <div> HEIGHT: {!! $val['height'] !!} ALTITUDE: {!! $val['level'] !!}</div>  
                                @endif  
                            </div>
                        </div>

                        @endforeach
                        <?php
                        $i++;
                        ?>

                    </div>      
                </div>
            </div>

            </div>


        </section>
    </main>   


</div>
