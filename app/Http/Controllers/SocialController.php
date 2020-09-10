<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SocialClass as Social;

class SocialController extends Controller
{
    //
    public function __construct( Social $social )
    {
                $this->social = $social;
    }

    public function index()
    {
      $data=[];

        $data['socials']=$this->social->all();
        return view('social/index', $data);
    }

    public function newSocial(Request $request, Social $social)
    {
        $data=[];

        //Get data from form and set data array
        $data['social_name']=$request->input('social_name');
        $data['social_description']=$request->input('social_description');

        //Validate form
        if( $request->isMethod('post') )
        {
          $this->validate(
            $request,
            [
              'social_name'=>'required|min:3',
              'social_description'=>'required',
            ]
          );
          //return $data; //Testing
          $social->insert($data);
          //Redirect to index
          return redirect('social');

        }
        //Load district data if not submitted
        $data['social']=$this->social;
        //Load alla social names from class
        //$data['countries']=$this->district_social;
        $data['modify']=0;
        //return $data; //Testing
        return view('social/form', $data);
    }

    public function show($social_id, Request $request)
    {

      //Set modify flag to 1
      $data['modify']=1;

      //Find social record that = id
      $data['social']=$this->social->find($social_id);
      /*
      $request->session()->put('last_updated', $district_data->district_id.' '.
      $district_data->districtname);
      */

      //return $data; //Testing output

      //Return to view. Passing dataformat $social->
      return view('social/form', $data);
    }

    public function modify(Request $request, $social_id)
    {
        $data=[];

        //Get data from form and set data array
        $data['social_name']=$request->input('social_name');
        $data['social_description']=$request->input('social_description');
        //Validate form
        if( $request->isMethod('post') )
        {
            $this->validate(
            $request,
            [
              'social_name'=>'required|min:3',
              'social_description'=>'required',
            ]
          );
          //Get the social from db
          $social_data=$this->social->find($social_id);
          //Update db-record with form data
          $social_data->social_name=$request->input('social_name');
          $social_data->social_description=$request->input('social_description');
          //Testing
          //return $social_data;

          $social_data->save();
          //$data['modify']=0;
          return redirect('social');

        }
        //If form not saved -> get social from db-record
        $data['social']=$this->social;
        //$data['modify']=0;
        return $data;
        //return view('district/form', $data);
    }

    //Delete recod method
    public function delSocial($social_id)
    {
      //Delete specified district from database
      Social::destroy($social_id);
      //Redirect to index
      return redirect('social');

    }

}
