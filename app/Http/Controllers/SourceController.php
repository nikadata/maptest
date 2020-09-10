<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Source as Source;

class SourceController extends Controller
{
    //
    public function __construct( Source $source )
    {
                $this->source = $source;
    }

    public function index()
    {
      $data=[];

        $data['sources']=$this->source->all()->sortBy("source_name");
        return view('source/index', $data);
    }

    public function newSource(Request $request, Source $source)
    {
        $data=[];

        //Get data from form and set data array
        $data['source_name']=$request->input('source_name');
        $data['source_description']=$request->input('source_description');

        //Validate form
        if( $request->isMethod('post') )
        {
          $this->validate(
            $request,
            [
              'source_name'=>'required|min:3',
              'source_description'=>'required',
            ]
          );
          //return $data; //Testing
          $source->insert($data);
          //Redirect to index
          return redirect('source');

        }
        //Load district data if not submitted
        $data['source']=$this->source;
        //Load alla source names from class
        //$data['countries']=$this->district_source;
        $data['modify']=0;
        //return $data; //Testing
        return view('source/form', $data);
    }

    public function show($source_id, Request $request)
    {

      //Set modify flag to 1
      $data['modify']=1;

      //Find source record that = id
      $data['source']=$this->source->find($source_id);
      /*
      $request->session()->put('last_updated', $district_data->district_id.' '.
      $district_data->districtname);
      */

      //return $data; //Testing output

      //Return to view. Passing dataformat $source->
      return view('source/form', $data);
    }

    public function modify(Request $request, $source_id)
    {
        $data=[];

        //Get data from form and set data array
        $data['source_name']=$request->input('source_name');
        $data['source_description']=$request->input('source_description');
        //Validate form
        if( $request->isMethod('post') )
        {
            $this->validate(
            $request,
            [
              'source_name'=>'required|min:3',
              'source_description'=>'required',
            ]
          );
          //Get the source from db
          $source_data=$this->source->find($source_id);
          //Update db-record with form data
          $source_data->source_name=$request->input('source_name');
          $source_data->source_description=$request->input('source_description');
          //Testing
          //return $source_data;

          $source_data->save();
          //$data['modify']=0;
          return redirect('source');

        }
        //If form not saved -> get source from db-record
        $data['source']=$this->source;
        $data['modify']=0;
        return $data;
        //return view('district/form', $data);
    }

    //Delete recod method
    public function delSource($source_id)
    {
      //Delete specified district from database
      Source::destroy($source_id);
      //Redirect to index
      return redirect('source');

    }

}
