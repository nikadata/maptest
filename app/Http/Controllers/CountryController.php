<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country as Country;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;


class CountryController extends Controller
{
    //
    public function __construct( Country $country )
    {
                $this->country = $country;

    }
    

    //Orginal
    public function index()
    {
      $data=[];

        $data['countries']=$this->country->all();
        return view('country/index', $data);
    }

    public function newCountry(Request $request, Country $country)
    {
        $data=[];

        //Get data from form and set data array
        $data['country_name']=$request->input('country_name');
        $data['country_population']=$request->input('country_population');
        $data['country_description']=$request->input('country_description');

        //Validate form
        if( $request->isMethod('post') )
        {
          $this->validate(
            $request,
            [
              'country_name'=>'required|min:3',
              'country_population'=>'required',
              'country_description'=>'required',
            ]
          );
          //return $data; //Testing
          $country->insert($data);
          //Redirect to index
          return redirect('country');

        }
        //Load district data if not submitted
        $data['country']=$this->country;
        //Load alla country names from class
        //$data['countries']=$this->district_country;
        $data['modify']=0;
        //return $data; //Testing
        return view('country/form', $data);
    }

    public function show($country_id, Request $request)
    {

      //Set modify flag to 1
      $data['modify']=1;

      //Find country record that = id
      $data['country']=$this->country->find($country_id);
      /*
      $request->session()->put('last_updated', $district_data->district_id.' '.
      $district_data->districtname);
      */

      //return $data; //Testing output

      //Return to view. Passing dataformat $country->
      return view('country/form', $data);
    }

    public function modify(Request $request, $country_id)
    {
        $data=[];

        //Get data from form and set data array
        $data['country_name']=$request->input('country_name');
        $data['country_population']=$request->input('country_population');
        $data['country_description']=$request->input('country_description');
        //Validate form
        if( $request->isMethod('post') )
        {
            $this->validate(
            $request,
            [
              'country_name'=>'required|min:3',
              'country_population'=>'required',
              'country_description'=>'required',
            ]
          );
          //Get the country from db
          $country_data=$this->country->find($country_id);
          //Update db-record with form data
          $country_data->country_name=$request->input('country_name');
          $country_data->country_population=$request->input('country_population');
          $country_data->country_description=$request->input('country_description');
          //Testing
          //return $country_data;

          $country_data->save();
          //$data['modify']=0;
          return redirect('country');

        }
        //If form not saved -> get country from db-record
        $data['country']=$this->country;
        $data['modify']=0;
        return $data;
        //return view('district/form', $data);
    }

    //Delete recod method
    public function delCountry($country_id)
    {
      //Delete specified district from database
      Country::destroy($country_id);
      //Redirect to index
      return redirect('country');

    }


}
