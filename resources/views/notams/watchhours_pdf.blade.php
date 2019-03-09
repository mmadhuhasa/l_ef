<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <div>
                    @if(sizeof($data)==0)
                    <div class="alert-danger" style="text-align:center;" >
                        NO DATA AVAILABLE
                    </div>
                    @endif
                    @foreach($data as $val)
                    <div class="col-sm-8 watchhours-block">

                        <div class="col-sm-12 p-lr-0">
                            <div class="col-sm-2 watchhours-label p-lr-0">
                                Aerodrome
                            </div>
                            
                            @foreach($val->ids as $id)
                            <div class="col-sm-6 p-lr-0 aerodrome-name" style="padding-right: 5px">
                                 {!! $val->aerodrome !!}({!! $val->notam_no !!})
                            </div>
                            <div>
                            </div>
                         @endforeach
                        </div>
                        <div class="col-sm-12 p-lr-0">
                            <div class="col-sm-2 p-lr-0 watchhours-label">
                                Duration 
                            </div>
                            <div class="col-sm-6 p-lr-0">
                                 {!! $val->start_date_formatted !!} - {!! $val->end_date_formatted !!}
                            </div>
                        </div>   
                        <div class="clearfix">
                            
                        </div>
                        <div class="row p-lr-0 margin-0 label-head">
                            <div class="col-sm-2 p-lr-0 watchhours-label week-days-label watchhours-title">
                                Name
                            </div>
                            <div class="col-sm-4 p-lr-0 watchhours-title">
                                Time
                            </div>
                            <div class="col-sm-6 p-lr-0 watchhours-title watchhours-remarks">
                                Remarks
                            </div>
                        </div>   
                        @foreach($val->watchhours as $key => $item)
                        <div class="p-lr-0 watchhours-list" >

                            <?php
                            $i = 0;
                            ?>
                            @foreach($item as $subitem)
                            <?php
                            $remarksKeyName = strtolower($key) . "_remarks";

                            ?>
                            <div class="row watch-time-row">
                                
                            
                            @if($subitem!=" - ")
                            <div class="col-sm-2 p-lr-0 watchhours-label week-days-label watchhours-content">
                                @if($i==0)
                                {!! $key !!}
                                @endif
                            </div>
                            <div class="col-sm-4 p-lr-0 watchhours-content">
                                @if($i==0 && $subitem==" - ")
                                 CLOSED
                                @elseif($i!=0 && $subitem==" - ")

                                @elseif($subitem=="CLOSED - CLOSED")
                                 CLOSED
                                @else
                                 {!! $subitem !!} {{ App::make('App\Http\Controllers\Notams\WatchHoursController')->utc_to_ist($subitem) }}
                                @endif
                            </div>
                            <div class="col-sm-6 p-lr-0 watchhours-content watchhours-remarks">
                               @if(!empty($val[$remarksKeyName])) {!! $val[$remarksKeyName] !!} @else &nbsp;  @endif
                            </div>
                            @endif
                            <?php $i++; ?>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
               
</body>
</html>                
               