<?php

namespace App\Http\Controllers\Padideh\Admin;

use App\Http\Controllers\Controller;
use App\Models\Padideh\User;
use App\Repositories\AddressRepository;
use App\Repositories\Admin\AddressRepo;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    private $address_repo ;
    public function __construct(AddressRepo $address_repo)
    {
        $this->address_repo = $address_repo;
    }
    public function show(User $user){
        return $this->address_repo->show($user);
    }
}
