<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Hash;

class UserController extends Controller
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
    public function index()
    {
        $users = DB::table('users')->get()->all();
        foreach ($users as $key => $userInfo) {
            if($userInfo->role === 2)
            unset($users[$key]);
        }
        return view('usermanage') -> with('user', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newUser = $request->all();

        $new = new User;
        $new->name = $newUser['newUserName'];
        $new->email = $newUser['newUserEmail'];
        $new->phoneNumber = $newUser['newUserPhone'];
        $new->password = Hash::make('123456789');
        $new->save();

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $userEditInfo = DB::table('users')->where('id', '=', $id)->get()->all();
        return json_encode($userEditInfo);
        // return view('usermanage') -> with('user', $userEditInfo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo "edit";exit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userUpdate(Request $request, $id)
    {
        $staff = User::find($id);
        $staff->name = $request->input('editName');
        $staff->email = $request->input('editEmail');
        $staff->phoneNumber = $request->input('editPhone');
        $staff->save();

        return redirect()->back();
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
        $password = $request->all()['newPassword'];
        
        $staff = User::find($id);
        $staff->password = Hash::make($password);
        $staff->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subData = new User;
        $subData = User::find($id);
        $subData->delete($id);
        return response()->json([
        'success' => 'Record has been deleted successfully!'
    ]);
    }
}
