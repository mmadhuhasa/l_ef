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

            <div class="margin-top form-group form-inline text-right">

                <form action="#" name="" method="POST" id="" role="form">

                    <input type="text" placeholder="Airport or FIR" maxlength="4" value="<?php echo $airport_fir; ?>" class="form-control airport_maps airport_uppercase" name="fir" id="airport_maps">

                    <input type="text" placeholder="NOTAM Number" class="form-control airport_maps" name="notam_number" value="<?php echo $notam_number; ?>" id="notam_number_maps">

                    <button type="submit" style="height: 35px;padding:0px;width: 105px;"  name="Search_coordinates" class="form-control"><img src="images/Search Image.png" /></button>                   

                    <!--<button class="btn btn-success show_coordinates " id="show_coordinates"><i class="fa fa-location-arrow fa-2x"> Show Coordinates</i></button>-->

                </form>

            </div>

            <div class="load text-right"><span  id="load"></span></div>

            <div id="response">

                <div class="box box-color box-bordered box-small">

                    <div class="box-title">

                        <h3><i class="fa fa-external-link"></i>Coordinates</h3>

                        <div class="actions">

                            <a href="update_coordinates.php" role="button" class="btn btn-mini"><i class="fa fa-history fa-2x"></i> Update Coordinates</a>              

                        </div>

                    </div>



                    <div class="box-content">  

			<?php //echo '<div style="padding-left: 10px;"><b> Number of Coordinates :</b> ' . $count . '</div>';   ?>

                        <form action="#" name="" id="" role="form">

                            <table cellspacing="0" width="100%" class="display coordinates_check table-bordered table-hover table-striped data_table">

                                <thead>

                                    <tr>

    <!--                                    <th class="col-sm-1"><input class="check_all" id="check_all" type="checkbox" /></th>

                                        <th class="col-sm-1">#</th>                                -->

                                        <th class="col-sm-1">FIR</th>

                                        <th class="col-sm-2">NOTAM.No</th>

    <!--                                    <th class="col-sm-1">Dec. Lat</th>

                                        <th class="col-sm-1">Dec.Long</th>                                -->

                                        <th class="col-sm-2">Latitude</th>

                                        <th class="col-sm-2">Longitude</th>

                                        <th class="col-sm-2">Show Point</th>

                                        <th class="col-sm-2">NOTAM Map</th>

                                        <th class="col-sm-2">NoFlying</th>

                                    </tr>    

                                </thead>

                                <tbody>

				    <?php
				    $sno = 1;

				    foreach ($get_coordinates as $coordinates) {
					?>

    				    <tr>

                    <!--                                        <td><input id="coordinates_check<?php echo $coordinates['id']; ?>" name="coordinates_check[]" value="<?php echo $coordinates['id']; ?>" type="checkbox" /></td>

                                                            <td><?php // echo $sno;         ?></td>                                    -->

    					<td><?php echo $coordinates['fir']; ?></td>

    					<td><?php echo $coordinates['notam_number']; ?></td>

                    <!--                                        <td><?php //echo $coordinates['lat_degs'];          ?></td>

                                                            <td><?php //echo $coordinates['lat_mins'];          ?></td>                                   -->

                                                            <!--<td><?php echo $coordinates['lat_degs'] . '' . '&deg' . $coordinates['lat_mins'] . "'" . $coordinates['lat_secs'] . '"'; ?></td>-->

                                                            <!--<td><?php echo $coordinates['long_degs'] . '' . '&deg' . $coordinates['long_mins'] . "'" . $coordinates['long_secs'] . '"'; ?></td>-->
    					<td><?php echo $coordinates['lattitude']; ?></td>
    					<td><?php echo $coordinates['longtitude']; ?></td>
    					<td>                                   

    					    <a href="#"  data-id="<?php echo $coordinates['id']; ?>" class="margin-left show_map" style="color: red"><i class="fa fa-map-marker fa-2x"></i></a>

    					</td>

    					<td>

    					    <a href="#" class="show_map" data-id='' data-notam-number='<?php echo $notam_number; ?>' data-from-time="<?php echo $from_time; ?>" data-to-time="<?php echo $to_time; ?>"

    					       data-from-date="<?php echo $from_date; ?>" data-to-date="<?php echo $to_date; ?>" data-notam-text='<?php echo $notam_text; ?>' data-fir='<?php echo $airport_fir ?>' id="" ><img src="images/Multiples Maps Image.png" style="height: 25px;width: 25px" /></a>      

    					</td>

    					<td>

						<?php if ($count > 2) { ?> <input type="checkbox" name="" id="" class="" /><?php } ?>

    					</td>

    				    </tr>

					<?php
					$sno++;
				    }
				    ?>

                                </tbody>

                            </table>  

                        </form>

                    </div>



                </div>

            </div>

        </div>

    </div>

</div>

<div id='showmap'></div>

<div id="map-canvas"></div>

@stop