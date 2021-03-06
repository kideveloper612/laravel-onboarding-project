<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Formdata;
    
class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = auth()->user();       
        $userRole = DB::table('users')->where('id' ,'=', $user->id)->pluck('role')[0];

        if($userRole === 2) {
            $submissionData = $this->data_get($request);
            return view('admindashboard')->with('data', $submissionData);
        }
        else{            
            $submissionData = $this->data_get($request, $user->id);
            return view('dashboard')->with('data', $submissionData);
        }        
    }

    public function formselect(){

        $users = DB::table('formbuilds')->select('section')->get()->all();
        return view('home')->with('users', $users);

    }

    /**
     *remove submission of users
     */

    public function destroy($id){

    //For Deleting Users
        $subData = new Formdata;
        $subData = Formdata::find($id);
        $subData->delete($id);
        return response()->json([
        'success' => 'Record has been deleted successfully!'
    ]);
    }

    /**
     * get user submission for admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function data_get($request, $id = 0){
        $page_num = $request->get('page');

        if (isset($page_num)) $page_num = intval($page_num);
        else $page_num = 1;

        if($id == 0){
            $data = DB::table('formdatas')
                ->orderBy('updated_at', 'DESC')
                ->offset(($page_num - 1 ) * 10)
                ->limit(10)
                ->get();
            $titleData = DB::table('formdatas')
                ->orderBy('updated_at', 'DESC')
                ->get();
            $url = DB::table('links')
                ->orderBy('updated_at', 'DESC')
                ->get();
            $data = $data->toArray();
            $titleData = $titleData->toArray();

            $total = DB::table('formdatas')->count();
        }
        else {
            $data = DB::table('formdatas')
                //->where('userId', '=', $id)
                ->orderBy('updated_at', 'DESC')
                ->offset(($page_num-1)*10)
                ->limit(10)
                ->get();
            $titleData = DB::table('formdatas')
                //->where('userId', '=', $id)
                ->orderBy('updated_at', 'DESC')
                ->get();
            $url = DB::table('links')
                ->orderBy('updated_at', 'DESC')
                ->get();
            $data = $data->toArray();
            $titleData = $titleData->toArray();

            $total = DB::table('formdatas')->where('userId', '=', $id)->count();
        }

        // initialize for landing of login and register pages
        $content = [];
        $titleContent = [];

        foreach ($data as $key => $value) {
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
                'username' => $value->userName,
                'id' => $value->id
            );
            $answer = [];
            $label = [];
            $formContent = [];
        }
        foreach ($titleData as $key => $value) {
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
            
            $titleContent[] = array(
                'formContent' => json_encode($formContent),
                'id' => $value->id
            );
            $answer = [];
            $label = [];
            $formContent = [];
        }

        $section = json_decode(DB::table('formbuilds')->select('section')->get());
        $num = $header = $order = array();

        foreach ($section as $key => $value) {
            $num[$value->section] = 0;
        }
        foreach ($section as $key => $keyName) {
            if($keyName->section === 'Missed Call' || $keyName->section === 'TRHC Cancelled Call' || $keyName->section === 'Employee Late/Call In' || $keyName->section === 'Call In Complaint' || $keyName->section === 'Important information update' || $keyName->section === 'Late to Call (Over 5 minutes)'){
            foreach ($titleContent as $key => $value) {
                $sectionName = json_decode(get_object_vars(json_decode($value['formContent']))["answer"])[0];
                if($sectionName === $keyName->section)  $num[$keyName->section]++;
            }
            
            $header['title'] = $keyName->section;
            $header['num'] = $num[$keyName->section];
            $order[] = $header;
            }
        }

        $countQuestion = array();
        foreach ($order as $key => $value) {
            if($value['title'] === 'Late to Call (Over 5 minutes)') $countQuestion[0] = $value['num'];
            if($value['title'] === 'Missed Call') $countQuestion[1] = $value['num'];
            if($value['title'] === 'TRHC Cancelled Call') $countQuestion[2] = $value['num'];
            if($value['title'] === 'Employee Late/Call In') $countQuestion[3] = $value['num'];
            if($value['title'] === 'Call In Complaint') $countQuestion[4] = $value['num'];
            if($value['title'] === 'Important information update') $countQuestion[5] = $value['num'];
        }
        // $count = count($section);
        // for ($i=0; $i <$count ; $i++) { 
        //     for ($j=$i+1; $j <$count ; $j++) { 
        //         if($order[$i]['num'] < $order[$j]['num']){

        //             $exchangeTitle = $order[$i]['title'];
        //             $order[$i]['title'] = $order[$j]['title'];
        //             $order[$j]['title'] = $exchangeTitle;

        //             $exchangeNum = $order[$i]['num'];
        //             $order[$i]['num'] = $order[$j]['num'];
        //             $order[$j]['num'] = $exchangeNum;
        //         }
        //     }
        // }
        // $title = array(
        //     'first' => $countQuestion[0],
        //     'second' => $countQuestion[1],
        //     'third' => $countQuestion[2],
        //     'forth' => $countQuestion[3],
        //     'fifth' => $countQuestion[4],
        //     'sixth' => $countQuestion[5]
        // );
        $title = array(
            'first' => '',
            'second' => '',
            'third' => '',
            'forth' => '',
            'fifth' => '',
            'sixth' => ''
        );
        
        $array = array(
            'content' => json_encode($content),
            'title' => json_encode($title),
            'url' => json_encode($url->toArray()), 
            'next_page' => $page_num + 1,
            'prev_page' => $page_num - 1,
        );

        if (($page_num) * 10 > $total) $array['next_page'] = 0;
        if (($page_num - 1) < 1) $array['prev_page'] = 0;
        return $array;
    }
}
