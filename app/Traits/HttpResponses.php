<?php

namespace App\Traits;

Trait HttpResponses {

    public function success($data,$message= 'Request was successfull',$code=200){
        return response()->json(  [
            'status'=> true,
            'message'=> $message,
            'data'=>$data
        ],$code);
    }
    public function error($data,$message='Error has Occured.....',$code=500){
        return response()->json(  [
            'status'=>false,
            'message'=> $message,
            'data'=>$data
        ],$code);
    }
}