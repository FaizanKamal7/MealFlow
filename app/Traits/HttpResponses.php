<?php

namespace App\Traits;

Trait HttpResponses {

    public function success($data,$message= null,$code=200){
        return response()->json(  [
            'status'=>'Request was successfull',
            'message'=> $message,
            'data'=>$data
        ],$code);
    }
    public function error($data,$message=null,$code){
        return response()->json(  [
            'status'=>'Error has Occured.....',
            'message'=> $message,
            'data'=>$data
        ],$code);
    }
}