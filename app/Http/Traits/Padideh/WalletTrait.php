<?php


namespace App\Http\Traits\Padideh;

use App\Models\B2c\B2cShopOrderHead;
use App\Models\B2c\B2cWallet;
use App\Models\Base\BaseOnlinePayment;
use App\Models\DeliWed\UserWallet;
use Illuminate\Http\Request;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

trait WalletTrait
{
    public function userContractPrePayment($request, $contract)
    {
        UserWallet::createRecord($request, $contract, $contract->user, $contract->pre_payment,'پرداخت پیش پرداخت قرارداد', -1);
    }

    public function checkCreditPayment($request, $totalAmount)
    {
        if($request->payment_method == 1){//with credit
            $credit = $this->getUserCredit($request->user());
            if(intval($credit) < $totalAmount){
                return false;
            }
            return true;
        }
        return true;
    }

    public function checkOrderHeadCreditPayment($request, $totalAmount)
    {
        if($request->payment_method == 2){//with credit
            $credit = $this->getUserCredit($request->user());
            if(intval($credit) < $totalAmount){
                return false;
            }
            return true;
        }
        return true;
    }

    public function getUserCredit($user)
    {
        return B2cWallet::where('user_id', $user->id)->sum('price');
    }

    public function addUserCreditWalletPayment($orderHead, $request)
    {
        if($request->payment_method == 1){//with credit
            $this->addOrderHeadWallet($orderHead, $request);
            $orderHead->update([
                'sale_stat' => B2cShopOrderHead::READY_STATUS_NUMBER,
                'payment_step' => B2cShopOrderHead::SUCCESS_PAYED
            ]);
        }
    }

    public function addUserCancelOrderPayment($orderHead, $request)
    {
        $data = [
            'title' => 'بازگشت مبلغ پرداخت شده بابت لغو سفارش کاربر',
            'model' => $orderHead,
            'sign' => 1,
            'user' => $orderHead->b2c_user_id,
            'type' => 'pay_order_credit'
        ];

        B2cWallet::addPaymentRecord($request, $data);
    }

    public function cancelOrderPayment($request, $order, $business = null)
    {
        if($order->payment_method_id == 1){//with credit
            $title = 'بازگشت مبلغ سفارش به کیف پول بابت لغو سفارش';
            B2cWallet::createRecord($request, $order,$title, 'user', 1);

            if ($business) {
                $title = 'برداشت مبلغ از کیف پول بابت لغو سفارش توسط فروشگاه';
            } else {
                $title = 'برداشت مبلغ از کیف پول بابت لغو سفارش توسط کاربر';
            }
            B2cWallet::createRecord($request, $order, $title,'business-user', -1);
            B2cWallet::payCancelOrderHeadCommission($order, $request);
        }
    }

    public function addStoreCancelOrderPayment($orderHead, $request)
    {
        $data = [
            'title' => 'برداشت مبلغ پرداخت شده بابت لغو سفارش مشتری',
            'model' => $orderHead,
            'sign' => -1,
            'user' => $orderHead->business->b2c->id,
            'type' => 'pay_order_credit'
        ];

        B2cWallet::addPaymentRecord($request, $data);
    }

    public function addStoreCreditWalletPayment($orderHead, $request)
    {
        if($request->payment_method == 1){//with credit
            B2cWallet::payStoreOrderHead($orderHead, $request);
            B2cWallet::payOrderHeadCommission($orderHead, $request);
        }
    }

    public function addOrderHeadWallet($b2cShopOrderHead, $request)
    {
        B2cWallet::payOrderHead($b2cShopOrderHead, $request);
    }

    public function addStoreOrderHeadWallet($b2cShopOrderHead, $request)
    {
        B2cWallet::payStoreOrderHead($b2cShopOrderHead, $request);
    }

    public function addIncrementWallet($b2cShopOrderHead, $request)
    {
        B2cWallet::payOrderHead($b2cShopOrderHead, $request);
    }

    public function addCashRequestWallet($request)
    {
        B2cWallet::payOrderHead($request);
    }

    public function callZarinPal($request, $orderHead, $type){
        $invoice = (new Invoice)->amount(intval($request->amount));

        // Purchase and pay the given invoice.
        // You should use return statement to redirect user to the bank page.
        switch ($type){
            case 'app':
                $payment = Payment::callbackUrl(route('zarinppal.callback'))->purchase($invoice, function() use($invoice , $request) {
                    // Store transactionId in database as we need it to verify payment in the future.
                    //$baseOnlinePayment = BaseOnlinePayment::createPayment($invoice , $request);
                })->pay()->toJson();
                $payment = json_decode($payment, true);
                if(isset($payment['action']) ){
                    return $payment['action'];
                }else{
                    return $payment;
                }
                break;
            case 'panel':
                return $payment = Payment::callbackUrl(route('zarinppal.callback'))->purchase($invoice, function() use($invoice , $request , $b2cUser) {
                    // Store transactionId in database as we need it to verify payment in the future.
                    $baseOnlinePayment = BaseOnlinePayment::createPayment($invoice, $request, $b2cUser);
                })->pay()->render();
        }
    }

    public function callbackZarinPal($request){
        if($request->filled('Authority')){
            try {
                $baseOnlinePayment = BaseOnlinePayment::where('authority',$request->Authority)->first();
                if($baseOnlinePayment){
                    $receipt = Payment::amount($baseOnlinePayment->price / 10)->transactionId($request->Authority)->verify();
                    $b2cWallet = $this->addTransActionToWallet($baseOnlinePayment);
                    $baseOnlinePayment->update([
                        'reference_id' => $receipt->getReferenceId(),
                        'wallet_id' => $b2cWallet->id,
                        'step' => 2
                    ]);
                    //$this->addTransActionToWallet($baseOnlinePayment);
                }
                return redirect()->route('myb2c.financial.business-wallet.increment_wallet')->with('message', [ 'پرداخت شما با موفقیت انجام شد' , "success" ]);

            } catch (InvalidPaymentException $exception) {
                $baseOnlinePayment = BaseOnlinePayment::where('authority',$request->Authority)->first();
                if($baseOnlinePayment){
                    $baseOnlinePayment->update([
                        'step' => 3
                    ]);
                    //$this->addTransActionToWallet($baseOnlinePayment->wallet_id);
                }
                return redirect()->route('myb2c.financial.business-wallet.increment_wallet')->with('message', [ $exception->getMessage() , "danger" ]);
            }
        }
        return redirect()->route('myb2c.financial.business-wallet.increment_wallet')->with('message', [ 'مشکلی در پرداخت بوجود آمده است' , "danger" ]);
    }

    public function addTransActionToWallet($baseOnlinePayment){
         return B2cWallet::payIncrementWallet($baseOnlinePayment);
    }

    public function checkPayment($request, $baseOnlinePayment)
    {
        if ($baseOnlinePayment->payable_type == B2cWallet::class) {
            $action = B2cWallet::createRecord($request, $baseOnlinePayment, 'افزایش کیف پول', null, 1);
            $baseOnlinePayment->update([
                'payable_id' => $action->id
            ]);

            return true;
        } elseif ($baseOnlinePayment->payable_type == B2cShopOrderHead::class) {
            $order = B2cShopOrderHead::find($baseOnlinePayment->payable_id);
            if ($order and ($order->total_price + $order->send_price)== $baseOnlinePayment->price) {
                $order->update([
                    'payment_step' => B2cShopOrderHead::SUCCESS_PAYED
                ]);
                B2cWallet::createRecord($request, $order, 'افزایش کیف پول', 'user', 1);
                B2cWallet::createRecord($request, $order, 'کاهش کیف پول', 'user', -1);

                B2cWallet::createRecord($request, $order, 'افزایش کیف پول بابت پرداخت سفارش', 'business-user', 1);
                B2cWallet::payOrderHeadCommission($order, $request);

                return true;
            } elseif ($order) {
                $order->update([
                    'payment_step' => B2cShopOrderHead::HAVE_PROBLEM_PAYED
                ]);
                B2cWallet::createRecord($request, $baseOnlinePayment, 'افزایش کیف پول', null, 1);

                return false;
            }
        }
    }
}
