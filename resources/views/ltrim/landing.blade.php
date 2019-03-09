@extends('layouts.new_index_layout',array('1'=>'1'))
@section('content')
<link rel="stylesheet" href="{{url('app/new_temp/css/animate.css')}}">
<style>
    .cust-container {
        background: #ffffff;
        margin:20px auto;
        box-shadow: 0 0 3px 1px #999999;
    }
    .tp_main_heading {
        text-align: center;
        font-family:inherit;
        font-size: 36px;
        margin:0;
    }
    .tp_main_img {
        width: 70%;
        margin: 0 auto;
        moz-transition: 0.5s all ease;
        -o-transition: 0.5s all ease;
        -webkit-transition: 0.5s all ease;
        transition: 0.5s all ease;
    }
    .tp_main_img:hover, .tp_sec_img:hover {
        -moz-transform: scale(1.1);
        -ms-transform: scale(1.1);
        -o-transform: scale(1.1);
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
        moz-transition: 0.5s all ease;
        -o-transition: 0.5s all ease;
        -webkit-transition: 0.5s all ease;
        transition: 0.5s all ease;
    }
    .color-red {
        color: #f1292b;
        font-weight: bold;
    }
    .tp_list li {
        list-style-image: url('media/images/tripsupport/bullet.png');
        font-size: 14px;
        font-weight: bold;
    }
    .tp_sec_img {
        width:90%;
        moz-transition: 0.5s all ease;
        -o-transition: 0.5s all ease;
        -webkit-transition: 0.5s all ease;
        transition: 0.5s all ease;
    }
    @media (max-width:768px) {
        .tp_main_img {
            width: 90%;
        }
        .tp_main_heading {
            font-size: 19px;
        }
    }
</style>

<div class="page" id="app">
    @include('includes.new_header',[])
    <main>
        <div class="container cust-container">
            <div class="row">
                <h1 class="tp_main_heading">LOAD AND TRIM</h1>
            </div>
            
        </div>

    </main>
    @include('includes.new_footer',[])
</div>

@stop