<style>
    .ui-autocomplete.ui-front.ui-menu.ui-widget.ui-widget-content{
        width: 225px;
        z-index: 9999 !important;
    }
    .download_delete-align{
        padding-left: 22px; 
    }
    #license_file_add_ld
    {
        color: transparent;
    }
    .tooltip_rel {position: relative;}
    .tooltip_rel .fa {cursor:pointer; font-size: 20px;}
    .tooltip_cust {position: absolute;top: -25px;left: 15px;padding: 1px 11px;color: #fff;border-radius: 4px;visibility: hidden;font-size: 11px;text-transform: capitalize;font-weight: normal; box-shadow: 0 0 1px 1px #ccc; background: #333333; z-index: 999999; white-space: nowrap; text-align: center;}
    .tooltip_rel:hover .tooltip_cust{visibility: visible;}
    .tooltip_rel {
        position: relative;
        display: inline;
    }
    .tooltip_edit_position {
        position: absolute;top: -28px;left: -5px;padding: 3px 11px;color: #fff;border-radius: 4px;visibility: hidden;font-size: 11px;font-weight: normal;
        box-shadow: 0 0 1px 1px #ccc;background: #333333;white-space: nowrap;z-index: 20; text-transform: uppercase;
    }
    .tooltip_rel:hover .tooltip_edit_position, .tooltip_rel:hover .tooltip_tri_shape1, .tooltip_rel:hover .tooltip_tri_shape2, .tooltip_rel:hover .tooltip_tri_shape3{visibility: visible;}
    .tooltip_tri_shape1, .tooltip_tri_shape2, .tooltip_tri_shape3 {width: 0;height: 0;border-left: 5px solid transparent;border-right: 5px solid transparent;border-top: 6px solid #333;position: absolute;top: -7px;right: 18px;z-index: 99999;visibility: hidden;}
    .tooltip_tri_shape3  {left:2px;}
    .pdfimg {height: 18px; margin-top: -4px;}
    .t_dp {left: -85px;}
    .t_vh {left:-40px;}

    .cd-horizontal-timeline .events-content p {
        text-align: justify;
    }
    .tooltip_exp_trishape, .tooltip_val_trishape, .tooltip_due_trishape {
        width: 0;
        height: 0;
        border-left: 7px solid transparent;
        border-right: 7px solid transparent;
        position: absolute;
        top: 23px;
        right: 52%;
        z-index: 99999;
    }
    .tooltip_exp_trishape {border-top: 8px solid #f16141;}
    .tooltip_val_trishape {border-top: 8px solid #59cb79;}
    .tooltip_due_trishape {border-top: 8px solid #faad41;}
    .tooltip_exp_trishape, .tooltip_val_trishape, .tooltip_due_trishape {right:50%;}
    .download_delete-align {
        padding-left: 108px;
        margin-top: 10px;
    }
    .download_delete-align_edit{
        padding-left:12px;
        margin-top:5px; 
    }
    .modal-dialog {
    margin: 60px auto;
    }
</style>
<div id="lr_modals"> 
    <!-- addlicense modal -->
    <div id="addLicense" class="modal fade in" style=" padding-right: 17px;">
        <div class="modal-dialog modal-addlicense">
            <header class="popupHeader"> <span class="header_title">ADD LICENSE</span> <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>
            <section class="popupBody">  
                <div class="row">
                    <div class="add_license_success" style="text-align:center;"></div>
                    <div class="col-md-12">
                        <?php $modal_type = "add_ld"; ?>
                        <form class="form_add_license" id="add_license_form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php
                                        $license_types = \App\models\lr\LicenseTypesModel::where('is_active', 1)
                                                        ->orderBy('short_name', 'asc')->get(['id', 'name', 'short_name']);
                                        $lr_users_list = \App\User::get_lr_user_list();
                                        ?>
                                        <select v-model="ltselected2" class="form-control" name="user_id_{{$modal_type}}" id="user_id_{{$modal_type}}">
                                            <option selected disabled value="">SELECT USER</option>
                                            @foreach($lr_users_list as $lr_users_list_val)
                                            <option value="{{$lr_users_list_val->id}}">{{$lr_users_list_val->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <select class="form-control" v-model="ltselected" id="license_type_{{$modal_type}}" name="license_type_{{$modal_type}}">
                                            <option selected disabled>SELECT LICENSE NAME</option>
                                            @foreach($license_types as $license_types_val)
                                            <?php
                                            $license_types_name = strtoupper($license_types_val->name);
                                            $short_name = strtoupper($license_types_val->short_name);
                                            ?>
                                            <option value="{{$license_types_val->id}}">{{$short_name.' -- '.$license_types_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="cust_label">License No</label>
                                    <div class="form-group">
                                        <input type="text" id="number_{{$modal_type}}" maxlength="50" v-model="number_add_ld" name="number_{{$modal_type}}" class="form-control text_uppercase" placeholder="License No">
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <label class="cust_label">Expiry Date</label>
                                    <div class="form-group">
                                    @php $current_year=date('Y'); $current_mnth =date('M'); $current_day =date('d');@endphp 
                                       <!--  <input type="text" id="to_date_{{$modal_type}}" placeholder="Expiry Date" name="to_date_{{$modal_type}}" class="form-control lrdate pointer"> -->
                                       <span class="">
                                         <select class="day" name="day" id="day" style="width: auto;">
                                           @for($i=01;$i<=31;$i++)
                                           <option value="@if($i < 10)0{{$i}}@else{{$i}}@endif" @if($current_day==$i) selected @endif>@if($i < 10)0{{$i}}@else{{$i}}@endif</option>
                                           @endfor
                                        </select>&nbsp;
                                         <!-- <select class="day" name="day" id="day" style="width: auto;">
                                           @for($i=$current_day;$i<=31;$i++)
                                           <option value="@if($i < 10 && $i!=$current_day)0{{$i}}@else{{$i}}@endif" @if($current_day==$i) selected @endif>@if($i < 10 && $i!=$current_day)0{{$i}}@else{{$i}}@endif</option>
                                           @endfor
                                        </select>&nbsp; -->
                                        <select class="month" name="month" id="month" style="width: auto;">
                                            <option value="Jan" @if($current_mnth=="Jan") selected @endif>Jan</option>
                                            <option value="Feb" @if($current_mnth=="Feb") selected @endif>Feb</option>
                                            <option value="Mar" @if($current_mnth=="Mar") selected @endif>Mar</option>
                                            <option value="Apr" @if($current_mnth=="Apr") selected @endif>Apr</option>
                                            <option value="May" @if($current_mnth=="May") selected @endif>May</option>
                                            <option value="Jun" @if($current_mnth=="Jun") selected @endif>Jun</option>
                                            <option value="Jul" @if($current_mnth=="Jul") selected @endif>Jul</option>
                                            <option value="Aug" @if($current_mnth=="Aug") selected @endif>Aug</option>
                                            <option value="Sep" @if($current_mnth=="Sep") selected @endif>Sep</option>
                                            <option value="Oct" @if($current_mnth=="Oct") selected @endif>Oct</option>
                                            <option value="Nov" @if($current_mnth=="Nov") selected @endif>Nov</option>
                                            <option value="Dec" @if($current_mnth=="Dec") selected @endif>Dec</option>
                                        </select>&nbsp;
                                        <select class="year" name="year" id="year" style="width: auto;">
                                            @for($year=$current_year-3;$year<=2075;$year++)
                                            <option value="{{$year}}" @if($year==$current_year) selected @endif>{{$year}}</option>
                                            @endfor
                                        </select>
                                        <p id="addlicense_expiry" class="hide" style="color: #f1292b;font-style: italic;font-weight: bold;font-size: 10px;float: inlin;">Expiry Date has to be equal or more than Current Date</p>
                                      </span>
                                    </div>
                                    
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <label class="cust_label">Choose File</label>
                                    <div class="form-group">
                                        <!--<input type="text" id="renewed_date_{{$modal_type}}" placeholder="Renewed Date" name="renewed_date_{{$modal_type}}" class="form-control cal_renewed_date pointer">-->
                                        <input style="padding-left: 37px;" type="file" @change="onFileChange" name="license_file_{{$modal_type}}" id="license_file_{{$modal_type}}" class="p-t-5">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="cust_label" style="text-align: left;">Remarks</label>
                                    <div class="form-group">
                                        <textarea id="remarks_{{$modal_type}}" maxlength="200" name="remarks_{{$modal_type}}" class="form-control text_uppercase" style="resize:vertical"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
<!--                                <div class="col-md-4">
                                    <input type="file" @change="onFileChange" name="license_file_{{$modal_type}}" id="license_file_{{$modal_type}}" class="p-t-5">
                                </div>-->
                                <div class="col-md-4 col-xs-3" style="margin-bottom:15px;">
                                    <div class="col-md-12 p-lr-0 download_delete-align lr_file_icons" id="button_upload" style="visibility:hidden;">
                                        <a href="#" @click="removeImage" id="remove_file" class="add_user_icon tooltip_rel" style="cursor: pointer;margin-right:20px;">
                                            <span style="top:-28px;left:-22px;" class="tooltip_cust">DELETE</span>
                                            <i style="font-size:1.4em;" class="fa fa-close fa-2x"></i>
                                        </a>
                                        <a href="#" class="lr-file-download add_user_icon tooltip_rel" style="cursor: pointer">
                                            <span style="top:-28px;left:-15px;" class="tooltip_cust">VIEW</span>
                                            <i class="fa fa-download fa-2x"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" @click="add_license_confirm" class="form-control btn newbtn_blackv1">Add license</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- addlicense modal -->
    <!-- pdf report modal -->
    <div id="pdfreport" class="modal fade in" style=" padding-right: 17px;">
        <div class="modal-dialog modal-pdfreport">
            <header class="popupHeader"> <span class="header_title">DOWNLOAD REPORT</span> <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>
            <section class="popupBody">
                <div class="row">
                    <form class="form_pdfreport">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php
                                $lr_users_list = \App\User::get_lr_user_list();
                                ?>
                                <select name="pdf_user_id" id="pdf_user_id" class="form-control pdfreport_arw">
                                    <option value="0">--SELECT USER --</option>
                                    @foreach($lr_users_list as $lr_users_list_val)
                                    <option value="{{$lr_users_list_val->id}}">{{$lr_users_list_val->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-offset-4 col-md-4"><button type="button" class="download_pdf form-control btn newbtn_blackv1">save</button></div>
                    </form>
                </div>
            </section>
        </div>
    </div>
    <!-- pdf report modal -->
    <!-- alertLicense -->
    <div id="alertLicense" class="modal fade in" style=" padding-right: 17px;">
        <div class="modal-dialog modal-deleteLicense">
            <header class="popupHeader"> <span class="header_title">ALERT<span class="del_lic_heading"></span></span>
                <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span></header>
            <section class="popupBody">
                <div class="row">
                    <p style="text-align: center;color: green;font-weight: bold"><span class="delete_license_success"></span></p>
                    <div class="remove_del">
                        <p class="dl_sure_text">Expiry Date Should Be Less Than Current Date</p>
                    </div> 
                </div>
            </section>
        </div>
    </div>

    <!-- add user -->
    <div id="addUser" class="modal fade in" style=" padding-right: 17px;">
        <div class="modal-dialog modal-addUser">
            <header class="popupHeader"> <span class="header_title">ADD USER</span><span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span></header>
            <section class="popupBody">
                <div class="row">
                    <div class="add_user_success"></div>
                    <?php
                    $modal_type = 'add_user';
                    ?>
                    <form class="form_addUser" id="add_users_form">
                        <div class="col-md-12 p-lr-0">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="name_{{$modal_type}}" @keyup="v_user_name" v-model="name_{{$modal_type}}" id="name_{{$modal_type}}" class="form-control" placeholder="name">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <?php
                                    $user_designations = \App\models\lr\LRUserRoles::where('is_active', 1)->get(['id', 'name']);
                                    ?>
                                    <select name="user_role_id_{{$modal_type}}" id="user_role_id_{{$modal_type}}" class="form-control desg_arw">
                                        <option value="0" selected disabled>Designation</option>
                                        @foreach($user_designations as $lr_designations_val)
                                        <option value="{{$lr_designations_val->id}}">{{$lr_designations_val->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" @keyup="v_email" v-model="email_{{$modal_type}}" name="email_{{$modal_type}}" id="email_{{$modal_type}}" placeholder="email">
                                </div>
                            </div>
                            <div class="col-md-4  col-sm-6">
                                <div class="form-group">
                                    <input type="text" @keyup="v_mobile_number" v-model="mobile_number_{{$modal_type}}" name="mobile_number_{{$modal_type}}" id="mobile_number_{{$modal_type}}" maxlength="10" class="form-control numeric" placeholder="mobile number">
                                </div>
                            </div>
                            <div class="col-md-4  col-sm-6">
                                <div class="form-group">
                                    <input type="password" @keyup="v_password" v-model="password_{{$modal_type}}" name="password_{{$modal_type}}" id="password_{{$modal_type}}" class="form-control" placeholder="password">
                                </div>
                            </div>
                            <div class="col-md-4  col-sm-6">
                                <div class="form-group">
                                    <input type="text" @keyup="v_confirm_password" v-model="confirm_password_{{$modal_type}}" name="confirm_password_{{$modal_type}}" id="confirm_password_{{$modal_type}}" placeholder="confirm password" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-8  col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="operator_name" id="operator_name" class="form-control get_operators text_uppercase" placeholder="Select Operator" />
                                </div>
                            </div>

                            <div class="col-md-4  col-sm-6"><button type="button" @click="add_users_confirm" class="form-control btn newbtn_blackv1">ADD USER</button></div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
    <!-- add user -->
    <div id="deleteLicense" class="modal fade in" style=" padding-right: 17px;">
        <div class="modal-dialog modal-deleteLicense">
            <header class="popupHeader"> <span class="header_title"><span class="del_lic_heading"></span></span>
                <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span></header>
            <section class="popupBody">
                <div class="row">
                    <form id="delete_license_form">
                        <p style="text-align: center;color: green;font-weight: bold"><span class="delete_license_success"></span></p>
                        <div class="remove_del">
                            <p class="dl_sure_text">are you sure want to delete this license?</p>
                            <div class="col-md-offset-5 col-md-3 col-xs-offset-2 col-xs-3">
                                <button @click="delete_license_confirm" class="btn newbtnv1 delete_license_confirm">YES</button>
                            </div>
                            <!--                            <div class="col-md-offset-0 col-md-3 col-xs-offset-2 col-xs-3"><button class="btn newbtn_blackv1">NO</button></div>-->
                            <input type="hidden" name="delete_license_id" id="delete_license_id" />
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <div id="editLicense" class="modal fade in" style=" padding-right: 17px;">
        <div class="modal-dialog modal-editLicense">
            <header class="popupHeader">EDIT LICENSE OF <span id="lr_user_name"></span><span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span></header>
            <section class="popupBody">
                <div class="row"> 
                    <p class="edit_license_success" style="text-align: center;text-transform: uppercase"></p>
                    <form action="{{url('/lr/edit_license')}}" id="edit_license_form" method="POST">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="">License Details</label>
                                <?php
                                $license_types = \App\models\lr\LicenseTypesModel::where('is_active', 1)->get(['id', 'name']);
                                ?>
                                <select v-model="editltselected" class="form-control desg_arw2" readonly="readonly" name="edit_license_type_id" id="edit_license_type_id">

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-6" style="padding-right: 0;width: 43%;">
                            <div class="form-group">
                                <label class="cust_label">Expiry Date</label>
                                <div class="input-group">
                                    <!-- <input type="text" data-url="" readonly style="background-color: white" v-model="to_date" name="to_date" id="to_date" class="form-control text_lowercase edit_lrdate pointer"> -->
                                    <span class="">
                                         <select class="day" name="day" id="edit_day" style="width: auto;">
                                           @for($j=01;$j<=31;$j++)
                                           <option value="@if($j < 10)0{{$j}}@else{{$j}}@endif" @if($current_day==$j) selected @endif>@if($j < 10)0{{$j}}@else{{$j}}@endif</option>
                                           @endfor
                                        </select>&nbsp;
                                        <select class="month" name="month" id="edit_month" style="width: auto;">
                                            <option value="Jan" @if($current_mnth=="Jan") selected @endif>Jan</option>
                                            <option value="Feb" @if($current_mnth=="Feb") selected @endif>Feb</option>
                                            <option value="Mar" @if($current_mnth=="Mar") selected @endif>Mar</option>
                                            <option value="Apr" @if($current_mnth=="Apr") selected @endif>Apr</option>
                                            <option value="May" @if($current_mnth=="May") selected @endif>May</option>
                                            <option value="Jun" @if($current_mnth=="Jun") selected @endif>Jun</option>
                                            <option value="Jul" @if($current_mnth=="Jul") selected @endif>Jul</option>
                                            <option value="Aug" @if($current_mnth=="Aug") selected @endif>Aug</option>
                                            <option value="Sep" @if($current_mnth=="Sep") selected @endif>Sep</option>
                                            <option value="Oct" @if($current_mnth=="10") selected @endif>Oct</option>
                                            <option value="Nov" @if($current_mnth=="Nov") selected @endif>Nov</option>
                                            <option value="Dec" @if($current_mnth=="Dec") selected @endif>Dec</option>
                                        </select>&nbsp;
                                        <select class="year" name="year" id="edit_year" style="width: auto;">
                                            @for($yearr=$current_year-3;$yearr<=2075;$yearr++)
                                            <option value="{{$yearr}}" @if($year==$current_year) selected @endif>{{$yearr}}</option>
                                            @endfor
                                        </select>
                                        
                                        <p id="editlicense_expiry" class="hide" style="color: #f1292b;font-style: italic;font-weight: bold;font-size: 10px;float: inlin;">Expiry Date has to be equal or more than Current Date</p>
                                      </span>
                                </div>
                                <p id="previous_exp_date_div" style="color: #f1292b;font-style: italic;font-weight: bold;font-size: 10px">Previous Expiry Date <span id="previous_exp_date"></span></p>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12" style="padding-left: 0;padding-right: 0;width: 23%;">
                            <div class="form-group">
                                <label class="cust_label">License No</label>
                                <input type="text" v-model="number_edit" name="number" id="number" class="form-control text_uppercase">
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-6">
                            <div class="form-group">
                                <label class="cust_label">Choose File</label>
                                <div class="input-group">
                                    <!--<input type="text" data-url="" readonly style="background-color: white" name="renewed_date" id="renewed_date" class="form-control text_lowercase edit_lrdate pointer">-->
                                    <!--<img class="ui-datepicker-trigger" src="{{url('media/ananth/images/calender-icon1.png')}}" alt="..." title="...">-->
                                <input style="padding-left: 12px;" type="file" @change="onFileChange" id="editfile_upload"><span class="lr_file_icons file_original_name"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-xs-12">Remarks:</div>
                        <div class="col-md-12 col-xs-12"><textarea class="form-control" rows="3" id="remarks" name="remarks" style="margin-bottom:15px;resize:none;"></textarea></div>
                        <div class="col-md-3 col-xs-3" style="margin-bottom:15px;"  >
                            <div class="col-md-12 p-lr-0 download_delete-align_edit lr_file_icons" style="display: none;" id="editfile_remove">
                                <a href="#" @click="removeImage" id="remove_file_edit" class="add_user_icon tooltip_rel" style="cursor: pointer;margin-right:20px;">
                                    <span style="top:-28px;left:-22px;" class="tooltip_cust">DELETE</span>
                                    <i style="font-size:1.6em;" class="fa fa-close fa-2x"></i>
                                </a>
                                <a href="#" class="lr-file-download add_user_icon tooltip_rel" style="cursor: pointer">
                                    <span style="top:-28px;left:-15px;" class="tooltip_cust">VIEW</span>
                                    <i class="fa fa-download fa-2x"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-12 col-xs-12" style="text-align:center;"><button @click="edit_license_confirm" class="btn newbtnv1 form-control" type="submit" style="width: 150px;">Update</button></div>
                        <div class="col-md-12 col-xs-12">
                            <div class="remove_file_success lr_file_icons" style="margin-bottom: 10px;text-align:center"></div>
                        </div>
                        {{csrf_field()}}
                        <input type="hidden" name="edit_license_id" id="edit_license_id" />
                        <input type="hidden" name="edit_user_name" id="edit_user_name" />
                        <input type="hidden" name="edit_license_name" id="edit_license_name" />
                    </form>
                </div>
            </section>
        </div>
    </div>

    <div id="viewhistory" class="modal fade in" style=" padding-right: 17px;">
        <div class="modal-dialog modal-viewhistory">
            <header class="popupHeader"><span class="viewhistory_header_title">kkkkk</span>
                <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span>
            </header>
            <section class="popupBody">
                <div class="row">
                    <div class="abc"></div>
                </div>
            </section>
        </div>
    </div>

    <input type="hidden" name="lr_file" id="lr_file" />
    <!--    End of Modal Popups  -->
</div>

<script>
    $("#remove_file").click(function(){
    $('#license_file_add_ld').val("");
    $('#license_file_add_ld').css('color', 'transparent');
    $("#remove_file").css('display', 'none');
    });
    $("#remove_file_edit").click(function()
    {
    $('#editfile_upload').val("");
    $('#editfile_upload').css('color', 'transparent');
    $("#remove_file_edit").css('display', 'none');
    });
    $('#editfile_upload').change(function ()
    {
    $("#remove_file_edit").css('display', 'inline-block');
    $("#editfile_remove").css('display', 'inline-block');
    $('#editfile_upload').css('color', '#343434');
    });
    $("#day,#month,#year").change(function(){
        $("#addlicense_expiry").addClass('hide');
    });

    $("#edit_day,#edit_month,#edit_year").change(function(){
        $("#editlicense_expiry").addClass('hide');
        $("#previous_exp_date_div").removeClass('hide');
    });

    Vue.http.headers.common['X-CSRF-TOKEN'] = $("meta[name=_token]").attr('content');
    new Vue({
    el: "#lr_modals",
            data: {
            name_add_user:'',
                    mobile_number_add_user:'',
                    email_add_user:'',
                    password_add_user:'',
                    confirm_password_add_user:'',
                    add_file_name: '',
                    add_file_size: '',
                    add_mime_type: '',
                    edit_file_name: '1',
                    ltselected2: '',
                    ltselected: '',
                    number_add_ld:'',
                    editltselected: '',
                    number_edit: '',
                    add_licence_type:""
            },
            methods: {
            add_license_confirm: function (e) { 
            e.preventDefault();
            if (this.ltselected == 25){
            if (this.number_add_ld == ""){
            $("#number_add_ld").css('border', 'red 1px solid');
            return false;
            }
            }
            if (this.ltselected2 == ""){
            $("#user_id_add_ld").css('border', 'red 1px solid');
            return false;
            }
            if (this.ltselected == ""){
            $("#license_type_add_ld").css('border', 'red 1px solid');
            return false;
            }
            let today = new Date();
            let dd = today.getDate();
            let mm = today.getMonth()+1; 
            let yyyy = today.getFullYear();
            var months = {
                'Jan' : '01',
                'Feb' : '02',
                'Mar' : '03',
                'Apr' : '04',
                'May' : '05',
                'Jun' : '06',
                'Jul' : '07',
                'Aug' : '08',
                'Sep' : '09',
                'Oct' : '10',
                'Nov' : '11',
                'Dec' : '12'
            }
            
            if(dd<10) 
            {
                dd=`0${dd}`;
            } 
            if(mm<10) 
            {
                mm=`0${mm}`;
            }
            var today_date=yyyy+mm+dd;
            var month1=$("#month option:selected").val();
            var expiry_date=$("#year option:selected").val()+months[month1]+$("#day option:selected").val();
            if(parseInt(expiry_date)<parseInt(today_date)){
             $("#addlicense_expiry").removeClass('hide')
             return false;
            }
            var data_url = base_url + "/lr/add_license_details";
            var formdata = $("#add_license_form").serializeArray();
            var data = {};
            $(formdata).each(function (index, obj) {
            data[obj.name] = obj.value;
            });
            data['to_date_add_ld'] = $("#day option:selected").val()+'-'+$("#month option:selected").val()+'-'+$("#year option:selected").val();
            console.log(data);
            data['lr_file'] = $("#lr_file").val();
            var ct = this;
            data['add_file_name'] = this.add_file_name;
            data['add_file_size'] = this.add_file_size;
            data['add_mime_type'] = this.add_mime_type;
            $(".add_license_success").html('<span style="text-align:center;color:red"><a><i class="fa fa-spinner fa-spin"></i></a> PLEASE WAIT ...</span>');
            this.$http.post(data_url, data).then(function (response) {
            if (response.body.STATUS_CODE == 1) {
            $("#addLicense").modal('hide');
            $(".success_msg").html('<p class="success animated  zoomIn custdelay" style="text-align: center;color:red">' + response.body.STATUS_DESC + '</p>');
            var get_data_url = base_url + "/lr/get-lr-count";
            var formdata = $("#lr_form").serializeArray();
            var data = {};
            $(formdata).each(function (index, obj) {
            data[obj.name] = obj.value;
            });
            if (response.body.status == 'DUE') {
            $(".due1").addClass('tooltip_due_trishape');
            $(".exp1").removeClass('tooltip_exp_trishape');
            $('.valid1').removeClass('tooltip_val_trishape');
            ct.add_licence_type = "DUE";
            } else if (response.body.status == 'VALID') {
            $(".valid1").addClass('tooltip_val_trishape');
            $(".due1").removeClass('tooltip_due_trishape');
            $(".exp1").removeClass('tooltip_exp_trishape');
            ct.add_licence_type = "VALID";
            }

            this.$http.post(get_data_url, data).then(function (response) {
            $("#expire_count").text(response.body.result.expire);
            $("#valid_count").text(response.body.result.valid);
            $("#due_count").text(response.body.result.due);
            });
            var data_url = base_url + "/lr/lr-filter";
            data['add_licence_type'] = ct.add_licence_type;
            data['status_type'] = '';
            this.$http.post(data_url, data).then(function (response) {
            if (response.body) {
            $(".get_filter_result").html(response.body);
            }
            });
            setTimeout(function(){
            $(".success_msg").html("");
            }, 5100);
            } else{
            $(".success_msg").html('');
            $(".add_license_success").html('<p class="success animated  zoomIn custdelay" style="text-align: center;color:red">' + response.body.STATUS_DESC + '</p>');
            }
            });
            },
                    delete_license_confirm: function (e) {
                    e.preventDefault();
                    var data_url = base_url + "/lr/delete_license";
                    var formdata = $("#delete_license_form").serializeArray();
                    var data = {};
                    var lr_form_data = $("#lr_form").serializeArray();
                    $(lr_form_data).each(function (index, obj) {
                    data[obj.name] = obj.value;
                    });
                    $(formdata).each(function (index, obj) {
                    data[obj.name] = obj.value;
                    });
                    console.log(data)
                            var delete_license_id = $("#delete_license_id").val();
                    $(".delete_license_success").show();
                    $(".delete_license_success").html('<span style="text-align: center;color:red"><a style="color:red"><i class="fa fa-spinner fa-spin"></i></a>Please wait ...</span>');
                    $(".success_msg").html('<span style="text-align: center;color:red"><a style="color:red"><i class="fa fa-spinner fa-spin"></i></a>Please wait ...</span>');
                    this.$http.post(data_url, data).then(function (data) {
                    if (data.body.STATUS_CODE == 1) {
                    $("#deleteLicense").modal('hide');
//                    $(".delete_license_success").html(data.body.STATUS_DESC);
                    $(".remove_del").hide();
                    $("#expire_count").text(data.body.result.expire);
                    $("#valid_count").text(data.body.result.valid);
                    $("#due_count").text(data.body.result.due);
                    $('#delete_license' + delete_license_id).parents('tr').remove();
                    $(".success_msg").html('<p class="success animated  zoomIn custdelay" style="text-align: center;color:red">' + data.body.STATUS_DESC + '</p>')
                            setTimeout(function(){
                            $(".success_msg").text("")
                            }, 5800);
                    }
                    });
                    var data_url = base_url + "/lr/lr-filter";
                    var lr_form_data = $("#lr_form").serializeArray();
                    var data = {};
                    $(lr_form_data).each(function (index, obj) {
                    data[obj.name] = obj.value;
                    });
                    data['flag'] = $("#status_type").val();
                    this.$http.post(data_url, data).then(function (data) {
                    if (data.body) {
                    $(".success").html('');
                    $(".get_filter_result").html(data.body);
                    }
                    });
                    },
                    edit_license_confirm: function (e) {
                    e.preventDefault();
                    let today = new Date();
                    let dd = today.getDate();
                    let mm = today.getMonth()+1; 
                    let yyyy = today.getFullYear();
                    var months = {
                        'Jan' : '01',
                        'Feb' : '02',
                        'Mar' : '03',
                        'Apr' : '04',
                        'May' : '05',
                        'Jun' : '06',
                        'Jul' : '07',
                        'Aug' : '08',
                        'Sep' : '09',
                        'Oct' : '10',
                        'Nov' : '11',
                        'Dec' : '12'
                    }
             
                    if(dd<10) 
                    {
                        dd=`0${dd}`;
                    } 
                    if(mm<10) 
                    {
                        mm=`0${mm}`;
                    }
                    var today_date=yyyy+mm+dd;
                    var edit_month=$("#edit_month option:selected").val();
                    var expiry_date=$("#edit_year option:selected").val()+months[edit_month]+$("#edit_day option:selected").val();
                    if(parseInt(expiry_date)<parseInt(today_date)){
                     $("#editlicense_expiry").removeClass('hide');
                     $("#previous_exp_date_div").addClass('hide');
                     return false;
                    }
                    var data_url = base_url + "/lr/edit_license";
                    var formdata = $("#edit_license_form").serializeArray();
                    var status_type = $("#status_type").val();
                    var data = {
                    to_date: ''
                    };
                    $(".edit_license_success").html('');
                    $(formdata).each(function (index, obj) {
                    data[obj.name] = obj.value;
                    });
                    data['lr_file'] = $("#lr_file").val();
                    data['edit_file_name'] = this.edit_file_name;
                    data['add_file_name'] = this.add_file_name;
                    data['add_file_size'] = this.add_file_size;
                    data['add_mime_type'] = this.add_mime_type;
                    data['to_date'] = $("#edit_day option:selected").val()+'-'+$("#edit_month option:selected").val()+'-'+$("#edit_year option:selected").val();
                    console.log(data);
                    if ($("#edit_license_type_id").val() == 25){
                    if ($("#number").val() == ""){
                    $("#number").css('border', 'red 1px solid');
                    return false;
                    }
                    }
                    var to = $("#to_date").val();
                    var edit_license_id = $("#edit_license_id").val();
                    $(".edit_license_success").html('<span style="text-align: center;color:red"><a style="color:red"><i class="fa fa-spinner fa-spin"></i></a>Please wait ...</span>');
                    this.$http.post(data_url, data).then(function (response) {
                    if (response.body.STATUS_CODE == 1) {
                    $("#editLicense").modal('hide');
                    $(".success_msg").html('<p class="success animated  zoomIn custdelay" style="text-align: center;color:red">' + response.body.STATUS_DESC + '</p>');
                    $("#license_name" + edit_license_id).text(response.body.result.short_name);
                    $("#license_type" + edit_license_id).text(response.body.result.license_type_name);
                    $("#to_date" + edit_license_id).text(response.body.result.to_date);
                    $("#license_number" + edit_license_id).text(response.body.result.license_number);
                    $("#valid_days" + edit_license_id).text(response.body.result.valid_days);
                    $("#remarks" + edit_license_id).text(response.body.result.remarks);
                    $("#expire_count").text(response.body.result.expire);
                    $("#valid_count").text(response.body.result.valid);
                    $("#due_count").text(response.body.result.due);
                    var ct = this;
                    
                    var get_data_url = base_url + "/lr/get-lr-count";
                    var formdata = $("#lr_form").serializeArray();
                    var data = {};
                    $(formdata).each(function (index, obj) {
                    data[obj.name] = obj.value;
                    });
                    if (response.body.status == 'DUE') {
                    $(".due1").addClass('tooltip_due_trishape');
                    $(".exp1").removeClass('tooltip_exp_trishape');
                    $('.valid1').removeClass('tooltip_val_trishape');
                    ct.add_licence_type = "DUE";
                    } else if (response.body.status == 'VALID') {
                    $(".valid1").addClass('tooltip_val_trishape');
                    $(".due1").removeClass('tooltip_due_trishape');
                    $(".exp1").removeClass('tooltip_exp_trishape');
                    ct.add_licence_type = "VALID";
                    }

                    this.$http.post(get_data_url, data).then(function (response) {
                    $("#expire_count").text(response.body.result.expire);
                    $("#valid_count").text(response.body.result.valid);
                    $("#due_count").text(response.body.result.due);
                    });
                    var data_url = base_url + "/lr/lr-filter";
                    data['add_licence_type'] = ct.add_licence_type;
                    data['status_type'] = '';
                    data['action'] = 'edit';
                    this.$http.post(data_url, data).then(function (response) {
                    if (response.body) {
                    $(".get_filter_result").html(response.body);
                    }
                    });
                    setTimeout(function(){
                    $(".success_msg").text("");
                    $("#addLicense").modal('hide');
                    }, 5400);
                    } else{
                    $(".success_msg").html('<span style="text-align: center;color:red">' + response.body.STATUS_DESC + '</span>');
                    }
                    });
                    },
                    add_users_confirm: function (e) {
                    var validation = true;
                    if (this.name_add_user == ''){
                    $("#name_add_user").css('border-color', '#f1292b');
                    validation = false;
                    }
                    if (this.mobile_number_add_user == ''){
                    $("#mobile_number_add_user").css('border-color', '#f1292b');
                    validation = false;
                    }
                    if (this.email_add_user == ''){
                    $("#email_add_user").css('border-color', '#f1292b');
                    validation = false;
                    }
                    if (this.password_add_user == ''){
                    $("#password_add_user").css('border-color', '#f1292b');
                    validation = false;
                    }
                    if (this.confirm_password_add_user == ''){
                    $("#confirm_password_add_user").css('border-color', '#f1292b');
                    validation = false;
                    }
                    if (!validation){
                    return false;
                    }

                    e.preventDefault();
                    var data_url = base_url + "/lr/add-users";
                    var formdata = $("#add_users_form").serializeArray();
                    var data = {};
                    $(formdata).each(function (index, obj) {
                    data[obj.name] = obj.value;
                    });
                    $(".add_user_success").html('<p style="text-align: center;color:red"><a><i class="fa fa-spinner fa-spin"></i></a>Please wait ...</p>');
                    this.$http.post(data_url, data).then(function (data) {

                    if (data.body.STATUS_CODE == 1) {
                    window.location = base_url + "/lr?success=" + data.body.STATUS_DESC;
//                    $(".add_user_success").html('<p class="success animated  zoomIn custdelay" style="text-align: center;color:red;text-transform:uppercase">' + data.body.STATUS_DESC + '</p>')
                    } else{
                    $(".add_user_success").html('<p class="success animated  zoomIn custdelay" style="text-align: center;color:red;text-transform:uppercase">' + data.body.STATUS_DESC + '</p>')
                    }
                    });
                    },
                    onFileChange(e) {
            var files = e.target.files || e.dataTransfer.files;
            $("#button_upload").css('visibility', 'visible');
            $("#remove_file").css('display', 'inline-block');
            $("#license_file_add_ld").css('color', 'red');
            $(".lr_file_icons").show();
            this.add_file_name = files[0].name;
            this.add_file_size = files[0].size;
            this.add_mime_type = files[0].type;
            if (!files.length)
                    return;
            this.createImage(files[0]);
            },
                    createImage(file) {
            var image = new Image();
            var reader = new FileReader();
            var vm = this;
            reader.onload = (e) => {
            vm.image = e.target.result;
            $("#lr_file").val(e.target.result);
            };
            reader.readAsDataURL(file);
            },
                    v_user_name: function(e){
                    if (this.name_add_user == ''){
                    $("#name_add_user").css('border-color', '#f1292b');
                    } else{
                    $("#name_add_user").css('border', '#555 1px solid');
                    }
                    },
                    v_mobile_number: function(e){
                    if (this.mobile_number_add_user == ''){
                    $("#mobile_number_add_user").css('border-color', '#f1292b');
                    } else{
                    $("#mobile_number_add_user").css('border', '#555 1px solid');
                    }
                    },
                    v_email: function(e){
                    if (this.email_add_user == ''){
                    $("#email_add_user").css('border-color', '#f1292b');
                    } else{
                    $("#email_add_user").css('border', '#555 1px solid');
                    }
                    },
                    v_password: function(e){
                    if (this.password_add_user == ''){
                    $("#password_add_user").css('border-color', '#f1292b');
                    } else{
                    $("#password_add_user").css('border', '#555 1px solid');
                    }
                    },
                    v_confirm_password: function(e){
                    if (this.confirm_password_add_user == ''){
                    $("#confirm_password_add_user").css('border-color', '#f1292b');
                    } else{
                    $("#confirm_password_add_user").css('border', '#555 1px solid');
                    }
                    },
                    removeImage: function (e) {
                    this.edit_file_name = "";
                    $('#license_file_add_ld').val("");
                    $('#license_file_add_ld').css('color', 'transparent');
                    $('#editfile_upload').val("");
                    $('#editfile_upload').css('color', 'transparent');
                    $(".remove_file_success").html("<span style='color:#555;position: absolute;top:-1px;right: 36px;font-size:14px;font-weight:bold'>PLEASE CLICK ON THE UPDATE BUTTON TO DELETE THE FILE</span>");
                    },
            }
    });
    $(document).on('click', '.download_pdf', function(){
    var pdf_user_id = $("#pdf_user_id").val();
    $("#pdfreport").modal('hide');
    window.location = base_url + '/lr/pdf/' + pdf_user_id;
    });
    $(function(){
    var currentDate = $("#to_date").val(); //document.getElementById("utcdate").value;

    var current_day = '';
    var current_month = '';
    var current_year = '';
    if (currentDate) {
    current_day = currentDate.substr(0, 2);
    current_month = currentDate.substr(3, 2) - 1;
    current_year = currentDate.substr(6, 4);
    }
    // Datepicker code
    var currentTime = new Date();
    var month = currentTime.getMonth() + 1;
    var day = currentTime.getDate();
    var year = currentTime.getFullYear();
    var todaydate = year + "-" + month + "-" + day;
    var day2 = currentTime.getDate() + 1;
    var seconddate = year + "-" + month + "-" + day2;
    var day3 = currentTime.getDate() + 2;
    var thirddate = year + "-" + month + "-" + day3;
    var day4 = currentTime.getDate() + 3;
    var fourthdate = year + "-" + month + "-" + day4;
    var day5 = currentTime.getDate() + 4;
    var fifthdate = year + "-" + month + "-" + day5;
    var readonlyDays = [todaydate, seconddate, thirddate, fourthdate, fifthdate];
    var date = new Date();
    var min_date = new Date(current_year, current_month, current_day);
    var max_date = addDays(min_date, 4);
    var min_date2 = new Date('2000', '1', '1');
    $(".edit_lrdate").datepicker({showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true, showOtherMonths: true, selectOtherMonths: true,
            //addDates: ['10/14/'+year, '02/19/'+year, '01/14/'+year, '11/16/'+year],
            // numberOfMonths: [2, 3],
            showAnim: "slide",
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            beforeShowDay: function (date) {
            var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
            for (i = 0; i < readonlyDays.length; i++) {
            if ($.inArray(y + '-' + (m + 1) + '-' + d, readonlyDays) !== - 1) {
            //return [false];
            return [true, 'dp-highlight-date', ''];
            }
            }
            return [true];
            },
            onSelect: function () {
            $('.notify-bg-v').hide();
            }
    });
    var exp_date = $('#to_date').val();
    $(".edit_lrdate").datepicker("option", "dateFormat", "dd-M-yy");
    $(".edit_lrdate").datepicker("setDate", currentDate);
    });



</script>