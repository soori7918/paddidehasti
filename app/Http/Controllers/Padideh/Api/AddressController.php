<?php

namespace App\Http\Controllers\Padideh\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Padideh\Api\StoreAddressRequest;
use App\Http\Resources\Padideh\AddressResource;
use App\Models\Padideh\Address;
use App\Repositories\AddressRepository;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    private $addressRepository;
    public function __construct(AddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }
    public function index(Request $request)
    {
        $addresses = AddressResource::collection($this->addressRepository->getIndex($request->user()));
        return $this->successResponse('لیست ادرس ها', $addresses);
    }

    public function store(StoreAddressRequest $request)
    {
        $address = $this->addressRepository->storeAddress($request);
        if ($address) {
            $addresses = AddressResource::collection($this->addressRepository->getIndex($request->user()));

            return $this->successResponse('ادرس با موفقیت ثبت شد', $addresses);
        }

        return $this->failedResponse('w', 'آدرس ثبت نشد دوباره تلاش کنید');
    }

    public function update(Address $address, StoreAddressRequest $request)
    {
        if ($address->user_id != $request->user()->id) {
            return $this->failedResponse('w', 'این آدرس متعلق به شما نمی باشد');
        }
        $result = $this->addressRepository->updateAddress($address, $request);
        if ($result) {
            return $this->successResponse('ادرس با موفقیت ویرایش شد');
        }

        return $this->failedResponse('w', 'آدرس ویرایش نشد دوباره تلاش کنید');
    }

    public function destroy(Address $address, Request $request)
    {
        if ($address->user_id != $request->user()->id) {
            return $this->failedResponse('w', 'این آدرس متعلق به شما نمی باشد');
        }
        $result = $this->addressRepository->deleteAddress($address);
        if ($result) {
            return $this->successResponse('ادرس با موفقیت حذف شد');
        }

        return $this->failedResponse('w', 'آدرس حذف نشد دوباره تلاش کنید');

    }
}
