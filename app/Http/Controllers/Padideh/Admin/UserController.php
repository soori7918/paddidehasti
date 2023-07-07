<?php

namespace App\Http\Controllers\Padideh\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Padideh\Admin\UpdateUserRequest;
use App\Http\Requests\Padideh\Admin\UserRequest;
use App\Models\Padideh\User;
use App\Repositories\Admin\UserRepo;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    public $UserRepo;
    public function __construct(UserRepo $UserRepo)
    {
        $this->userRepo = $UserRepo;
    }

    public function index()
    {
        $users = $this->userRepo->all();
        return view('Padideh.users.index')->with([
            'users' => $users
        ]);
    }


    public function create()
    {
        return $this->userRepo->create();

    }


    public function store(UserRequest $request)
    {
        $user = $this->userRepo->store($request);
        if($user)
        {
            return \redirect()->route('panel.users.index')->with([
                'success' => 'با موفقیت ثبت شد'
            ]);
        }
    }


    public function show(User $user)
    {
        return $this->userRepo->show($user);

    }


    public function edit(User $user)
    {
        return $this->userRepo->edit($user);

    }


    public function update(UpdateUserRequest $request,User $user)
    {
        $this->userRepo->update($request,$user);
        return \redirect()->route('panel.users.index')->with([
            'success' => 'با موفقیت ثبت شد'
        ]);
    }


    public function destroy(User $user)
    {
        $this->userRepo->destroy($user);
       return back()->with([
           'success' => 'با موفقیت حذف شذ',
       ]);
    }

  
}
