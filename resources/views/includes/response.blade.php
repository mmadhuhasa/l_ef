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