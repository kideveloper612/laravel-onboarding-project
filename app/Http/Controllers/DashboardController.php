<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//custom
use App\Formdata;
use Illuminate\Support\Facades\DB;
use App\Formbuild;
use App\Link;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
use Illuminate\Support\Facades\Schema;


use App\ExportFile;

class DashboardController extends Controller
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

    // Link save
    public function Link(Request $request){

        // Get file for uploading
        $file = $request->file('uploadFile');

        // File Details
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $mimeType = $file->getMimeType();

        // file upload
        $path = $file->storeAs('public', $filename);

        // Save Links
        $url = asset("storage/".$filename);

        $userId= 0;
        $link = new Link;
        $link->userID = $userId;
        $link->linkName = $request->get('newLinkName');
        $link->link = $url;

        $link->save();

        return redirect()->back();        
    }

    public function AddLink(Request $request){
        $userId= 0;
        $link = new Link;
        $link->userID = $userId;
        $link->linkName = $request->get('newAddLinkName');
        $link->link = $request->get('newAddLinkUrl');

        $link->save();

        return redirect()->back();   
    }

    // Get List of Link for Removing
    public function linkRemoveList(){
        $link = DB::table('links') -> select('id', 'linkName') -> get();
        echo $link;
    }

    // Link Remove
    public function linkRemove(Request $request){

        $link = Link::find($request->get('linkList'));
        $link->delete();

        return redirect()->back();
    }

    // Export Excel
    public function exportExcel(){

        $data = $this->excel_data();
        $header = []; //headers
        
        $excel = Excel::download(new ExportFile($data, $header), "excel.xlsx");
        return $excel;
    }

    private function excel_data(){       
        
        $data = DB::table('formdatas')
            ->orderBy('updated_at', 'DESC')                
            ->get();

        $titleData = DB::table('formdatas')
            ->orderBy('updated_at', 'DESC')
            ->get();
        $data = $data->toArray();
        $titleData = $titleData->toArray();
        
        // initialize for landing of login and register pages
        $record = [];
       
        foreach ($data as $key => $value) {
            $answerRecord = array_values(get_object_vars(json_decode(json_decode($value->formContent)->answer)));
            $labelRecord = array_values(json_decode(json_decode($value->formContent)->label));

            array_splice( $labelRecord, 0, 0, "Timestamp");
            array_splice( $labelRecord, 1, 0, "Event" );
            array_push($labelRecord, "Submitted by");

            array_unshift($answerRecord, $value->updated_at);
            array_push($answerRecord, $value->userName);

            $record[] = $labelRecord;
            $record[] = $answerRecord;

            $answerRecord = [];
            $labelRecord = [];
        }

        return $record;          
    }

    // User sortting
    
    public function userSortting(){
        $section = DB::table('formbuilds')->select('section')->get();
        $allUserRecord = array();
        $head = array(
            '0' => "USERNAME",
        );
        foreach ($section as $key => $value) {
            array_push($head, $value->section);
        }
        array_push($allUserRecord, $head);
        $user = DB::table('users')->where('role' ,'=', '1')->select('id', 'name')->get();
        foreach ($user as $userkey => $uservalue) {
            $userRecord = array();
            $allRecords = DB::table('formdatas')->select('userId', 'formContent')->get();
            foreach ($allRecords as $allkey => $allvalue) {

                if($uservalue->id === $allvalue->userId){
                    array_push($userRecord, $allvalue);
                }
            }
            $sectionArray = array(
                '0' => $uservalue->name,
            );
            $section = DB::table('formbuilds')->select('section')->get();
            foreach ($section as $sectionkey => $sectionvalue) {
                $section = 0;
                foreach ($userRecord as $usersectionkey => $usersectionvalue) {
                    $sectionName = json_encode(get_object_vars(json_decode(json_decode(
                               $usersectionvalue->formContent)->answer))['section']);
                    $temp = json_encode($sectionvalue->section);
                    if($sectionName === $temp) $section++;
                }
                array_push($sectionArray, $section);
            }

            array_push($allUserRecord, $sectionArray);
            $sectionArray = array();    
            $userRecord = array();
        }
        $data = $allUserRecord;
        $allUserRecord = array();
        return view('userSortting') -> with('data', $data);
        
    }
}