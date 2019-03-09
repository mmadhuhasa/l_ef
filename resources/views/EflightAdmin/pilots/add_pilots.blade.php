@extends('layouts.backend_layout2',array('1'=>'1'))
@section('content')
<style>
    .update_pilot_form {
        text-align: center;
        margin-top: 30px;
    }
    .update_pilot_form .form-control {
        margin-bottom: 20px;
        border-color: #555;
        text-align: center;
    }
    .update_pilot_form .form-control:focus {
        border-color: red;
        box-shadow: none;
    }
    select.form-control {
        background-position: 90% 50%;
    }
    select.form-control:focus {
        box-shadow: none;
        border-color:red;
    }

    .upd_heading {
        text-transform: uppercase;
        text-align: center;
        padding:5px 0;
        font-weight: bold;
        background: rgba(249,249,249,1);
        background: -moz-linear-gradient(left, rgba(249,249,249,1) 0%, rgba(255,255,255,1) 0%, rgba(204,204,204,1) 50%, rgba(249,249,249,1) 100%);
        background: -webkit-gradient(left top, right top, color-stop(0%, rgba(249,249,249,1)), color-stop(0%, rgba(255,255,255,1)), color-stop(50%, rgba(204,204,204,1)), color-stop(100%, rgba(249,249,249,1)));
        background: -webkit-linear-gradient(left, rgba(249,249,249,1) 0%, rgba(255,255,255,1) 0%, rgba(204,204,204,1) 50%, rgba(249,249,249,1) 100%);
        background: -o-linear-gradient(left, rgba(249,249,249,1) 0%, rgba(255,255,255,1) 0%, rgba(204,204,204,1) 50%, rgba(249,249,249,1) 100%);
        background: -ms-linear-gradient(left, rgba(249,249,249,1) 0%, rgba(255,255,255,1) 0%, rgba(204,204,204,1) 50%, rgba(249,249,249,1) 100%);
        background: linear-gradient(to right, rgba(249,249,249,1) 0%, rgba(255,255,255,1) 0%, rgba(204,204,204,1) 50%, rgba(249,249,249,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f9f9f9', endColorstr='#f9f9f9', GradientType=1 );
    }
    #upload_button {
        display: none;
        height: 32px;
        border: 1px solid #555;
        background: #fff;
        border-radius: 5px;
        width:100%;
        color: #888;
        padding: 5px;
        text-transform: uppercase;
        font-size: 13px;
    }
    #upload_button:hover {
        color:red;
    }
</style>
<script>
    $(document).ready(function() {
        var button = document.getElementById('upload_button');
    var input = document.getElementById('upload_input');

    input.style.display = 'none';
    button.style.display = 'initial';

    button.addEventListener('click', function (e) {
        e.preventDefault();
        input.click();
    });
    input.addEventListener('change', function () {
        button.innerText = this.value;
    });
    });
    
</script>
<div id="page">
    @include('includes.v_header',[])  
    <section>
        <div class="container cust-container-v">
            <div class="row">
                <div class="col-md-12 p-lr-0">
                    <p class="upd_heading">create pilot details<p>
                </div>

                <div class="col-md-12">
                    <form class="update_pilot_form">
                        <div class="col-md-2 ">

                            <select class="form-control">
                                <option>PILOT</option>
                                <option>CO PILOT</option>
                                <option>CABIN CREW</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="NAME">
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="email">
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" placeholder="mobile">
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="call sign">
                        </div>
                        <div class="col-md-2">
                            <select class="form-control">
                                <option selected disabled>STATUS</option>
                                <option>ACTIVE</option>
                                <option>INACTIVE</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            
                       
                            <p><button id="upload_button">Choose file... <span><i class="fa fa-upload"></i></span></button></p>
                            <p><input  id="upload_input" name="your_name" type="file"/></p>
                        </div>
                        <div class="col-md-2">                          
                            <button type="button" class="btn newbtnv1" style="width: 100%;border:0">submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @include('includes.v_footer',[])  
</div>
@stop