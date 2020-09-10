<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link as Link;
use App\GroupType as GroupType;
use App\Household as Household;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LinkController extends Controller
{
    //
    public function __construct( Link $link, Household $household, GroupType $grouptypes )
    {
                $this->link = $link;
                $this->household = $household;
                $this->groupetype=$grouptypes;

    }

    public function index(Link $link)
    {
      $data=[];
      $data['links']=$this->link->all();

      return view('link/index', $data);
    }

    public function link($household_id, Request $request, Link $link)
    {
      $insert=[];
      if( $request->isMethod('post') )
      if($request->input('rel_id')==$household_id){
        return 'Trying to link an household with the identical houshold';
      }
      {
      if(!empty($link_data=$this->link->find($household_id))){
        $data=$link_data->group;
        $data_type=$link_data->relation;
        $add=$request->input('rel_id');
        $add_type=$request->input('rel_type');
        //Check if id is in group
        $cdata=$data;
        $check=explode(',',$cdata);
        foreach($check as $task){
          if($task==$add){
            return "Household exist already in group relation";
          }
        }
        $data.=','.$add;
        $data_type.=','.$add_type;
        $link_data->group=$data;
        $link_data->relation=$data_type;
        $link_data->save();
        //Grouping Algorithm
        //Convert to arrays
        $key=explode(',',$data);
        $key_type=explode(',',$data_type);
        //Count length of $key
        $group=count($key);
        //Add household id at the end of arrays
        array_push($key,$household_id);
        $reltype=$key_type[0]; //The firt relationtype in array
        array_push($key_type,$reltype);

        for($i=0;$i<$group;$i++){
            //Removes the first element from $key, and returns the value of the removed element
            $shift=array_shift($key);
            //return $key_type;
            $shift_type=array_shift($key_type);

            //Check if linkid exist, if so update
            if(!empty($link_data=$this->link->find($shift))){
              $data=$link_data->group;
              $data_type=$link_data->relation;
              $add=$request->input('rel_id');
              $add_type=$request->input('rel_type');
              $data.=','.$add;
              $data_type.=','.$add_type;
              $link_data->group=$data;
              $link_data->relation=$data_type;
              $link_data->save();
              array_push($key,$shift);
              array_push($key_type,$shift_type);
              }
            else{
              $insert['id']=$shift;
              $key=implode(",",$key);
              $key_type=implode(",",$key_type);
              $insert['group']=$key;
              $insert['relation']=$key_type;
              $insert['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
              $insert['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
              $link->insert($insert);
              //Update linked flag
              $linked_flag=$this->household->find($shift);
              $linked_flag->linked=1;
              $linked_flag->save();
              //
              $key=explode(',',$key);
              $key_type=explode(',',$key_type);
              array_push($key,$shift);
              array_push($key_type,$shift_type);
            }
          }

      }

      //If there is no id in linkstable
      else{
        // Check if rel_id exist in linkstable
        $flag=0;
        if(!empty($link_data=$this->link->find($request->input('rel_id')))){
          //Load existing linked data
          $data=$link_data->group;
          $data_type=$link_data->relation;
          $add=$household_id;
          $add_type=$request->input('rel_type');
          //First add the linking id and rel_type
          //$data=$add.','.$data;
          //$data_type=$add_type.','.$data_type;
          $data.=','.$add;
          $data_type.=','.$add_type;

          $link_data->group=$data;
          $link_data->relation=$data_type;
          $link_data->save();
          //Save other linked group data
          //Convert to array
          $data=explode(',',$data);
          $data_type=explode(',',$data_type);
          //count array
          $group=count($data)-1;
          for($i=0;$i<$group;$i++){
            //Remove first element
            $key=array_shift($data);
            $key_type=array_shift($data_type);
            //Find object in linkstable
              $link_data=$this->link->find($key);
              $link_data->group.=','.$add;
              $new_group=$link_data->group;
              $new_id=$link_data->id;
              $link_data->relation.=','.$add_type;
              $new_rel=$link_data->relation;
              $link_data->save();
          }

          // Insert the new id in linkstable
          $insert['id']=$household_id;
          $link_data=$this->link->find($new_id);
          $data=$link_data->group;
          $data_type=$link_data->relation;
          //Convert to array
          $data=explode(',',$data);
          $data_type=explode(',',$data_type);

          array_pop($data);
          array_pop($data_type);
          array_push($data,$new_id);
          array_push($data_type,$key_type);
          $data=implode($data,',');
          $data_type=implode($data_type,',');
          $insert['group']=$data;
          $insert['relation']=$data_type;
          $insert['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
          $insert['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
          $link->insert($insert);
          //Linked flag
          $linked_flag=$this->household->find($household_id);
          $linked_flag->linked=1;
          $linked_flag->save();
          $flag=1;
        }
        if($flag==0){
        //Else insert the new id and link in linkstable
        $insert['id']=$household_id;
        $insert['group']=$request->input('rel_id');
        $insert['relation']=$request->input('rel_type');
        $insert['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
        $insert['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
        $link->insert($insert);
        //Linked flag
        $linked_flag=$this->household->find($household_id);
        $linked_flag->linked=1;
        $linked_flag->save();
        //
        $insert['id']=$request->input('rel_id');
        $insert['group']=$household_id;
        $insert['relation']=$request->input('rel_type');
        $insert['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
        $insert['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
        $link->insert($insert);
        //Linked flag
        $linked_flag=$this->household->find($request->input('rel_id'));
        $linked_flag->linked=1;
        $linked_flag->save();
      }

      }

      return redirect('households');
      }
    }
    public function show($household_id, Request $request, Link $link)
    {
      //Create array
      $data=[];
      //household id
      $data['household_id']=$household_id;
      //Load household data
      $data['alls']=$this->household->all();
      $data['grouptypes']=$this->groupetype->all();
      $household_data=$this->household->find($household_id);
      $data['number']=$household_data->number;
      $data['name']=$household_data->name;
      //Modify status
      $data['modify']=0;
      $data['var']=0;
      $data['k']=0;
      //Load link data
      if(!empty($vektor=$this->link->find($household_id))){
      //Activate linked flag
      $data['linked']=1;
      //Convert to array
      $x=$vektor['group'];
      $y=$vektor['relation'];
      $key=explode(',',$x);
      $key_rel=explode(',',$y);
      //Push to array
      foreach($key as $id){
        $tack[]=$this->household->find($id);
      }
      //Load relation
      //$data['relation']=$vektor->relation;
      $data['relations']=$key_rel;
      $data['links']=$tack;

      //return $data;
      return view('link/form', $data);
    }
      else {
        $data['linked']=0;
        return view('link/form', $data);
      }
    }


}
