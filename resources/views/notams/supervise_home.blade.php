@extends('layouts.notam_layout',array('1'=>'1'))
@section('content')
@push('supervisefiles')
<link rel="stylesheet" type="text/css" href="{{url('app/css/notams/supervise_home.css')}}">
@endpush
<div class="page">
    <!-- @include('includes.new_fpl_header',[]) -->
    @include('includes.new_header',[])
    <main>
        <section class="bg-1 welcome infopage" >
            <div class="container container-supervise">
                <div class="supervise_header_title">
                    NOTAM SUPERVISOR
                </div>
                <div class="row item-strip">
                    <div class="col-md-6 p-r-0">
                        VIDF NOTAMS
                    </div>
                    <div class="col-md-6">
                        {!! $vi !!}
                    </div>
                </div>
                <div class="row item-strip">
                    <div class="col-md-6 p-r-0">
                        VABF NOTAMS
                    </div>
                    <div class="col-md-6">
                        {!! $va !!}
                    </div>
                </div>
                <div class="row item-strip">
                    <div class="col-md-6 p-r-0">
                        VECF NOTAMS
                    </div>
                    <div class="col-md-6">
                        {!! $ve !!}
                    </div>
                </div>
                <div class="row item-strip">
                    <div class="col-md-6 p-r-0">
                        VOMF NOTAMS
                    </div>
                    <div class="col-md-6">
                        {!! $vo !!}
                    </div>
                </div>
                <div class="row item-strip last-visited-row">
                    <div class="col-md-6 p-r-0">
                        New notams since last visited 
                    </div>
                    <div class="col-md-6">
                        <a href="javascript:void(0)" class="count-since-last-visited"> {!! $last_visited !!}</a> 
                        <span >{!! $last_visited_date !!}</span>
                    </div>
                </div>


            </div>

        </section>

    </main>   
    <div id='v_toTop'><span></span></div>



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
        $(".count-since-last-visited").on('click', function () {
            if ($(this).html() == 0) {
                return;
            }
            // $.redirect(base_url + '/notams/supervise/pending', { _token : $('meta[name="_token"]').attr('content'), data : $(this).html() }, 'POST', '_blank');
            $.redirect(base_url + '/notams/supervise/pending', {_token: $('meta[name="_token"]').attr('content'), data: $(this).html()}, 'POST');
            console.log($(this).html());
        });
    </script>

    @include('includes.new_footer',[])
</div>
@stop