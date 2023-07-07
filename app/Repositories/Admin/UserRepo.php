<?php
namespace App\Repositories\Admin;
use App\Models\Padideh\User;
use Illuminate\Support\Facades\Hash;

class UserRepo {

    public function all(){
        return User::latest()->paginate(15);
    }

    public function create()
    {
        return view('Padideh.users.create');
    }

    public function store($request)
    {
        return User::create([
            'name' => $request->name,
            'family' => $request->family,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => $request->password,
            'access_status' => $request->input('access_status') ? true : false,
        ]);
    }
    public function show($user)
    {
        return view('Padideh.users.show')->with([
            'user' => $user
        ]);
    }
    public function edit($user)
    {
        return view('Padideh.users.edit')->with([
            'user' => $user
        ]);
    }

    public function update($request,$user){
        return $user->update([
            'name' => $request->name,
            'family' => $request->family,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => Hash::make($request->password) ?: $user->password,
            'access_status' => $request->access_status ? true : false,
        ]);
    }


    public function destroy($user)
    {
       $user->delete();
    }


 

}
