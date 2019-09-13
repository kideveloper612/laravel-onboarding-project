<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//custom
use App\Formdata;
use Illuminate\Support\Facades\DB;
use App\Formbuild;
use App\Link;
use Maatwebsite\Excel\Facades\Excel;


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
}
