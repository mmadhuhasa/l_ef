    <div class="container" style="width:680px;background: #fff;-webkit-box-shadow: 0px 1px 0px 0px rgba(0, 0, 0, 0.12);-moz-box-shadow: 0px 1px 0px 0px rgba(0, 0, 0, 0.12);box-shadow: 0px 1px 0px 0px rgba(0, 0, 0, 0.12);-moz-transition: 0.5s all ease;-o-transition: 0.5s all ease;margin-top:10px;
            z-index: 1;border: 1px solid #eee;">
    <div class="row">
        <div class="col-md-12" style=" padding: 10px;background: #f9f9f9;border: 7px solid #fff;">
              
            <div class="p-rl-5">
                <p style="font-size: 15px;font-family: verdana;color:black;margin-top: 15px;">
                Hello Ops Team,
                </p>
                <p style=" font-size: 12px;font-family:verdana;line-height: 1.4;text-align: justify;padding: 0 2px;text-transform:lowercase;">
                  <b style="text-transform:uppercase;"> WATCH HOURS DELETED FOR {{$airport}}</b><br>
                  <b style="text-transform:uppercase;"> FROM DATE:{{date('d-M-Y',strtotime($start_date))}}</b><br>
                  <b style="text-transform:uppercase;"> TO DATE: {{date('d-M-Y',strtotime($end_date))}}</b><br>
                  <b style="text-transform:uppercase;"> BY: {{Auth::user()->name}}</b><br>
                 
                </p>
                <p style="color: #000;font-size: 13px;margin-top:20px;">Thanks, </p>
                <p style="font-size: 12px;font-family:verdana;line-height: 1.2;text-align: justify;">SYSTEM ADMIN</p>
        </div>
    </div>
</div>
</div>