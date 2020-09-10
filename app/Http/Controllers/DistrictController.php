<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\District as District;
use App\Country as Country;
use Illuminate\Support\Facades\DB;


class DistrictController extends Controller
{

    public function __construct( District $district, Country $country)
    {
                $this->district = $district;
                  $this->district_country = $country->all();
    }

    public function index()
    {
      //Get table districts with reference country name
      $districts=[];
      $districts['districts']=DB::table('districts')
            ->join('countries','districts.country_id','=','countries.id')
            ->select('districts.*', 'countries.country_name')
            ->orderBy('districts.district_name')
            ->get();


        //return $districts;
        return view('district/index', $districts);
    }

    public function delDistrict($district_id)
    {
      //Delete specified district from database
      District::destroy($district_id);
      //Redirect to index
      return redirect('district');

    }

    public function newDistrict(Request $request, District $district)
    {
        $data=[];

        //Get data from form and set data array
        $data['district_name']=$request->input('district_name');
        $data['district_description']=$request->input('district_description');
        $data['country_id']=$request->input('district_country_id');

        //Validate form
        if( $request->isMethod('post') )
        {
          $this->validate(
            $request,
            [
              'district_name'=>'required|min:3',
              'district_description'=>'required',
              'district_country_id'=>'required',
            ]
          );
          //return $data; //Testing
          $district->insert($data);
          //Redirect to index
          return redirect('district');

        }
        //Load district data if not submitted
        $data['districts']=$this->district;
        //Load alla country names from class
        $data['countries']=$this->district_country;
        $data['modify']=0;
        //return $data; //Testing
        return view('district/form', $data);
    }

    public function show($district_id, Request $request)
    {
      //Get district id vaiabel and set the data array
      $data=[]; $data['district_id']=$district_id;
      //Load alla country names from class
      $data['countries']=$this->district_country;

      //Set modify flag to 1
      $data['modify']=1;

      //Find district record that = to id
      $district_data=$this->district->find($district_id);
      //Find country id for chososen districts
      $key=$district_data->country_id;
      //Set data array to country key
      $data['district_country_id']=$district_data->country_id;
      //Ser data array to country name
      $data['district_country_name']=Country::find($key)->country_name;
      //Set $data array with district attributes
      $data['district_name']=$district_data->district_name;
      $data['district_description']=$district_data->district_description;
      /*
      $request->session()->put('last_updated', $district_data->district_id.' '.
      $district_data->districtname);
      */
      //return $data; //Testing output
      return view('district/form', $data);
    }

    public function modify(Request $request, $district_id, District $district)
    {
        $data=[];

        //Get data from form and set data array
        $data['district_name']=$request->input('district_name');
        $data['district_description']=$request->input('district_description');
        $data['district_country_id']=$request->input('district_country_id');
        //Validate form
        if( $request->isMethod('post') )
        {
          //dd($data);
          $this->validate(
            $request,
            [
              'district_name'=>'required|min:3',
              'district_description'=>'required',
              'district_country_id'=>'required',
            ]
          );

          $district_data=$this->district->find($district_id);


          $district_data->district_name=$request->input('district_name');
          $district_data->district_description=$request->input('district_description');
          $district_data->country_id=$request->input('district_country_id');
          //return $district_data;

          $district_data->save();
          //$data['modify']=0;
          return redirect('district');

        }
        $data['districts']=$this->district;
        $data['modify']=0;
        //return $data;
        //return view('district/form', $data);
    }


}
