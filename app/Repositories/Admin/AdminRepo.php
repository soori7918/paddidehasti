<?php
namespace App\Repositories\Admin;

use App\Http\Resources\Padideh\V1\AdminCollection;
use App\Models\Padideh\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminRepo {

    public function all(){
        return Admin::latest()->paginate(20);
    }

    public function create()
    {
        return view('Padideh.admins.create');
    }

    public function store($request)
    {
        return Admin::create([
            'name' => $request->name,
            'family' => $request->family,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'access_status' => $request->access_status ? true : false,
        ]);
    }

    public function show($admin)
    {
        return view('Padideh.admins.show')->with([
            'admin' => $admin
        ]);
    }
    public function edit($admin)
    {
        return view('Padideh.admins.edit')->with([
            'admin' => $admin
        ]);
    }

    public function update($request,$admin){
        return $admin->update([
            'name' => $request->name,
            'family' => $request->family,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => Hash::make($request->password) ?: $admin->password,
            'access_status' => $request->access_status ? true : false,
        ]);
    }

    public function destroy($admin)
    {
       $admin->delete();
    }


    public function search($request)
    {
        switch($request->catId){
            case 'phone':
                return $admins = Admin::where('phone','like',"%$request->search%")->get();
                break;
            case 'family':
                return $admins = Admin::where('family','like',"%$request->search%")
                ->orWhere('name','like',"%$request->search%")->get();
                break;
            case 'role':
                return $admins = Admin::where('name','like',"%$request->search%");
                break;
            default : $this->all();
            break;
        }
       
    }

    public function getAdmins($request) {
        $start = 0;
        if ((isset($request['start'])) && (! is_null($request['start'])) && ($request['start'] != '') && (is_numeric($request['start']))) {
            $start = (int)$request['start'];
        }
        $length = 10;
        if ((isset($request['length'])) && (! is_null($request['length'])) && ($request['length'] != '') && (is_numeric($request['length']))) {
            $length = (int)$request['length'];
        }

        $adminQuery = Admin::query();
        if ((isset($request['search_like'])) && (! is_null($request['search_like'])) && ($request['search_like'] != '')) {
            $adminQuery = $adminQuery->where(function($query) use ($request) {
                $query->where('mobile' , 'LIKE' , '%'.$request['search_like'].'%')
                      ->orWhere('name' , 'LIKE' , '%'.$request['search_like'].'%')
                      ->orWhere('family' , 'LIKE' , '%'.$request['search_like'].'%');
            });
        } else {
            $adminQuery = $adminQuery->orderBy('id', 'desc');
        }
        $resultsCount = [
            'total_admins' => $adminQuery->count() ,
            // 'start' => $start ,
            // 'length' => $length
        ];

        $adminsResult = $adminQuery->get();
        $admins = [];
        foreach ($adminsResult as $admin) {
            array_push($admins, (new AdminCollection($admin))->resolve());
        }

        $response = [
            'results_count' => $resultsCount ,
            'admins'      => $admins
        ];
        return responseGenerator()->success($response);
        
    }


}
