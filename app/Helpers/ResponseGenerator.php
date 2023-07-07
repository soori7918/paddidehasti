<?php

namespace App\Helpers;
class ResponseGenerator {

    /**
     * Success
     */
    public static function success($data = array()){
        $status = array('status' => 'success');
        $data = array('body' => $data);
        $data = $status + $data;
        return array('data' => $data , 'status' => 200);
    }

    //Unauthorized
    public static function unauthorized($data = array()){
        $status = array('status' => 'error');
        $data = isset($data['errors']) ? $data : array('errors' => $data);
        $data = $status + $data;
        return array('data' => $data , 'status' => 401);
    }

    //Forbidden
    public static function forbidden($data = array()){
        $status = array('status' => 'error');
        $data = isset($data['errors']) ? $data : array('errors' => $data);
        $data = $status + $data;
        return array('data' => $data , 'status' => 403);
    }
    //Not found
    public static function notFound($data = array()){
        $status = array('status' => 'error');
        $data = isset($data['errors']) ? $data : array('errors' => $data);
        $data = $status + $data;
        return array('data' => $data , 'status' => 404);
    }

    //Method not allowed
    public static function notAllowed($data = array()){
        $status = array('status' => 'error');
        $data = isset($data['errors']) ? $data : array('errors' => $data);
        $data = $status + $data;
        return array('data' => $data , 'status' => 405);
    }

    //Duplicate entry
    public static function conflict($data = array()){
        $status = array('status' => 'error');
        $data = isset($data['errors']) ? $data : array('errors' => $data);
        $data = $status + $data;
        return array('data' => $data , 'status' => 409);
    }

    //Unprocessable entity
    public static function entity($data = array(), $format = false){
        if($format) $data = self::format($data);
        $status = array('status' => 'error');
        $data = isset($data['errors']) ? $data : array('errors' => $data);
        $data = $status + $data;
        return array('data' => $data , 'status' => 422);
    }

    public static function unprocessableEntity($data = array(), $format = false){
        if($format) $data = self::format($data);
        $status = array('status' => 'error');
        $data = isset($data['errors']) ? $data : array('errors' => $data);
        $data = $status + $data;
        return array('data' => $data , 'status' => 422);
    }

    //Server error
    public static function serverError($data = array()){
        $status = array('status' => 'error');
        $data = $status + $data;
        return array('data' => $data , 'status' => 500);
    }


    public static function format($errors){
        $response = array();
        foreach($errors as $key => $value){
            $response[$key] = $value[0];
        }
        return array('errors' => $response);
    }
}
