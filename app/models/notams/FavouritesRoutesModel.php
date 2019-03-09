<?php

namespace App\models\notams;


/**
* 
*/
use Illuminate\Database\Eloquent\Model;

class FavouritesRoutesModel extends Model {
	
	protected $table ='favourites_routes';
	protected $primaryKey = "id";
    public $timestamps = true;

    public static function getAll(){
    	$result = FavouritesRoutesModel::get();
    	return $result;
    }
  
	
}

?>