<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php  
    $data=Session::get('aircraft');
 ?>
  <p>Callsign={{$data->callsign}}</p>
  <p>operator={{$data->operator}}</p>
  <p>aircrafttype={{$data->aircrafttype}}</p>
  <p>engine_type={{$data->engine_type}}</p>
  <p>weight=  @if($data->weight==1) {{"KGS"}} @else {{"LBS"}} @endif</p>
  <p>MAX PAX= {{$data->pax}}</p>
  <p>max_fl=  {{$data->max_fl}}</p>
  <p>max_fuel= {{$data->max_fuel}}</p>
  <p>taxi_fuel= {{$data->taxi_fuel}}</p>
  <p>tow= {{$data->tow}}</p>
  <p>lw= {{$data->lw}}</p>
  <p>zfw= {{$data->zfw}}</p>
  <p>basic_wt= {{$data->basic_wt}}</p>
  <p>equipments= {{$data->equipments}}</p>
  <p>holding= @if($data->holding==1) {{"KGS"}} @else {{"LBS"}} @endif</p>
  <p>transponder= {{$data->transponder}}</p>
  <p>pbn= {{$data->pbn}}</p>
  <p>nav= @if($data->nav!="") {{$data->nav}}@endif</p>
  <p>credit_aai= @if($data->credit_aai==1) {{"YES"}} @else {{"NO"}} @endif</p>
  <p>aircraftcolor= @if($data->aircraftcolor!="") {{$data->aircraftcolor}}@endif</p>
  @php 
        $e_radio =json_decode($data->emergency_radio);  
  @endphp
  @if(count($e_radio)>0)
  <p>emergency_radio= 
   @foreach($e_radio as $key=>$radio)
    {{$radio}} @if($key != count($e_radio)-1) , @endif
    @endforeach
  </p>
  @endif
  @php 
        $survival_equipment =json_decode($data->survival_equipment);  
  @endphp
  @if(count($survival_equipment)>0)
  <p>survival_equipment= 
   @foreach($survival_equipment as $key => $equipment)
    {{$equipment}} @if($key != count($survival_equipment)-1) , @endif
   @endforeach
  </p>
  @endif
  @php 
        $jacket =json_decode($data->jacket);  
  @endphp
  @if(count($jacket)>0)
  <p>jacket= 
   @foreach($jacket as $key => $j)
    {{$j}} @if($key != count($jacket)-1) , @endif
   @endforeach
  </p>
  @endif
  <p>Dinghies No= @if($data->dinghies_no!="") {{$data->dinghies_no}} @endif</p>
  <p>Dinghies Capacity= @if($data->dinghies_capacity!="") {{$data->dinghies_capacity}} @endif</p>
  <p>Dinghies Color= @if($data->dinghies_color!="") {{$data->dinghies_color}} @endif</p>
  <p>Dinghies Cover= @if(isset($data->dinghies_cover)) {{"YES"}} @endif</p>

  
  <p>ops_manager= {{$data->ops_manager}}</p>
  <p>ops_mobile= {{$data->ops_mobile}}</p>
  <p>ops_email_id= {{$data->ops_email_id}}</p>
  @if($data->crew1!="") 
    <p>{{$data->designation1}} NAME = {{$data->crew1}}</p>
    <p>{{$data->designation1}} mobile= {{$data->mobile1}}</p>
    <p>{{$data->designation1}} email= {{$data->email1}}</p>
  @endif
  @if($data->crew2!="") 
    <p>{{$data->designation2}} NAME = {{$data->crew2}}</p>
    <p>{{$data->designation2}} mobile= {{$data->mobile2}}</p>
    <p>{{$data->designation2}} email= {{$data->email2}}</p>
  @endif
  @if($data->crew3!="") 
    <p>{{$data->designation3}} NAME = {{$data->crew3}}</p>
    <p>{{$data->designation3}} mobile= {{$data->mobile3}}</p>
    <p>{{$data->designation3}} email= {{$data->email3}}</p>
  @endif
  @if($data->crew4!="") 
    <p>{{$data->designation4}} NAME = {{$data->crew4}}</p>
    <p>{{$data->designation4}} mobile= {{$data->mobile4}}</p>
    <p>{{$data->designation4}} email= {{$data->email4}}</p>
  @endif
  @if($data->crew5!="") 
    <p>{{$data->designation5}} NAME = {{$data->crew5}}</p>
    <p>{{$data->designation5}} mobile= {{$data->mobile5}}</p>
    <p>{{$data->designation5}} email= {{$data->email5}}</p>
  @endif
  @if($data->crew6!="") 
    <p>{{$data->designation6}} NAME = {{$data->crew6}}</p>
    <p>{{$data->designation6}} mobile= {{$data->mobile6}}</p>
    <p>{{$data->designation6}} email= {{$data->email6}}</p>
  @endif
  @if($data->crew7!="") 
    <p>{{$data->designation7}} NAME = {{$data->crew7}}</p>
    <p>{{$data->designation7}} mobile= {{$data->mobile7}}</p>
    <p>{{$data->designation7}} email= {{$data->email7}}</p>
  @endif
  @if($data->crew8!="") 
    <p>{{$data->designation8}} NAME = {{$data->crew8}}</p>
    <p>{{$data->designation8}} mobile= {{$data->mobile8}}</p>
    <p>{{$data->designation8}} email= {{$data->email8}}</p>
  @endif
  @if($data->crew9!="") 
    <p>{{$data->designation9}} NAME = {{$data->crew9}}</p>
    <p>{{$data->designation9}} mobile= {{$data->mobile9}}</p>
    <p>{{$data->designation9}} email= {{$data->email9}}</p>
  @endif
</body>
</html>