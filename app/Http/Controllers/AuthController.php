<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Session;
use JWTAuth;

class Authcontroller extends Controller
{
    //Get All users swagger
    /**
     * @SWG\Get(
     *     path="/api/All-Users",
     *     description = "get all users",
     *     produces={"application/json"},
     *     operationId="GET_ALL_USERS",
     *     tags={"Users"},
     *   
     *     @SWG\Response(
     *         response = 200,
     *         description = "SUCCESSFULLY DONE"
     *     ),
     *     @SWG\Response(
     *         response=401, 
     *         description="Bad request"
     *      )
     * )
     */
    public function index(){
        $users = User::all();

        if ( !$users->first() ) {
           return response()->json([
            'Message' => 'No user found'
           ],404);
        }
        return response()->json([
            'Message' => 'found users',
            'users' => $users->toArray()
        ],200);
    }

    //Get User be swagger
    /**
     *
     *  @SWG\Delete(
     *      path="/api/Delete-Users/{id}",
     *      tags={"Users"},
     *      operationId="deleteUser",
     *      summary="Remove User entry",
     *      @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="User ID",
     *      ),
     *      @SWG\Response(
     *          response = 200,
     *          description="success",
     *      ),
     *      @SWG\Response(
     *          response = 401,
     *          description="error",
     *      )
     *  )
     *
     */
    public function Delete_User($id){
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'Message' => 'This User is not found'
            ],404);
        }

        if (!$user->delete()) {
            return response()->json([
                'Message' => 'This User Can Not be deleted',
                'user_information' => $user->toArray()
            ],409);
        }

        return response()->json([
                'Message' => 'This User deleted successfully congrats',
                'user_information' => $user->toArray()
            ],200);  
    }

    //Get login view swagger
    /**
     * @SWG\Get(
     *     path="/api/auth/login",
     *     description = "get login view for user",
     *     produces={"application/json"},
     *     operationId="GET_LoginView_USERS",
     *     tags={"Users"},
     *     
     *      @SWG\Response(
     *         response = 200,
     *         description = "SUCCESSFULLY DONE"
     *     ),
     *     @SWG\Response(
     *         response=401, 
     *         description="Bad request"
     *      )
     * )
     */
    public function Get_Login_View(){
    	//get login page
        return view('user.login');
    }

    //Get register view swagger
    /**
     * @SWG\Get(
     *     path="/api/auth/register",
     *     description = "get register view for user",
     *     produces={"application/json"},
     *     operationId="GET_RegisterView_USERS",
     *     tags={"Users"},
     *     
     *      @SWG\Response(
     *         response = 200,
     *         description = "SUCCESSFULLY DONE"
     *     ),
     *     @SWG\Response(
     *         response=401, 
     *         description="Bad request"
     *      )
     * )
     */
    public function Get_register_View(){
    	//get Register page
    	return view('user.register');
    }



    // post login
    /**
     *   @SWG\Post(
     *     path="/api/auth/login",
     *     description = "post login form ",
     *     produces={"application/json"},
     *     operationId="POST_LOGINForm_USERS",
     *     tags={"Users"},
     *
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          schema={"$ref": "#/definitions/User_Login"},
     *          required=true
     *      ),
     *       
     *      
     *      @SWG\Response(
     *         response = 200,
     *         description = "SUCCESSFULLY DONE",     
     *     ),
     *     @SWG\Response(
     *         response=401, 
     *         description="Bad request"
     *      )
     *     
     * )
     */
    
    public function login(Request $request){

        //validation
        $this->validate($request,[
            'email' => 'email|required',
            'password' => 'required'
        ]);
        $email = $request['email'];
        $password = $request['password'];
        $token = null;

        if (!$token = JWTAuth::attempt(['email' => $email, 'password' => $password])) {
            return response()->json([
                'invalid_email_or_password , please refresh and try again'
            ], 422);
        }else{
             return response()->json([
                'Message' => 'user in now logged in ',
                'Token' => $token
             ],200);
        } 
    }


    // post register
    /**
     *   @SWG\Post(
     *     path="/api/auth/register",
     *     description = "post register form ",
     *     produces={"application/json"},
     *     operationId="POST_RegisterForm_USERS",
     *     tags={"Users"},
     *
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          schema={"$ref": "#/definitions/User_Regiester"},
     *          required=true
     *      ),
     *      @SWG\Response(
     *         response = 200,
     *         description = "SUCCESSFULLY DONE"
     *     ),
     *     @SWG\Response(
     *         response=401, 
     *         description="Bad request"
     *      )
     *     
     * )
     */
    public function register(Request $request){
    	//validation
    	$this->validate($request,[
    		'email' => 'email|required|unique:users',
    		'name' => 'required|min:2|max:20',
    		'password' => 'required|min:5|max:32'
    	]);
        //get user information from form
    	$email = $request['email'];
    	$name = $request['name'];
    	$password = bcrypt($request['password']);


    	//make new user
    	$user =new User();
    	$user->email = $email;
    	$user->name = $name;
    	$user->password = $password;

    	
	
        //save this user in database
    	$user->save();
        if ( ! $user->save()) {
          return response()->json([
            'message'  => 'user can not be created',
            'code' => 401
            ],401);
        }
        //return the welcome page
    	return response()->json([
            'message'  => 'user is created',
            'user_info' => $user->toArray()
        ],200);
    }


    public function Get_Auth_User_Information(){
        $user = JWTAuth::parseToken()->authenticate();
        return response()->json([
            'AuthUser-Information' => $user
        ],200);

        // "email": "12345@yahoo.com",
        // "name":"Ahmed12345",
        // "password":"11111",
        // "password_confirmation":"11111"
    }



    // public function logout(Request $request){
        //     auth()->logout();
        //     //destroy session
        //     Session::flush();
        //     return redirect()->route('home');
    // }


}
