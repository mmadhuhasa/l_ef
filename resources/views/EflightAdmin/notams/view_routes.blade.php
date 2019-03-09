@extends('layouts.master',array('1'=>'1'))
@section('content')
@if(Session::get('success'))
<div class='alert alert-success'>
    <button type="button" class="close" data-dismiss="alert" data-dismiss="alert">x</button>
    {{Session::get('success')}}
</div>
@endif
@if(Session::get('error'))
<div class='alert alert-danger'>
    <button type="button" class="close" data-dismiss="alert" data-dismiss="alert">x</button>
    {{Session::get('error')}}
</div>
@endif

<div class="container">

    <div class='login_info'>   

        <span>

            <img style="height: 63px" src="eflightlogo.png">

        </span>

    </div>

    <div class="row">

        <div class="col-sm-12">

            <div class="box box-color box-bordered box-small">

                <div class="box-title">
                    <h3><i class="fa fa-external-link"></i>Routes</h3>                  
                </div>

                <div class="box-content">                   

                    <table cellspacing="0" width="100%" class="display table-bordered table-hover table-striped data_table">

                        <thead>

                            <tr>

                                <th class="col-sm-1">#</th>

                                <th class="col-sm-2">Airport</th>

                                <th class="col-sm-2">Notam Number</th>

                                <th class="col-sm-2">Route</th>

                                <th class="col-sm-2">Status</th>

                            </tr>    

                        </thead>

                        <tbody>

			    <?php
			    $sno = 1;

			    foreach ($get_routes as $routes) {
				?>

    			    <tr>

    				<td><?php echo $sno; ?></td>

    				<td><?php echo $routes['airport']; ?></td>

    				<td><?php echo $routes['notam_number']; ?></td>

    				<td><?php echo $routes['route_name']; ?></td>

    				<td><?php echo 'Active'; ?></td>

    			    </tr>

				<?php
				$sno++;
			    }
			    ?>

                        </tbody>

                    </table>      

                </div>

            </div>

        </div>

    </div>

</div>

@stop