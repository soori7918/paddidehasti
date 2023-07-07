<?php

namespace App\Http\Controllers\Padideh\Admin;

use App\Http\Controllers\Controller;
use App\Models\Padideh\Waste;
use App\Repositories\Admin\pasmandRepo;
use Illuminate\Http\Request;

class PasmandController extends Controller
{
    public $pasmandRepo;
    public function __construct(PasmandRepo $pasmandRepo)
    {
        $this->pasmandRepo = $pasmandRepo;
    }

    public function index()
    {
        return $this->pasmandRepo->all();
    }


    public function create()
    {
        return $this->pasmandRepo->create();

    }


    public function store(Request $request)
    {
        $waste = $this->pasmandRepo->store($request);
        if ($waste) {

            return \redirect()->route('panel.pasmands.index')->with([
                'success' => 'با موفقیت ثبت شد'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Waste $pasmand)
    {
        return $this->pasmandRepo->show($pasmand);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Waste $pasmand)
    {
        return $this->pasmandRepo->edit($pasmand);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Waste $pasmand)
    {
        $waste = $this->pasmandRepo->update($request,$pasmand);
        if ($waste) {

            return \redirect()->route('panel.pasmands.index')->with([
                'success' => 'با موفقیت ثبت شد'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Waste $pasmand)
    {
        $result = $this->pasmandRepo->destroy($pasmand);
        if ($result) {
            return \redirect()->back()->with([
                'success' => 'با موفقیت ثبت شد'
            ]);
        }
    }
}
