<?php

namespace App\Http\Controllers;

use App\Phone;
use App\Formdata;
use App\Formbuild;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forms = DB::table('formbuilds')->select('id', 'section', 'phone')->get()->all();
        return view('phone')->with('forms', $forms);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $all = $request->all();
        $id = $all['addId'];
        $phone = $all['addphone'];
        $data = new Formbuild();
        $data::where('id', $id)->update(array('phone' => $phone));
        return 'Successfully Added!';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $phoneData  = DB::table('formbuilds')->where('id' ,'=', $request->get('id'))->select('id', 'section', 'phone')->get();
        return $phoneData;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function edit(Phone $phone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Phone $phone)
    {
        $all = $request->all();
        $id = $all['updateId'];
        $phone = $all['updatephone'];
        $data = new Formbuild();
        $data::where('id', $id)->update(array('phone' => $phone));
        return 'Successfully Updated!';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Phone $phone)
    {
        dd('here');
        $all = $request -> all();
        $id = $add['deleteId'];
        $data = new Formbuild();
        $data::where('id', $id)->update(array('phone' => ''));
        return 'Successfully Deleted!';
    }
}
