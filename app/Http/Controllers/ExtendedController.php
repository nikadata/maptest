<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Extended as Extended;

class ExtendedController extends Controller
{
    //
    public function __construct( Extended $extended )
    {
                $this->extended = $extended;
    }
    public function index()
    {
      $data=[];

        $data['extendeds']=$this->extended->all();
        return view('extended/index', $data);
    }
    public function newExtended(Request $request, Extended $extended)
    {
        $data=[];

        //Get data from form and set data array
        $data['type']=$request->input('extended_name');
        $data['extended_description']=$request->input('extended_description');

        //Validate form
        if( $request->isMethod('post') )
        {
          $this->validate(
            $request,
            [
              'extended_name'=>'required|min:3',
              'extended_description'=>'required',
            ]
          );
          //return $data; //Testing
          $extended->insert($data);
          //Redirect to index
          return redirect('extended');

        }
        //Load district data if not submitted
        $data['extended']=$this->extended;
        //Load alla extended names from class
        //$data['countries']=$this->district_extended;
        $data['modify']=0;
        //return $data; //Testing
        return view('extended/form', $data);
    }
    public function show($extended_id, Request $request)
    {

      //Set modify flag to 1
      $data['modify']=1;

      //Find extended record that = id
      $data['extended']=$this->extended->find($extended_id);
      /*
      $request->session()->put('last_updated', $district_data->district_id.' '.
      $district_data->districtname);
      */

      //return $data; //Testing output

      //Return to view. Passing dataformat $extended->
      return view('extended/form', $data);
    }
    public function modify(Request $request, $extended_id)
    {
        $data=[];

        //Get data from form and set data array
        $data['type']=$request->input('extended_name');
        $data['extended_description']=$request->input('extended_description');
        //Validate form
        if( $request->isMethod('post') )
        {
            $this->validate(
            $request,
            [
              'extended_name'=>'required|min:3',
              'extended_description'=>'required',
            ]
          );
          //Get the extended from db
          $extended_data=$this->extended->find($extended_id);
          //Update db-record with form data
          $extended_data->type=$request->input('extended_name');
          $extended_data->extended_description=$request->input('extended_description');
          //Testing
          //return $extended_data;

          $extended_data->save();
          //$data['modify']=0;
          return redirect('extended');

        }
        //If form not saved -> get extended from db-record
        $data['extended']=$this->extended;
        $data['modify']=0;
        return $data;
        //return view('district/form', $data);
    }
    //Delete recod method
    public function delExtended($extended_id)
    {
      //Delete specified district from database
      Extended::destroy($extended_id);
      //Redirect to index
      return redirect('extended');

    }

}
