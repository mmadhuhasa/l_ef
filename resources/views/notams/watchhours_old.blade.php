<?php 
 ini_set('memory_limit', '512M');
?>
@extends('layouts.notam_layout',array('1'=>'1'))
@section('content')
@push('watchhourcss') 
<link rel="stylesheet" type="text/css" href="{{url('/app/css/notams/watchhour.css')}}"></link> 
<link rel="stylesheet" type="text/css" href="{{url('/app/css/notams/watchhour_view.css')}}"></link> 
@endpush 
<div class="page">
    <!-- @include('includes.new_fpl_header',[]) -->
    @include('includes.new_header',[])
    <main>
        <section class="bg-1 welcome infopage" >
            @include('includes.watchhours_modal',[])
            <div class="container container-watchhours">
                <div class="row">
                    <form>

                        <div class="col-sm-3 aerodrome-form-section">
                            <div class="col-md-9 p-lr-0"><input type="text" class="form-control aerodrome-input" name="code" placeholder="Aerodrome"  ng-model="notamsFilter.routeNotams" autocomplete="off" data-toggle="popover" data-placement="top" value="{!! $code !!}" max-length="4"></div>
                            <button class="btn search-btn" type="submit" ng-click="filterNotams(routenotams)"><span class="glyphicon glyphicon-search"></span></button>
                        </div>
                        
                        @if(isset($code) && $code !="" && sizeof($data) !=0)
                        <div class="col-sm-4 aerodrome-form-section">
                            <span style='padding-right:10px'>See all watch hours for {!! strtoupper($code) !!}</span>
                            <input class="checkwatch" type='checkbox' name='check' id='check' {{($check == 'all') ? "checked='checked'" : ''}} value='' />
                        </div>
                        @endif
                    </form>

                </div>
                <div class="row">
                    @if(sizeof($data)==0)
                    <div class="alert-danger" style="text-align:center;" >
                        NO DATA AVAILABLE
                    </div>
                    @endif
                    <?php //dd($data);?>
                    @foreach($data as $val)
                    <div class="col-sm-8 watchhours-block">

                        <div class="col-sm-12 p-lr-0">
                            <div class="col-sm-2 watchhours-label p-lr-0">
                                Aerodrome
                            </div>
                            <div class="col-sm-6 p-lr-0 aerodrome-name">
                                  <a href="{{url('/watchhours')}}/{!! $val->id !!}/edit" target="_blank">{!! $val->aerodrome !!} </a>
                            <span class="edit-tooltip">
                                Edit
                            </span>
                            </div>
                            <div><a class="delete_notam_pop" data-id="{!! $val->id !!}" style="padding-left: 9px;cursor: pointer"><i class="fa fa-trash"></i></a></div>

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

            </div>
        </section>
    </main>   
    <div id='v_toTop'><span></span></div>
    
      <!-- Delete Notams -->
    <div id="deleteNotam" class="modal fade in" style=" padding-right: 17px;">
       <div class="modal-dialog modal-container">
	<header class="popupHeader"> <span class="header_title">Delete</span><span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>
	<section class="popupBody"> 
	    <div class="user_login">
		<h5>Are you sure want to delete this NOTAM?</h5>
		<div class="action_btns">
                    <div class="row">
		    <div class="col-md-3 yesedit">
			<a href="#" watch-id=""  class="delete_watch_confirm btn newbtn_black">Yes</a>
		    </div>  
		</div>
		</div>

	    </div>
	</section>
    </div>
    </div>
    <script>
        $(window).scroll(function () {
            if ($(this).scrollTop()) {
                $('#v_toTop').fadeIn();
                $('#v_toTop_mid').fadeIn();
            } else {
                $('#v_toTop_mid').fadeOut();
                $('#v_toTop').fadeOut();
            }
        });
        $("#v_toTop").click(function () {
            $("html, body").animate({scrollTop: 0}, 500);
        });
        
         $(document).on('click',".checkwatch", function(){
            var code = $("input[name='code']").val();
                     if(code != ""){
                         window.location = base_url + "/watchhours?code="+code+"&check=all";
                     }
        });
        
        $(document).on('click',".delete_notam_pop", function(){
            var id = $(this).attr('data-id');
            $(".delete_watch_confirm").attr('watch-id', id);
            
            $("#deleteNotam").modal()
        });
         $(document).on('click',".delete_watch_confirm", function(e){
             e.preventDefault();
            var id = $(this).attr('watch-id');
            $.ajax({
                type: "POST",
                url: base_url + "/delete_watch",
                dataType: "json",
                data: {'id': id},
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (data) {
                     var code = $("input[name='code']").val();
                     if(code != ""){
                         window.location = base_url + "/watchhours?code="+code;
                     }else{
                         window.location = base_url + "/watchhours";
                     }
                }
        });
         })
    </script>

    @include('includes.new_footer',[])
</div>
@stop