 <div>
                    @if(sizeof($data)==0)
                    <div class="alert-danger" id="watchhours_empty"style="text-align:center;" >
                        NO DATA AVAILABLE
                    </div>
                    @endif
                    @foreach($data as $val)
                    <div class="col-sm-8 watchhours-block">

                        <div class="col-sm-12 p-lr-0">
                            <div class="col-sm-2 watchhours-label p-lr-0">
                                Aerodrome
                            </div>
                            <div class="col-sm-6 p-lr-0 aerodrome-name" style="padding-right: 5px">
                                 {!! $val->aerodrome !!}({!! $val->notam_no !!})
                            </div>
                            @if(isset($val->notams) && !empty($val->notams))
                                    <div class="col-md-1 tooltip_rel style_plus_wrapper" style="">
                                        <a style="cursor:pointer;" class="style_plus_price" data-toggle="modal" data-target="#notams_info_{{$val->id}}">
                                            <img src="https://www.eflight.aero/media/ananth/images/preview.png" class="img-responsive modal_class" alt="">
                                        </a>
                                        <span class="tooltip_cust">NOTAMS INFO</span>
                                        <span class="tooltip_tri_shape1" style="right:22px;"></span>
                                    </div>
                             @endif
        
                            <div class="">
                                <a class="delete_notam_pop pencil_fuel_price" data-id="{!! $val->id !!}" style="padding-left:0px;cursor:pointer;font-size: 17px;"><i class="fa fa-trash"></i>
                                </a>
                             
                             <a href="javascript:void(0)" data-id="{!! $val->id !!}" target="_blank" style="padding-left:8px;cursor:pointer;font-size: 17px;" ng-click="edit(1)" class="edit_watchhours"><i class="fa fa-pencil-square pencil_fuel_price"></i></a>
                             <a class="viewhistory" data-toggle="modal" data-target="#ViewHistory" data-watchhours_id="{{$val->id}}" target="_blank" style="padding-left:8px;cursor:pointer;font-size: 17px;"><i class="fa fa-history pencil_fuel_price"></i></a>
                            </div>
                         <div>
                             
                             <div id="notams_info_{{$val->id}}" class="modal fade" style="display:none;" >
                                <div class="modal-dialog modal-container">
                                     <header class="popupHeader"> 
                                         <span class="header_title">NOTAMS INFO</span> 
                                         <span class="modal_close" data-dismiss="modal">
                                             <i class="fa fa-times-circle"></i>
                                         </span> 
                                     </header>
                                     <section class="popupBody modal-body">
                                         {{$val->notams}}
                                     </section>
                                 </div>
                             </div>
                         </div>
                        </div>
                        <div class="col-sm-12 p-lr-0">
                            <div class="col-sm-2 p-lr-0 watchhours-label">
                                Duration 
                            </div>
                            <div class='col-sm-6 p-lr-0 @if(strtotime("now")> strtotime("$val->end_date_formatted")) red_col @endif'>
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
 <script type="text/javascript">
    $(".edit_watchhours").click(function(){
      $("#record_id").val($(this).attr('data-id'));
      $("#watchhours_list").hide();
      $("#edit_watchours").show();  
      angular.element('#record_id').scope().edit(); 
      
    })
     
 </script>                