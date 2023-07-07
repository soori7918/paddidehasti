<?php

namespace App\Http\Controllers\Padideh\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Padideh\UserResource;
use App\Http\Traits\Padideh\DriverTrait;
use App\Http\Traits\Padideh\SmsIrTrait;
use App\Models\Padideh\Driver;
use App\Models\Padideh\UserVerificationCode;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoginDriverController extends Controller
{
    use SmsIrTrait, DriverTrait;

    public function verification(Request $request)
    {
        $this->validate($request,[
            'mobile'=>'required|min:11|max:11',
        ]);

        if(true or UserVerificationCode::lastSendCodeTime($request->mobile) > 3 ){

            $code = UserVerificationCode::createCode($request->mobile,1);

            $this->smsVerifyCodeCustomer($request->mobile,$code);

            return $this->successResponse('کد تایید برای شما ارسال شد.', $code, 'کد تایید برای شما ارسال شد.');

        }else{
            return $this->failedResponse('e','3 دقیقه دیگر برای درخواست کد تایید اقدام نمایید.');
        }
    }

    public function login(Request $request)
    {
        if ($uvCode = UserVerificationCode::codeValidate($request->mobile,$request->code)){
            $driver = $this->driverWithMobileExists($request->mobile);
            if (!$driver) {
                $driver = Driver::create([
                    'mobile' => $request->mobile,
                ]);
            }

            $uvCode->useCode();

            $tokenResult = $driver->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->expires_at = Carbon::now()->addYear();
            $token->save();

            $driver->access_token = $tokenResult->accessToken;
            $data = new UserResource($driver);
                return $this->successResponse('ورود موفق', $data, 'ورود موفق');

        }else{

            return $this->failedResponse('e','کد تایید شما معتبر نمی باشد.');
        }
    }

    public function register(Request $request)
    {
        if ($uvCode = UserVerificationCode::codeValidate($request->mobile,$request->code)){

            if (!$driver = $this->driverWithMobileExists($request->mobile)){

                $driver = Driver::create([
                    'first_name' => $request->name,
                    'last_name' => '',
                    'mobile' => $request->mobile,
                ]);

            }
            return $this->login($request);
        }else{
            return $this->failedResponse('e','','کد تایید نامعتبر است');
        }
    }

    public function logout(Request $request)
    {
        $driver = $request->user()->token();
        $driver->revoke();

        return $this->successResponse('',null,'با موفقیت از حساب کاربری خارج شدید.');
    }
}
