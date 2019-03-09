<style>
    .user_callsigns {
        resize: none;
        border-radius: 4px;
        padding: 3px;
    }
    .fdtlpop {
        width: 710px;
    }
    #ui-id-11{
        z-index: 9999;
    }

    .add_des_arrow_down {
        position: absolute;
        top: 32px;
        right: 30px;
        font-size: 18px;
        cursor: pointer;
    }
    .popover
    {
        width: 250px;
        background-color: #333;
        border: #eeeeee solid 2px;
        font-family: 'pt_sansregular';
        margin-top: 0px;
        text-align: center;
        color: white;
    }
    .popover-content{
        padding:2px;
    }
</style>
<script>
    $(function () {
        console.log('edit_info.blade.php');
    });
</script>
<div id="info_modal" class="modal fade" style="display:none;">
    <div class="modal-dialog modal-lg modal-container fdtlpop">
        <header class="popupHeader"> <span class="header_title">Update User Details</span> <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>
        <section class="popupBody">
            <form  data-toggle="validator" @submit="valid_info" data-url="{{url('Admin/update_callsign_info')}}"  action="{{url('Admin/update_callsign_info')}}" id="pilots_form" enctype="multipart/form-data" role="form"  data-toggle="validator" method="POST">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>CALL SIGN</label>
                            <input type="text" readonly required="required" name="aircraft_callsign2" placeholder="CALL SIGN" id="aircraft_callsign2" autocomplete="off"  class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>DESIGNATION</label>
                            <input type="text" required="required" id="designation" name="designation" placeholder="DESIGNATION" autocomplete="off" style="cursor: pointer" data-value="" class="form-control pointer add_designation" data-toggle="popover" data-placement="top">
                            <label class="add_des_arrow_down" for="designation" ><i class="fa fa-caret-down"></i><label>
                                    </div>
                                    </div>
                                       <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>EMAIL</label>
                                                <input type="text" id="email" name="email" placeholder="EMAIL" autocomplete="off" class="auto_email valid_email form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                     
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>MOBILE</label>
                                                <input type="text" required="required" id="mobile_number" placeholder="MOBILE" name="mobile_number" maxlength="10" minlength="10" autocomplete="off" class="auto_mobile form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>NAME</label>
                                            <input type="text" required="required" id="name" name="name" placeholder="NAME" autocomplete="off" class="form-control text_uppercase auto_name" data-toggle="popover" data-placement="top">
                                        </div>
                                    </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>STATUS</label>
                                                <select name="is_active" id="is_active" class="form-control" data-toggle="popover" data-placement="top">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>UPDATE</label>
                                                <button type="submit" value="" autocomplete="off" class="form-control btn newbtnv1">UPDATE</button>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="id" id="id" />
                                    <input type="hidden" name="type" id="type" value="update"/>
                                    <input type="hidden" name="data_value" id="data_value" />
                                    {!! csrf_field() !!}
        </form>
        </section>
</div>
</div>

<script>
 $(function () {
        $(".auto_email").autocomplete({
            minLength: 2,
            source: function (request, response) {
                $.ajax({
                    type: "GET",
                    url: base_url + "/Admin/auto_email",
                    dataType: "json",
                    data: {
                        term: request.term.toUpperCase(),
                        aircraft_callsign: $("#aircraft_callsign").val().toUpperCase()
                    },
                    headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                    success: function (data) {
                        response(data);

                    }
                });
            },
            select: function (event, ui) {
                 $("#name,#designation,#is_active").popover('destroy');
                 $("#name,#is_active,#designation").css('border', '1px solid #555');
                if ((ui.item.value == '') || (ui.item.value.length <= '1')) {

                } else {

                }
                get_pilot_data('',ui.item.value);
            }
        });
        
         $(".auto_mobile").autocomplete({
            minLength: 2,
            source: function (request, response) {
                $.ajax({
                    type: "GET",
                    url: base_url + "/Admin/auto_mobile",
                    dataType: "json",
                    data: {
                        term: request.term.toUpperCase(),
                        aircraft_callsign: $("#aircraft_callsign").val().toUpperCase()
                    },
                    headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                    success: function (data) {
                        response(data);

                    }
                });
            },
            select: function (event, ui) {
                $("#name,#designation,#is_active").popover('destroy');
                $("#name,#is_active,#designation").css('border', '1px solid #555');
                if ((ui.item.value == '') || (ui.item.value.length <= '1')) {

                } else {

                }
                get_pilot_data(ui.item.value);
            }
        });
        
        $(".auto_name").autocomplete({
            minLength: 2,
            source: function (request, response) {
                $.ajax({
                    type: "GET",
                    url: base_url + "/Admin/auto_name",
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                    success: function (data) {
                        response(data);

                    }
                });
            },
            select: function (event, ui) {
                $("#name,#designation,#is_active").popover('destroy');
                $("#name,#is_active,#designation").css('border', '1px solid #555');
                if ((ui.item.value == '') || (ui.item.value.length <= '1')) {

                } else {

                }
                get_pilot_data('','',ui.item.value);
            }
        });

        function get_pilot_data(mobile_number,email='',name='') {
            if(email !=''){
                var data = {'email':email}
            }else if(mobile_number != ''){
               var data = {'mobile_number':mobile_number}  
            }else{
                var data = {'name':name} 
            }
            $.ajax({
                type: "GET",
                url: base_url + "/Admin/get_pilot_data",
                data: data,
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (result) {
                    var mobilenumber = result.mobile_number;
                    $("#mobile_number").val(mobilenumber);
                    $("#name").val(result.name);
                    $("#email").val(result.email);
                    
                    $("#is_active").val(result.is_active);
                    if(result.is_admin_manager=="1")
                     $("#designation").val('ADMIN MANAGER');
                    else if(result.is_pilot=="1")
                     $("#designation").val('PILOT');
                    else if(result.is_copilot=="1")
                     $("#designation").val('CO-PILOT');
                    else if(result.is_cabin_crew=="1")
                     $("#designation").val('CABIN CREW');
                    else if(result.is_ops_staff=="1")
                     $("#designation").val('OPS STAFF');    

                }
            });
        }
    });
</script>
