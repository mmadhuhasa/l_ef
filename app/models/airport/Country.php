<?php

namespace App\models\airport;
use Illuminate\Database\Eloquent\Model;
//use Cviebrock\EloquentSluggable\Sluggable;
class Country extends Model
{
	//use Sluggable;
    protected $guarded = ['id']; 

    // public function sluggable()
    // {
    //     return [
    //         'slug' => [
    //             'source' => 'countryname'
    //         ]
    //     ];
    // }
}
