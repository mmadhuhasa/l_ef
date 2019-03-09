<?php

namespace App\models\notams;


/**
* 
*/
use Illuminate\Database\Eloquent\Model;

class FavouritesNotamsModel extends Model {
	
	protected $table ='favourites_notams';
	protected $primaryKey = "id";
    public $timestamps = true;

    public static function getAll(){
    	$result = FavouritesNotamsModel::get();
    	return $result;
    }
    public static function getNotamUsersByAerodrome($aero_id){
    	$result = FavouritesNotamsModel::where('fav_aerodrome_notams','=',$aero_id)
    	->join('users', 'favourites_notams.user_id', '=', 'users.id')
    	->get(['email','fav_aerodrome_notams']);
    	return $result;
    }
	
}

?>