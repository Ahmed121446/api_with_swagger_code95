<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

//for regiester properties
/**
 * @SWG\Definition(
 *      definition = "User_Regiester",
 *      @SWG\Property(
 *          property="email",
 *          type="string",
 *          example="Ahmed@yahoo.com"
 *      ),
 * 
 *     @SWG\Property(
 *          property="name",
 *          type="string",
 *          example="Ahmed"
 *      ),
 * 
 *     @SWG\Property(
 *          property="password",
 *          type="string",
 *          example="11111"
 *      )    
 * )

 */


//for login properties
/**
 * @SWG\Definition(
 *      definition = "User_Login",
 *      @SWG\Property(
 *          property="email",
 *          type="string",
 *          example="Ahmed@yahoo.com"
 *      ),
 * 
 *     @SWG\Property(
 *          property="password",
 *          type="string",
 *          example="11111"
 *      )    
 * )

 */

class User extends Authenticatable
{
    //define property for swagger in post request
    /**

     * 
     */
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Items(){
       return $this->hasMany(\App\item::class);
    }
}
