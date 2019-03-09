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
                    <input type="text" data-toggle="popover" data-placement="top" class="form-control auto_caps lnt_validation alphabets" autocomplete="off" placeholder="From" name="from" value="{{Request::old('from')}}" maxlength="4"  id="from" >
                    <span style="color:red;">{{$errors->first('from')}}</span>
                </div>

                <div class="from-group col-sm-4 form_input_field">
                    <label for="to">To</label>
                    <input type="text" data-toggle="popover" data-placement="top" class="form-control auto_caps alphabets" placeholder="To" autocomplete="off" name="to" value="{{Request::old('to')}}"  maxlength="4" id="to">
                    <span style="color:red;">{{$errors->first('to')}}</span>
                </div>
            </div>
            <div class="row">
                        
                <div class="from-group col-sm-4 form_input_field">
                    <label for="to">Cargo</label>
                    <select name="cargo" class="form-control" id="cargo">
                      <option value="">Select</option>
                      <option value="10">10</option>
                      <option value="20">20</option>
                      <option value="30">30</option>
                      <option value="40">40</option>
                      <option value="50">50</option>
                      <option value="60">60</option>
                      <option value="70">70</option>
                      <option value="80">80</option>
                      <option value="90">90</option>
                      <option value="100">100</option>
                      <option value="110">110</option>
                      <option value="120">120</option>
                    </select>
                    <span style="color:red;">{{$errors->first('to')}}</span>
                </div>
                <div class="col-sm-4">
                    <label for="take_off_fuel">Take Off Fuel (Max. 3650 Lbs)</label>
                    <input type="text" autocomplete="off" data-toggle="popover" data-placement="top" name="take_off_fuel" id="take_off_fuel" class="form-control take_off_fuel_roundoff numbers" value="{{Request::old('take_off_fuel')}}" placeholder="Take Off Fuel" >
                    <span style="color:red;">{{$errors->first('take_off_fuel')}}</span>
                </div>

                <div class="col-sm-4">
                    <label for="landing_fuel">Block Fuel</label>
                    <input type="text" name="less_fuel" data-toggle="popover" data-placement="top" id="landing_fuel" autocomplete="off" class="form-control landing_fuel_roundoff numbers" value="{{Request::old('less_fuel')}}" placeholder="Less Fuel" >
                    <span style="color:red;">{{$errors->first('less_fuel')}}</span>
                </div>
            </div>
            <div class="row">
                <div class="from-group col-sm-4 form_input_field">
                    <label for="pilot">Pilot Name</label>
                    <input type="text" data-toggle="popover" data-placement="top" class="form-control auto_caps alphabets_with_space" placeholder="Pilot Name" autocomplete="off" name="pilot" value="{{Request::old('pilot')}}"  id="pilot">
                    <span style="color:red;">{{$errors->first('pilot')}}</span>
                </div>
                <div class="from-group col-sm-4 form_input_field">
                    <label for="co_pilot">Co Pilot Name</label>
                    <input type="text" data-toggle="popover" data-placement="top" class="form-control auto_caps alphabets_with_space" placeholder="Co Pilot Name" autocomplete="off" name="co_pilot" value="{{Request::old('co_pilot')}}"  id="co_pilot">
                    <span style="color:red;">{{$errors->first('co_pilot')}}</span>
                </div>
                <div class="from-group col-sm-4 form_input_field">
                    <label for="to">Pax</label>
                    <select name="pax" class="form-control" id="pax">
                      <option value="">Select</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                    </select>
                    <span style="color:red;">{{$errors->first('to')}}</span>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="row" id="button">
                <div class="col-sm-1 text-center">
                    <button  class="btn search-btn" >Submit</button>
                </div>
            </div>
            </fieldset>
        </form>
    </div>
    <script src="{{url('app/js/common/validation.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
  $("#select_date" ).datepicker({ minDate: 0});
  $('document').ready(function(){
  $("#select_date").datepicker().datepicker("setDate", new Date());
});
</script>
</body>
</html>