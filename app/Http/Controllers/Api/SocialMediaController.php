<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\FriendsRequest;
use App\BlockUser;
use App\Http\Resources\Blog as BlogResource;
use Validator;

class SocialMediaController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_request(Request $request)
    {   

        $reqs_data =  BlockUser::where("block", $request->requestor)
        ->where('requestor',$request->to)->first();
        if(!is_null($reqs_data)){
            return response()->json([
                "error" => 'request_fail',
                "message" => 'this mail is blocked',
            ], 422);

        }

        $reqs_data =  FriendsRequest::where("requestor", $request->requestor)->first();
        if(!is_null($reqs_data)){
            return response()->json([
                "error" => 'request_fail',
                "message" => 'request have been made',
            ], 422);

        }
        
        $validator =  Validator::make($request->all(),[
            'requestor' => 'required|string|email|max:255"',
            'to' => 'required|string|email|max:255',
        ]);

        if($validator->fails()){
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 422);
        }
        // if validation through then continue 
        try{
            $data = input::all();
            $data['status'] = 'pending';
         
            $friend_request = new FriendsRequest($data);
            $friend_request->save();
            return response()->json([
                "success" => true,
            ], 200);

        }
        catch(Exception $e) {
            return response()->json([
                "error" => true,
                "message" => $e->getMessage(),
            ], 422);
        }
    }

    public function manage_request(Request $request)
    {
        $validator =  Validator::make($request->all(),[
            'requestor' => 'required|string|email|max:255',
            'to' => 'required|string|email|max:255',
            'accept' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 422);
        }
        // if validation through then continue 
        try{
           
            $data = input::all();
            if(isset($data['accept']) ||$data['accept']!='' ){
                $data['accept'] = $data['accept']=='true'?"accepted":"rejected";
            }

            $requestor = $data['requestor'];
            $to = $data['to'];
            $status = $data['accept'];

            //check in database whether is row is exist 
            $existRow =  FriendsRequest::where("requestor", $requestor)->where("to", $to)->first();
            if(is_null($existRow)){
                return response()->json([
                    "error" => 'no_data_found',
                    "message" => 'there is no data with these parameter ',json_encode($data),
                ], 422);
            }
            $affectedRows = FriendsRequest::where("requestor", $requestor)->where("to", $to)->update(["status" => $status]);
            return response()->json([
                "success" => true,
            ], 200);

        }
        catch(Exception $e) {
            return response()->json([
                "error" => true,
                "message" => $e->getMessage(),
            ], 422);
        }
    }

    public function list_request(Request $request)
    {
        $jsondata='';
        $validator =  Validator::make($request->all(),[
            'request_for' => 'required|string|email|max:255',
        ]);

        if($validator->fails()){
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 422);
        }
        // if validation through then continue 
        try{
           
            $data = input::all();
            $request_for = $data['request_for'];
            
            //check in database whether is row is exist 
            $existRow =  FriendsRequest::where("to", $request_for)->get();
            foreach($existRow as $k=>$v){
                $jsondata[$k]['requestor'] = $v->requestor;
                $jsondata[$k]['status'] = $v->status;
            }
            
            return response()->json([
                "request" => $jsondata,
                
            ], 200);

        }
        catch(\Illuminate\Database\QueryException $e) {
            return response()->json([
                "error" => true,
                "message" => $e->getMessage(),
            ], 422);
        }
    }

    public function list_friends(Request $request)
    {
        $jsondata='';
        $validator =  Validator::make($request->all(),[
            'email' => 'required|string|email|max:255',
        ]);

        if($validator->fails()){
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 422);
        }
        // if validation through then continue 
        try{
           
            $data = input::all();
            $email = $data['email'];
            
            //check in database whether is row is exist 
            $existRow =  FriendsRequest::where("to", $email)->where('status','accepted')->get();
         
            foreach($existRow as $k=>$v){
                $jsondata[$k] = $v->requestor;
            }
          
            return response()->json([
                "friends" => $jsondata,
                
            ], 200);

        }
        catch(Exception $e) {
            return response()->json([
                "error" => true,
                "message" => $e->getMessage(),
            ], 422);
        }
    }

    public function retrieve_friends(Request $request)
    {
        $friends= '';
        try{
            $bodyContent = $request->getContent();
            if(!is_null($bodyContent)){
                $data = json_decode($bodyContent, true);
                
                foreach($data['friends'] as $k=>$v){
                    $mail[$k] = $v; 
                }
                
                $friend_list = FriendsRequest::select('requestor')
                ->where('to', $mail[0])
                ->orWhere('to', '=', $mail[1])
                ->where('requestor', '!=' ,$mail[0])
                ->where('requestor', '!=' ,$mail[1])
                ->where('status', 'accepted')->groupBy('requestor')->get();
                
                foreach($friend_list as $k=>$v){
                    $friends[$k] = $v->requestor;
                }

            }
            
          
            return response()->json([
                "success" => true,
                "friends" => $friends,
                "count" => count($friend_list),
                
            ], 200);

        }
        catch(Exception $e) {
            return response()->json([
                "error" => true,
                "message" => $e->getMessage(),
            ], 422);
        }
    }

    public function block_user(Request $request)
    {
        try {
            $reqs_data =  BlockUser::where("block", $request->block)
            ->where("requestor", $request->requestor)
            ->first();
            
        } catch (\Illuminate\Database\QueryException $e) {
          
            return response()->json([
                "error" => true,
                "message" => $e->getMessage(),
            ], 422);
        }

      
        if(!is_null($reqs_data)){
            return response()->json([
                "error" => 'request_fail',
                "message" => 'this mail already blocked',
            ], 422);

        }
        
        $validator =  Validator::make($request->all(),[
            'requestor' => 'required|string|email|max:255',
            'block' => 'required|string|email|max:255',
        ]);

        if($validator->fails()){
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 422);
        }
        // if validation through then continue 
        try{
            $data = input::all();
            $block_request = new BlockUser($data);
            $block_request->save();
            return response()->json([
                "success" => true,
            ], 200);

        }
        catch(Exception $e) {
            return response()->json([
                "error" => true,
                "message" => $e->getMessage(),
            ], 422);
        }
    }


}
