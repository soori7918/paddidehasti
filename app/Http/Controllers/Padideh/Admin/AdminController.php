<?php

namespace App\Http\Controllers\Padideh\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Padideh\Admin\AdminRequest;
use App\Http\Requests\Padideh\Admin\UpdateAdminRequest;
use App\Models\Padideh\Admin;
use App\Repositories\Admin\AdminRepo;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public $adminRepo;
    public function __construct(AdminRepo $adminRepo)
    {
        $this->AdminRepo = $adminRepo;
    }
    public function index()
    {
        $admins = $this->AdminRepo->all();
        return view('Padideh.admins.index')->with([
            'admins' => $admins
        ]);
    }

    public function create()
    {
        return $this->AdminRepo->create();
    }

    public function store(AdminRequest $request)
    {
        $this->AdminRepo->store($request);
        return \redirect()->route('panel.admins.index')->with([
            'success' => 'با موفقیت ثبت شد'
        ]);
    }

    public function show(Admin $admin)
    {
        return $this->AdminRepo->show($admin);

    }

    public function edit(Admin $admin)
    {
        return $this->AdminRepo->edit($admin);
    }

    public function update(UpdateAdminRequest $request,Admin $admin)
    {
        $this->AdminRepo->update($request,$admin);
        return \redirect()->route('panel.admins.index')->with([
            'success' => 'با موفقیت ثبت شد'
        ]);
    }

    public function destroy(Admin $admin)
    {
       $this->AdminRepo->destroy($admin);
       return back()->with([
           'success' => 'با موفقیت حذف شذ',
       ]);
    }

    public function search(Request $request)
    {
        $admins =  $this->AdminRepo->search($request);
        return $admins ;
       
       
        
    }

    public function getAdminsTable(Request $request)
    {
        $this->validate($request, [
            // 'start'         => 'required|numeric|min:0',
            // 'length'        => 'required|numeric|min:0|max:100',
            'search_like'   => 'nullable|string',
            // 'order_by'      => 'nullable|in:id_asc,id_desc,username_asc,username_desc,firstname_asc,firstname_desc,lastname_asc,lastname_desc,mobile_asc,mobile_desc,created_asc,created_desc',
        ]);

        $admins_result = $this->AdminRepo->getAdmins($request);
        // $request->merge(['start' => 0]);
        return DataTables::collection($admins_result['data']['body']['admins'])->setTotalRecords($admins_result['data']['body']['results_count']['total_admins'])->make(true);
      

    }
}
