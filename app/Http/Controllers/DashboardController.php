<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//custom
use App\Formdata;
use Illuminate\Support\Facades\DB;
use App\Formbuild;


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
    
    public function index(){
        $users = DB::table('formdatas')->select('formContent')->get();
        print_r($users);    	
    }

    public function show(){
        $user= auth()->user();
        $data = DB::table('formdatas')->where('userId', '=', $user->id)->orderBy('updated_at', 'DESC')->get();
        $content = [];
        foreach (json_decode($data) as $key => $value) {
            $answerRecord = array_values(get_object_vars(json_decode(json_decode($value->formContent)->answer)));
            $labelRecord = array_values(json_decode(json_decode($value->formContent)->label));
            foreach ($answerRecord as $answerValue) {
                $answer[] = $answerValue;
            }
            foreach ($labelRecord as $labelValue) {
                $label[] = $labelValue;                
            }
            $formContent = array(
                'label' => json_encode($label),
                'answer' => json_encode($answer)
            );
            
            $content[] = array(
                'timestamp' => $value->updated_at,
                'formContent' => json_encode($formContent),
                'username' => $value->userName
            );
            $answer = [];
            $label = [];
            $formContent = [];
        }

        $section = json_decode(DB::table('formbuilds')->select('section')->get());
        $num = $header = array();
        foreach ($section as $key => $value) {
            $num[$value->section] = 0;
        }
        foreach ($section as $key => $keyName) {
            foreach ($content as $key => $value) {
                $sectionName = json_decode(get_object_vars(json_decode($value['formContent']))["answer"])[0];
                if($sectionName === $keyName->section)  $num[$keyName->section]++;
            }
            $header['title'] = $keyName->section;
            $header['num'] = $num[$keyName->section];
            $order[] = $header;
        }

        $count = count($section);
        for ($i=0; $i <$count ; $i++) { 
            for ($j=$i+1; $j <$count ; $j++) { 
                if($order[$i]['num'] < $order[$j]['num']){

                    $exchangeTitle = $order[$i]['title'];
                    $order[$i]['title'] = $order[$j]['title'];
                    $order[$j]['title'] = $exchangeTitle;

                    $exchangeNum = $order[$i]['num'];
                    $order[$i]['num'] = $order[$j]['num'];
                    $order[$j]['num'] = $exchangeNum;
                }
            }
        }

        $title = array(
            'first' => $order[0],
            'second' => $order[1],
            'third' => $order[2],
            'forth' => $order[3]
        );

        $array = array(
            'content' => json_encode($content),
            'title' => json_encode($title)
        );
      
        return view('dashboard')->with('data', $array);
    }
}
