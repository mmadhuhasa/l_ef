<?php

namespace App\models\notams;


/**
* 
*/
use Illuminate\Database\Eloquent\Model;

class FavouritesWxModel extends Model {
	
	protected $table ='favourites_wx';
	protected $primaryKey = "id";
    public $timestamps = true;

    public static function getAll(){
    	$result = FavouritesWxModel::get();
    	return $result;
    }
}

?>