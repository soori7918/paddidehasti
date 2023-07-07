<?php


namespace App\Http\Traits\Padideh;

use Illuminate\Support\Facades\Log;

trait SmsIrTrait
{
    use SmsIrUltraFastSendTrait;

    public function smsVerifyCodeDriver($mobile,$code){

        Log::info('smsVerifyCodeDriver - Start');
        $data = array(
            "ParameterArray" => array(
                array(
                    "Parameter" => "VerificationCode",
                    "ParameterValue" => "$code"
                )
            ),
            "Mobile" => "$mobile",
            "TemplateId" => "36598"
        );

        $send = $this->UltraFastSend($data);
        Log::info('smsVerifyCodeDriver - End '.$send);
    }

    public function smsVerifyCodeCustomer($mobile,$code){

        $data = array(
            "ParameterArray" => array(
                array(
                    "Parameter" => "VerificationCode",
                    "ParameterValue" => "$code"
                )
            ),
            "Mobile" => "$mobile",
            "TemplateId" => "55016"
        );

        return $this->UltraFastSend($data);
    }

    public function smsDoneOrderHeadForCustomer($mobile,$data, $details){

//        dd($details);
        $data = array(
            "ParameterArray" => array(
                array(
                    "Parameter" => "Orders",
                    "ParameterValue" => $data['orders']
                ),
                $details[0],
                $details[1],
                $details[2],
                $details[3],
                $details[4],
                $details[5],
                $details[6],
                $details[7],
                array(
                    "Parameter" => "SumWeight",
                    "ParameterValue" => $data['weight']
                ),
                array(
                    "Parameter" => "SumAmount",
                    "ParameterValue" => $data['amount']
                ),
                array(
                    "Parameter" => "OrderCode",
                    "ParameterValue" => $data['code']
                ),
            ),
            "Mobile" => "$mobile",
           // "TemplateId" => "41132"
            "TemplateId" => "43565"
        );

        return $this->UltraFastSend($data);
    }
}
