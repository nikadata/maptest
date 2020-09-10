<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\District as District;
use App\County as County;
use App\Source as Source;
use Illuminate\Support\Facades\DB;

class CountyController extends Controller
{
    //
    public function __construct( County $county, District $district, Source $sources)
    {
                $this->county = $county;
                $this->county_district = $district->all()->sortBy("district_name");
                $this->sources = $sources->all()->sortBy("source_name");
    }

    public function index(District $district, Source $sources)
    {
      //Get table countys with reference district name
      $countys=[];

      $countys['counties']=DB::table('counties')
            ->join('districts','counties.district_id','=','districts.id')
            ->join('sources as s1','counties.source_id','=','s1.id')
            ->join('sources as s2','counties.source2_id','=','s2.id')
            ->select('counties.*', 'districts.district_name','s1.source_name as s1_name','s2.source_name as s2_name')
            ->orderBy('counties.county_name')
            ->get();
        $countys;
        return view('county/index', $countys);
    }

    public function delCounty($county_id)
    {
      //Delete specified county from database
      County::destroy($county_id);
      //Redirect to index
      return redirect('county');

    }

    public function newCounty(Request $request, County $county)
    {
        $data=[];

        //Get data from form and set data array
        $data['county_name']=$request->input('county_name');
        $data['county_description']=$request->input('county_description');
        $data['district_id']=$request->input('county_district_id');
        $data['source_id']=$request->input('source');
        $data['source2_id']=$request->input('source2');

        //Validate form
        if( $request->isMethod('post') )
        {
          $this->validate(
            $request,
            [
              'county_name'=>'required|min:3',
              'county_description'=>'required',
              'county_district_id'=>'required',
            ]
          );
          //return $data; //Testing
          $county->insert($data);
          //Redirect to index
          return redirect('county');

        }
        //Load county data if not submitted
        $data['countys']=$this->county;
        //Load alla district names from class
        $data['districts']=$this->county_district;
        $data['sources']=$this->sources;
        $data['modify']=0;
        //return $data; //Testing
        return view('county/form', $data);
    }

    public function show($county_id, Request $request)
    {
      //Get county id vaiabel and set the data array
      $data=[]; $data['county_id']=$county_id;
      //Load alla district names from class
      $data['districts']=$this->county_district;
      $data['sources']=$this->sources;

      //Set modify flag to 1
      $data['modify']=1;

      //Find county record that = to id
      $county_data=$this->county->find($county_id);
      //Find district id for chososen countys
      $key=$county_data->district_id;
      //Set data array to district key
      $data['county_district_id']=$county_data->district_id;
      //Ser data array to district name
      $data['county_district_name']=District::find($key)->district_name;
      //Set $data array with county attributes
      $data['county_name']=$county_data->county_name;
      $data['county_description']=$county_data->county_description;
      $data['source1_id']=$county_data->source_id;
        $data['source2_id']=$county_data->source2_id;
      $key=$data['source1_id'];
        $key2=$data['source2_id'];
      $data['source1']=$this->sources->find($key);
        $data['source2']=$this->sources->find($key2);
      /*
      $request->session()->put('last_updated', $county_data->county_id.' '.
      $county_data->countyname);
      */
      //return $data; //Testing output
      return view('county/form', $data);
    }

    public function modify(Request $request, $county_id, County $county)
    {
        $data=[];

        //Get data from form and set data array
        $data['county_name']=$request->input('county_name');
        $data['county_description']=$request->input('county_description');
        $data['county_district_id']=$request->input('county_district_id');
        //Validate form
        if( $request->isMethod('post') )
        {
          //dd($data);
          $this->validate(
            $request,
            [
              'county_name'=>'required|min:3',
              'county_description'=>'required',
              'county_district_id'=>'required',
            ]
          );

          $county_data=$this->county->find($county_id);


          $county_data->county_name=$request->input('county_name');
          $county_data->county_description=$request->input('county_description');
          $county_data->district_id=$request->input('county_district_id');
          $county_data->source_id=$request->input('source');
            $county_data->source2_id=$request->input('source2');
          //return $county_data;

          $county_data->save();
          //$data['modify']=0;
          return redirect('county');

        }
        $data['countys']=$this->county;
        $data['modify']=0;
        //return $data;
        //return view('county/form', $data);
    }


}
