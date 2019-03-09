@extends('layouts.backend_layout2',array('1'=>'1'))
@section('content')
<link rel="stylesheet" href="{{url('app/new_temp/css/animate.css')}}">
<style>
    .textarea_updateuser {
        margin-top: 20px;
        margin-bottom:20px;
        resize: none;
        border-radius: 4px;
        border: 1px solid #555555;
        color:#888888;
        font-size:13px;
    }
    textarea:focus {
        border:red solid 1px !important;
        box-shadow:none !important;
    }
    .updateusers_heading {
        text-transform: uppercase;
        text-align: center;
        padding: 5px 0;
        font-weight: bold;
        background: rgba(249,249,249,1);
        background: -moz-linear-gradient(left, rgba(249,249,249,1) 0%, rgba(255,255,255,1) 0%, rgba(204,204,204,1) 50%, rgba(249,249,249,1) 100%);
        background: -webkit-gradient(left top, right top, color-stop(0%, rgba(249,249,249,1)), color-stop(0%, rgba(255,255,255,1)), color-stop(50%, rgba(204,204,204,1)), color-stop(100%, rgba(249,249,249,1)));
        background: -webkit-linear-gradient(left, rgba(249,249,249,1) 0%, rgba(255,255,255,1) 0%, rgba(204,204,204,1) 50%, rgba(249,249,249,1) 100%);
        background: -o-linear-gradient(left, rgba(249,249,249,1) 0%, rgba(255,255,255,1) 0%, rgba(204,204,204,1) 50%, rgba(249,249,249,1) 100%);
        background: -ms-linear-gradient(left, rgba(249,249,249,1) 0%, rgba(255,255,255,1) 0%, rgba(204,204,204,1) 50%, rgba(249,249,249,1) 100%);
        background: linear-gradient(to right, rgba(249,249,249,1) 0%, rgba(255,255,255,1) 0%, rgba(204,204,204,1) 50%, rgba(249,249,249,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f9f9f9', endColorstr='#f9f9f9', GradientType=1 );
    }
    form#create_user_form{
        text-transform: uppercase;
    }
    .success{
        margin: 0 0 10px;
    width: 100%;
    text-align: center;
    color: #f1292b;
    }


</style>



<div id="page" class="app">
    @include('includes.v_header',[])
    <section>
        <div class="container cust-container-v">
            <div class="row">
                <div class="col-md-12 p-lr-0">
                    <p class="updateusers_heading">ADD LICENCE TYPES</p>
                    <p class="success"></p>

                </div>
            </div>
            <form data-toggle="validator" id="create_user_form"  name="create_user_form" @submit="add_users">
            <div class="row">
                <div class="col-md-4 form-group">
                    <input type="text" required="" class="form-control text_uppercase" @keyup="v_name" autocomplete="off" v-model="name" id="name" name="name" placeholder="name">
                </div>
                <div class="col-md-4 form-group">
                    <input type="text" required="" class="form-control" autocomplete="off" @keyup="v_email" id="email" v-model="email" name="email" placeholder="email">
                </div>
                <div class="col-md-2 form-group">
                    <input type="text" required=""  class="form-control numeric" autocomplete="off" @keyup="v_mobile_number" v-model="user_mobile_number" id="user_mobile_number" maxlength="10" name="user_mobile_number" placeholder="mobile number">
                </div>
                <div class="col-md-2 form-group">
                    <input type="text" required=""  class="form-control text_uppercase" autocomplete="off" @keyup="v_operator"  v-model="operator" id="operator" name="operator" placeholder="operator">
                </div>
                <div class="col-md-12 form-group">
                    <textarea  required="" class="form-control textarea_updateuser text_uppercase" autocomplete="off" v-model="user_callsigns" id="user_callsigns" placeholder="CALL SIGNS" @keyup="v_user_callsigns" name="user_callsigns"></textarea>
                </div>
                <div class="col-md-2 form-group">
                    <select required=""  class="form-control">
                        <option value="0"  disabled>--USER TYPE--</option>
                        <option selected value="1">USER</option>
                        <option value="2">OPS</option>
                        <option value="3">ADMIN</option>
                    </select>
                </div>
                <div class="col-md-2 form-group">
                    <select required=""  class="form-control">
                        <option value="0" disabled>STATUS</option>
                        <option value="1" selected>ACTIVE</option>
                        <option value="0">INACTIVE</option>
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    <input type="password" required=""  name="inputpassword" @keyup="v_password" id="inputpassword" autocomplete="off" class="form-control" v-model="inputpassword" placeholder="Password">
                </div>
                <div class="col-md-3 form-group">
                    <input type="password"  required=""  name="confirm_password" @keyup="v_password_confirm" autocomplete="off" id="confirm_password" v-model="confirm_password" class="form-control" placeholder="Confirm Password" data-match="#inputpassword" data-match-error="Whoops, these don't match" />
                </div>
                <div class="">
                    <input type="hidden" v-model="url" name="url" id="url" value="{{url('')}}">
                    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn newbtnv1 form-control">CREATE</button>
                </div>
            </div>
            </form>
        </div>
    </section>
    @include('includes.v_footer',[])
</div>
<script>
    Vue.http.headers.common['X-CSRF-TOKEN'] = $("meta[name=_token]").attr('content');
new Vue({
    el: '.app',
   data: {
            name: '',
            user_mobile_number: '',
            email: '',
            operator: '',
            inputpassword:'',
            url:'',
            v1_user:'',
            user_callsigns:'',
            confirm_password:''
        },

    methods:{
     add_users: function(e){
          e.preventDefault();
     // var data = $("form[id='create_user_form']").serialize();

     var formdata = $("#create_user_form").serializeArray();
        var data = {};
        $(formdata ).each(function(index, obj){
            data[obj.name] = obj.value;
        });

     this.$http.post(this.url+'/Admin/add_users', data).then(function(data){
        $(".success").html('<p class="success animated  zoomIn custdelay" style="text-align: center;color:red">'+data.body.STATUS_DESC+'</p>');
        if(data.body.success =='success'){
        this.name = '';
        this.email = '';
        this.user_mobile_number = '';
        this.operator = '';
        this.user_callsigns = '';
        this.inputpassword = '';
        this.confirm_password = '';
    }
     })
     },
     v_name : function(e){
       if(this.name !='' && this.name.length >=2){
        $("#name").css('border','lightgrey solid 1px')
       }else{
        $("#name").css('border','red solid 1px')
       }
     },
      v_email : function(e){
       if(this.email !='' && this.email.length >=2){
        $("#email").css('border','lightgrey solid 1px')
       }else{
        $("#email").css('border','red solid 1px')
       }
     },
      v_mobile_number : function(e){
       if(this.user_mobile_number !='' && this.user_mobile_number.length ==10){
        $("#user_mobile_number").css('border','lightgrey solid 1px')
       }else{
        $("#user_mobile_number").css('border','red solid 1px')
       }
     },
      v_operator : function(e){
       if(this.operator !='' && this.operator.length >=2){
        $("#operator").css('border','lightgrey solid 1px')
       }else{
        $("#operator").css('border','red solid 1px')
       }
     },
     v_user_callsigns : function(e){
        console.log('Hii')
       if(this.user_callsigns !='' && this.user_callsigns.length >=2){
        $("#user_callsigns").css('border','lightgrey solid 1px !important')
       }else{
        $("#user_callsigns").css('border','red solid 1px !important')
       }
     },
     v_password : function(e){
       if(this.inputpassword !='' && this.inputpassword.length >=2){
        $("#inputpassword").css('border','lightgrey solid 1px')
       }else{
        $("#inputpassword").css('border','red solid 1px')
       }
     },
     v_password_confirm : function(e){
       if(this.confirm_password !='' && this.confirm_password.length >=2){
        $("#confirm_password").css('border','lightgrey solid 1px')
       }else{
        $("#confirm_password").css('border','red solid 1px')
       }
     },

    }
});
</script>
@stop