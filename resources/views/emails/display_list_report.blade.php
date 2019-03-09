

<style type="text/css">
    .notam-strip{
        width: 100%;
        margin: 0px 0px;
        padding: 7px 7px;
        color: #000 !important;
        /*float: left;*/
        border-radius: 0px;
        font-size: 12px;
        font-family: courier;
        background: #fff;
        margin-right: 0;
        border-bottom: 1px solid #ccc;
        border-top: 1px solid #ccc;
        page-break-inside: avoid;
        white-space: pre-line;

    }
    .notam-strip:nth-child(1) {
        border: 0;
    }
    /*.notam-strip:nth-child(7n) {
        border-bottom: 1px solid #ccc;
        padding: 0px 7px !important ;
        border-radius: 0px;
    }
    
    .notam-strip:nth-child(8n) {
        page-break-before: always;
        border-top: 1px solid #ccc;
        padding: 0px 7px !important ;
        border-radius: 0px;
    }*/
    .notam-strip:last-child(1) {
        border-bottom: 0;
    }
    .to-date{
        text-align: right;
    }
    .margin-0{
        margin: 0;
    }
    .margin-b-5{
        margin-bottom: 5px;
    }

    .desc{
        text-align: justify;
        font-weight: bold;
        font-size: 13px;
        line-height: 1.2;
        margin-top:5px !important; 
    }
    .time-strip{
        margin-top: 5px !important;
    }
    .container-notam{
        background: #fff ;
        margin-bottom: 15px;
        /*width: 825px !important;*/
    }
    body{
        background: #fff !important;
        color: #000 !important;
    }

    .aerodrome_name{
        background:#fff;
        padding-left: 21px;
        color: #000 !important;
        border-radius: 5px;
        font-family: courier;
        font-style: bold !important;
        text-align: center;
        font-size: 15px;
        clear: both;
        border-top:1px solid #ccc; 

    }
    .aerodrome_name:nth-child(1){
        border-top: 0 !important;
        border-bottom:1px solid #ccc; 
    }
    .qline{
        margin-left: 10px;
    }
    .col{
        width: 21%;
    }
    .p-lr-15{
        padding-left: 15px;
        padding-right: 15px;
    }
    .form-control{
        border: 1px solid #999 !important;
        border-radius: 4px !important;
    }

    .input-group-addon{
        top: 0px;
        right: 0;
    }
    .p-t-10{
        padding-top: 10px;
    }
    .page{
        border: 1px solid #ccc;
        page-break-inside: avoid;
    }
    .header,
    .footer {
        width: 100%;
        text-align: center;
        position: fixed;
        color: #000 !important;
    }
    .header {
        top: 0px;
        color: #000 !important;
        width: 100%;
        font-size: 11px;
    }
    .header:after {
        display: none;
    }
    .footer {
        bottom: 0px;
        font-size: 12px;
        font-weight: normal;
    }
    .pagenum:before {
         /*content: counter(page) " of " counter(pages);*/
        content: "Page " counter(page);
    }
    .pagenum{
        color: #000 !important;
    }
    .align-right{
        text-align: right;
        width: 50%;
        display: inline-block;
    }
    .align-left{
        text-align: left;
        width: 50%;
        display: inline-block;
    }
    .page-break{
        page-break-before: always;
    }    
</style>


<div class="page">
    <main>

        <section class="bg-1 welcome infopage" style="background: #fff !important;">
            <div class="container container-notam">

                <div class="row">
                    <div class="wheather_sec " >		    
                        <!--  <div class="p-l-15  aerodrome_name" >
                           <span style="font-weight:bold !important;">  {{strtoupper($airport)}} </span> <span class="p-l-25" style="font-weight:bold !important;">{{count($notams_array)}} NOTAMS {{$headerText }} </span>
                         </div> --> 
                        <!-- <div > -->
                            <?php
                            $i=0;
                            ?>
                            @foreach ($notams_array as $key)
                            @if(count($key['result'])!=0) 
                            @if($i==0)
                            <div class="p-l-15  aerodrome_name p-t-10" >
                                <span style="font-weight:bold !important;">  {{strtoupper($key['airport'])}} </span> <span class="p-l-25" style="font-weight:bold !important;">{{count($key['result'])}} NOTAMS {{$headerText }} </span>
                            </div>
                            @else
                            <div class="p-l-15  aerodrome_name p-t-10 " >
                                <span style="font-weight:bold !important;">  {{strtoupper($key['airport'])}} </span> <span class="p-l-25" style="font-weight:bold !important;">{{count($key['result'])}} NOTAMS {{$headerText }} </span>
                            </div>
                            @endif 
                            @endif 
                            @foreach ($key['result'] as $val) 
                            @if($val['line_count']==1000 || $val['no_of_rows'] >100)
                            <div class="notam-strip page-break" >
                            @else
                            <div class="notam-strip" >
                            @endif    
                                {!! explode("E)",$val['raw_data'])[0] !!}
                                E) {!! $val['description'] !!}
                                @if($val['height'])
                                <br/>
                                F) {!! $val['height'] !!} G) {!! $val['level'] !!}  
                                @endif
                            </div>
                            @if($val['line_count']==0 || $val['no_of_rows'] >10 || $val['sl_no']==1)
                            <div class="footer">
                                <span class="pagenum"></span> <!-- of <span>{!! $total_page_number !!} --></span>
                            </div>
                            @endif
                            @endforeach
                            <?php
                                $i++;
                            ?>
                            @endforeach

                        </div>		
                    </div>
                </div>

            </div>


        </section>
    </main>   


</div>
