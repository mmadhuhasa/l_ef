<!DOCTYPE html>
<html>

<head>
    <title>Laravel</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">

    <style>
        body {
            width: 80%;
            margin: 0 auto;
        }
        fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
            
}

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
        .container {
            width: 1000px;
            margin-top: 10px;
        }
        .form_name {
            margin-top: 20px;
        }
        .form_input_field {
            margin-bottom: 20px;
        }
        .checkbox-inline {
            margin-right: 8px;
        }
        .checkbox_row {
            margin-bottom: 18px;
        }
        #button {
            margin-top: 40px;
            margin-bottom: 20px;
        }
        #submit {
            width: 140px;
        }
        .auto_caps{
            text-transform: uppercase;
        }
        .form-control:focus
        {
            box-shadow: none;
               border: 1px solid red;
        }


        .search-btn {
    width: 100px;
    height: 30px;
    padding: 3px 3px;
    transition: all 0.25s ease;
    overflow: hidden;
    position: relative;
    display: inline-block;
    margin-bottom: 0;
    color: #fff !important; 
    font-size: 14px;
    line-height: 20px;
    font-weight: 300;
    text-transform: uppercase;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    border: none;
    background: #333;
    z-index: 3;
        outline: none !important;
}

.search-btn:hover:before {
    visibility: visible;
    width: 200%;
    left: -46%;
}

.search-btn:before {
    -webkit-transition: all 0.35s ease;
    -moz-transition: all 0.35s ease;
    -o-transition: all 0.35s ease;
    transition: all 0.35s ease;
    -webkit-transform: skew(45deg, 0);
    -moz-transform: skew(45deg, 0);
    -ms-transform: skewX(45deg) skewY(0);
    -o-transform: skew(45deg, 0);
    transform: skew(45deg, 0);
    -webkit-backface-visibility: hidden;
    content: '';
    position: absolute;
    visibility: hidden;
    top: 0;
    left: 50%;
    width: 0;
    height: 100%;
    /*background: #333;*/
    background: #F26232;
    background: linear-gradient(to top, #fa9b5b, #F26232);
    background: #f1292b;
    filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='#f37858', endColorstr='#f1292b');
    background: -webkit-gradient(linear, left top, left bottom, from(#f37858), to(#f1292b));
    background: -moz-linear-gradient(top, #f37858, #f1292b);
    z-index: -1;
    color: #fff;
}

.search-btn:hover {
    box-shadow: none !important;
    color: #fff;
}
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 form_name">
                <h3 class="text-center">Load and Trim form</h3> @if(Session::has('message'))
            </div>
        </div>
        <p class="alert alert-danger">{{ Session::get('message') }}</p>
        @endif
        <form action="{{url('calculate')}}" method="post" id="myform">
            {{ csrf_field() }}
            <div class="row">
                <div class="from-group col-sm-4 form_input_field">
                    <label for="date">Date</label>
                    <input type="text" class="form-control" name="date" autocomplete="off" id="datepicker" value="{{Request::old('date')}}" placeholder="Date" >
                    <span style="color:red;">{{$errors->first('date')}}</span>
                </div>

                <div class="from-group col-sm-4 form_input_field">
                    <label for="from">From</label>
                    <input type="text" class="form-control auto_caps lnt_validation alphabets" autocomplete="off" placeholder="From" name="from" value="{{Request::old('from')}}" maxlength="4"  id="from" >
                    <span style="color:red;">{{$errors->first('from')}}</span>
                </div>

                <div class="from-group col-sm-4 form_input_field">
                    <label for="to">To</label>
                    <input type="text" class="form-control auto_caps alphabets" placeholder="To" autocomplete="off" name="to" value="{{Request::old('to')}}"  maxlength="4" id="to">
                    <span style="color:red;">{{$errors->first('to')}}</span>
                </div>
            </div>
            <div class="row">
                        
                <div class="from-group col-sm-4 form_input_field">
                    <label for="to">Cargo</label>
                    <select name="cargo" class="form-control" id="cargo">
                      <option value="">Select</option>
                      <option value="20">20</option>
                      <option value="40">40</option>
                      <option value="60">60</option>
                    </select>
                    <span style="color:red;">{{$errors->first('to')}}</span>
                </div>
                <div class="col-sm-4">
                    <label for="take_off_fuel">Take Off Fuel (Max. 3650 Lbs)</label>
                    <input type="text" autocomplete="off" name="take_off_fuel" id="take_off_fuel" class="form-control take_off_fuel_roundoff numbers" value="{{Request::old('take_off_fuel')}}" placeholder="Take Off Fuel" >
                    <span style="color:red;">{{$errors->first('take_off_fuel')}}</span>
                </div>

                <div class="col-sm-4">
                    <label for="landing_fuel">Landing Fuel</label>
                    <input type="text" name="landing_fuel" id="landing_fuel" autocomplete="off" class="form-control landing_fuel_roundoff numbers" value="{{Request::old('landing_fuel')}}" placeholder="Landing Fuel" >
                    <span style="color:red;">{{$errors->first('landing_fuel')}}</span>
                </div>
            </div>
            <div class="row">
                <div class="from-group col-sm-4 form_input_field">
                    <label for="pilot">Pilot Name</label>
                    <input type="text" class="form-control auto_caps alphabets_with_space" placeholder="Pilot Name" autocomplete="off" name="pilot" value="{{Request::old('pilot')}}"  id="pilot">
                    <span style="color:red;">{{$errors->first('pilot')}}</span>
                </div>
                <div class="from-group col-sm-4 form_input_field">
                    <label for="co_pilot">Co Pilot Name</label>
                    <input type="text" class="form-control auto_caps alphabets_with_space" placeholder="Co Pilot Name" autocomplete="off" name="co_pilot" value="{{Request::old('co_pilot')}}"  id="co_pilot">
                    <span style="color:red;">{{$errors->first('co_pilot')}}</span>
                </div>
            </div>

            <div class="clearfix"></div>
           <div class="row">
              <div class="from-group col-sm-4 form_input_field">
                <fieldset class="scheduler-border ">
                      <legend class="scheduler-border">Pax1</legend>
                       <input type="radio" value="165" name="pax0" @if(Request::old('pax1')) =="165" checked @endif>Adult</label>
                       <input type="radio" value="77" name="pax0" @if(Request::old('pax1')) =="165" checked @endif>Child</label>
                       <input type="radio" value="187" name="pax0" @if(Request::old('pax1')) =="165" checked @endif>Infant</label>
                </fieldset>
              </div>
              <div class="from-group col-sm-4 form_input_field">
                <fieldset  class="scheduler-border">
                      <legend class="scheduler-border">Pax2</legend>
                       <input type="radio" value="165" name="pax1" @if(Request::old('pax2')) =="165" checked @endif>Adult</label>
                       <input type="radio" value="77" name="pax1" @if(Request::old('pax2')) =="165" checked @endif>Child</label>
                       <input type="radio" value="187" name="pax1" @if(Request::old('pax2')) =="165" checked @endif>Infant</label>
                </fieldset>
              </div>
              <div class="from-group col-sm-4 form_input_field">  
                  <fieldset class="scheduler-border">
                      <legend class="scheduler-border">Pax3</legend>
                       <input type="radio" value="165" name="pax2" @if(Request::old('pax3')) =="165" checked @endif>Adult</label>
                       <input type="radio" value="77" name="pax2" @if(Request::old('pax3')) =="165" checked @endif>Child</label>
                       <input type="radio" value="187" name="pax2" @if(Request::old('pax3')) =="165" checked @endif>Infant</label>
                  </fieldset>
              </div>  
            </div>
            <div class="row">
               <div class="from-group col-sm-4 form_input_field">
                  <fieldset class="scheduler-border">
                      <legend class="scheduler-border">Pax4</legend>
                       <input type="radio" value="165" name="pax3" @if(Request::old('pax4')) =="165" checked @endif>Adult</label>
                       <input type="radio" value="77" name="pax3" @if(Request::old('pax4')) =="165" checked @endif>Child</label>
                       <input type="radio" value="187" name="pax3" @if(Request::old('pax4')) =="165" checked @endif>Infant</label>
                  </fieldset>
                </div>
                <div class="from-group col-sm-4 form_input_field">
                  <fieldset class="scheduler-border">
                      <legend class="scheduler-border">Pax5</legend>
                       <input type="radio" value="165" name="pax4" @if(Request::old('pax5')) =="165" checked @endif>Adult</label>
                       <input type="radio" value="77" name="pax4" @if(Request::old('pax5')) =="165" checked @endif>Child</label>
                       <input type="radio" value="187" name="pax4" @if(Request::old('pax5')) =="165" checked @endif>Infant</label>
                  </fieldset>
                </div>
                <div class="from-group col-sm-4 form_input_field">
                   <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Pax6</legend>
                         <input type="radio" value="165" name="pax5" @if(Request::old('pax6')) =="165" checked @endif>Adult</label>
                         <input type="radio" value="77" name="pax5" @if(Request::old('pax6')) =="165" checked @endif>Child</label>
                         <input type="radio" value="187" name="pax5" @if(Request::old('pax6')) =="165" checked @endif>Infant</label>
                  </fieldset>
                </div>
            </div>
            <div class="row" id="button">
                <div class="col-sm-1 text-center">
                    <button  class="btn search-btn" >Submit</button>
                </div>
            </div>
            </fieldset>
        </form>
    </div>
    <script src="{{url('app/js/common/validation.js')}}" type="text/javascript"></script>
</body>
<script>
  $( function() {
  //   $( "select" )
  // .change(function () {
  //   // var str = "";
  //   var val=$("select option:selected" ).val();
  //   if(val==20||val==60||val==40)
  //   {
  //     $('#cargo').css('border','1px solid #ccc');
  //   }
  //   else
  //   {
  //    $('#cargo').css('border','1px solid red');
  //   }
  // })
    $("#datepicker").on('keyup', function () 
     {
         if ($(this).val().length <= 0) 
         {
            $(this).css("border", "red solid 1px");
         }
         else
         {
            $(this).css("border", "1px solid #999");
         }
     });  
     $("#from").on('keyup', function () 
     {
         
         if ($(this).val().length <= 3) 
         {
            $(this).css("border", "red solid 1px");
         }
         else
         {
            $('#to').focus();
            $(this).css("border", "1px solid #999");
         }
     });  
     $("#to").on('keyup', function () 
     {
         
         if ($(this).val().length <= 3) 
         {
            $(this).css("border", "red solid 1px");
         }
         else
         {
            $("#baggage_nose").focus();
            $(this).css("border", "1px solid #999");
         }
     });  
      $("#take_off_fuel").on('keyup', function () 
     {
        console.log($(this).val().length);
         if ($(this).val().length <=0) 
         {
            console.log('if_take_off_fuel');
            $(this).css("border", "red solid 1px");
         }
         else
         {
            console.log('else_take_off_fuel');
            $(this).css("border", "1px solid #999");
         }
     });  
    $("#landing_fuel").on('keyup', function () 
     {
         if ($(this).val().length <= 0)  
         {
            console.log('landing_fuel_keup_if');
            $(this).css("border", "red solid 1px");
         }
         else
         {
            console.log('landing_fuel_key_up_else');
            $(this).css("border", "1px solid #999");
         }
     });  
    $("#pilot,#co_pilot").on('keyup', function () 
     {
        
         if ($(this).val().length <= 1) 
         {
            $(this).css("border", "red solid 1px");
         }
         else
         {
            $(this).css("border", "1px solid #999");
         }
     });  
           $('.take_off_fuel_roundoff').blur(function(){
              var val=$(this).val();
              var mod=val%25;
              var result;
                if(mod<=12 && val.length>0)
                {
                    result=val-mod;
                }
                if(mod>12 && val.length>0)
                {  
                    add_res=25-mod;
                    result=parseInt(val)+ parseInt(add_res);
                }
                if(val<100 && val.length>0)
                  result=100;   
                if(val>3650)
                   result=3650;
               $(this).val(result);
               console.log('take_off_fuel_length'+$(this).val().length);
               console.log($("#landing_fuel").val());
               console.log($("#landing_fuel").val().length);
               if($("#landing_fuel").val().length>0 && $(this).val().length>0)
               {  
                     if(result<=parseInt($("#landing_fuel").val()))
                      {
                          console.log('landing_fuel_if');
                          $("#landing_fuel").css("border", "red solid 1px");
                          $("#take_off_fuel").css("border", "red solid 1px");
                      }
                      else
                      {
                          console.log('landing_fuel_else');
                          $("#landing_fuel").css("border", "1px solid #999");
                          $("#take_off_fuel").css("border", "1px solid #999"); 
                      }
               }
           });
           $('.landing_fuel_roundoff').blur(function(e)
           {
              var val=$(this).val();
              var mod=val%25;
              var result;
              if(mod<=12 && val.length>0)
                    result=val-mod;
              if(mod>12 && val.length>0)
                {
                    add_res=25-mod;
                    result=parseInt(val)+ parseInt(add_res);
                }
                if(val<100 && val.length>0)
                  result=100;   
                if(val>3650)
                   result=3650;
                 $(this).val(result);
                 if($("#take_off_fuel").val().length>0 && $(this).val().length>0)
                 { 
                    if(result>=parseInt($("#take_off_fuel").val()))
                    {
                        console.log('take_off_fuel_if');
                        $("#landing_fuel").css("border", "red solid 1px");
                        $("#take_off_fuel").css("border", "red solid 1px");
                        $(this).val(result);
                    }
                  else
                    { 
                      console.log('take_off_fuel_else');
                         $(this).val(result);
                        $("#landing_fuel").css("border", "1px solid #999");
                        $("#take_off_fuel").css("border", "1px solid #999");   
                    }
               }    
           });
  $("#myform").submit(function()
  {
     var bool=true;
      if($("#baggage_nose").val()=='')
      {
        $("#baggage_nose").css("border", "red solid 1px");

        bool=false;
      }
      if($("#aft_fuselage_baggage_forward").val()=='')
      {
        $("#aft_fuselage_baggage_forward").css("border", "red solid 1px");

        bool=false;
      }
      // if($("#cargo").val()=='')
      // {
      //   $("#cargo").css("border", "red solid 1px");

      //   bool=false;
      // }
      if($("#aft_fuselage_baggage_aft").val()=='')
      {
        $("#aft_fuselage_baggage_aft").css("border", "red solid 1px");

        bool=false;
      }
      if($("#baggage_aft_cabin").val()=='')
      {
        $("#baggage_aft_cabin").css("border", "red solid 1px");

        bool=false;
      }
      if($("#datepicker").val()=='')
      {
        $("#datepicker").css("border", "red solid 1px");

        bool=false;
      }
      if($("#from").val()=='' || $("#from").val().length<4)
      { 

        $("#from").css("border", "red solid 1px");
         bool=false;
        // alert(bool);
      }      
      if($("#to")=='' || $("#to").val().length<4)
      { 
        $("#to").css("border", "red solid 1px");
        bool=false;
      }
      if($("#take_off_fuel").val()=='')
      {
        $("#take_off_fuel").css("border", "red solid 1px");
        bool=false;
      }
     // alert("hiii");
      if($("#landing_fuel").val()=='' || $("#take_off_fuel").val()=='' || parseInt($("#landing_fuel").val())>=parseInt($("#take_off_fuel").val()))
      {
        //alert("if");
        console.log("ggg");
        $("#landing_fuel").css("border", "red solid 1px");
        $("#take_off_fuel").css("border", "red solid 1px");
        bool=false;
      }
      else
      {
        
              var take_off_fuel_val=$("#take_off_fuel").val();
              var take_off_fuel_mod=take_off_fuel_val%25;
              var take_off_fuel_result;
              var landing_fuel_val=$("#landing_fuel").val();
              var landing_fuel_mod=landing_fuel_val%25;
              var landing_fuel_result;
                if(take_off_fuel_mod<=12 && take_off_fuel_val.length>0)
                {
                    take_off_fuel_result=take_off_fuel_val-take_off_fuel_mod;
                }
                if(take_off_fuel_mod>12 && take_off_fuel_val.length>0)
                {  
                    take_off_fuel_add_res=25-take_off_fuel_mod;
                    take_off_fuel_result=parseInt(take_off_fuel_val)+ parseInt(take_off_fuel_add_res);
                }
                if(take_off_fuel_val<100 && take_off_fuel_val.length>0)
                  take_off_fuel_result=100;   
                if(take_off_fuel_val>3650)
                   take_off_fuel_result=3650;
               $("#take_off_fuel").val(take_off_fuel_result);
               if(landing_fuel_mod<=12 && landing_fuel_val.length>0)
                {
                    landing_fuel_result=landing_fuel_val-landing_fuel_mod;
                }
                if(landing_fuel_mod>12 && landing_fuel_val.length>0)
                {  
                    landing_fuel_add_res=25-landing_fuel_mod;
                    landing_fuel_result=parseInt(landing_fuel_val)+ parseInt(landing_fuel_add_res);
                }
                if(landing_fuel_val<100 && landing_fuel_val.length>0)
                  landing_fuel_result=100;   
                if(landing_fuel_val>3650)
                   landing_fuel_result=3650;
               $("#landing_fuel").val(landing_fuel_result);
              
      }
     // alert("sss");
        if($("#pilot").val()=='')
        {
          $("#pilot").css("border", "red solid 1px");
          bool=false;
        }
        if($("#co_pilot").val()=='')
        {
          $("#co_pilot").css("border", "red solid 1px");
          bool=false;
        }
      //alert(bool);
      return bool;
  });
            $("#datepicker" ).datepicker({
                showOtherMonths: true,
                dateFormat: 'dd-M-yy',
                selectOtherMonths: true,
                onSelect: function(dateText, inst) { 
                    $("#datepicker").css("border", "1px solid #999");
                }
            }).datepicker("setDate", "0");
  });
  </script>
</html>