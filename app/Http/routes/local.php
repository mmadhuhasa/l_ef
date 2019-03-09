<?php

use App\myfolder\myFunction;
use App\User;

Route::get('sendemail2', function () {

    $data = array(
        'name' => "Learning Laravel",
    );

    Mail::later(5, 'emails.welcome', $data, function ($message) {

        $message->from('dev.eflight@pravahya.com.vuppu18@gmail.com', 'Learning Laravel');

        $message->to('dev.eflight@pravahya.com')->subject('Learning Laravel test email');
    });

    return "Your email has been sent successfully";
});

Route::get('errors', function () {
    return view('test.error_message')->with('ww', 'ff');
});

Route::get('graph', function () {
    return view('test.graph');
});
Route::group(['namespace' => 'test'], function () {
    Route::group(['prefix' => 'test'], function () {
        Route::resource('/', 'TestController');
    });
});
Route::get('annexure', function () {
    $AnnexureCopy = 'AnnexureCopy.pdf';
    $filePath = base_path('media/pdf/fpl/');
    $annexure_copy_content = view('templates.pdf.fpl.annexure_copy');
    $pdf = PDF::loadView('templates.pdf.fpl.annexure_copy');
    return $pdf->stream('dev.eflight@pravahya.com.pdf');
});

Route::get('/user/{user}', function (User $user) {
    return $user;
});
//hasone relation
Route::get('phone/{id?}', function ($id) {
    return $phone = User::findorFail($id)->phone;
});
//
Route::get('user2/{id?}', function ($id) {
    return $user = App\models\PhoneModel::findorFail($id)->user;
});

Route::get('users_', function () {
    return App\User::paginate();
});

Route::get('run_api_doc', function () {
//	     base_path('app\Api\Controllers\doc').' '.base_path('resources\doc');
    $src = base_path('app\Api\Controllers\doc');
    $dst = base_path('public\api_doc');
    return App\myfolder\myFunction::recurse_copy($src, $dst);
});

Route::get('notifications', function () {
    $web_notifications = App\User::find(26)->web_notifications;
    $user_details = App\models\WebNotificationsModel::find(3)->user;
//    echo '<pre>';print_r($web_notifications);echo '</pre>';

    foreach ($web_notifications as $value) {
        if ($value->is_active == 1) {
            echo $value->subject;
            echo '<br/>';
        }
    }
});

Route::get('/xmltojson', function () {
    return view('test.xmltojson');
});

Route::get('redis', 'Redis\RedisController@redis');

Route::get('events/{jj?}', function ($jj = 'kk') {
    //Event::fire(new \App\Events\UserRegisterEvent($jj));

    $data = ['name' => 'dev.eflight@pravahya.com', 'email' => 'an@gg.com', 'mobile_number' => '8787878989', 'password' => bcrypt('dev.eflight@pravahya.com')];

    $fff = event(new \App\Events\UserRegisterEvent($data));
    print_r($fff);
});

Route::get('/encrypt', function () {
    $encrypt = encrypt('Hello');
    $decrypt = decrypt($encrypt);
    return $encrypt . ' ' . $decrypt;
});

Route::any('captcha-test', function() {
    if (Request::getMethod() == 'POST') {
        $rules = ['captcha' => 'required|captcha'];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            echo '<p style="color: #ff0000;">Incorrect!</p>';
        } else {
            echo '<p style="color: #00ff30;">Matched :)</p>';
        }
    }

    $form = '<form method="post" action="captcha-test">';
    $form .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
    $form .= '<p>' . captcha_img() . '</p>';
    $form .= '<p><input type="text" name="captcha"></p>';
    $form .= '<p><button type="submit" name="check">Check</button></p>';
    $form .= '</form>';
    return $form;
});

Route::get('bcrypt', function(){
    $res = \App\models\lr\LicenseInfoModel::all();
    foreach ($res as $value) {
        $id    = $value->id;
        $bcrypt = bcrypt($value->password);
        $result = \App\models\lr\LicenseInfoModel::where('id',$id)
                 ->update(['bcrypt' => $bcrypt]);
    }
    return 1;
});

Route::get('df', function(){
    $res = \App\models\lr\LicenseInfoModel::all();
    foreach ($res as $value) {
        $id    = $value->id;
        $date = $value->expire_date;
        $to = date('ymd',  strtotime($date));
        $result = \App\models\lr\LicenseInfoModel::where('id',$id)
                 ->update(['expire_date' =>$to ]);
    }
    return 1;
});

Route::get('df2', function(){
    $res = \App\models\lr\LicenseInfoModel::all();
    foreach ($res as $value) {
        $id    = $value->id;
        $date = $value->renewed_date;
        $to = date('ymd',  strtotime($date));
        $result = \App\models\lr\LicenseInfoModel::where('id',$id)
                 ->update(['renewed_date' =>$to ]);
    }
    return 1;
});
