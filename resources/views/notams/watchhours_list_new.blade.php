@extends('layouts.check_quick_plan_layout')
@section('content')
<div class="page" id="app">
<style>
.watchhourstext{
margin-bottom:20px;
text-align: center;
padding: 7px 0;
font-weight: 600;
font-size: 15px;
color: #fff;
font-family: 'pt_sansregular', sans-serif;
background: #a6a6a6;
background: linear-gradient(to right, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
}
.search-band {
background: #ffffff;
box-shadow: 3px 3px 12px 0px #999;
margin-bottom: 15px;
margin-top: 15px;
padding: 0px 0 10px 0px;
}
.row {
margin-right: 0;
margin-left: 0;
}
.search_button_one{
border-radius: 0 4px 4px 0px;    
width: 40px;
}
.box2 input::-webkit-input-placeholder {
font-weight:bold;
}
.box1 input::-webkit-input-placeholder {
font-style:italic;
text-align:left;
}
.favairports_input{
background:#ededed;   
}
</style>
@include('includes.new_header',[])

<div class="container">
    <div class="search-band">
       <div class="row">
            <div class="col-md-12" style="padding-left: 0;padding-right: 0;">
                <p class="watchhourstext">WATCH HOURS</p>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <div class="input-group box1">
                            <input type="text" class="form-control text_uppercase alphabets font-bold stations ui-autocomplete-input" minlength="4" maxlength="4" name="" placeholder="SEARCH UPTO 5 AIRPORTS WATCH HOURS" autocomplete="off">
                            <div class="input-group-addon search-addon" style="padding: 0;">
                                <button type="submit" name="flag" value="search" class="btn newbtnv1 search_button_one"><span class="glyphicon glyphicon-search"></span></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group box2">
                        <input required="" type="text" data-toggle="popover" data-placement="bottom" minlength="5" maxlength="7" autocomplete="off" class="alpha_numeric text-center font-bold text_uppercase validation_class form-control modtooltip ui-autocomplete-input favairports_input" placeholder="FAV AIRPORTS:  VABB VIDP VOMM VOBG VOHY" id="" name="">
                    </div>
                </div>
                
            </div><!--row close here-->
        </div>
    </div>
</div>



</div><!--container close here-->
@include('includes.new_footer',[])
</div>
@stop