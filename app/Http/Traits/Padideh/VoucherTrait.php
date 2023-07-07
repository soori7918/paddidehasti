<?php


namespace App\Http\Traits\Padideh;


use App\Models\Petyar\Voucher;

trait VoucherTrait
{
    public function voucherIsValid($user,$code){

        $voucher = Voucher::getVoucher($code);

        if ($voucher && $voucher->isValid($user)){
            return $voucher;
        }else{
            return false;
        }
    }

    public function calculateVoucherAmount($voucher,$amount){
        $voucherDisAmount = (($amount / 100) * $voucher->percentage);

        if ($voucherDisAmount > $voucher->max_amount){
            $voucherDisAmount = $voucher->max_amount;
        }

        return $voucherDisAmount;
    }
}
