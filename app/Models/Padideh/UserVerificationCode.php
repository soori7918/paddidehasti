<?php

namespace App\Models\Padideh;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserVerificationCode extends Model
{
    protected $table = 'mobile_verification_codes';

    protected $guarded = [];

    const UPDATED_AT = null;

    private static $expirationTime = 7;

    public static function createCode($mobile,$type){
        $userCode = self::where('mobile_number', $mobile)
            ->orderBy('id', 'DESC')->first();
        $code = rand(10000,99999);
        if ($userCode) {
            $userCode->update([
                'used' => 0,
                'used_at' => null,
                'code' => $code,
                'created_at' => Carbon::now(),
            ]);
        } else {
            $userCode = (new static);
            $userCode->mobile_number = $mobile;
            $userCode->code = $code;
            $userCode->created_at = Carbon::now();
            $userCode->save();
        }

        return $userCode->code;
    }

    public static function lastSendCodeTime($mobile){
        $lastSendCodeTry = self::where('mobile_number','=',$mobile)->where('used', 0)->orderBy('id','desc')->first();
        if (!$lastSendCodeTry){
            return 4;
        }
        $minute = self::toMinuteAgo($lastSendCodeTry->updated_at);
        return $minute;
    }

    public static function toMinuteAgo($lastSendCodeTime)
    {
        return Carbon::now()->diffInMinutes($lastSendCodeTime);
    }

    public static function codeValidate($mobile,$code){
        $userVerCode = self::where('mobile_number','=',$mobile)
            ->where('code','=',$code)->orderBy('id', 'DESC')->first();

        if ($userVerCode && $userVerCode->isValid()){
            return $userVerCode;
        }

        return false;
    }


    public function useCode(){
        $this->used = 1;
        $this->used_at = Carbon::now();
        $this->save();
    }

    /**
     * True if the token is not used nor expired
     *
     * @return bool
     */
    public function isValid()
    {
        return ! $this->isUsed() && ! $this->isExpired();
    }

    /**
     * Is the current token used
     *
     * @return bool
     */
    public function isUsed()
    {
        return $this->used;
    }

    /**
     * Is the current token expired
     *
     * @return bool
     */
    public function isExpired()
    {
        return Carbon::now()->diffInMinutes($this->updated_at) >= self::$expirationTime ;
    }
}
