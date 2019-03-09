

<div class="row" style="border: 0px solid #ccc;width:830px;padding: 0 0px;/* width: 100%;*/float: left;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;    background: #f9f9f9;
    border-radius: 5px;">
    <div class="row" style="border-bottom: 1px solid #ccc;background: -webkit-gradient(linear,left top,left bottom,from(#f1292b ),to(#f37858 )) !important;color: #fff;margin: 0 0 6px 0px;float: left;width: 100%;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;background:#f1292b;border-radius: 5px 5px 0 0;">
        <div class="col-xs-8" style="padding:10px 8px;font-weight: bold;padding-left: 15px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;position: relative;min-height: 1px;padding-right: 15px;float: left;width: 66.66666667%;">NEW NOTAM UPDATES</div>
        <div class="col-xs-4" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;position: relative;min-height: 1px;padding-right: 15px;padding-left: 15px;float: left;width: 33.33333333%;"></div>
    </div>
    @foreach ($data['result']  as $val) 
    @if($val['print_aerodrome']=='true')
    <div class="aerodrome_name" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 4px 4px 4px 15px;/* background: linear-gradient(to right, #a6a6a6 0%, #212121 50%, #a6a6a6 100%) !important ;*/ background: linear-gradient(to bottom,#a6a6a6 0%,#555555 50%,#a6a6a6 100%) !important;clear: both;color: #fff;font-weight: bold;font-size: 14px;margin-bottom: 0px;background:#212121;text-transform: uppercase;"> {!! $val['aerodrome_notam_count_email'] !!} Notam - {!! $val['aerodrome'] !!}  ({!! $val['aerodrome_name'] !!}) </div>
    @endif
    <div class="notam-strip row" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;width: 96%;margin: 7px 2%;padding: 7px 0px;border: 1px solid #d5d5d5;float: left;border-radius: 5px;font-size: 13px;font-family: monospace;background: #fff;font-style:italic;">
        <div>
            <div class="col-sm-5 margin-0 p-l-0" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin: 0;padding-left: 15px;position: relative;min-height: 1px;padding-right: 15px;width: 39.66666667%;float:left;font-style:normal;">

                <div class="p-l-0 col-sm-1" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding-left: 0px;position: relative;min-height: 1px;padding-right: 15px;font-weight: normal;"> {!! $val['notam_no'] !!}

                </div>  
            </div>  
            <div class="col-sm-7 p-r-0 margin-0 p-l-0" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin: 0;padding-left: 15px;padding-right: 0px;position: relative;min-height: 1px;width: 60.33333333%;float:right;">
                <span class="qline" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin-left: 10px;font-size: 13px;float: right;"><span ng-if="item.decoded_qline != 'NA'" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">@if($val['decoded_qline'] !='NA') CATEGORY: {!! $val['decoded_qline'] !!} @endif</span><span ng-if="item.decoded_qline == 'NA'" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">&nbsp;</span> <span ng-if="item.decoded_qline != 'NA'" ng-bind="item.decoded_qline" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></span>  </span>
            </div>
        </div>

        <div class="col-sm-12  margin-0 desc p-lr-0 " style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin: 0;padding-top: 15px;padding-bottom: 5px;padding-left:15px; padding-right: 15px;text-align: justify;font-weight: bold;font-size: 15px;line-height: 1.2;position: relative;min-height: 1px;width: 100%;margin-top: 5px !important;white-space: pre-line;font-style:normal;"> {!! $val['description'] !!}</div>  

        <div class="col-sm-12  p-r-0 margin-0 p-l-0" style="margin-top: 5px;line-height: 1.0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin: 0;padding-left: 15px;padding-right: 15px;position: relative;min-height: 1px;width: 100%;font-weight: normal;">

            <span class="to-date p-lr-0" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;text-align: right;text-transform: uppercase;padding-left: 0;padding-right: 0;">  FROM: {!! $val['e_start_date_formatted'] !!}<span ng-bind="item.e_start_date_formatted" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></span></span> 
            @if($val['e_end_date_formatted']=='31-Dec-9999')<span class="to-date p-lr-0" ng-if="item.e_end_date_formatted == '31-Dec-9999'" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;text-align: right;text-transform: uppercase;padding-left: 0;padding-right: 0;">  TO: PERMANENT </span>
            @else
            <span class="to-date p-lr-0" ng-if="item.e_end_date_formatted != '31-Dec-9999'" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;text-align: right;text-transform: uppercase;padding-left: 0;padding-right: 0;">  TO: {!! $val['e_end_date_formatted'] !!}<span ng-bind="item.e_end_date_formatted" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></span></span>
            @endif
        </div>

        <div class="col-sm-12 margin-0 margin-b-5 time-strip p-l-0" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin: 0;margin-bottom: 5px;padding-left: 15px;line-height: 1.3;position: relative;min-height: 1px;padding-right: 15px;width: 100%;font-weight: normal;">TIME:  {!! $val['time'] !!}<span ng-bind="item.time" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></span> </div>  
        @if($val['height']!="")
        <div class="col-sm-12 margin-0 margin-b-5 height-strip p-l-0" ng-if="item.height" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin: 0;margin-bottom: 5px;padding-left: 15px;position: relative;min-height: 1px;padding-right: 15px;width: 100%;margin-top: 5px !important;">
            <div style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"> HEIGHT: {!! $val['height'] !!} <span ng-bind="item.height" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></span> ALTITUDE: {!! $val['level'] !!} <span ng-bind="item.level" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></span>
            </div>  
        </div>
        @endif
    </div>
    @endforeach
</div>