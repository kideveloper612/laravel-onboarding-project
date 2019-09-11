<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Formbuild;
use DB;
use Session;

class BuildController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $formData = Session::get('formData');
        if($formData){
            Session::forget('formData');
            return view('formBuild')->with('formData', $formData);
        }
        else{
            return view('formBuild');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $forms = DB::table('formbuilds')->select('id', 'section')->get()->all();
        return $forms;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $array = json_decode($request->get('payload'));

        if ($array[0]->type === 'header'){
            $data = new Formbuild();
            $data -> form = $request->get('payload');
            $data -> section = $array[0]->label;
            $data -> save();
           
            echo "Successfully Saved!";
        } 
        else {
            echo "Failed to save this form! Please put a Header Component on the first step.";
            exit;
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $req, $id)
    {
        $formData = Formbuild::find($req->section)->form;
        Session::put('formData', $formData);
        $formDelete = Formbuild::find($req->section);
        $formDelete->delete($req->section);
        return redirect('formBuild');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd('here arrival');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req, $id)
    {
        $form = new Formbuild;
        $form = Formbuild::find($req->section);
        $form -> delete($req->section);
        return redirect()->back();
    }
}
