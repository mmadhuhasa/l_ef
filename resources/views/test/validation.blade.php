@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@section('content')
<head>
    <script>
        if (window.Notification && Notification.permission !== "denied") {
            Notification.requestPermission(function (status) {  // status is "granted", if accepted by user
                var title = "Hi Hello";
                var body = "Hello World!";
                var n = new Notification(title, {
                    body: body,
                    dir: "ltr",
                    icon: base_url + '/app/new_temp/images/logo-web.png' // optional https://davidwalsh.name/demo/notifications-api.php
                });
                n.onshow = function () {
                    console.log('Notification shown');
                };
                n.onerror = function () {
                    console.log('Error in Notification');
                }
                n.onclick = function () {
                    console.log('click in Notification');
                }
                n.onclose = function () {
                    console.log('close in Notification');
                }
                n.close();
            });
        }
    </script>
</head>
<div class="container">
    <div class="row">
	<section>
	    <div class="col-sm-8 col-sm-offset-2">
		<div class="page-header">
		    <h2>Test</h2>
		</div>
		{!! Form::open(array('url' => 'foo/bar', 'method' => 'put')) !!}
		{!! Form::label('email', 'E-Mail Address', array('class' => 'awesome awesome2')) !!}
		{!! Form::select('animal', array(
		'Cats' => array('leopard' => 'Leopard'),
		'Dogs' => array('spaniel' => 'Spaniel'),
		)) !!}
		{!! Form::close() !!}

	    </div>
	</section>
    </div>
</div>

@stop
