<?php

namespace App\Http\Traits;

trait ResponseTrait
{
    protected $responseCode;
    protected $responseMessage;
    protected $responseStatus;

    public function setFailedResponse($error_code, $message)
    {
        $this->responseStatus = 'failed';
        $this->responseCode = $error_code;
        $this->responseMessage = $message;
    }

    public function getFailedResponse()
    {
        return response()->json([
            'status' => $this->responseStatus,
            'message' => $this->responseMessage,
            'error_code' => $this->responseCode
        ]);
    }

    public function successResponse($message, $data = NULL, $fa_message = null)
    {
        return response()->json(['status' => 'successful', 'message' => $message, 'fa_message' => $fa_message, 'data' => $data]);
    }

    public function failedResponse($error_code, $message, $fa_message = null)
    {
        return response()->json(['status' => 'failed', 'message' => $message, 'fa_message' => $fa_message, 'error_code' => $error_code]);
    }

}
