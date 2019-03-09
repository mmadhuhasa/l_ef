<!-- resources/views/auth/login.blade.php -->
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

<div class="container-fluid">

    <div class='login_info'>   

        <span>

            <img style="height: 63px" src="media/logo/eflightlogo.png">

        </span>

    </div>

    <div class="row">    

        <div class="box box-color box-bordered box-small">

            <div class="box-title">

                <h3><i class="fa fa-external-link"></i>Notam Users Details</h3>

                <div class="actions">

                    <a href="notam_users.php" role="button" class="btn btn-mini"><i class="fa fa-user-plus"></i> Add Notam Users</a>                  

                </div>

            </div>

            <div class="box-content">

                <div class="col-sm-12">

                    <table id="notam_users_display" class="data_table table-bordered table-hover table-striped">

                        <thead>
                            <tr>
                                <th>SNO</th>

                                <th>First Name</th>

                                <th>Last Name</th>

                                <th>Email</th>

                                <th>Mobile</th>                      

                                <th>Operator</th>

                                <th>All Airports</th>
                                <th>All Routes</th>

                                <th>User Type</th>

                                <th>Status</th>

                                <th>Actions</th>

                            </tr>

                        </thead>

                        <tbody>

			    <?php
			    $sno = 1;

			    foreach ($notam_users as $users) {
				$status = ($users['status']) ? 'Active' : 'Inactive';
				?>
    			    <tr>
    				<td><?php echo $sno; ?></td>
    				<td    id="fname<?php echo $users['notam_id']; ?>"> <?php echo $users['first_name']; ?></td> 
    				<td    id="lname<?php echo $users['notam_id']; ?>"> <?php echo $users['last_name']; ?></td>
    				<td><?php echo $users['email']; ?></td> 
    				<td    id="mobile_number<?php echo $users['notam_id']; ?>"> <?php echo $users['mobile_number']; ?></td>
    				<td    id="operator<?php echo $users['notam_id']; ?>" ><?php echo $users['operator']; ?></td> 
    				<td    id="airport1<?php echo $users['notam_id']; ?>" >
    				    <a href="#" data-toggle="tooltip" data-placement="bottom" title="<?php echo $users['all_airports']; ?>"><?php echo substr($users['all_airports'], 0, 10) . '..'; ?></a>
    				</td>
    				<td    id="airport2<?php echo $users['notam_id']; ?>" >
    				    <a href="#" data-toggle="tooltip" data-placement="bottom" title="<?php echo $users['all_routes']; ?>">  <?php echo substr($users['all_routes'], 0, 10) . '..'; ?></a>
    				</td> 
    				<td>
    				    <select id="user_type" style="width: 126px;height: 27px;">
    					<option value="<?php echo $users['user_type']; ?>">
						<?php
						if ($users['user_type'] == 1) {

						    echo 'Pilot';
						} else if ($users['user_type'] == 2) {

						    echo 'Operation Team';
						} else if ($users['user_type'] == 4) {

						    echo 'Admin';
						} else {

						    echo 'Pilot';
						}
						?>
    					</option>
					    <?php if ($users['user_type'] != 4) { ?>
						<option value="0">--Please Select--</option>
						<option value="1">Pilot</option>
						<option value="2">Ops Team</option>  
					    <?php } ?>
    				    </select>
    				</td> 
    				<td id="status<?php echo $users['notam_id']; ?>"><?php echo $status; ?></td>    
    				<td>
    				    <a href="#" class="update_users" data-toggle="modal" id="edit_status<?php echo $users['notam_id']; ?>" rel="tooltip" title="Edit" style="padding-right: 6px;" ><i class="fa fa-edit fa-2x"></i></a>
    				    <a href="#" class="delete_user" id="delete_user<?php echo $users['notam_id']; ?>" data-url="ajaxbak/notamusers.php" data-id="<?php echo $users['notam_id']; ?>" rel="tooltip" title="Delete" ><i class="fa fa-trash fa-2x"></i></a>                                    
    				</td>
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