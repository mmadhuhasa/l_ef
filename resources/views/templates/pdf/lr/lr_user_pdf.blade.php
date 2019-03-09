<?php
$img = 'pdfbg.png';
$name = 'Hello';
?>

<style type="text/css">
    table,th,td{
        border:1px solid #999;
        font-family: Arial, Verdana, sans-serif;
    }
    th {
        padding: 3px;
    }
    td {
        padding:2px 0px 2px 3px;
        text-transform: uppercase;
    }

    .container {font-family: sans-serif;border:1px solid #999;padding: 20px;}
    .main_head {color:red;text-align: center;padding: 0px 0 20px;font-weight: bold;font-size: 14px;}
    .table_lr th {text-align: left;}
    .table_lr tr:nth-child(even) {background: #eee;}
    .expire_color{
        color: red;font-size: 14px;font-weight: bold;
    }
    .due_color{
        color: orange;font-size: 14px;font-weight: bold;
    }
    .valid_color{
        color: green;font-weight: bold;font-size: 14px;
    }
</style>
<div class="container">
    <div id="lr_list" class="main_head">LICENSE REMINDER LIST</div>
    <div style="font-size:11px;"><b>NAME OF THE COMPANY:</b> {{$operator}}</div>
    <div style="font-size:11px;">
        <p><b>CREW NAME:</b> {{$user_name}}</p>
        <p style="position:absolute;top:80px;right:25px;font-weight:normal;font-size: 12px;font-style: italic;">
            as on {{date('d-M-Y')}}
        </p>
    </div>
    <table class="table_lr" style="border: 1px solid black" width="100%; margin-top:5px;font-size:11px;border-collapse:collapse;">
        <tr style="font-weight: bold;text-align: left;background: #333;color:#fff;">
            <th style="width:3%;">SL</th>
            <th style="width:18%;">USER NAME</th>
            <th style="width:23%;">LICENSE NAME</th>
            <th style="width:12%;">LICENSE TYPE</th>
            <th style="width:15%;">LICENSE NUMBER</th>
            <th style="width:12%;">DATE OF EXPIRY</th>
            <th style="width:11%;">REMAINING DAYS</th>
            <th style="width:6%;">STATUS</th>
        </tr>
        <?php
        $i = 1;
        $current_date = strtotime(date('Ymd'));
        ?>
        @foreach($lr_data as $lr_data_values)

        <?php
        $to_date = $lr_data_values->to_date;
        $renewed_date = $lr_data_values->renewed_date;
        $to_date = strtotime('20' . trim($to_date)); //echo floor($datediff / (60 * 60 * 24));
        $valid_days = ceil(($to_date - $current_date) / 86400);
        $status_color = '';
        if ($valid_days >= 0 && $valid_days <= 31) {
            $status = 'DUE';
            $status_color = 'due_color';
        } else if ($valid_days < 0) {
            $status = 'EXPIRED';
            $status_color = 'expire_color';
        } else {
            $status = 'VALID';
            $status_color = 'valid_color';
        }

        $expire_date = date('d-M-Y', $to_date);
        $renewed_date = date('d-M-Y', strtotime('20' . $renewed_date));
        $user_name_data = App\User::where('id', $lr_data_values->user_id)->first(['name']);
        $user_name = ($user_name_data) ? $user_name_data->name : '';
        ?>
        <tr>
            <td>{{$i}}</td>
            <td>{{$user_name}}</td>
            <td>{{$lr_data_values->lr_license_name}}</td>
            <td>{{$lr_data_values->license_type}}</td>
            <td>{{$lr_data_values->number}}</td>
            <td>{{$expire_date}}</td>
            <td><span class="{{$status_color}}">{{$valid_days}}</span></td>
            <td>{{$status}}</td>   
        </tr>
        <?php $i++; ?>
        @endforeach
    </table>
    <div style="text-align: center;position:absolute;top:100%;left:45%;"><img src="https://www.eflight.aero/media/images/header/logo-web.png" width="165" height="43"></div>
</div>

