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

                    <h3><i class="fa fa-external-link"></i>All Notams</h3>

                    <div class="actions">

                        <a href="view_new_notams.php" role="button" class="btn btn-mini"><i class="fa fa-history"></i> View New Notams</a>              

                    </div>

                </div>

                <div class="box-content"> 

		    <?php echo '<div style="padding-left: 10px;"><b> Number of NOTAMS:</b> ' . $count . '</div>'; ?>

                    <table class="datatable_newnotam table-bordered table-hover table-striped data_table_actions">

                        <thead>

                            <tr> <th class="col-sm-1">#</th>

                                <th class="col-sm-6">New Notams</th>

                                <th class="col-sm-2">From Date</th>

                                <th class="col-sm-2">To Date</th>

                                <th class="col-sm-1">Status</th>
				<?php if ($_SESSION['user_type'] != 1) { ?>
    				<th>Actions</th>
				<?php } ?>
                            </tr>    

                        </thead>

                        <tbody>

			    <?php
			    $sno = 1;
			    $dupe_notam_number = '';
			    foreach ($getNotams as $notams) {
				?>

    			    <tr>

    				<td>  <?php echo $sno; ?></td>

    				<td border='0' class="" align='left'>                                      

					<?php
					if ($dupes) {
					    $dupe_notam_number = $notams['dupe_notam_number'];
					}
					echo $notams['notam_number'] . $dupe_notam_number . ' NOTAMR ' . $notams['revised_notam_number'];

					echo '<br/>';

					echo 'A) ' . $notams['airport'];

					echo '<br/>';

					echo ' B) ' . $notams['from_date'] . $notams['from_time'];

					echo '<br/>';

					echo ' C) ' . $notams['to_date'] . $notams['to_time'];

					echo '<br/>';

					if ($notams['valid_timing']) {

					    echo $notams['valid_timing'];

					    echo '<br/>';
					}

					echo 'E ) <span data-id="' . $notams['id'] . '" class="notam_text_update" data-url ="ajaxbak/notam_update.php" id="notam_text' . $notams['id'] . '">' . $notams['notam_text'] . '</span>';
					?><br/>

    				</td>



    				<td><?php echo $notams['from_date'] . ' - ' . $notams['from_time']; ?></td>

    				<td><?php echo $notams['to_date'] . ' - ' . $notams['to_time']; ?></td>

    				<td><?php echo ($notams['status']) ? 'Active' : 'Inactive' ?></td>
				    <?php if ($_SESSION['user_type'] != 1) { ?>
					<td id="td<?php echo $notams['id'] ?>">
					    <a href="#" style="padding-right: 10px" data-id="<?php echo $notams['id'] ?>"  class="edit_notam_text"><i class="fa fa-edit fa-2x"></i></a>
					    <a href="#" class="delete_notam" data-id="<?php echo $notams['id'] ?>" data-url ="ajaxbak/notam_update.php" ><i class="fa fa-trash-o fa-2x"></i></a>
					</td>
				    <?php } ?>
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