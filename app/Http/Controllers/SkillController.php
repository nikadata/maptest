<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Skill\Skill as Skill;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SkillController extends Controller
{
    //
    public function __construct( Skill $skill )
    {
                $this->skill = $skill;
    }

    public function index()
    {
      $data=[];

      //  $data['skills']=$this->skill->all();
          $data['skills']=DB::table('skills')
                          ->orderBy('skills.skill_name')
                          ->get();

        return view('skills/index', $data);
    }

    public function newSkill(Request $request, Skill $skill)
    {
        $data=[];

        //Get data from form and set data array
        $data['skill_name']=$request->input('skill_name');
        $data['skill_description']=$request->input('skill_description');
        //Time and date
        $data['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
        $data['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();

        //Validate form
        if( $request->isMethod('post') )
        {
          $this->validate(
            $request,
            [
              'skill_name'=>'required|min:3',
              'skill_description'=>'required',
            ]
          );
          //return $data; //Testing
          $skill->insert($data);
          //Redirect to index
          return redirect('skill');

        }
        //Load district data if not submitted
        $data['skill']=$this->skill;
        //Load alla skill names from class
        //$data['countries']=$this->district_skill;
        $data['modify']=0;
        //return $data; //Testing
        return view('skills/form', $data);
    }

    public function show($skill_id, Request $request)
    {

      //Set modify flag to 1
      $data['modify']=1;

      //Find skill record that = id
      $data['skill']=$this->skill->find($skill_id);
      /*
      $request->session()->put('last_updated', $district_data->district_id.' '.
      $district_data->districtname);
      */

      //return $data; //Testing output

      //Return to view. Passing dataformat $skill->
      return view('skills/form', $data);
    }

    public function modify(Request $request, $skill_id)
    {
        $data=[];

        //Get data from form and set data array
        $data['skill_name']=$request->input('skill_name');
        $data['skill_description']=$request->input('skill_description');
        //Validate form
        if( $request->isMethod('post') )
        {
            $this->validate(
            $request,
            [
              'skill_name'=>'required|min:3',
              'skill_description'=>'required',
            ]
          );
          //Get the skill from db
          $skill_data=$this->skill->find($skill_id);
          //Update db-record with form data
          $skill_data->skill_name=$request->input('skill_name');
          $skill_data->skill_description=$request->input('skill_description');
          //Testing
          //return $skill_data;

          $skill_data->save();
          //$data['modify']=0;
          return redirect('skill');

        }
        //If form not saved -> get skill from db-record
        $data['skill']=$this->skill;
        $data['modify']=0;
        return $data;
        //return view('district/form', $data);
    }

    //Delete recod method
    public function delSkill($skill_id)
    {
      //Delete specified district from database
      Skill::destroy($skill_id);
      //Redirect to index
      return redirect('skill');

    }

}
