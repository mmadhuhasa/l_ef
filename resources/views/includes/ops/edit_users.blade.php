<style>
    .user_callsigns {
        resize: none;
        border-radius: 4px;
        padding: 3px;
    }
    .checkbox-inline+.checkbox-inline {margin-left: 14px;}
    .ui-autocomplete.ui-front.ui-menu.ui-widget.ui-widget-content{
        width: 175px;
        z-index: 9999 !important;
    }
    .checkbox-inline, .radio-inline{
        padding-left: 12px
    }
</style>
<div id="user_edit_modal" class="modal fade" style="display:none;">
    <div class="modal-dialog modal-lg modal-container fdtlpop">
        <header class="popupHeader"> <span class="header_title">Update User Details</span> <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>
        <section class="popupBody"> 		   
            <form  data-toggle="validator" data-url ="{{url('Admin/update_users')}}"  action="{{url('Admin/update_users')}}" id="users_edit_form" enctype="multipart/form-data" role="form"  data-toggle="validator" method="POST">		   
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" required="required" name="name" id="name" autocomplete="off"  class="form-control pilot_in_command text_uppercase">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" required="required" id="email" name="email" autocomplete="off" class="form-control text_lowercase">
                        </div>	
                    </div>			
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" required="required" id="mobile_number" name="mobile_number" maxlength="10" autocomplete="off" class="form-control numeric">
                        </div>	
                    </div>
                </div>
                <div class="row">		
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>User Role</label>
                            <select name="user_role_id" id="user_role_id" class="form-control">
                                <option value="0">--SELECT--</option>
                                <option value="1">Eflight Admin</option>
                                <option value="2">Eflight Ops</option>
                                <option value="3">Operator Admin</option>
                                <option value="4">USER</option>                               
                            </select>
                        </div>	
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Operator Email</label>
                            <input type="text" required="required" id="operator_email" name="operator_email" placeholder="Operator email" autocomplete="off" class="ops_admin_email form-control">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Operator</label>
                            <input type="text" required="required" id="operator" name="operator" placeholder="Operator" autocomplete="off" class="form-control auto_operator">
                        </div>
                    </div>	
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">				
                            <textarea style="width:100%;" class="user_callsigns text_uppercase" name="user_callsigns" id="user_callsigns" rows="4" cols="44">Call Signs</textarea>
                        </div>				
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="checkbox-inline"><input name="is_fpl" id="is_fpl" type="checkbox" value="">FPL</label>
                            <label class="checkbox-inline"><input name="is_fdtl" id="is_fdtl" type="checkbox" value="">FDTL</label>
                            <label class="checkbox-inline"><input name="is_navlog" id="is_navlog" type="checkbox" value="">NAV LOG</label>
                            <label class="checkbox-inline"><input name="is_lnt" id="is_lnt" type="checkbox" value="">L&T</label>
                            <label class="checkbox-inline"><input name="is_runway" id="is_runway" type="checkbox" value="">RW Analysis</label>
                            <label class="checkbox-inline"><input name="is_notams" id="is_notams" type="checkbox" value="">NOTAMS</label>
                            <label class="checkbox-inline"><input name="is_weather" id="is_weather" type="checkbox" value="">WX</label>
                            <label class="checkbox-inline"><input name="is_lr" id="is_lr" type="checkbox" value="">LR</label>
                            <label class="checkbox-inline"><input name="is_billing" id="is_billing" type="checkbox" value="">Billing</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-offset-8 col-md-4">
                        <div class="form-group">
                            <button type="submit" id="update_pilots" style="width: 100%;"  class="btn newbtnv1">UPDATE</button>		
                        </div>												
                    </div>
                </div>
                </div>
                <input type="hidden" name="id" id="id" />
                <input type="hidden" name="type" id="type" value="update"/>
                {!! csrf_field() !!}
            </form>	    
        </section>
    </div>
</div>
