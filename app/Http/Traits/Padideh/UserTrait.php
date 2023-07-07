<?php


namespace App\Http\Traits\Padideh;

use App\Models\Padideh\{
    Admin,
    User
};
use Illuminate\Support\Facades\Auth;

trait UserTrait
{
    public function userWithMobileExists($mobile){
        return User::where('mobile','=',$mobile)->first();
    }

    public function createAdmin($user, $roleId)
    {
        return Admin::create([
            'admin_role_id' => $roleId,
            'name' => $user->first_name,
            'family' => $user->last_name,
            'email' => $user->email?? '',
            'mobile' => $user->mobile_number,
            'password' => bcrypt($user->mobile_number)
        ]);
    }

    public function checkAdmin($user)
    {
        return Admin::where('mobile', $user->mobile_number)->first();
    }

    public function createAdminMarket($customer, $admin)
    {
        return PasmandMarketer::create([
            'admin_id' => $admin->id,
            'pasmand_customer_id' => $customer->id,
        ]);
    }

    public function deleteAdminMarket($customer)
    {
        $marketer = PasmandMarketer::where('pasmand_customer_id', $customer->id)->first();
        if($marketer){
            $marketer->admin->delete();
            $marketer->delete();
        }
    }

    public function checkUserLeadLocationInfo($mobile)
    {
        $marketPlace = PasmandLocationLead::where('person_mobile', $mobile)->first();
        if($marketPlace){
            $marketer = $marketPlace->marketer;
            if($marketer){
                return $marketer->pasmand_customer_id;
            }
        }
        return NULL;
    }

    public function changeUserCredit($user , $amount)
    {
        $user->update([
            'credit' => $user->credit + $amount
        ]);
    }

    public function customerCreditAction($customer, $amount, $description, $type)
    {
        $title = $description . ' - کاربر '. Auth::user()->name.' '.Auth::user()->family;
        $turnoverType = 'CustomerCreditChange';
        $customerTurnover = CustomerTurnover::submitTurnover($title,$customer,'CustomerCreditChange',Auth::user()->id,$turnoverType);
        if($type){
            $customerTurnover->addDetail('دریافت اعتباری بابت '. $description,$amount,true);
            $this->changeUserCredit($customer , $amount);
        }else{
            $customerTurnover->addDetail('کاهش اعتباری بابت '. $description,-1 *$amount,true);
            $this->changeUserCredit($customer , -1 * $amount);
        }
    }

    public function customerProductCreditAction($customer, $description, $products)
    {
        $totalAmount = 0;
        $title = $description . ' - توسط کاربر '. Auth::user()->name.' '.Auth::user()->family;
        $turnoverType = 'CustomerCreditChange';
        $customerTurnover = CustomerTurnover::submitTurnover($title,$customer,PasmandProductCustomer::class,Auth::user()->id,$turnoverType);
        foreach ($products as $product) {
            $type = $product['count'] >= 0 ? 'کاهش اعتباری بابت ': 'افزایس اعتباری بابت';
            $totalAmount += -1 * $product['count'] * $product['price'];
            $newDescription = $type.' - '.$product['name'] .' به تعداد '.$product['count'].' عدد و به قیمت '.$product['price'];
            $customerTurnover->addDetail($newDescription, -1* $product['count'] * $product['price'], true);
        }
        $this->changeUserCredit($customer, $totalAmount);

        return $customerTurnover;
    }

    public function driverCreditAction($customer, $amount, $description, $type)
    {
        $title = $description . ' - کاربر '. Auth::user()->name.' '.Auth::user()->family;
        $turnoverType = 'DriverCreditChange';
        $customerTurnover = DriverTurnover::submitTurnover($title,$customer,'DriverCreditChange',Auth::user()->id,$turnoverType);
        if($type){
            $customerTurnover->addDetail('دریافت اعتباری بابت '. $description,$amount,true);
            $this->changeUserCredit($customer , $amount);
        }else{
            $customerTurnover->addDetail('کاهش اعتباری بابت '. $description,-1 *$amount,true);
            $this->changeUserCredit($customer , -1 * $amount);
        }
    }

    public function getCustomerSubsets($admin)
    {
        $ids = [];
        if($admin->admin_role_id >= 6){
            $marketer = PasmandMarketer::with('customer')->where('admin_id', $admin->id)->first();
            if($marketer){

                $allSubsetCustomers = Customer::with('role.user')->where('referral_customer_id', $marketer->pasmand_customer_id)
                    ->doesntHave('marketer')->get();
                foreach ($allSubsetCustomers as $subsetCustomer){
                    $ids [] = $subsetCustomer->role->user->id;
                }

                $allSubsetMarketers = Customer::with('role.user')->where('referral_customer_id', $marketer->pasmand_customer_id)
                    ->whereHas('marketer')->get();
                $allSubsetMarketerIds = [];
                foreach ($allSubsetMarketers as $subsetMarketer){
                    $ids [] = $subsetMarketer->role->user->id;
                    $allSubsetMarketerIds [] = $subsetMarketer->id;
                }

                $allSubsetMarketerCustomers = Customer::whereIn('referral_customer_id', $allSubsetMarketerIds)
                    ->get();
                foreach ($allSubsetMarketerCustomers as $subsetMarketerCustomer){
                    $ids [] = $subsetMarketerCustomer->role->user->id;
                }
            }
        }
        return $ids;
    }

    public function getMarketerCustomersUsers($users)
    {
        $ids = [];
        foreach ($users as $user){
            if($user->userRoleCustomer){
                $subsetCustomers = Customer::with('role.user')->where('referral_customer_id', $user->userRoleCustomer->customer->id)
                    ->select('id')->get();
                foreach ($subsetCustomers as $subsetCustomer){
                    $ids [] = $subsetCustomer->role->user->id;
                }
            }
        }
        return $ids;
    }

    public function getRegionAreaOfAddress($lat , $lng)
    {
        $area = '';
        $region = PasmandMantageh::whereRaw('ST_CONTAINS(ST_GeomFromGeoJSON(`position_array`) , POINT(' . $lng . ', ' . $lat . '))')
            ->select('id')
            ->first();

        if ($region) {
            $area = PasmandNahie::where('pasmand_mantageh_id', $region->id)
                ->whereRaw('ST_CONTAINS(ST_GeomFromGeoJSON(`position_array`) , POINT(' . $lng . ', ' . $lat . '))')
                ->select('id','area_id')
                ->first();
        }else{
            $area = PasmandNahie::whereRaw('ST_CONTAINS(ST_GeomFromGeoJSON(`position_array`) , POINT(' . $lng . ', ' . $lat . '))')
                ->select('id','area_id', 'pasmand_mantageh_id')
                ->first();
            if($area) {
                return [
                    'region' => $area->pasmand_mantageh_id ?? null,
                    'area' => $area->area_id ?? null,
                ];
            } else {

                $innerRadius = PasmandInfo::find(10);
                $innerArea = PasmandNahie::where('name', 'like','%'.'ناحیه حومه'.'%')->first();

                if ($innerRadius and $innerArea) {
                    $location = $innerArea->position_array;
                    $distance = $this->getDistance(floatval($lat), floatval($lng),  floatval($location['lat']), floatval($location['lng']), 'KM');

                    if ($distance <= floatval($innerRadius->value)) {

                        return [
                            'region' => $innerArea->pasmand_mantageh_id ?? null,
                            'area' => $innerArea->area_id ?? null,
                        ];
                    } else {

                        $outerArea = PasmandNahie::where('name','like' ,'%'.'ناحیه خارج از حومه'.'%')->first();
                        $location = $outerArea->position_array;
//                        $distance = $this->getDistance($lat, $lng, $location['lat'], $location['lng'], 'KM');

                            return [
                                'region' => $outerArea->pasmand_mantageh_id ?? null,
                                'area' => $outerArea->area_id ?? null,
                            ];
                    }
                }
            }
        }

        return [
            'region' => $region->id ?? null,
            'area' => $area->area_id ?? null,
        ];
    }

    public function getDistance($lat1 , $lng1, $lat2 , $lng2, $unit)
    {
        $theta = $lng1 - $lng2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        switch ($unit) {
            case "KM":
                return ($miles * 1.609344);
            default:
                return $miles;
        }
    }
}
