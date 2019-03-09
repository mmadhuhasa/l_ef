 @if($key['raw_time'])
                                <div class=" col-sm-12  p-l-0 margin-0 margin-b-5 time-strip raw-time @if( ($key['is_daily']  || $key['is_weekly']  || $key['is_date_specific'] )) edited @endif"  >RAW TIME: <span style="display:inline-block;">{!! $key['raw_time'] !!}</span> <i class="fa fa-clock-o" style="cursor: pointer;" aria-hidden="true" ng-click="loadDatePicker($event, '{!! $key['e_start_date_formatted'] !!}', '{!! $key['e_end_date_formatted'] !!}', '{!! $key['notam_no'] !!}', '{!! $key['id'] !!}','{!! $key['aerodrome'] !!}')"></i>
                                 </div> 
                                 @if( ($key['is_daily']  || $key['is_weekly']  || $key['is_date_specific'] ))
                                <div class=" col-sm-12  p-l-0 margin-0 margin-b-5 time-strip formatted-time" > FORMATTED TIME:
                                @foreach($key['formatted_time'] as $val)
                            <div style="/*    white-space: pre;
    display: inline-block;
    vertical-align: top*/"> 
                            {!! $val['time'] !!}<i class="fa fa-pencil" style="cursor: pointer;    padding-left: 5px;" aria-hidden="true" ng-click="loadDatePicker($event, '{!! $key['e_start_date_formatted'] !!}', '{!! $key['e_end_date_formatted'] !!}', '{!! $key['notam_no'] !!}', '{!! $val['notam_id'] !!}', '{!! $key['aerodrome'] !!}','edit','{!! $val['time'] !!}')"></i> 
     </div>
                                @endforeach
                                </div> 
                                @endif 
                                @else($key['time'] )
                                <div class=" col-sm-12  p-l-0 margin-0 margin-b-5 time-strip" style="line-height: 1.3;font-weight: bold;"> TIME: {!! $key['formatted_time'][0]['time'] !!}  <i class="fa fa-clock-o" style="cursor: pointer;" aria-hidden="true" ng-click="loadDatePicker($event, '{!! $key['e_start_date_formatted'] !!}', '{!! $key['e_end_date_formatted'] !!}', '{!! $key['notam_no'] !!}', '{!! $key['id'] !!}','{!! $key['aerodrome'] !!}')"></i>
                                 </div> 
                                  @endif