<?php
namespace App\Repositories\Admin;

class AddressRepo {

    public function show($user){
        return view('padideh.address.show')->with([
            'user' => $user
        ]);
    }





}
