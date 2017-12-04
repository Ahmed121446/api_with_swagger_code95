<?php

namespace App\Http\Controllers;

use App\item;
use Illuminate\Http\Request;
use JWTAuth;
use App\User;

class ItemController extends Controller{
    //Get updated Items swagger
    /**
     * @SWG\Get(
     *     path="/api/Update",
     *     description = "get updated items",
     *     produces={"application/json"},
     *     operationId="GET_ALL_Updated_ITEMS",
     *     tags={"Items"},
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
    public function get_update_view(){
        //get update page
        return view('item.update_item');
    }
    //Get All Items swagger
    /**
     * @SWG\Get(
     *     path="/api/All-Items",
     *     description = "get all items",
     *     produces={"application/json"},
     *     operationId="GET_ALL_ITEMS",
     *     tags={"Items"},
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
       $items = item::all();
       if (!$items->first()) {
           return response()->json([
            'message' => 'no data found'
        ],404);
       }
       return response()->json([
        'message' => 'data found',
        'items' =>$items->toArray()
        ],200);
    }

    //Get Item be swagger
    /**
     *
     *  @SWG\Delete(
     *      path="/api/Delete-item/{id}",
     *      tags={"Items"},
     *      operationId="deleteItem",
     *      summary="Remove Item entry",
     *      
     *      @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="Item ID",
     *      ),
     *      
     *      @SWG\Parameter(
     *          name="Authorization",
     *          in="header",
     *          required=true,
     *          type="string",
     *          description="User token",
     *      ),  
     *        
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
    public function Delete_Item($id){
        $user = JWTAuth::parseToken()->authenticate();
        $user_id = $user->id;

        $item_of_authuser = $user->Items()->find($id);
       //$item_of_authuser = item::find($id);
        if (!$item_of_authuser) {
            return response()->json([
                'Message'=>'Item is not found , you are not auth to delete this item'
            ],404);
        }else{
            if (!$item_of_authuser->delete()) {
            return response()->json([
                'Message' => 'This item Can Not be deleted',
                'item_information' => $item_of_authuser->toArray()
            ],409);
        }

        return response()->json([
            'Message' => 'This item deleted successfully congrats',
            'item_information' => $item_of_authuser->toArray()
        ],200);  

        }
    }

    // put register update item
    /**
     *   @SWG\Put(
     *     path="/api/update-item/{id}",
     *     description = "put request for update item name ",
     *     produces={"application/json"},
     *     operationId="PUT_UPDATE_ITEM_NAME",
     *     tags={"Items"},
     *
     *      @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="UUID",
     *      ),
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          schema={"$ref": "#/definitions/Item"},
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
    public function Update_Item(Request $request,$id){
        // $user = JWTAuth::parseToken()->authenticate();
        // $user_id = $user->id;

        // $item_of_authuser = $user->Items()->find($id);
        
        $item_of_authuser = item::find($id);

        if (!$item_of_authuser) {
            return response()->json([
                'Message' => 'This item is not found , you are not auth to update this item'
            ],404);
        }

        $this->validate($request,[
            'itemname' =>'required|max:20'
        ]);
        $item_of_authuser->name = $request->get('itemname');


        if (!$item_of_authuser->update()) {
            return response()->json([
                'Message' => 'This item Can Not be updated',
                'item_information' => $item_of_authuser->toArray()
            ],409);
        }
        return response()->json([
            'Message' => 'This item updated successfully congrats',
            'item_information' => $item_of_authuser->toArray()
        ],200); 
    }


}
