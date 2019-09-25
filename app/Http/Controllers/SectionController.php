<?php

namespace App\Http\Controllers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use App\Formdata;
use App\User;
use App\Link;
use DB;
use Twilio\Rest\Client;

class SectionController extends Controller
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
     * Display a section with questions.
     *
     * @return \Illuminate\Http\Response
     */   
    public function show(Request $request)
    {
        // Session::flush();
        // Session::put('sectionName', $request->get('section'));
        $sectionName = $request->get('section');
        $formdata = DB::table('formbuilds')->where('section', '=', $sectionName)->pluck('form')[0];
        $data = array(
            "section" => $sectionName,
            "formdata" => $formdata
        );
        
        return view('section')->with('data', $data);
    }

    public function store(Request $request){

         // Get file for uploading
        $file = $request->file('fileName');

        if($file){
            // File Details
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();
$test= explode('/', base_path());
array_pop($test); $baseUrl = implode('/', $test);
$baseUrl = $baseUrl."/logs/uploads";

$file->move($baseUrl, $filename);
            // file upload
            //$path = $request->file('fileName')->storeAs('public', $filename);
            $array = $request->all();
            $array['fileName'] = $filename;
/*
            // Save Links
            $url = asset("uploads/".$filename);

            //$url = asset("storage/".$filename);
            $userId= auth()->user()->id;
            $link = new Link;
            $link->userID = $userId;
            $link->linkName = $filename;
            $link->link = $url;

            $link->save();
*/
        } else {
            $array = $request->all();
        }
        
        
        //Get label of all elements
        $formdata = DB::table('formbuilds')->where('section', '=', $request->get('section'))->pluck('form')[0];
            foreach (json_decode($formdata) as $value) {
                if($value->type !== "paragraph" && $value->type !== "header"){
                    $labelInput[] = $value->label;
                }
                if($value->type === 'header') $headerName = $value->label;            
            }

        $formContent = array(
            'label' => json_encode($labelInput),
            'answer' => json_encode($array)
        );

        $labelcount = $contentcount = 0;
        $text = $headerName;
        foreach ($labelInput as $labelkey => $labelvalue) {
            $temp = '';
            $labelcount++;
            foreach ($array as $arraykey => $arrayvalue) {
                if($labelcount === $contentcount){                    
                    $temp = $labelvalue.":".$arrayvalue;
                }
                $contentcount++;
            }
            $text = $text."\n".$temp;
            $contentcount = 0;
        }

        // Save data submitted in database
        $user= auth()->user();
        $userName = DB::table('users')->where('id', '=', $user->id)->pluck('name')[0];
        $formDataSave = new Formdata();
        $formDataSave->userId = $user->id;
        $formDataSave->userName = $userName;
        $formDataSave->formContent = json_encode($formContent);
        
        $formDataSave -> save();

        $userphone = DB::table('users')->where('id', '=', $user->id)->pluck('phoneNumber')[0];

        // Account SID and Auth Token from twilio.com/console
        $sid    = env( 'TWILIO_SID' );
        $token  = env( 'TWILIO_TOKEN' );
        $client = new Client( $sid, $token );

        if($userphone){
            $client->messages->create(
                $userphone,
                [
                'from' => env( 'TWILIO_FROM' ),
                'body' => $text,
                ]
            );
        } 

        $formName = $request->get('section');
        if($formName === "Maintenance Needed (Reported by Crew)" || $formName === "Maintenance Completed"){
            $client->messages->create(
                "+19362043111",
                [
                'from' => env( 'TWILIO_FROM' ),
                'body' => $text,
                ]
            );
            
        }

        if($formName === "Missed call" || $formName === "Employee Late/Call In" || $formName ==="Call In Complaint" ){
            $client->messages->create(
                "+19364447437",
                [
                'from' => env( 'TWILIO_FROM' ),
                'body' => $text,
                ]
            );
        }
        $text = '';
        return redirect()->route('dashboard')->with("Successfully message sent!");
    }
}
