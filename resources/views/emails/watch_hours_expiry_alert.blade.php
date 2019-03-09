    <div class="container" style="width:680px;background: #fff;-webkit-box-shadow: 0px 1px 0px 0px rgba(0, 0, 0, 0.12);-moz-box-shadow: 0px 1px 0px 0px rgba(0, 0, 0, 0.12);box-shadow: 0px 1px 0px 0px rgba(0, 0, 0, 0.12);-moz-transition: 0.5s all ease;-o-transition: 0.5s all ease;margin-top:10px;
            z-index: 1;border: 1px solid #eee;font-family:monospace;" >
    <div class="row">
        <div class="col-md-12" style=" padding: 10px;background: #f9f9f9;border: 7px solid #fff;">
  <!--              <p  style="font-size: 15px;font-family: verdana;    background: #333;background: linear-gradient(to bottom,#a6a6a6 0%,#555555 50%,#a6a6a6 100%);padding: 5px 7px;color: #fff;margin-bottom: 10px;border: 1px solid #eee;border-radius: 6px; margin-bottom:0px;">
               Following Airport Watch Hours are expiring tomorrow ( {!! $date !!}), Please update records ASAP
               </p> -->
           
            <div class="p-rl-5">
                <p style="font-size: 14px;font-family: monospace;color:black;margin-top: 15px;">
                Hello Ops Team,
                </p>
                <span style="font-family:monospace;font-size: 14px;">Following Airport Watch Hours are expiring tomorrow ({!! $date !!}), Please update records ASAP.</span>
                <p style=" font-size: 14px;font-family:monospace;line-height: 1.4;text-align: justify;font-style: italic;padding: 0 2px;text-transform:lowercase;">
                <?php $i=0 ;?>
                 @foreach($data as $item)
                   <?php $data=App\models\WatchHoursAirportModel::where('code',$item)->pluck('name'); ?>
                   <b style="text-transform:uppercase;font-family:monospace;font-size: 14px;"><span style="color: red">{!! $item !!}</span> - <span style="color: red">{{$data[0]}}</span></b> <br/> 
                  @endforeach
               <!--  WATCH HOURS IS EXPIRING ON {!! $date !!} PLEASE UPDATE WEBSITE DATABASE TO STAY CURRENT. -->
                </p>
              </div>
                <p style="color: #000;font-size: 14px;margin-top:20px;font-family:monospace;">Thanks, </p>
                <p style="font-size: 14px;font-family:monospace;line-height: 1.2;text-align: justify;">SYSTEM ADMIN</p>
        </div>
    </div>
</div>
</div>