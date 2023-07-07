<?php

namespace App\Http\Controllers\Padideh\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Padideh\Api\UpdateUserRequest;
use App\Http\Resources\Padideh\AddressResource;
use App\Http\Resources\Padideh\UserResource;
use App\Http\Traits\FileUploadTrait;
use App\Models\Padideh\MyAddresses;
use App\Models\Padideh\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use FileUploadTrait;
    public function init(Request $request)
    {
        return $this->successResponse('اطلاعات پایه کاربر', new UserResource($request->user()));
    }

    public function updateProfile(UpdateUserRequest $request)
    {
        $user = $request->user();
        $user->update([
            'first_name' => $request->first_name ?? $user->first_name,
            'last_name' => $request->last_name ?? $user->last_name,
        ]);

        return $this->successResponse('اطلاعات کاربر به روز شد', new UserResource($user), 'اطلاعات کاربر به روز شد');
    }

    public function updateFirebase(Request $request)
    {
        $user = $request->user();
        $user->update([
            'firebase_token' => $request->firebase_token ?? $user->firebase_token,

        ]);

        return $this->successResponse('firebase کاربر به روز شد', new UserResource($user),'firebase کاربر به روز شد');
    }

    public function getCities(Request $request)
    {
        return $this->successResponse('search cities', City::where('name', 'like', '%'.$request->search.'%')->select('id','name')->get());
    }

   

 
}
