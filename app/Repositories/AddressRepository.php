<?php
namespace App\Repositories;

use App\Models\Padideh\Address;

class AddressRepository {

    public function getIndex($user)
    {
        return $user->addresses()->orderByDesc('updated_at')->get();
    }

    public function storeAddress($request)
    {
        return Address::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'address' => $request->address,
            'user_name' => $request->user_name,
            'user_mobile' => $request->user_mobile,
            'lat' => $request->lat,
            'long' => $request->long,
        ]);
    }

    public function updateAddress($address, $request)
    {
        return $address->update([
            'title' => $request->title,
            'address' => $request->address,
            'user_name' => $request->user_name,
            'user_mobile' => $request->user_mobile,
            'lat' => $request->lat,
            'long' => $request->long,
        ]);
    }

    public function deleteAddress($address)
    {
        return $address->delete();
    }
}
