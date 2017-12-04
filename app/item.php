<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * @SWG\Definition(
 * 	definition = "Item"
 * )
 */
class item extends Model
{

	//define property for swagger in post request
    /**
     * @SWG\Property(
     *      property="itemname",
     *      type="string",
     *      example="New Item"
     * )
     * 
     */
    
     public function User(){
    	return $this->belongsTo(\App\User::class);
    }
}
