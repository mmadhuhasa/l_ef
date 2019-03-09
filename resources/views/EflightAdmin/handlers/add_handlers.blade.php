@extends('layouts.backend_layout2',array('1'=>'1'))
@section('content')
<style>
    .call_sign_textarea {
        margin-top:20px;
        resize: none;
        border-radius: 4px;
        border: 1px solid #555555;
        color:#888888;
        font-size:13px;
        margin-bottom:20px;
    }
    textarea:focus {
        border-color:red !important;
        box-shadow:none !important;
    }
    .designation_select {
        border-color: #555;
    }
    .designation_select:focus {
        border-color: red;
        box-shadow: none;
    }
    .designation_select option {
        text-transform: uppercase;
    }
    .handlers_heading {
        text-transform: uppercase;
        text-align: center;
        padding: 5px 0;
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
</style>    
<div id="page">
    @include('includes.v_header',[])  
    <section>
        <div class="container cust-container-v">
            <div class="row">
                <div class="col-md-12 p-lr-0">
                    <p class="handlers_heading">UPDATE HANDLER DETAILS</p>
                </div>
            </div>
            <div class="row">
                <form>
                    <div class="col-md-offset-2 col-md-2">
                        <input type="text" class="form-control" placeholder="airport">
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="handling company name">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn newbtnv1">submit</button>
                    </div>
                    <div class="col-md-12">
                        <textarea rows=5 class="call_sign_textarea form-control ">CALL SIGN</textarea>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="staff name">
                        
                    </div>
                     <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="email">
                        
                    </div>
                     <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="mobile">
                        
                    </div>
                     <div class="col-md-2">
                         <select class="form-control designation_select">
                             <option  selected disabled>DESIGNATION</option>
                             <option>PILOT</option>
                             <option>CO-PILOT</option>
                         </select>
                       
                    </div>
                </form>
            </div>


        </div>

    </section>
    @include('includes.v_footer',[])  
</div>
@stop