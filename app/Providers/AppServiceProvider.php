<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use App\models\Fuelprice;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
//	  $this->app['request']->server->set('HTTPS', $this->app->environment() != 'local');
       if (env('APP_ENV') == 'eflightproduction' || env('APP_ENV') == 'production' || env('APP_ENV') == 'eflcoin' || env('APP_ENV') == 'eflcoinproduction') {
    \URL::forceSchema('https');
    }
    Validator::extend('is_date_valid', function($attribute, $value, $parameters) 
    {
        
            $airport_code=$parameters[0];
            $to_date=date('Ymd', strtotime($parameters[1]));
            $from_date=date('Ymd', strtotime($value));
            $city=$parameters[2];
            $isvalid_date=Fuelprice::where('airport_code',$airport_code)
                   ->where('city',$city) 
                   ->where('from_date','>=',$from_date)
                   ->where('to_date','<=',$to_date)
                   ->count();
             $isvalid_date1=Fuelprice::where('airport_code',$airport_code)
                   ->where('city',$city) 
                   ->where('from_date','<=',$to_date)
                   ->where('to_date','>=',$to_date)
                   ->count();

             $isvalid_date2=Fuelprice::where('airport_code',$airport_code)
                   ->where('city',$city) 
                   ->where('from_date','<=',$from_date)
                   ->where('to_date','>=',$from_date)
                   ->count();
             if($isvalid_date==0 && $isvalid_date1==0 && $isvalid_date2==0){
                return true;
              }
              return false;
    });

    Validator::extend('is_edit_date_valid', function($attribute, $value, $parameters) 
    {

            $airport_code=$parameters[0];
            $to_date=date('Ymd', strtotime($parameters[1]));
            $from_date=date('Ymd', strtotime($value));
            $id=$parameters[2];
            $city=$parameters[3];
            $isvalid_date=Fuelprice::where('airport_code',$airport_code)
                   ->where('city',$city) 
                   ->where('from_date','>=',$from_date)
                   ->where('to_date','<=',$to_date)
                   ->where('id','!=',$id)
                   ->count();
            
            
             $isvalid_date1=Fuelprice::where('airport_code',$airport_code)
                   ->where('city',$city) 
                   ->where('from_date','<=',$to_date)
                   ->where('to_date','>=',$to_date)
                   ->where('id','!=',$id)
                   ->count();

             $isvalid_date2=Fuelprice::where('airport_code',$airport_code)
                   ->where('city',$city) 
                   ->where('from_date','<=',$from_date)
                   ->where('to_date','>=',$from_date)
                   ->where('id','!=',$id)
                   ->count();
             if($isvalid_date==0 && $isvalid_date1==0 && $isvalid_date2==0){
                return true;
              }
              return false;
    });
    

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
	$this->app->alias('bugsnag.logger', \Illuminate\Contracts\Logging\Log::class);
	$this->app->alias('bugsnag.logger', \Psr\Log\LoggerInterface::class);
    }

}
