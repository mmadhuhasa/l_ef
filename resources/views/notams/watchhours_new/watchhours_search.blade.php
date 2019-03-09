        <div class="hoursListContainer">
            @foreach($datalist as $data)
              <div class="whList">
              <?php
                $expiry=true; 
                foreach($data as $dd){
                  if($dd['end_date_timestamp']>=strtotime(date("y-m-d"))){
                    $expiry=false; 
                    break;
                  }
              } 
              ?>  
               @foreach($data as $key=>$d)
                @php $end=$d['end_date_formatted']; $date=date("y-m-d") @endphp
                @if($key==0)
                <div class="scrollingList">
                  <!-- flight details with eye icon starts -->
                  <div class="flightDets">
                    <p>
                      <span class="flightName">{{$d['aerodrome']}} - {{$d['airport_name'][0]}}</span>   
                       @if(isset($d['notams']) && $d['notams']!="") 
                       <a style="cursor:pointer;"  class="notams_info" data-notams="{{$d['notams']}}" data-aerodrome="{{$d['aerodrome']}}">
                         <span class="viewFlight icons"><i class="sr-only">Eye icon</i></span>
                        </a>
                        @endif  
                    </p>
                    
                     <p class='flightDt dd @if($expiry==true) red_col  blinking @endif'>{{$d['start_date_formatted']}} to {{$d['end_date_formatted']}}</p>
                  </div>
                  <!-- flight details with eye icon starts -->

                  <!-- edit and checklist icon starts -->
                  <div class="editIconsCont">
                    <a href="javascript:void(0)" data-id="{{$d['id']}}" target="_blank" ng-click="edit(1)" class="editClick tooltip_rel" data-name="{{$d['aerodrome']}} - {{$d['airport_name'][0]}}">
                        <span class="editIcon icons"></span>
                        <span class="tooltip_cust">EDIT</span>
                    </a>
                    <a class="viewhistory tooltip_rel" data-toggle="modal" data-target="#ViewHistory" data-watchhours_id="{{$d['id']}}" target="_blank">
                      <span class="checkListIcon icons"></span>
                        <span class="tooltip_cust tooltip_history">VIEW HISTORY</span>
                    </a>
                    <a class="delete_notam_pop pencil_fuel_price tooltip_rel" data-id="{{$d['id']}}" data-name="{{$d['aerodrome']}}">
                       <span class="deleteIcon icons"></span>
                        <span class="tooltip_cust tootip_delete">DELETE</span>
                    </a>  
                  </div>
                  <ul>
                      @foreach($d['watchhours'] as $days=>$times)
                      <li>
                          <dl>
                              <dt>{{strtoupper($days)}}</dt>
                              @foreach($times as $time)
                               @if($time!=" - ")
                                 @if($time=="CLOSED - CLOSED")
                                   <dd class="hrsClosed">CLOSED</dd>
                                 @else
                                 <dd>{{$time}} {{ App::make('App\Http\Controllers\Notams\WatchHoursController')->utc_to_ist($time) }}</dd>
                                 @endif
                               @endif
                              @endforeach  
                          </dl>
                      </li>
                      @endforeach
                  </ul>
                  <!-- weekly schedule list starts here -->

                </div>
                @else
                <div class="scrollingList">
                  <div class="flightDets">
                    <p>
                      <span class="flightName">{{$d['aerodrome']}} - {{$d['airport_name'][0]}}</span> 
                       @if(isset($d['notams']) && $d['notams']!="") 
                       <a style="cursor:pointer;"  class="notams_info" data-notams="{{$d['notams']}}"  data-aerodrome="{{$d['aerodrome']}}">
                         <span class="viewFlight icons"><i class="sr-only">Eye icon</i></span>
                        </a>
                        @endif 
                    </p>
                     <p class='flightDt @if($expiry==true) red_col blinking @endif'>{{$d['start_date_formatted']}} to {{$d['end_date_formatted']}}</p>
                  </div>
                  <div class="editIconsCont">
                      <a href="javascript:void(0)" data-id="{{$d['id']}}" target="_blank" ng-click="edit(1)" class="editClick tooltip_rel" data-name="{{$d['aerodrome']}} - {{$d['airport_name'][0]}}">
                        <span class="editIcon icons"></span>
                        <span class="tooltip_cust">EDIT</span>
                      </a>
                      <a class="viewhistory tooltip_rel" data-toggle="modal" data-target="#ViewHistory" data-watchhours_id="{{$d['id']}}" target="_blank">
                      <span class="checkListIcon icons"></span>
                        <span class="tooltip_cust tooltip_history">VIEW HISTORY</span>
                     </a>
                     <a class="delete_notam_pop pencil_fuel_price tooltip_rel" data-id="{{$d['id']}}"><span class="deleteIcon icons"></span>
                        <span class="tooltip_cust tootip_delete">DELETE</span>
                     </a> 
                  </div>
                  <ul>
                     @foreach($d['watchhours'] as $days=>$times)
                     <li>
                         <dl>
                             <dt>{{strtoupper($days)}}</dt>
                             @foreach($times as $time)
                               @if($time!=" - ")
                                 @if($time=="CLOSED - CLOSED")
                                    <dd class="hrsClosed">CLOSED</dd>
                                 @else
                                 <dd>{{$time}} {{ App::make('App\Http\Controllers\Notams\WatchHoursController')->utc_to_ist($time) }}</dd>
                                 @endif
                               @endif  
                             @endforeach  
                         </dl>
                     </li>
                     @endforeach
                  </ul>
                </div>
                @endif
                @endforeach
              </div>
            @endforeach
        </div>


        <!-- watch hours outer container ends here -->
        <script type="text/javascript">
          $(document).ready(function(){
            $('.whList').on('init', function(event, slick, direction){
              console.log("direction");
              $(this).css({'max-height' : 'none', 'overflow' : 'auto'});
              // left
            });
            $('.whList').slick({
              adaptiveHeight: true,
              infinite:false,
              draggable:false,
            });
            $(".edit_watchhours").click(function(e){
                $("#record_id").val($(this).attr('data-id'));
                $("#watchhours_list").hide();
                $("#edit_watchours").show();  
                angular.element('#record_id').scope().edit(); 
            })
            $('.notams_info').on('click',function(e){
                 $("#notams_msg").html($(this).attr('data-notams'))
            });
            $('.editClick').on('click', function(){
              var id = $(this).data('id');
              $(".addDataId").attr('data-id', id);
              var name=$(this).attr("data-name");
              $("#editNotams_name").text(name);
              $("#editNotams").modal('show');
              $(".addDataId").on('click', function(){
                  $("#editNotams").modal('hide');
                  $(".searchBlock,#singleBorder").hide(300);
              });
            })
          });
        </script>   