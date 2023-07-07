<?php

namespace App\Http\Traits;



trait SmsIrTrait
{
    use SmsIrUltraFastSendTrait;

    public function smsVerifyCodeDriver($mobile, $code)
    {

        $data = array(
            "ParameterArray" => array(
                array(
                    "Parameter" => "VerificationCode",
                    "ParameterValue" => "$code"
                )
            ),
            "Mobile" => "$mobile",
            "TemplateId" => "24413"
        );

        $this->UltraFastSend($data);
    }

    public function smsVerifyCodeCustomer($mobile, $code)
    {

        $data = array(
            "ParameterArray" => array(
                array(
                    "Parameter" => "VerificationCode",
                    "ParameterValue" => "$code"
                )
            ),
            "Mobile" => "$mobile",
            "TemplateId" => env('SMS_TEMPLATE_REGISTER')
        );
        $this->UltraFastSend($data);
    }

    public function emailVerifyCodeCustomer($email, $code)
    {
        event(new emailValidationEvent($email, $code));

    }

    public function smsInvitationDriver($mobile, $fullName)
    {

        $data = array(
            "ParameterArray" => array(
                array(
                    "Parameter" => "firstName",
                    "ParameterValue" => "$fullName"
                ),
                array(
                    "Parameter" => "lastName",
                    "ParameterValue" => ""
                )
            ),
            "Mobile" => "$mobile",
            "TemplateId" => "30704"
        );

        $this->UltraFastSend($data);
    }

    public function smsDriverConfirm($mobile, $fullName)
    {
        $data = array(
            "ParameterArray" => array(
                array(
                    "Parameter" => "firstName",
                    "ParameterValue" => "$fullName"
                ),
                array(
                    "Parameter" => "lastName",
                    "ParameterValue" => ""
                )
            ),
            "Mobile" => "$mobile",
            "TemplateId" => "24416"
        );

        $this->UltraFastSend($data);
    }

    public function smsVerifyCode($mobile, $code)
    {

        $data = array(
            "ParameterArray" => array(
                array(
                    "Parameter" => "VerificationCode",
                    "ParameterValue" => "$code"
                )
            ),
            "Mobile" => "$mobile",
            "TemplateId" => "25942"
        );

        $this->UltraFastSend($data);
    }

}
