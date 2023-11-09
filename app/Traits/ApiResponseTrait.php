<?php

namespace App\Traits;


trait ApiResponseTrait
{
    public function apiResponseData($data = null , $message = null , $code = 200)
    {
        $array = [
            'status' => 1,
            'message' => $message,
            'data' => $data ,
        ];

        return response($array, 200);
    }

    public function apiResponseMessage($status , $message = null , $code = 200)
    {
        $array = [
            'status' => $status,
            'message' => $message,
            'data' => null ,
        ];

        return response($array, 200);
    }

    public function not_found($array, $arabic,$english,$lang)
    {
        if(is_null($array)){
            $msg=$lang== 'ar'? $arabic . 'غير موجود' : $english . 'Not Found' ;
            return response()->json([
                'status' => 0,
                'message' => $msg,
                'data' => null ,
            ],200);
        }
    }

    public function not_found_v2($lang)
    {
        $msg=$lang=='en'? 'Data Not Found' : 'الداتا غير موجوده';
        return response()->json([
            'status' => 0,
            'message' => $msg,
            'data' => null ,
        ],200);
    }

    public function Message($lang , int $type){
        $msg=$lang=='en'? 'edit successfully' : 'تم التعديل بنجاح ';
        if($type=1){
            $msg=$lang=='en'? 'edit successfully' : 'تم التعديل بنجاح ';
        }
        return $msg;
    }

}

