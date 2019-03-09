@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@push('js')
<script src="{{url('app/js/common/validation.js')}}" type="text/javascript"></script>
@endpush
@push('css')
<link rel="stylesheet" type="text/css" href="{{url('app/css/airport/style.css')}}">
@endpush
@section('content')
<div id="page">
    @include('includes.new_header',[])
    <div class="container cust-container">
 
        <div class="row">
            <div class="col-md-12 p-lr-0">
                <p class="airport_heading auto_caps">{{$airportname}}</p>
            </div>

            <div class="col-md-12">
                <div class="but-sec">
                    <button type="button" class="btn newbtnv1 but_wd" data-toggle="modal" data-target="#metar_modal" >METAR &amp; TAF</button>
                   <!--  <form action='{{url("notams/$airports->airport_code")}}' method="POST" target="_blank" style="display: inline-block";>
                        {{ csrf_field() }}
                      
                       <button type="submit" value="NOTAMS ({{$notam_count}})" class="btn newbtnv1 but_wd"> NOTAMS ({{$notam_count}})</button>
                       <input type="hidden" data-toggle="modal" value="{{ $airports->airport_code}}" name="airportcode">
                    </form>  -->
                     <a href='{{url("notams/airport/$airports->airport_code")}}' target="_blank" class="btn newbtnv1 but_wd"> NOTAMS ({{$notam_count}})</a>
                    <button type="button" class="btn newbtnv1 but_wd newbtnsid" data-toggle="modal" data-target="#sid_modal">SID</button>
                    <button type="button" class="btn newbtnv1 but_wd newbtnstar" data-toggle="modal" data-target="#star_modal">STAR</button>
                    <button type="button" class="btn newbtnv1 but_wd newbtnapproach"  data-toggle="modal" data-target="#approach_modal">APPROACH</button>
                    <button type="button" class="btn newbtnv1 but_wd newbtnapron"  data-toggle="modal" data-target="#apron_modal">APRON</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 p-l-0">
                <div class="col-md-9">
                    <div class="col-md-12 loc_sec">
                        <p class="loc_heading auto_caps">Location Information for {{ $airports->airport_code}}</p>
                        <div class="col-md-4 loc_inner_sec">
                            <p class="cor-text">Sunrise/Sunset <span> <img src="{{URL::asset('/media/whe-icons/sunny.png' )}}" width="25px" height="25px";></span></p>
                            <p class="val_text"> <i class="fa fa-long-arrow-up"></i>
                           <span> 6:00 AM</span> <i class="fa fa-long-arrow-down"></i> <span> 6:00 PM</span> </p>
                        </div>
                        <div class="col-md-4 loc_inner_sec">
                           <p class="cor-text">Coordinates <img src="{{URL::asset('media/whe-icons/coordinates.png' )}}" width="20px" height="20px";></span> </p>
                            <p class="val_text">{{ $airports->coordinates}}</p>
                        </div>
                        <div class="col-md-4 loc_inner_sec">
                            <p class="cor-text">Elevation <img src="{{URL::asset('media/whe-icons/elevation.png' )}}" width="15px" height="15px";></span> </p>
                            <p class="val_text">{{ $airports->elevation}}</p>
                        </div>
                    </div>
                    <div class="col-md-12 p-lr-0">
                        <div class="rw_sec">
                            <p class="rw_heading1 auto_caps">Runway  </p>
                            <div class="col-md-12">
                                
                                <table class="table">
                                    <tbody>
                                  @foreach($airports->runway as $runways)
                                          @if(isset($runways->dimension))
                                           <div class="col-md-4 text-right"><b>Runway {{ $runways->xrunway."/".$runways->yrunway}} Dimension :</b></div>
                                           <div class="col-md-2 p-lr-0">{{ $runways->dimension}}</div>
                                          @else
                                            <div class="col-md-4 text-left">No Data Available</div>
                                          @endif
                                  @endforeach        
                                  @foreach($airports->runway as $runways)        
                                          @if(isset($runways->xcoordinates))
                                              <div class="col-md-4 text-right"><b>Runway {{ $runways->xrunway}} Coordinates :</b></div>
                                              <div class="col-md-2 p-lr-0">{{ $runways->xcoordinates}}</div>
                                          @endif
                                  @endforeach        
                                  @foreach($airports->runway as $runways)            
                                          @if(isset($runways->ycoordinates))
                                              <div class="col-md-4 text-right"><b>Runway {{ $runways->yrunway}} Coordinates :</b></div>
                                              <div class="col-md-2 p-lr-0">{{ $runways->ycoordinates}}</div>
                                          @endif
                                  @endforeach        
                                  @foreach($airports->runway as $runways)             
                                          @if(isset($runways->xelevation))
                                              <div class="col-md-4 text-right"><b>Runway {{ $runways->xrunway}} Elevation :</b></div>
                                              <div class="col-md-2 p-lr-0">{{ $runways->xelevation}}</div>
                                          @endif
                                 @endforeach        
                                  @foreach($airports->runway as $runways)           
                                          @if(isset($runways->yelevation))  
                                              <div class="col-md-4 text-right"><b>Runway {{ $runways->yrunway}} Elevation :</b></div>  
                                              <div class="col-md-2 p-lr-0">{{ $runways->yelevation}}</div>
                                          @endif
                                   @endforeach        
                                  @foreach($airports->runway as $runways)             
                                          @if(isset($runways->xdisplaced_threshold))
                                              <div class="col-md-4 text-right"><b>Runway {{ $runways->xrunway}} Displaced Threshold :</b></div>
                                              <div class="col-md-2 p-lr-0">{{ $runways->xdisplaced_threshold}}</div>
                                          @endif
                                   @endforeach        
                                  @foreach($airports->runway as $runways)           
                                          @if(isset($runways->ydisplaced_threshold))
                                              <div class="col-md-4 text-right"><b>Runway {{ $runways->yrunway}} Displaced Threshold :</b></div>
                                              <div class="col-md-2 p-lr-0">{{ $runways->ydisplaced_threshold}}</div>
                                         @endif 
                                    @endforeach 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                     @if(count($airports->communication)>0)     
                    <div class="col-md-12 ac_sec">
                        <p class="ac_heading auto_caps">Airport Communications</p>
                        <div class="ac_inner_sec">

                            @foreach($airports->communication as $communications)
                              <?php $str =strpos($communications->comm_details,':') ;?>
                            <div class="col-sm-4 text-right" style="font-weight: bold;">{{ substr($communications->comm_details,0,$str+1)}}</div>
                            <div class="col-sm-2 text-left p-lr-0">{{ substr($communications->comm_details,$str+1)}}</div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <!--        end of Airport Communications-->
                    <!--start of Nearby Airports section-->
                    <div class="col-md-12  p-lr-0">
                        <div class="near_ar_sec">
                            <p class=" near_ar_heading auto_caps">Nearby Airports with Instrument Procedures</p>
                            <div class="col-md-12">
                            @if(count($airports->near_by_airport)>0)
                                <table class="table m-b-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Heading</th>
                                            <th>Distance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($airports->near_by_airport as $near_by_airport)
                                          <tr>
                                           <td>{{ $near_by_airport->nearbyairportid.'-'.$near_by_airport->name}}</td>
                                           <td>{{ $near_by_airport->heading}}</td>
                                           <td>{{ $near_by_airport->distance}}</td>
                                          </tr> 
                                         @endforeach
                                    </tbody>
                                </table>
                               @endif 
                            </div>
                        </div>
                    </div>
                    <!--end of Nearby Airports section-->
                     <!--        Start of Nearby Navigation Aids Section-->
        <div>
            <div class="col-md-12  p-lr-0">
                <div class="nav_aids_sec">
                    <p class=" nav_aids_heading auto_caps">Nearby Navigation Aids</p>
                    @if(count($airports->radail)>0)
                    <div class="col-md-6">
                        <table class="table m-b-15">
                            <thead>
                                <tr>

                                    <th>VOR</th>
                                    <th>freq</th>
                                    <th>radial</th>
                                    <th>Distance</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach($airports->radail as $radails)
                              <tr>
                               <td>{{  $radails->radialid.'-'.$radails->name}}</td>
                               <td>{{ $radails->frequency}}</td>
                               <td>{{ $radails->radial}}</td>
                               <td>{{ $radails->range}}</td>
                              </tr> 
                             @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                     @if(count($airports->bearing)>0)
                    <div class="col-md-6">
                        <table class="table m-b-0">
                            <thead>
                                <tr>

                                    <th>NDB</th>
                                    <th>freq</th>
                                    <th>Bearing</th>
                                    <th>Distance</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach($airports->bearing as $bearings)
                              <tr>
                                 <td>{{ $bearings->bearingid.'-'.$bearings->name}}</td>
                                 <td>{{ $bearings->frequency}}</td>
                                 <td>{{ $bearings->bearing}}</td>
                                 <td>{{ $bearings->range}}</td>
                              </tr> 
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!--        End of Nearby Navigation Aids Section--> 
    
                </div>
                <div class="col-md-3 p-lr-0">
                 
                    <form class="ar_search" target="_blank" action="{{action('AirportController@search') }}" method="POST">
                        <div class="input-group">
                           {{ csrf_field() }}
                            <input type="text" autocomplete="off" class="form-control ar_search_input airport-search-input auto_caps alphabets" style=""placeholder="Airport Name or ICAO Code" name="search" id="Info" required maxlength="3">
                            <div class="input-group-btn">
                                <button class="btn newbtnv1 ar_search_btn" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                        <span style="color:red;">{{$errors->first('search')}}</span>
                    </form>
                      <div class="time_sec">
                         <p class=" airport_time_heading">Airport Timings (IST)</p>
                      <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Open</th>
                                    <th>Close</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($airports->watchhours)>0)
                             @foreach($airports->watchhours as $watchhourskey=>$watchhour)
                                @if(!empty($watchhour->monday_open))
                                  <tr>
                                     @if($watchhourskey==0)
                                       <td class="@if($today=='Monday'){{'today'}}@endif auto_caps" >Monday</td>
                                     @else
                                     <td></td>
                                     @endif 
                                      <td>{{$watchhour->monday_open}}</td>
                                      <td>{{$watchhour->monday_close}}</td>
                                  </tr>
                                @endif  
                             @endforeach   
                             @foreach($airports->watchhours as $watchhourskey=>$watchhour)
                               @if(!empty($watchhour->tuesday_open))
                                <tr>
                                    @if($watchhourskey==0)
                                    <td class="@if($today=='Tuesday'){{'today'}}@endif auto_caps">Tuesday</td>
                                   @else
                                   <td></td>
                                   @endif 
                                    
                                    <td>{{$watchhour->tuesday_open}}</td>
                                    <td>{{$watchhour->tuesday_close}}</td>
                                </tr>
                               @endif   
                             @endforeach
                             @foreach($airports->watchhours as $watchhourskey=>$watchhour)
                               @if(!empty($watchhour->wednesday_open))
                                 <tr>
                                     @if($watchhourskey==0)
                                    <td class="@if($today=='Wednesday'){{'today'}}@endif auto_caps">Wednesday</td>
                                   @else
                                   <td></td>
                                   @endif  
                                    
                                    <td>{{$watchhour->wednesday_open}}</td>
                                    <td>{{$watchhour->wednesday_close}}</td>
                                </tr>
                               @endif    
                             @endforeach     
                             @foreach($airports->watchhours as $watchhourskey=>$watchhour)
                               @if(!empty($watchhour->wednesday_open))
                                <tr>
                                     @if($watchhourskey==0)
                                    <td class="@if($today=='Thursday'){{'today'}}@endif auto_caps">Thursday</td>
                                   @else
                                   <td></td>
                                   @endif  
                                    
                                    <td>{{$watchhour->thursday_open}}</td>
                                    <td>{{$watchhour->thursday_close}}</td>
                                </tr>
                               @endif
                             @endforeach     
                             @foreach($airports->watchhours as $watchhourskey=>$watchhour)
                               @if(!empty($watchhour->friday_open))
                                <tr>
                                    @if($watchhourskey==0)
                                    <td class="@if($today=='Friday') {{'today'}}@endif auto_caps">Friday</td>
                                   @else
                                   <td></td>
                                   @endif  
                                    
                                    <td>{{$watchhour->friday_open}}</td>
                                    <td>{{$watchhour->friday_close}}</td>
                                </tr>
                               @endif
                             @endforeach     
                             @foreach($airports->watchhours as $watchhourskey=>$watchhour)
                               @if(!empty($watchhour->saturday_open))
                                <tr>
                                     @if($watchhourskey==0)
                                    <td class="@if($today=='Saturday') {{'today'}}@endif auto_caps">Saturday</td>
                                   @else
                                   <td></td>
                                   @endif  
                                    
                                    <td>{{$watchhour->saturday_open}}</td>
                                    <td>{{$watchhour->saturday_close}}</td>
                                </tr>
                               @endif
                             @endforeach
                             @foreach($airports->watchhours as $watchhourskey=>$watchhour)
                                @if(!empty($watchhour->saturday_open))
                                <tr>
                                    @if($watchhourskey==0)
                                    <td class="@if($today=='Sunday') {{'today'}}@endif auto_caps">Sunday</td>
                                   @else
                                   <td></td>
                                   @endif  
                                    
                                    <td>{{$watchhour->sunday_open}}</td>
                                    <td>{{$watchhour->sunday_close}}</td>
                                </tr>
                                @endif
                             @endforeach
                             @else
                               <tr>
                                    <td></td> 
                                    <td>Not Available</td>
                                    <td></td>
                                </tr>
                            @endif              
                            </tbody>
                        </table>
                    </div>
                    <div class="satellite_va">
                        <p class="satellite_text">Satellite View of {{ $airports->airport_code}}</p>
                        <div class="col-md-12 p-tb-15">
                             <a target="_blank" href="http://maps.google.com/maps?ll={{$airports->lat}},{{$airports->long}}&amp;t=h&amp;z=16"><img src="https://maps.google.com/maps/api/staticmap?center={{$airports->lat}},{{$airports->long}}&amp;size=300x300&amp;zoom=14&amp;maptype=satellite&amp;sensor=false&key=AIzaSyD8kpfNY_zchycTS1zvLHMgxE3W1N06EkY" style="width: 215px; height: 215px; border: 1px solid #aaa;" alt="Google Maps Satellite View" class="tp_main_img"></a>
                        </div>
                    </div>
                  
                </div>
            </div>

        </div>
       </div>
    <!--start of Modal popups-->
    <div id="metar_modal" class="modal fade in">
        <div class="modal-dialog">
            <header class="popupHeader"> <span class="header_title">METAR &AMP; TAF</span> <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>
            <section class="popupBody">
                <div class="row">
                    
                </div>
            </section>
        </div>
    </div>

    <div id="sid_modal" class="modal fade in" >
        <div class="modal-dialog modal_sid">
            <header class="popupHeader"> <span class="header_title"></span> <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>
            <section class="popupBody">
                <div class="sid row">
                  
                </div>
            </section>
        </div>
    </div>
    <div id="star_modal" class="modal fade in">
        <div class="modal-dialog modal_sid">
            <header class="popupHeader"> <span class="header_title"></span> <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>
            <section class="popupBody">
                <div class="row star">
                   
                </div>
            </section>
        </div>
    </div>
    <div id="approach_modal" class="modal fade in">
        <div class="modal-dialog modal_sid">
            <header class="popupHeader"> <span class="header_title"></span> <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>
            <section class="popupBody">
                <div class="row approach">
                   <iframe src="{{url('approachpopup')}}" name="iframe_a"></iframe>
                </div>
            </section>
        </div>
    </div>
    <div id="apron_modal" class="modal fade in">
        <div class="modal-dialog modal_sid">
            <header class="popupHeader"> <span class="header_title"></span> <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>
            <section class="popupBody">
                <div class="row apron">
                   <iframe src="{{url('apronpopup')}}" name="iframe_a"></iframe>
                </div>
            </section>
        </div>
    </div>

    <!--End of modal popups-->
    @include('includes.new_footer',[])
</div>
<script>
  $( function() {
     $("#Info").on('keyup', function () 
     {
         if ($("#Info").val().length <= 3) 
         {
            $("#Info").css("border", "red solid 1px");
         }
         else
         {
            $("#Info").css("border", "1px solid #999");
         }
     });
    $("#ui-id-1").addClass('auto_caps')
     $.ajax({
        url: "{{action('AirportController@autosuggest') }}",
        dataType:"json",  
        success: function(result)
        {
            $("#Info").autocomplete({
                source: result,
                selectFirst: true,
                minLength: 2,
                select: function (event, ui) 
                {
                    // console.log(ui);
                    // window.location = '/airport/'+ui.item.label.substr(0, 4)+'/'+ui.item.label.substr(7);
                     $("#Info").css('border','1px solid #999');
                     var url='/airport/'+ui.item.label.substr(0, 4)+'/'+ui.item.label.substr(7);
                    window.open(url, "_blank");
                }
            });
        }});
  $(".newbtnsid").click(function(){
       $('.sid').html(`<iframe src="{{url('sidpopup')}}" name="iframe_a"></iframe>`);
  });
  $(".newbtnstar").click(function(){
       $('.star').html(` <iframe src="{{url('starpopup')}}" name="iframe_a"></iframe>`);
  });
  $(".newbtnapproach").click(function(){
       $('.approach').html(` <iframe src="{{url('approachpopup')}}" name="iframe_a"></iframe>`);
  });
  $(".newbtnapron").click(function(){
       $('.apron').html(` <iframe src="{{url('apronpopup')}}" name="iframe_a"></iframe>`);
  });
  $(".ar_search_btn").click(function(){
      var data=$('#Info').val();
      res='';
      $.ajax({

        url: "/validate_airport",
        data: "airport_name="+data,
        dataType:"json", 
        async:false, 
        success: function(result)
        {   
           res=result;
        }
      });
       if(res==false)
       {
         $('.ar_search_input').css('border-color','red');
         return false;
        }
    });

});
  </script>
@stop